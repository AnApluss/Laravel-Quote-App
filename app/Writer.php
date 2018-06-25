<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    public function quotes()
    {
    	return $this->hasMany('App\Quotes');
    }
}
