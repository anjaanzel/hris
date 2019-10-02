<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ex_employee extends Model
{
    protected $fillable = [
    	'ime', 
    	'prezime',
    	'email',
    	'brTel',
    	'adresa',
    	'pol',
    	'datumRodjenja',
    	'satnica',
    	'slika',
    	'pozicija',
    	'department_id',
    	'join_date',
    	'datum_odlaska'

    	
    ];



     public function department(){
        return $this->belongsTo('App\Department','department_id');

    }
}
