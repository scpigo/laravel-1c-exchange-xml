<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Transformers\Read;

use League\Fractal\TransformerAbstract;
use Scpigo\Laravel1cXml\Helpers\XmlExchangeFields;
use Illuminate\Support\Arr;
use Spatie\Fractal\Facades\Fractal;
use Spatie\Fractalistic\ArraySerializer;

class ProductsXmlTransformer extends TransformerAbstract {
    public function transform(array $data) {
        $array_attributes = Fractal::create()
            ->collection(Arr::get($data, 'attributes_values.attribute_value') , new AttributesXmlTransformer())
            ->serializeWith(new ArraySerializer())
            ->toArray();

        return [
	        XmlExchangeFields::UID => Arr::get($data, 'uid'),
            XmlExchangeFields::VENDOR_CODE => Arr::get($data, 'vendor_code'),
            XmlExchangeFields::NAME => Arr::get($data, 'name'),
            XmlExchangeFields::BASE_UNIT => Arr::get($data, 'base_unit'),
            XmlExchangeFields::UNIT_PRICE => Arr::get($data, 'unit_price'),
            XmlExchangeFields::QUANTITY => Arr::get($data, 'quantity'),
            XmlExchangeFields::COST => Arr::get($data, 'cost'),
            XmlExchangeFields::ATTRIBUTES_VALUES => [
                XmlExchangeFields::ATTRIBUTE_VALUE => $array_attributes
            ]
	    ];
    }
}