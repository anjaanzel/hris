@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2 card-mt-15">
                <h4 class="center grey-text text-darken-2 card-title">Ažuriranje tipa odsustva</h4>
                <div class="card-content">
                    <div class="row">
                        <form action="{{route('leave_types.update',$leave_type->id)}}" method="POST">
                            <!--
                                in value attribute of naziv input, we are checking
                                if it has a value that we have submitted previously, else set
                                value to actual value that we are getting from $leave_type.
                            -->
                            <div class="input-field no-margin">
                            <i class="material-icons prefix">account_balance</i>
                                <input type="text" name="naziv" id="naziv" value="{{Request::old('naziv') ? : $leave_type->naziv}}">
                                
                                <span class="{{$errors->has('naziv') ? 'helper-text red-text' : ''}}">{{$errors->first('naziv')}}</span>
                            </div>


         

                            <div class="input-field no-margin">
                            <i class="material-icons prefix">account_balance</i>
                            <input type="text" name="procenat_satnice" id="procenat_satnice" value="{{Request::old('procenat_satnice') ? : $leave_type->procenat_satnice}}"
                               
                                <span class="{{$errors->has('procenat_satnice') ? 'helper-text red-text' : ''}}">{{$errors->first('procenat_satnice')}}</span>
                            </div>
                            @method('PUT')
                            @csrf()
                            <button type="submit" class="btn waves-effect waves-light mt-15 col s6 offset-s3 m4 offset-m4 l4 offset-l4 xl4-offset-xl4">Sačuvaj</button>
                        </form>
                    </div>
                    <div class="card-action">
                        <a href="/leave_types">Nazad</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection