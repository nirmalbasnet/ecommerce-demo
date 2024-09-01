<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->hasMany('\App\Model\Product', 'category_id');
    }
}
