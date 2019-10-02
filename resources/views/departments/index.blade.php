@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="grey-text text-darken-2">Departmani</h4>
    
    {{-- Include the searh component with with title and route --}}
    @component('inc.search',['title' => 'Department' , 'route' => 'departments.search'])
    @endcomponent
    
    <div class="row">
        {{-- Show All Departments List as a Card --}}
        <div class="card col s12 m12 l12 xl12">
            <div class="card-content">
                <div class="row">
                    <h5 class="pl-15 grey-text text-darken-2 center">Spisak departmana</h5>
                    {{-- Table that shows Departments List --}}
                    <br>
                    <table class="responsive-table col s12 m12 l12 xl12">
                        <thead class="grey-text text-darken-2">
                            <tr>
                                
                                <th class="center">Naziv departmana</th>
                                <th class="center">Opis departmana</th>
                                <th class="center">Akcije</th>
                            </tr>
                        </thead>
                        <tbody id="dept-table">
                            {{-- Check if there are any departments to render in view --}}
                            @if($departments->count())
                                @foreach($departments as $department)
                                    <tr>
                                        
                                        <td width="23%">{{$department->naziv}}</td>
                                        <td width="62%" style="text-align:justify">{{$department->opis}}</td>
                                        <td width="15%">
                                            <div class="row mb-0">
                                              <div class="col">
                                                    {{-- 
                                                        Edit button will navigate us to departments.edit
                                                        for defining a route you can use route method
                                                        route('route name') or if you want to pass data like
                                                        below then use route('route name',$data)
                                                     --}}
                                                    <a href="{{route('departments.edit',$department->id)}}" class="btn btn-floating btn-small waves=effect waves-light orange"><i class="material-icons">mode_edit</i></a>
                                                </div>
                                                <div class="col">
                                                    {{-- 
                                                        Delete button will navigate us to departments.destroy
                                                     --}}
                                                    <form action="{{route('departments.destroy',$department->id)}}" method="POST">
                                                        {{--
                                                            @method('DELETE') is a hidden input that we need
                                                            to make a Delete request because html doesn't support
                                                            DELETE and PUT methods
                                                        --}}
                                                        @method('DELETE')
                                                        {{--
                                                            @csrf() is also a hidden input that renders the csrf token
                                                            for security
                                                        --}}
                                                        @csrf()
                                                        <button type="submit" class="btn btn-floating btn-small waves=effect waves-light red"><i class="material-icons">delete</i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                {{-- if there are no departments then show this message --}}
                                <tr>
                                    <td colspan="5"><h6 class="grey-text text-darken-2 center">Sistem nije pronašao departmane!</h6></td>
                                </tr>
                            @endif
                            @if(isset($search))
                                <tr>
                                    <td colspan="3">
                                        <a href="/departments" class="right">Prikaži sve</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{-- Departments Table END --}}
                </div>
                {{-- Show Pagination Links --}}
                <div class="center" id="pagination">
                  {{$departments->links('vendor.pagination.default',['paginator' => $departments])}}
                </div>
            </div>
        </div>
        <!-- Card END -->
    </div>
</div>


{{-- This is the button that is located at the bottom right, that navigates us to department.create view --}}
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves=effect waves-light red" href="{{route('departments.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div> 
@endsection