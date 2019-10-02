@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="grey-text text-darken-1 center">Trenutni radnici</h4>
    {{-- Search --}}
    <div class="row mb-0">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">
                    <i class="material-icons">search</i>
                    Pretraga zaposlenih
                </div>
                <div class="collapsible-body">
                    <div class="row mb-0">
                        <form action="{{route('employees.search')}}" method="POST">
                            @csrf()
                            <div class="input-field col s12 m6 l5 xl6">
                                <input id="search" type="text" name="search" >
                                <label for="search">Pretraži radnike</label>
                                <span class="{{$errors->has('search') ? 'helper-text red-text' : '' }}">{{$errors->has('search') ? $errors->first('search') : '' }}</span>
                            </div>
                            <div class="input-field col s12 m6 l4 xl4">
                                <select name="options" id="options">
                                    <option value="ime">Ime</option>
                                    <option value="prezime">Prezime</option>
                                    <option value="pozicija">Pozicija</option>
                                    <option value="department_id">Departman</option>
                                </select>
                                <label for="options">Kriterijum pretrage:</label>
                            </div>
                            <br>
                            <div class="col l2">
                                <button type="submit" class="btn waves-effect waves-light">Pretraga</button>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    {{-- Search END --}}
        <!-- Show All Employee List as a Card -->
<br>    
        <div class="card-content">
            <div class="row">

                <!-- Table that shows Employee List -->
                <table class="responsive-table col s12 m12 l12 xl12">
                    <thead class="grey-text text-darken-1">
                        <tr>
                            <th class="center"></th>
                            <th class="center">Ime i prezime</th>
                            <th class="center">Departman</th>
                            <th class="center">Pozicija</th>
                            <th>Dnevnica</th>
                            <th>Detalji</th>
                        </tr>
                    </thead>
                    <tbody id="emp-table">
                        <!-- Check if there are any employee to render in view -->
                        @if($employees->count())
                            @foreach($employees as $employee)
                                <tr>
                                    <td>
                                    <img class="emp-img" src="{{asset('storage/employee_images/'.$employee->slika)}}">
                                    </td>
                                    <td>{{$employee->ime}} {{$employee->prezime}}</td>
                                    <td class="center">{{$employee->department->naziv}}</td>
                                    <td class="center">{{$employee->pozicija}}</td>
                                    <td class="center">{{$employee->satnica}}</td>
                                    <td>
                                    <a href="{{route('employees.show',$employee->id)}}" class="btn btn-small btn-floating waves=effect waves-light teal lighten-2"><i class="material-icons">list</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @if(isset($search))
                                <tr>
                                    <td colspan="4">
                                        <a href="/employees" class="right">Prikaži sve</a>
                                    </td>
                                </tr>
                            @endif
                        @else
                            {{-- if there are no employees then show this message --}}
                            <tr>
                                <td colspan="5"><h6 class="grey-text text-darken-2 center">Sistem nije pronašao zaposlene!</h6></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <!-- employees Table END -->
            </div>
            <!-- Show Pagination Links -->
            <div class="center">
                {{$employees->links('vendor.pagination.default',['paginator' => $employees])}}
            </div>
        </div>
   
    <!-- Card END -->
</div>
<!-- This is the button that is located at the right bottom, that navigates us to employees.create view -->
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves=effect waves-light red" href="{{route('employees.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div> 
@endsection