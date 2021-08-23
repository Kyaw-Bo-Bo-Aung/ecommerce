<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }
}
