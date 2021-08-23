<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'category_id', 'name', 'image', 'discount', 'description',
        'url', 'meta_title', 'meta_description', 'meta_keywords', 'status'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

   public function products()
   {
       return $this->hasMany('App\Products');
   }
}
