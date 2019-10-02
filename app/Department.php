<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
    	'naziv', 
    	'opis'

    ];

    public function employees(){
    	return $this->hasMany('App\Employee');

    }

    public function ex_employees(){
    	return $this->hasMany('App\Ex_employee');

    }
}
