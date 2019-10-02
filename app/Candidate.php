<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
    	'ime', 
    	'prezime',
    	'email',
    	'brTel',
    	'adresa',
    	'pol',
    	'datumRodjenja',
    	'slika',
    	'cv'
    	
    ];
}
