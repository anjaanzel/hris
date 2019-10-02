<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
    	'ime', 
    	'prezime',
    	'email',
    	'brTel',
    	'adresa',
    	'pol',
    	'datumZaposlenja',
    	'datumRodjenja',
    	'satnica',
    	'slika',
    	'cv',
    	'status',
    	'pozicija',
    	'department_id'

    	
    ];


    public function attendances(){
        return $this->hasMany('App\Attendance');

    }


    public function leaves(){
        return $this->hasMany('App\Leave');

    }

     public function department(){
        return $this->belongsTo('App\Department','department_id');

    }
}
