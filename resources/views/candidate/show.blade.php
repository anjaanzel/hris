@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-panel grey-text text-darken-2 mt-20">
            <h4 class="grey-text text-darken-1 center">Detalji o kandidatu</h4>
            <div class="row">
                <div class="row collection mt-20">
                    <!-- Show this image on small devices -->
                    <div class="hide-on-med-only hide-on-large-only row">
                        <div class="col s8 offset-s2 mt-20">
                            <img class="p5 card-panel emp-img-big" src="{{asset('storage/candidate_images/'.$candidate->slika)}}">
                        </div>
                    </div>
                    <div class="col m8 l8 xl8">
                        <h5 class="pl-15 mt-20">{{$candidate->ime}} {{$candidate->prezime}}</h5>
                        <p class="pl-15 mt-20"><i class="material-icons left">location_on</i>{{$candidate->adresa}}</p>
                       <p class="pl-15 mt-20"><i class="material-icons left">phone</i>{{$candidate->brTel}}</p>
                        <p class="pl-15"><i class="material-icons left">wc</i>{{$candidate->pol}}</p>
                        <p class="pl-15"><i class="material-icons left">cake</i>{{$candidate->datumRodjenja}}</p>
                        <p class="pl-15"><i class="material-icons left">email</i>{{$candidate->email}}</p>
                    </div>
                    <!-- Hide this image on small devices -->
                    <div class="hide-on-small-only col m4 l4 xl3">
                        <img class="p5 card-panel emp-img-big" src="{{asset('storage/candidate_images/'.$candidate->slika)}}">
                    </div>
                </div>
                <div class="collection">
                    <div class="embed-responsive embed-responsive-16by9">
                        <object class="embed-responsive-item" style="width:100%;" height="800px" data="/storage/candidates_cv/{{$candidate->cv}}" type="application/pdf" internalinstanceid="9" title="">
                        <p>Your browser isn't supporting embedded pdf files. You can download the file
                        <a href="/storage/candidates_cv/{{$candidate->cv}}">here</a>.</p>
                        </object>
                    </div>
                </div>
                  

                <form action="{{route('candidates.destroy',$candidate->id)}}" method="POST">
                    @method('DELETE')
                    @csrf()
                    <button class="btn red col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2" type="submit">Obriši</button>
                </form>
                <a class="btn orange col s3 offset-s2 m3 offset-m2 l3 offset-l2 xl3 offset-xl2" href="{{route('candidates.edit',$candidate->id)}}">Zaposli</a>
            </div>
        </div>
    </div>
@endsection