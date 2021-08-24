<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'subcategory_id', 'name', 'code', 'color', 'price', 'discount', 'image', 'video', 'weight',
        'feature', 'url', 'meta_title', 'meta_description', 'meta_keywords'
    ];

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }
}
