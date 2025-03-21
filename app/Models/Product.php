<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property float $price
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['category_id', 'name', 'price', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
