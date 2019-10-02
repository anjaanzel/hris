@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2 card-mt-15">
                <h4 class="center grey-text text-darken-2 card-title">Dodavanje departmana</h4>
                <div class="card-content">
                    <div class="row">
                        <!--
                            $errors has all validation errors if you wanna
                            show validation failure message then you can use it
                            like below.
                            $errors->has('input name') will return boolean
                            Request::old('input name') will return the value of the input field
                            that we have submitted.
                            $errors->first('input name') will return the first validation error,
                            so you can show it on the form.
                        -->
                        <form action="{{route('departments.store')}}" method="POST">
                            <div class="input-field no-margin">
                            <i class="material-icons prefix">account_balance</i>
                                <!--
                                    in value attribute of naziv input,
                                    we are just using ternary operator and checking 
                                    if it has a value that we have submitted
                                    previously, else set value to ''.
                                -->
                                <input type="text" name="naziv" id="naziv" class="validate" value="{{ Request::old('naziv') ? : '' }}">
                                <label for="naziv">Naziv</label>

                                
                                <!--
                                    in span tag below,
                                    we are checking for validation errors
                                    and if it has any errors that apply css classes,
                                    else set it to ''.
                                -->
                                <span class="{{$errors->has('naziv') ? 'helper-text red-text' : '' }}">{{$errors->first('naziv')}}</span>
                            </div>
                            <br>
                            <div class="input-field no-margin">
                                <i class="material-icons prefix">account_balance</i>
                                <textarea type="text" id="opis" name="opis" class="materialize-textarea">{{Request::old('opis') ? : ''}}</textarea> 
                                <label for="opis">Opis</label>

                            </div>
                            @csrf()
                            <button type="submit" class="btn waves-effect waves-light mt-15 col s6 offset-s3 m4 offset-m4 l4 offset-l4 xl4-offset-xl4">Dodaj</button>
                        </form>
                    </div>
                </div>
                <div class="card-action">
                    <a href="/departments">Nazad</a>
                </div>
            </div>
        </div>
    </div>
@endsection