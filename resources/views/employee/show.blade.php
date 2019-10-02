@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-panel grey-text text-darken-2 mt-20">
            <h4 class="grey-text text-darken-1 center">Detalji o zaposlenom</h4>
            <div class="row">
                <div class="row collection mt-20">
                    <!-- Show this image on small devices -->
                    <div class="hide-on-med-only hide-on-large-only row">
                        <div  class="col s8 offset-s2 mt-20">
                            <img class="p5 card-panel emp-img-big" src="{{asset('storage/employee_images/'.$employee->slika)}}">
                        </div>
                    </div>
                    <div class="col m8 l8 xl8">
                        <h5 class="pl-15 mt-20">{{$employee->ime}} {{$employee->prezime}}</h5>
                        <p class="pl-15 mt-20"><i class="material-icons left">location_on</i>{{$employee->adresa}}</p>
                       <p class="pl-15 mt-20"><i class="material-icons left">phone</i>{{$employee->brTel}}</p>
                        <p class="pl-15"><i class="material-icons left">wc</i>{{$employee->pol}}</p>
                        <p class="pl-15"><i class="material-icons left">cake</i>{{$employee->datumRodjenja}}</p>
                    </div>
                    <!-- Hide this image on small devices -->
                    <div class="hide-on-small-only col m4 l4 xl3">
                        <img class="p5 card-panel emp-img-big" src="{{asset('storage/employee_images/'.$employee->slika)}}">
                    </div>
                </div>
                <div class="collection">
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">E-mail:</span><span class="col m8 l8 xl9">{{$employee->email}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Departman:</span><span class="col m8 l8 xl9">{{$employee->department->naziv}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Pozicija:</span><span class="col m8 l8 xl9">{{$employee->pozicija}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Dnevnica:</span><span class="col m8 l8 xl9">RSD {{$employee->satnica}}.00</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Datum zaposlenja:</span><span class="col m8 l8 xl9">{{$employee->join_date}}</span></p>
                    </div>
                    <div class="row">
                        <p class="pl-15"><span class="bold col s5 m4 l4 xl3">Status:</span><span class="col m8 l8 xl9">{{$employee->status}}</span></p>
                    </div>
                </div>
               
               

                <a class="btn red col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2" href="{{route('employees.otpusti', $employee->id)}}">Prekid rada</a>


                <a class="btn orange col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2" href="{{route('employees.edit',$employee->id)}}">Ažuriraj</a>
            </div>
        </div>
    </div>
@endsection