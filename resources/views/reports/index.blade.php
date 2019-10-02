@extends('layouts.app')
@section('content')

<div class="container">
    <h4 class="grey-text text-darken-1">Evidencija prisustva i zarade
</h4>
    <div class="card-panel">
        <div class="row mb-0">
            <form action="{{route('reports.make')}}" method="POST">
            @csrf()

        
              <div class="input-field col s10 offset-s1 m4 l4 xl10 offset-xl1">
                             <i class="material-icons prefix">face</i>
                            <select class="form-control" name="employee" id="employee">
                            <option value="" disabled {{ old('employee') ? '' : 'selected' }}>Odaberite zaposlenog</option>
                                @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->prezime}} {{$employee->ime}} </option>
                                @endforeach
                            </option>
                            </select>
                </div>

                <div class="input-field col s10 offset-s1 m4 l4 xl5 offset-xl1">
                    <i class="material-icons prefix">date_range</i>
                    <input class="datepicker" type="text" name="date_from" id="date_from" value="{{old('date_from') ? : ''}}">
                    <label for="date_from">Datum od</label>
                    <span class="{{$errors->has('date_from') ? 'helper-text red-text' : ''}}">{{$errors->has('date_from') ? $errors->first('date_from') : ''}}</span>
                </div>
                <div class="input-field col s10 offset-s1 m4 l4 xl5">
                    <i class="material-icons prefix">date_range</i>
                    <input type="text" name="date_to" id="date_to" class="datepicker" value="{{old('date_to') ? : ''}}">
                    <label for="date_to">Datum do</label>
                    <span class="{{$errors->has('date_to') ? 'helper-text red-text' : ''}}">{{$errors->has('date_to') ? $errors->first('date_to') : ''}}</span>
                </div>
                <br>
              <br>
        
                 <div class="row s10 offset-s1 m4 l4 xl5 center">
                <button class="btn waves-effect waves-light btn-large center" type="submit" name="action">Štampanje
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Show All Employee List as a Card -->
    
</div>

@endsection