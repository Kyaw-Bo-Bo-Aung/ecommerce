<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name', 'status'
    ];

    public function categories() 
    {
        return $this->hasMany('App\Category');
    }
}
