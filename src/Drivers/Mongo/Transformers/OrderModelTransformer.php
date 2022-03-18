<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Transformers;

use League\Fractal\TransformerAbstract;
use Illuminate\Support\Arr;
use Scpigo\Laravel1cXml\Drivers\Mongo\Models\Order;

class OrderModelTransformer extends TransformerAbstract {
    private $order_id;

    protected $defaultIncludes = [
        'products'
    ];

    public function transform(array $data) {
        $model = new Order();

        $model->nextid();
        $this->order_id = $model->id;

        $model->uid = Arr::get($data, 'uid');
        $model->number = Arr::get($data, 'number');
        $model->date = Arr::get($data, 'date');
        $model->operation = Arr::get($data, 'operation');
        $model->role = Arr::get($data, 'role');
        $model->currency = Arr::get($data, 'currency');
        $model->rate = Arr::get($data, 'rate');
        $model->sum = Arr::get($data, 'sum');
        $model->time = Arr::get($data, 'time');
        $model->comment = Arr::get($data, 'comment');
        $model->counterparty = Arr::get($data, 'counterparty');
        $model->attributes_values = Arr::get($data, 'attributes_values');

        return [
	        'order' => $model
	    ];
    }

    public function includeProducts(array $data)
    {
        $products = Arr::get($data, 'products');

        return $this->collection($products, new ProductsModelTransformer($this->order_id));
    }
}