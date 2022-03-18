<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Transformers;

use League\Fractal\TransformerAbstract;
use Scpigo\Laravel1cXml\Helpers\XmlExchangeFields;
use Illuminate\Support\Arr;

class OrderListTransformer extends TransformerAbstract {
    protected $defaultIncludes = [
        'products',
        'attributes_values'
    ];

    public function transform(array $data) {
        return [
	        'uid' => Arr::get($data, XmlExchangeFields::UID),
            'number' => Arr::get($data, XmlExchangeFields::NUMBER),
            'date' => Arr::get($data, XmlExchangeFields::DATE),
            'operation' => Arr::get($data, XmlExchangeFields::OPERATION),
            'role' => Arr::get($data, XmlExchangeFields::ROLE),
            'currency' => Arr::get($data, XmlExchangeFields::CURRENCY),
            'rate' => Arr::get($data, XmlExchangeFields::RATE),
            'sum' => Arr::get($data, XmlExchangeFields::SUM),
            'time' => Arr::get($data, XmlExchangeFields::TIME),
            'comment' => Arr::get($data, XmlExchangeFields::COMMENT),
            'counterparty' => [
                'uid' => data_get($data, XmlExchangeFields::COUNTERPARTY.'.'.XmlExchangeFields::UID),
                'name' => data_get($data, XmlExchangeFields::COUNTERPARTY.'.'.XmlExchangeFields::NAME),
                'role' => data_get($data, XmlExchangeFields::COUNTERPARTY.'.'.XmlExchangeFields::ROLE),
                'full_name' => data_get($data, XmlExchangeFields::COUNTERPARTY.'.'.XmlExchangeFields::FULL_NAME)
            ]
	    ];
    }

    public function includeProducts(array $data)
    {
        $products = data_get($data, XmlExchangeFields::PRODUCTS.'.'.XmlExchangeFields::PRODUCT);

        return $this->collection($products, new ProductsListTransformer);
    }

    public function includeAttributesValues(array $data)
    {
        $attributes = data_get($data, XmlExchangeFields::ATTRIBUTES_VALUES.'.'.XmlExchangeFields::ATTRIBUTE_VALUE);

        return $this->collection($attributes, new AttributesListTransformer);
    }
}