@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m12 l12 xl12 mt-20">
                <div>
                <h4 class="center grey-text text-darken-2 card-title">Kreiranje novog kandidata</h4>
                </div>
                <hr>
                <div class="card-content">
                    <form action="{{route('candidates.store')}}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s12 m6 l6 xl4 offset-xl2">
                                <i class="material-icons prefix">person</i>
                                <input type="text" name="ime" id="ime" value="{{Request::old('ime') ? : ''}}">
                                <label for="ime">Ime</label>
                                <span class="{{$errors->has('ime') ? 'helper-text red-text' : ''}}">{{$errors->first('ime')}}</span>
                            </div>
                            <div class="input-field col s12 m6 l6 xl4">
                                <i class="material-icons prefix">person</i>
                                <input type="text" name="prezime" id="prezime" value="{{Request::old('prezime') ? : ''}}">
                                <label for="prezime">Prezime</label>
                                <span class="{{$errors->has('ime') ? 'helper-text red-text' : ''}}">{{$errors->first('ime')}}</span>
                            </div>
                            <div class="input-field col s12 m6 l6 xl8 offset-xl2">
                                <i class="material-icons prefix">email</i>
                                <input type="email" name="email" id="email" value="{{Request::old('email') ? : ''}}">
                                <label for="email">E-mail</label>
                                <span class="{{$errors->has('email') ? 'helper-text red-text' : ''}}">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                            </div>
                            <div class="input-field col s12 m6 l6 xl4 offset-xl2">
                                <i class="material-icons prefix">wc</i>
                                <select name="pol" id="pol" class="form-control" >
                                    <option value="" disabled {{ old('pol') ? '' : 'selected' }}>Odaberite pol</option>
                                <option>muški</option>
                                <option>ženski</option>
                                </select>
                            </div>
                            <div class="input-field col s12 m6 l6 xl4">
                                <i class="material-icons prefix">date_range</i>
                                <input type="text" name="datumRodjenja" id="datumRodjenja" class="datepicker" value="{{Request::old('datumRodjenja') ? : ''}}">
                                <label for="datumRodjenja">Datum rođenja</label>
                                <span class="{{$errors->has('datumRodjenja') ? 'helper-text red-text' : ''}}">{{$errors->has('datumRodjenja') ? $errors->first('datumRodjenja') : '' }}</span>
                            </div>
                            
                            <div class="input-field col s12 m6 l6 xl4 offset-xl2">
                                <i class="material-icons prefix">add_location</i>
                                <textarea name="adresa" id="adresa" class="materialize-textarea" >{{Request::old('adresa') ? : ''}}</textarea>
                                <label for="adresa">Adresa</label>
                                <span class="{{$errors->has('adresa') ? 'helper-text red-text' : ''}}">{{$errors->has('adresa') ? $errors->first('adresa') : ''}}</span>
                            </div>
                            <div class="input-field col s12 m6 l6 xl4">
                                <i class="material-icons prefix">contact_phone</i>
                                <input type="text" name="brTel" id="brTel" value="{{Request::old('brTel') ? : ''}}">
                                <label for="brTel">Broj telefona</label>
                                <span class="{{$errors->has('brTel') ? 'helper-text red-text' : ''}}">{{$errors->has('brTel') ? $errors->first('brTel') : ''}}</span>
                            </div>
                            <div class="file-field input-field col s12 m12 l12 xl8 offset-xl2">
                                <div class="btn">
                                    <span>Slika</span>
                                    <input type="file" name="slika">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" value="{{old('slika') ? : '' }}">
                                    <span class="{{$errors->has('slika') ? 'helper-text red-text' : ''}}">{{$errors->has('slika') ? $errors->first('slika') : ''}}</span>
                                </div>
                            </div>

                            <div class="file-field input-field col s12 m12 l12 xl8 offset-xl2">
                                <div class="btn">
                                    <span>CV</span>
                                    <input type="file" name="cv">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" value="{{old('cv') ? : '' }}">
                                    <span class="{{$errors->has('cv') ? 'helper-text red-text' : ''}}">{{$errors->has('cv') ? $errors->first('cv') : ''}}</span>
                                </div>
                            </div>


                        </div>
                        @csrf()
                        <div class="row">
                            <button type="submit" class="btn waves-effect waves-light col s8 offset-s2 m4 offset-m4 l4 offset-l4 xl4 offset-xl4">Sačuvaj</button>
                        </div>
                    </form>
                </div>
                <div class="card-action">
                    <a href="/candidates">Nazad</a>
                </div>
            </div>
        </div>
    </div>
@endsection