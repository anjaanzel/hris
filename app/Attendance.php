<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
protected $table = 'attendances';
public $primaryKey = 'id';

    protected $fillable = [
    	'employee_id', 
    	'datum',
    	'prijava',
    	'odjava'

    ];

      public function employee(){
        return $this->belongsTo('App\Employee');

    }

}
