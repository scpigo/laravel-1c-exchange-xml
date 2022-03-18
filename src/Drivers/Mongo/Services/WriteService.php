<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Mtownsend\XmlToArray\XmlToArray;
use Scpigo\Laravel1cXml\Drivers\Mongo\Transformers\OrderListTransformer;
use Scpigo\Laravel1cXml\Drivers\Mongo\Transformers\OrderModelTransformer;
use Scpigo\Laravel1cXml\Services\Interfaces\WriteInterface;
use Spatie\Fractal\Facades\Fractal;
use Spatie\Fractalistic\ArraySerializer;

class WriteService implements WriteInterface {
    public function write(
        string $local_disk_driver, 
        string $local_path,
        string $filename
    ) {
        $xml = Storage::disk($local_disk_driver)->get($local_path.$filename);

        $data = XmlToArray::convert($xml);

        $array = Fractal::create()
            ->item($data, new OrderListTransformer())
            ->serializeWith(new ArraySerializer())
            ->toArray();
        
        $models = Fractal::create()
            ->item($array, new OrderModelTransformer())
            ->serializeWith(new ArraySerializer())
            ->toArray();

        $order_model = Arr::get($models, 'order');
        $products_models = Arr::get($models, 'products');

        $order_model->save();

        foreach ($products_models as $value) {
            $model = Arr::get($value, 'product');
            $model->save();
        }
    }
}