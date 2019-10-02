@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="grey-text text-darken-1 center">Bivši radnici</h4>
    {{-- Search --}}
    <div class="row mb-0">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">
                    <i class="material-icons">search</i>
                    Pretraga bivših zaposlenih
                </div>
                <div class="collapsible-body">
                    <div class="row mb-0">
                        <form action="{{route('ex_employees.search')}}" method="POST">
                            @csrf()
                            <div class="input-field col s12 m6 l5 xl6">
                                <input id="search" type="text" name="search" >
                                <label for="search">Pretraži prethodne radnike</label>
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
        <!-- Show All ex_Employee List as a Card -->

        <div class="card-content">
            <div class="row">
                <br>
                <!-- Table that shows ex_Employee List -->
                <table class="responsive-table col s12 m12 l12 xl12">
                    <thead class="grey-text text-darken-1">
                        <tr>
                            <th class="center"></th>
                            <th class="center">Ime i prezime</th>
                            <th class="center">E-mail</th>
                            <th class="center">Pozicija</th>
                            <th class="center">Razlog odlaska</th>
                            <th class="center">Detalji</th>
                        </tr>
                    </thead>
                    <tbody id="emp-table">
                        <!-- Check if there are any ex_employee to render in view -->
                        @if($ex_employees->count())
                            @foreach($ex_employees as $ex_employee)
                                <tr>
                                    <td>
                                    <img class="emp-img" src="{{asset('storage/ex_employee_images/'.$ex_employee->slika)}}">
                                    </td>
                                    <td>{{$ex_employee->ime}} {{$ex_employee->prezime}}</td>
                                    <td class="center">{{$ex_employee->email}}</td>
                                    <td class="center">{{$ex_employee->pozicija}}</td>
                                    <td class="center">{{$ex_employee->razlog_odlaska}}</td>
                                    <td class="center">
                                    <a href="{{route('ex_employees.show', $ex_employee->id)}}" class="btn btn-small btn-floating waves=effect waves-light teal lighten-2"><i class="material-icons">list</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @if(isset($search))
                                <tr>
                                    <td colspan="4">
                                        <a href="/ex_employees" class="right">Prikaži sve</a>
                                    </td>
                                </tr>
                            @endif
                        @else
                            {{-- if there are no ex_employees then show this message --}}
                            <tr>
                                <td colspan="5"><h6 class="grey-text text-darken-2 center">Sistem nije pronašao bivše zaposlene!</h6></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <!-- ex_employees Table END -->
            </div>
            <!-- Show Pagination Links -->
            <div class="center">
                {{$ex_employees->links('vendor.pagination.default',['paginator' => $ex_employees])}}
            </div>
        </div>

    <!-- Card END -->
</div>

@endsection