<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave_type extends Model
{
    protected $fillable = [
    	'naziv', 
    	'procenat_satnice'


    ];


    public function leaves(){
        return $this->hasMany('App/Leave');

    }
}
