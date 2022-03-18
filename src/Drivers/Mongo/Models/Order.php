<?php

namespace Scpigo\Laravel1cXml\Drivers\Mongo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MongoDB\Operation\FindOneAndUpdate;

/**
 * @property string $uid
 * @property string $number
 * @property string $date
 * @property string $operation
 * @property string $role
 * @property string $currency
 * @property float $rate
 * @property float $sum
 * @property string $time
 * @property string $comment
 * @property string[] $counterparty
 * @property string[] $attributes_values
 */
class Order extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'orders_1c';

    protected $dates = [
        'date',
        'time'
    ];

    protected $fillable = [
        'uid',
        'number',
        'date',
        'operation',
        'role',
        'currency',
        'rate',
        'sum',
        'time',
        'comment',
        'counterparty',
        'attributes_values',
    ];

    public function orderProducts() {
        return $this->hasMany(OrdersProduct::class);
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
            ['id' => 'orders'],
            ['$inc' => ['seq' => 1]],
            ['new' => true, 'upsert' => true, 'returnDocument' => FindOneAndUpdate::RETURN_DOCUMENT_AFTER]
        );
        return $seq->seq;
    }
}
