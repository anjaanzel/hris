@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col s12 m12 l12 xl12 mt-20">
                <div>
                <h4 class="center grey-text text-darken-2 card-title">Ažuriranje zaposlenog</h4>
                </div>
                <hr>
                <div class="card-content">
                    <form action="{{route('employees.update',$employee->id)}}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s12 m6 l6 xl4 offset-xl2">
                                <i class="material-icons prefix">person</i>
                                <input type="text" name="ime" id="ime" value="{{old('ime') ? : $employee->ime}}">
                                <label for="ime">Ime</label>
                                <span class="{{$errors->has('ime') ? 'helper-text red-text' : ''}}">{{$errors->first('ime')}}</span>
                            </div>
                            <div class="input-field col s12 m6 l6 xl4">
                                <i class="material-icons prefix">person</i>
                                <input type="text" name="prezime" id="prezime" value="{{old('prezime') ? : $employee->prezime}}">
                                <label for="prezime">Prezime</label>
                                <span class="{{$errors->has('prezime') ? 'helper-text red-text' : ''}}">{{$errors->first('prezime')}}</span>
                            </div>
                            <div class="input-field col s12 m12 l12 xl8 offset-xl2">
                                <i class="material-icons prefix">email</i>
                                <input type="email" name="email" id="email" value="{{old('email') ? : $employee->email}}">
                                <label for="email">E-mail</label>
                                <span class="{{$errors->has('email') ? 'helper-text red-text' : ''}}">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                            </div>
                            <div class="input-field col s12 m6 l6 xl4 offset-xl2">
                                <i class="material-icons prefix">wc</i>
                                <select name="pol" id="pol" class="form-control" >
                                    <option value="" disabled {{ old('pol') ? '' : 'selected' }}>Odaberite pol</option>
                                <option value="{{$employee->pol}}" {{old('pol') ? 'selected' : ''}} {{ $employee->pol=='muški' ? 'selected' : '' }} >muški</option>
                                <option value="{{$employee->pol}}" {{old('pol') ? 'selected' : ''}} {{ $employee->pol=='ženski' ? 'selected' : '' }} >ženski</option>
                                </select>
                            </div>
                            <div class="input-field col s12 m6 m6 xl4">
                                <i class="material-icons prefix">contact_phone</i>
                                <input type="text" name="brTel" id="brTel" value="{{old('brTel') ? : $employee->brTel}}">
                                <label for="brTel">Broj telefona</label>
                                <span class="{{$errors->has('brTel') ? 'helper-text red-text' : ''}}">{{$errors->has('brTel') ? $errors->first('brTel') : ''}}</span>
                            </div>
                            <div class="input-field col s12 m12 l12 xl8 offset-xl2">
                                <i class="material-icons prefix">add_location</i>
                                <textarea name="adresa" id="adresa" class="materialize-textarea" >{{Request::old('adresa') ? : $employee->adresa}}</textarea>
                                <label for="adresa">Adresa</label>
                                <span class="{{$errors->has('adresa') ? 'helper-text red-text' : ''}}">{{$errors->has('adresa') ? $errors->first('adresa') : ''}}</span>
                            </div>
                            
                            
                            <div class="input-field col s12 m12 l12 xl8 offset-xl2">
                                <i class="material-icons prefix">business</i>
                                <select name="department">
                                    <option value="" disabled>Odaberite departman</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}" {{old('department') ? 'selected' : ''}} {{ $employee->department==$department ? 'selected' : '' }} >{{$department->naziv}}</option>
                                    @endforeach
                                </select>
                                <label>Departman</label>
                            </div>

                            <div class="input-field col s12 m6 l6 xl4 offset-xl2">
                                <i class="material-icons prefix">business_center</i>
                                <textarea name="pozicija" id="pozicija" class="materialize-textarea" >{{Request::old('pozicija') ? : $employee->pozicija}}</textarea>
                                <label for="pozicija">Pozicija</label>
                                <span class="{{$errors->has('pozicija') ? 'helper-text red-text' : ''}}">{{$errors->has('pozicija') ? $errors->first('pozicija') : ''}}</span>
                            </div>
                            
                            <div class="input-field col s12 m6 l6 xl4">
                                <i class="material-icons prefix">attach_money</i>
                                 <input type="number" name="satnica" id="satnica" value="{{$employee->satnica}}" >
                                <label for="satnica">Dnevnica</label>
                                <span class="{{$errors->has('satnica') ? 'helper-text red-text' : ''}}">{{$errors->has('satnica') ? $errors->first('satnica') : ''}}</span>
                            </div>

                            <div class="input-field col s12 m12 l12 xl8 offset-xl2">
                                <i class="material-icons prefix">equalizer</i>
                                <textarea name="status" id="status" class="materialize-textarea" >{{Request::old('status') ? : $employee->status}}</textarea>
                                <label for="status">Status</label>
                                <span class="{{$errors->has('status') ? 'helper-text red-text' : ''}}">{{$errors->has('status') ? $errors->first('status') : ''}}</span>
                            </div>

                            <div class="input-field col s12 m6 l6 xl4 offset-xl2">
                                <i class="material-icons prefix">date_range</i>
                                <input type="text" name="join_date" id="join_date" class="datepicker" value="{{Request::old('join_date') ? : $employee->join_date}}">
                                <label for="join_date">Datum zaposlenja</label>
                                <span class="{{$errors->has('join_date') ? 'helper-text red-text' : ''}}">{{$errors->has('join_date') ? $errors->first('join_date') : ''}}</span>
                            </div>
                            <div class="input-field col s12 m6 l6 xl4">
                                <i class="material-icons prefix">date_range</i>
                                <input type="text" name="datumRodjenja" id="datumRodjenja" class="datepicker" value="{{Request::old('datumRodjenja') ? : $employee->datumRodjenja}}">
                                <label for="datumRodjenja">Datum rođenja</label>
                                <span class="{{$errors->has('datumRodjenja') ? 'helper-text red-text' : ''}}">{{$errors->has('datumRodjenja') ? $errors->first('datumRodjenja') : '' }}</span>
                            </div>
                            
                            <div class="file-field input-field col s12 m8 offset-m2 l8 offset-l2 xl8 offset-xl2">
                                <div class="btn">
                                    <span>Slika</span>
                                    <input type="file" name="slika">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" value="{{old('slika') ? : $employee->slika}}">
                                    <span class="{{$errors->has('slika') ? 'helper-text red-text' : ''}}">{{$errors->has('slika') ? $errors->first('slika') : ''}}</span>
                                </div>
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
                    <a href="/employees">Nazad</a>
                </div>
            </div>
        </div>
    </div>
@endsection