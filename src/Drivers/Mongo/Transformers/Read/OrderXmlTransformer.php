<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Transformers\Read;

use League\Fractal\TransformerAbstract;
use Scpigo\Laravel1cXml\Helpers\XmlExchangeFields;
use Illuminate\Support\Arr;
use Spatie\Fractal\Facades\Fractal;
use Spatie\Fractalistic\ArraySerializer;

class OrderXmlTransformer extends TransformerAbstract {
    public function transform(array $data) {
        $array_products = Fractal::create()
            ->collection(Arr::get($data, 'products.product') , new ProductsXmlTransformer())
            ->serializeWith(new ArraySerializer())
            ->toArray();

        $array_attributes = Fractal::create()
            ->collection(Arr::get($data, 'attributes_values.attribute_value') , new AttributesXmlTransformer())
            ->serializeWith(new ArraySerializer())
            ->toArray();

        return [
	        XmlExchangeFields::UID => Arr::get($data, 'uid'),
            XmlExchangeFields::NUMBER => Arr::get($data, 'number'),
            XmlExchangeFields::DATE => Arr::get($data, 'date'),
            XmlExchangeFields::OPERATION => Arr::get($data, 'operation'),
            XmlExchangeFields::ROLE => Arr::get($data, 'role'),
            XmlExchangeFields::CURRENCY => Arr::get($data, 'currency'),
            XmlExchangeFields::RATE => Arr::get($data, 'rate'),
            XmlExchangeFields::SUM => Arr::get($data, 'sum'),
            XmlExchangeFields::TIME => Arr::get($data, 'time'),
            XmlExchangeFields::COMMENT => Arr::get($data, 'comment'),
            XmlExchangeFields::COUNTERPARTY => [
                XmlExchangeFields::UID => data_get($data, 'counterparty.uid'),
                XmlExchangeFields::NAME => data_get($data, 'counterparty.name'),
                XmlExchangeFields::ROLE => data_get($data, 'counterparty.role'),
                XmlExchangeFields::FULL_NAME => data_get($data, 'counterparty.full_name')
            ],
            XmlExchangeFields::PRODUCTS => [
                XmlExchangeFields::PRODUCT => $array_products
            ],
            XmlExchangeFields::ATTRIBUTES_VALUES => [
                XmlExchangeFields::ATTRIBUTE_VALUE => $array_attributes
            ]
	    ];
    }
}