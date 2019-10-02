@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="grey-text text-darken-1 center">Kandidati</h4>
    {{-- Search --}}
    <div class="row mb-0">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">
                    <i class="material-icons">search</i>
                    Pretraga kandidata
                </div>
                <div class="collapsible-body">
                    <div class="row mb-0">
                        <form action="{{route('candidates.search')}}" method="POST">
                            @csrf()
                            <div class="input-field col s12 m6 l5 xl6">
                                <input id="search" type="text" name="search" >
                                <label for="search">Pretraži kandidate</label>
                                <span class="{{$errors->has('search') ? 'helper-text red-text' : '' }}">{{$errors->has('search') ? $errors->first('search') : '' }}</span>
                            </div>
                            <div class="input-field col s12 m6 l4 xl4">
                                <select name="options" id="options">
                                    <option value="ime">Ime</option>
                                    <option value="prezime">Prezime</option>
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
        <!-- Show All candidate List as a Card -->
<br>
        <div class="card-content">
            <div class="row">

                <!-- Table that shows candidate List -->
                <table class="responsive-table col s12 m12 l12 xl12">
                    <thead class="grey-text text-darken-1">
                        <tr>
                            <th class="center"></th>
                            <th class="center">Ime i prezime</th>
                            <th class="center">E-mail</th>
                            <th class="center">Datum rođenja</th>
                            <th class="center">Detalji</th>
                        </tr>
                    </thead>
                    <tbody id="emp-table">
                        <!-- Check if there are any candidate to render in view -->
                        @if($candidates->count())
                            @foreach($candidates as $candidate)
                                <tr>
                                    <td>
                                    <img class="emp-img" src="{{asset('storage/candidate_images/'.$candidate->slika)}}">
                                    </td>
                                    <td>{{$candidate->ime}} {{$candidate->prezime}}</td>
                                    <td class="center">{{$candidate->email}}</td>
                                    <td class="center">{{$candidate->datumRodjenja}}</td>
                                    <td class="center">
                                    <a href="{{route('candidates.show',$candidate->id)}}" class="btn btn-small btn-floating waves=effect waves-light teal lighten-2"><i class="material-icons">list</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @if(isset($search))
                                <tr>
                                    <td colspan="4">
                                        <a href="/candidates" class="right">Prikaži sve</a>
                                    </td>
                                </tr>
                            @endif
                        @else
                            {{-- if there are no candidates then show this message --}}
                            <tr>
                                <td colspan="5"><h6 class="grey-text text-darken-2 center">Sistem nije pronašao kandidate!</h6></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <!-- candidates Table END -->
            </div>
            <!-- Show Pagination Links -->
            <div class="center">
                {{$candidates->links('vendor.pagination.default',['paginator' => $candidates])}}
            </div>
        </div>

    <!-- Card END -->
</div>
<!-- This is the button that is located at the right bottom, that navigates us to candidates.create view -->
<div class="fixed-action-btn">
    <a class="btn-floating btn-large waves=effect waves-light red" href="{{route('candidates.create')}}">
        <i class="large material-icons">add</i>
    </a>
</div> 
@endsection