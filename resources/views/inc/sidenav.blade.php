<ul id="slide-out" class="sidenav sidenav-fixed grey lighten-4">
    <li>
        <div class="user-view">
            <div class="background">
            </div>
            {{-- Get picture of authenicated user --}}
            <a href="dashboard"><img class="circle" src="{{asset('storage/admins/'.Auth::user()->picture)}}"></a>
            {{-- Get first and last name of authenicated user --}}
            <a href="dashboard"><span class="white-text name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></a>
            {{-- Get email of authenicated user --}}
            <a href="/dashboard"><span class="white-text email">{{ Auth::user()->email }}</span></a>
        </div>
    </li>
    <li>
        <a class="waves-effect waves-grey" href="/dashboard"><i class="material-icons">dashboard</i>Početna</a>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header"><i class="material-icons pl-15">supervisor_account</i><span class="pl-15">Radnici</span></a>
                <div class="collapsible-body">
                    <ul>
                        <li>
                            <a href="/employees" class="waves-effect waves-grey">
                                <i class="material-icons">sentiment_very_satisfied</i>
                                Zaposleni
                            </a>
                        </li>
                        <li>
                            <a href="/ex_employees" class="waves-effect waves-grey">
                                <i class="material-icons">sentiment_very_dissatisfied</i>
                                Bivši zaposleni
                            </a>
                        </li>
                        <li>
                            <a href="/candidates" class="waves-effect waves-grey">
                            <i class="material-icons">sentiment_satisfied</i>
                                Kandidati
                            </a>
                        </li>
                    </ul>   
                </div>     
            </li>
        </ul>
    </li>
    <li>
        <a class="waves-effect waves-grey" href="{{route('attendances.create')}}"><i class="material-icons">location_on</i>Evidencija prisustva</a>
    </li>
    
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header"><i class="material-icons pl-15">location_off</i><span class="pl-15">Odsustva</span></a>
                <div class="collapsible-body">
                    <ul>
                        <li>
                            <a href="/leaves" class="waves-effect waves-grey">
                                <i class="material-icons">alarm_off</i>
                                Zahtevi za odsustvom
                            </a>
                        </li>
                        <li>
                            <a href="/leave_types" class="waves-effect waves-grey">
                                <i class="material-icons">apps</i>
                                Tipovi odsustva
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <a class="waves-effect waves-grey" href="/reports"><i class="material-icons">attach_money</i>Isplata</a>
    </li>
    <li>
        <a class="waves-effect waves-grey" href="/departments"><i class="material-icons">business</i>Departmani</a>
    </li>
    
</ul>
