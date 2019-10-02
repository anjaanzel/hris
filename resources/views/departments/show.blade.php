@extends('layouts.app')

@section('content');
<div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
     

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>{{$department->naziv}}</h1>
        <p class="lead">{{$department->opis}}</p>
      <!--  <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>-->
      </div>

       <!--Example row of columns -->
      <div class="row" style="background-color: white; margin: 10px;">

        @foreach($department->employees as $employee)
        <div class="col-lg-4">
          <h2>{{$employee->ime}} {{$employee->prezime}}</h2>
          <p class="text-danger">{{$employee->pozicija}} </p>
          <p><a class="btn btn-primary" href="/employees/{{$employee->id}}" role="button">Detalji zaposlenog »</a></p>
        </div>
      @endforeach
        
      </div>


    </div>

    @endsection