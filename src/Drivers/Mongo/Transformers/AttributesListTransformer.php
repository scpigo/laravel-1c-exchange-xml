<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Transformers;

use League\Fractal\TransformerAbstract;
use Scpigo\Laravel1cXml\Helpers\XmlExchangeFields;
use Illuminate\Support\Arr;

class AttributesListTransformer extends TransformerAbstract {
    public function transform(array $data) {
        return [
	        'name' => Arr::get($data, XmlExchangeFields::NAME),
            'value' => Arr::get($data, XmlExchangeFields::VALUE),
	    ];
    }
}