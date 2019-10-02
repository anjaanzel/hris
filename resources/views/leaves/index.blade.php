@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="grey-text text-darken-1 center">Zahtevi za odsustvom</h4>
    <br>
    <div class="card">
        <div class="card-content">
            <div class="row">
                
                <!-- Table that shows leave List -->
                <table class="responsive-table col s12 m12 l12 xl12">
                    <thead class="grey-text text-darken-1">
                        <tr>
                            <th class="center">Ime i prezime</th>
                            <th class="center">Tip</th>
                            <th class="center">Datum početka</th>
                            <th class="center">Datum završetka</th>
                            <th class="center">Razlog</th>
                            <th class="center">Status</th>
                            <th class="center">Obrada</th>
                        </tr>
                    </thead>
                    <tbody id="emp-table">
                        <!-- Check if there are any leave to render in view -->
                        @if($leaves->count())
                            @foreach($leaves as $leave)
                                <tr>
                                    
                                    <td class="center" width="20%">{{$leave->employee->ime}} {{$leave->employee->prezime}}</td>
                                    <td class="center">{{$leave->leave_type->naziv}}</td>
                                    <td class="center" width="15%">{{$leave->datum_pocetka}}</td>
                                    <td class="center" width="20%">{{$leave->datum_zavrsetka}}</td>
                                    <td class="center">{{$leave->razlog}}</td>
                                    <td class="center">{{$leave->status}}</td>
                                    <td class="center" width="20%">
                                  

                                    <div class="row mb-0">
                                              <div class="col">
                                                    
                                                      <a href="{{route('leaves.edit',$leave->id)}}" class="btn btn-small btn-floating waves=effect waves-light teal lighten-2"><i class="material-icons">list</i></a>
                                                </div>
                                                <div class="col">
                                                    
                                                    <form action="{{route('leaves.destroy',$leave->id)}}" method="POST">
                                                     
                                                        @method('DELETE')
                                                    
                                                        @csrf()
                                                        <button type="submit" class="btn btn-floating btn-small waves=effect waves-light red"><i class="material-icons">delete</i></button>
                                                    </form>
                                                </div>
                                            </div>


                                    </td>
                                </tr>
                            @endforeach
                            @if(isset($search))
                                <tr>
                                    <td colspan="4">
                                        <a href="/leaves" class="right">Prikaži sve</a>
                                    </td>
                                </tr>
                            @endif
                        @else
                            {{-- if there are no leaves then show this message --}}
                            <tr>
                                <td colspan="5"><h6 class="grey-text text-darken-2 center">Sistem nije pronašao odsustva!</h6></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <!-- leaves Table END -->
            </div>
            <!-- Show Pagination Links -->
            <div class="center">
                {{$leaves->links('vendor.pagination.default',['paginator' => $leaves])}}
            </div>
        </div>
    </div>
    <!-- Card END -->
</div>

@endsection