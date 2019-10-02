<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('employees')){
        Schema::create('employees', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('ime');
        $table->string('prezime');
        $table->string('email')->unique() ;
        $table->string('brTel');
        $table->string('adresa');
        $table->string('pol');
        $table->date('datumZaposlenja')->nullable();
        $table->date('datumRodjenja');
        $table->double('satnica')->nullable();
        $table->string('slika')->nullable();
        $table->string('cv')->nullable();
        $table->string('status');
        $table->string('pozicija')->nullable();
        $table->unsignedBigInteger('department_id');
        $table->foreign('department_id')->references('id')->on('departments');
        $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
