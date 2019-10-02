@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m8 offset-m2 l8 offset-l2 xl10 offset-xl2 card-mt-15">
                <h4 class="center grey-text text-darken-2 card-title">Ažuriranje departmana</h4>
                <div class="card-content">
                    <div class="row">
                        <form action="{{route('departments.update',$department->id)}}" method="POST">
                            <!--
                                in value attribute of naziv input, we are checking
                                if it has a value that we have submitted previously, else set
                                value to actual value that we are getting from $department.
                            -->
                            <div class="input-field no-margin">
                            <i class="material-icons prefix">business</i>
                                <input type="text" name="naziv" id="naziv" value="{{Request::old('naziv') ? : $department->naziv}}">
                                
                                <span class="{{$errors->has('naziv') ? 'helper-text red-text' : ''}}">{{$errors->first('naziv')}}</span>
                            </div>


         

                            <div class="input-field no-margin">
                            <i class="material-icons prefix">account_balance</i>
                            <textarea type="text" id="opis" name="opis" class="materialize-textarea">{{Request::old('opis') ? : $department->opis}}</textarea> 
                               
                                <span class="{{$errors->has('opis') ? 'helper-text red-text' : ''}}">{{$errors->first('opis')}}</span>
                            </div>
                            @method('PUT')
                            @csrf()
                            <button type="submit" class="btn waves-effect waves-light mt-15 col s6 offset-s3 m4 offset-m4 l4 offset-l4 xl4-offset-xl4">Sačuvaj</button>
                        </form>
                    </div>
                    <div class="card-action">
                        <a href="/departments">Nazad</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection