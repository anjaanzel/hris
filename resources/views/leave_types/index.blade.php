@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="grey-text text-darken-2">Tipovi odsustva</h4>
    
    {{-- Include the searh component with with title and route --}}
    @component('inc.search',['title' => 'Leave_type' , 'route' => 'leave_types.search'])
    @endcomponent
    
    <div class="row">
        {{-- Show All leave_types List as a Card --}}
        <div class="card col s12 m12 l12 xl12">
            <div class="card-content">
                <div class="row">
                    <h5 class="pl-15 grey-text text-darken-2 center">Spisak tipova</h5>
                    {{-- Table that shows leave_types List --}}
                    <br>
                    <table class="responsive-table col s12 m12 l12 xl12">
                        <thead class="grey-text text-darken-2">
                            <tr>
                                
                                <th>Naziv tipa odsustva</th>
                                <th>Procenat satnice</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>
                        <tbody id="dept-table">
                            {{-- Check if there are any leave_types to render in view --}}
                            @if($leave_types->count())
                                @foreach($leave_types as $leave_type)
                                    <tr>
                                        
                                        <td>{{$leave_type->naziv}}</td>
                                        <td>{{$leave_type->procenat_satnice}}</td>
                                        <td>
                                            <div class="row mb-0">
                                              <div class="col">
                                                    {{-- 
                                                        Edit button will navigate us to leave_types.edit
                                                        for defining a route you can use route method
                                                        route('route name') or if you want to pass data like
                                                        below then use route('route name',$data)
                                                     --}}
                                                    <a href="{{route('leave_types.edit',$leave_type->id)}}" class="btn btn-floating btn-small waves=effect waves-light orange"><i class="material-icons">mode_edit</i></a>
                                                </div>
                                                <div class="col">
                                                    {{-- 
                                                        Delete button will navigate us to leave_types.destroy
                                                     --}}
                                                    <form action="{{route('leave_types.destroy',$leave_type->id)}}" method="POST">
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
                                {{-- if there are no leave_types then show this message --}}
                                <tr>
                                    <td colspan="5"><h6 class="grey-text text-darken-2 center">Sistem nije pronašao tipove odsustva!</h6></td>
                                </tr>
                            @endif
                            @if(isset($search))
                                <tr>
                                    <td colspan="3">
                                        <a href="/leave_types" class="right">Prikaži sve</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{-- leave_types Table END --}}
                </div>
                {{-- Show Pagination Links --}}
                <div class="center" id="pagination">
                  {{$leave_types->links('vendor.pagination.default',['paginator' => $leave_types])}}
                </div>
            </div>
        </div>
        <!-- Card END -->
    </div>
</div>


{{-- This is the button that is located at the bottom right, that navigates us to leave_type.create view --}}
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves=effect waves-light red" href="{{route('leave_types.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div> 
@endsection