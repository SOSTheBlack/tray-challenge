<?php

namespace Modules\Hub\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Hub\Database\factories\RelationFactory;

/**
 * @mixin Builder
 */
class Relation extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'offer_id',
        'product_id'
    ];

    protected static function newFactory(): RelationFactory
    {
        return RelationFactory::new();
    }
}
