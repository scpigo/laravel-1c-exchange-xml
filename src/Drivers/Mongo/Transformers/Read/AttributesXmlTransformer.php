<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Transformers\Read;

use League\Fractal\TransformerAbstract;
use Scpigo\Laravel1cXml\Helpers\XmlExchangeFields;
use Illuminate\Support\Arr;

class AttributesXmlTransformer extends TransformerAbstract {
    public function transform(array $data) {
        return [
	        XmlExchangeFields::NAME => Arr::get($data, 'name'),
            XmlExchangeFields::VALUE => Arr::get($data, 'value'),
	    ];
    }
}