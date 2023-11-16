<?php

namespace Modules\Hub\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Hub\Database\factories\OfferFactory;

/**
 * @mixin Builder
 */
class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'reference',
        'status',
        'price',
        'sale_price',
        'sale_starts_on',
        'sale_ends_on',
        'stock'
    ];

    /**
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'sale_starts_on' => 'datetime:Y-m-d H:i:s',
        'sale_ends_on' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @return OfferFactory
     */
    protected static function newFactory(): OfferFactory
    {
        return OfferFactory::new();
    }
}
