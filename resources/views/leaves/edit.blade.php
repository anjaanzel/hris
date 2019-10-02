@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m12 l12 xl12 mt-20">
                <div>
                <h4 class="center grey-text text-darken-2 card-title">Ažuriranje zahteva</h4>
                </div>
                <hr>
                <div class="card-content">
                    <form action="{{route('leaves.update',$leave->id)}}" method="POST" enctype="multipart/form-data">
                        <div class="row">      


                <div class="row collection mt-20">
                    <!-- Show this image on small devices -->
                    <div class="hide-on-med-only hide-on-large-only row">
                        <div class="col s8 offset-s2 mt-20">
                            <img class="p5 card-panel emp-img-big" src="{{asset('storage/employee_images/'.$leave->employee->slika)}}">
                        </div>
                    </div>
                    <div class="col m8 l8 xl8">
                        <h5 class="pl-15 mt-20">{{$leave->employee->ime}} {{$leave->employee->prezime}}</h5>
                        <p class="pl-15 mt-20"><i class="material-icons left">email</i>{{$leave->employee->email}}</p>
                       <p class="pl-15 mt-20"><i class="material-icons left">phone</i>{{$leave->employee->department->naziv}}</p>

                        <p class="pl-15 mt-20"><i class="material-icons left">wc</i>{{$leave->employee->pozicija}}</p>
                        
                    </div>
                    <!-- Hide this image on small devices -->
                    <div class="hide-on-small-only col m4 l4 xl3">
                        <img class="p5 card-panel emp-img-big" src="{{asset('storage/employee_images/'.$leave->employee->slika)}}">
                    </div>
                </div>

                    
                <div class="collection mt-20">
                    <div class="row">
                        <br>
                        <p class="pl-15"><span class="bold col s5 m6 l6 xl4">Tip odsustva:</span><span class="col m6 l6 xl6">{{$leave->leave_type->naziv}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m6 l6 xl4">Datum početka:</span><span class="col m6 l6 xl6">{{$leave->datum_pocetka}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m6 l6 xl4">Datum završetka:</span><span class="col m6 l6 xl6">{{$leave->datum_zavrsetka}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m6 l6 xl4">Razlog odsustva:</span><span class="col m6 l6 xl6">{{$leave->razlog}}</span></p>
                    </div>
                </div>

                            <div class="input-field col s12 m12 l12 xl8 offset-xl2">
                                <i class="material-icons prefix">equalizer</i>
                                <select name="status" id="status" class="form-control" >{{Request::old('status') ? : $leave->status}}</textarea>
                                <label for="status">Obradi zahtev</label>
                                <option>Na čekanju</option>
                                <option>Odobren</option>
                                <option>Odbijen</option>
                                </select>
                            </div>


                        </div>
                        @method('PUT')
                        @csrf()
                        <div class="row">
                            <button type="submit" class="btn waves-effect waves-light col s8 offset-s2 m4 offset-m4 l4 offset-l4 xl4 offset-xl4">Ažuriraj</button>
                        </div>
                    </form>
                </div>
                <div class="card-action">
                    <a href="/leaves">Nazad</a>
                </div>
            </div>
        </div>
    </div>
@endsection