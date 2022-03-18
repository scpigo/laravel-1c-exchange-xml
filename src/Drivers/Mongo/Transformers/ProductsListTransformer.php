<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Transformers;

use League\Fractal\TransformerAbstract;
use Scpigo\Laravel1cXml\Helpers\XmlExchangeFields;
use Illuminate\Support\Arr;

class ProductsListTransformer extends TransformerAbstract {
    protected $defaultIncludes = [
        'attributes_values'
    ];

    public function transform(array $data) {
        return [
	        'uid' => Arr::get($data, XmlExchangeFields::UID),
            'vendor_code' => Arr::get($data, XmlExchangeFields::VENDOR_CODE),
            'name' => Arr::get($data, XmlExchangeFields::NAME),
            'base_unit' => Arr::get($data, XmlExchangeFields::BASE_UNIT),
            'role' => Arr::get($data, XmlExchangeFields::ROLE),
            'currency' => Arr::get($data, XmlExchangeFields::CURRENCY),
            'rate' => Arr::get($data, XmlExchangeFields::RATE),
	    ];
    }

    public function includeAttributesValues(array $data)
    {
        $attributes = data_get($data, XmlExchangeFields::ATTRIBUTES_VALUES.'.'.XmlExchangeFields::ATTRIBUTE_VALUE);

        return $this->collection($attributes, new AttributesListTransformer);
    }
}