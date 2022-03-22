<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Transformers\Write;

use League\Fractal\TransformerAbstract;
use Illuminate\Support\Arr;
use Scpigo\Laravel1cXml\Drivers\Mongo\Models\OrdersProduct;

class ProductsModelTransformer extends TransformerAbstract {
    private $order_id;

    public function __construct(int $order_id)
    {
        $this->order_id = $order_id;
    }

    public function transform(array $data) {
        $model = new OrdersProduct();

        $model->nextid();

        $model->order_id = $this->order_id;
        $model->uid = Arr::get($data, 'uid');
        $model->vendor_code = Arr::get($data, 'vendor_code');
        $model->name = Arr::get($data, 'name');
        $model->base_unit = Arr::get($data, 'base_unit');
        $model->unit_price = Arr::get($data, 'unit_price');
        $model->quantity = Arr::get($data, 'quantity');
        $model->cost = Arr::get($data, 'cost');
        $model->attributes_values = Arr::get($data, 'attributes_values');

        return [
            'product' => $model
        ];
    }
}