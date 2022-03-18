<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MongoDB\Operation\FindOneAndUpdate;

/**
 * @property int $order_id
 * @property string $uid
 * @property int $vendor_code
 * @property string $name
 * @property string[] $base_unit
 * @property float $unit_price
 * @property int $quantity
 * @property float $cost
 * @property string[] $attributes_values
 */
class OrdersProduct extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'orders_products_1c';

    protected $fillable = [
        'order_id',
        'uid',
        'vendor_code',
        'name',
        'base_unit',
        'unit_price',
        'quantity',
        'cost',
        'attributes_values'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function nextid()
    {
        $this->id = self::getID();
    }

    public static function bootUseAutoIncrementID()
    {
        static::creating(function ($model) {
            $model->sequencial_id = self::getID($model->getTable());
        });
    }
    public function getCasts()
    {
        return $this->casts;
    }

    private static function getID()
    {
        $seq = DB::connection('mongodb')->getCollection('counters')->findOneAndUpdate(
            ['id' => 'orders_products'],
            ['$inc' => ['seq' => 1]],
            ['new' => true, 'upsert' => true, 'returnDocument' => FindOneAndUpdate::RETURN_DOCUMENT_AFTER]
        );
        return $seq->seq;
    }
}
