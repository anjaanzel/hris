<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
    	'employee_id', 
    	'datum_pocetka',
    	'datum_zavrsetka',
    	'razlog',
    	'status',
    	'leave_type_id'


    ];


    public function employee(){
        return $this->belongsTo('App\Employee');

    }

    public function leave_type(){
        return $this->belongsTo('App\Leave_type');

    }
}
