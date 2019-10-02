@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m12 l12 xl12 mt-20">
                <div>
                <h4 class="center grey-text text-darken-2 card-title">Evidentiranje prisustva</h4>
                </div>
                <hr>
                <div class="card-content">
                    <form action="{{route('attendances.store')}}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                           

                            <div class="input-field col s12 m12 l12 xl8 offset-xl2">
                            <i class="material-icons prefix">business</i>
                                <select name="employee">
                                    <option value="" disabled {{ old('employee') ? '' : 'selected' }}>Odaberite zaposlenog</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}" {{ old('employee') ? 'selected' : '' }}>{{$employee->ime}} {{$employee->prezime}}</option>
                                    @endforeach
                                </select>
                                <label>Zaposleni</label>
                            </div>

                            <div class="input-field col m6 l6 xl8 offset-xl2">
                                <i class="material-icons prefix">date_range</i>
                                <input type="text" name="datum" id="datum" class="datepicker" value="{{old('datum') ? : ''}}">
                                <label for="datum">Datum</label>
                                <span class="{{$errors->has('datum') ? 'helper-text red-text' : ''}}">{{$errors->has('datum') ? $errors->first('datum') : ''}}</span>
                            </div>

                            <div class="input-field col s12 m6 l6 xl4 offset-xl2">
                                <i class="material-icons prefix">date_range</i>
                                <input type="text" name="prijava" id="prijava" class="timepicker" value="{{Request::old('prijava') ? : ''}}">
                                <label for="prijava">Vreme dolaska</label>
                                <span class="{{$errors->has('prijava') ? 'helper-text red-text' : ''}}">{{$errors->has('prijava') ? $errors->first('prijava') : '' }}</span>
                            </div>
                            
                            <div class="input-field col s12 m6 l6 xl4">
                                <i class="material-icons prefix">date_range</i>
                                <input type="text" name="odjava" id="odjava" class="timepicker" value="{{Request::old('odjava') ? : ''}}">
                                <label for="prijava">Vreme odlaska</label>
                                <span class="{{$errors->has('odjava') ? 'helper-text red-text' : ''}}">{{$errors->has('odjava') ? $errors->first('odjava') : '' }}</span>
                            </div>


                        </div>
                        @csrf()
                        <div class="row">
                            <button type="submit" class="btn waves-effect waves-light col s8 offset-s2 m4 offset-m4 l4 offset-l4 xl4 offset-xl4">Sačuvaj</button>
                        </div>
                    </form>
                </div>
                <div class="card-action">
                    <a href="/dashboard">Nazad</a>
                </div>
            </div>
        </div>
    </div>
@endsection