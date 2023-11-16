<?php

namespace Modules\Hub\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Hub\Database\factories\ProductFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'reference',
        'title',
        'status',
        'price',
        'promotional_price',
        'promotion_starts_on',
        'promotion_ends_on',
        'quantity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'promotion_starts_on' => 'datetime:Y-m-d H:i:s',
        'promotion_ends_on' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return ProductFactory
     */
    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
