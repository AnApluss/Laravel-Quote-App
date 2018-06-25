<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    public function writer()
    {
    	return $this->belongsTo('App\Writer');
    }
}
