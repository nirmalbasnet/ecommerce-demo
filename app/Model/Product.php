<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = ['id'];

    public function productCategory()
    {
        return $this->belongsTo('\App\Model\ProductCategory', 'category_id');
    }
}
