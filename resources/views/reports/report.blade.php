<!DOCTYPE html>
<html lang="sr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{public_path('css/materialize.css')}}">

        <title>Modul za upravljanje ljudskim resursima</title>
         <br>
            <style>
                    #attendances, #radnik, #dept {
                      font-family: "DejaVu Sans", Times, serif;
                      border-collapse: collapse;
                      width: 100%;
                    }

                    #attendances td, #attendances th {
                      border: 1px solid #ddd;
                      padding: 8px;
                    }

                    #attendances tr:nth-child(even){background-color: #f2f2f2;}

                    #attendances tr:hover {background-color: #ddd;}

                    #attendances th {
                      padding-top: 12px;
                      padding-bottom: 12px;
                      text-align: left;
                      background-color: #4bb8c4;
                      color: white;
                      font-size: 18px;
                    }

                    #zarada, #zaradal {
                    padding-top: 12px;
                    padding-bottom: 12px;
                    text-align: left;
                    background-color: white;
                    color: #4bb8c4;
                    font-size: 24px;
                    }
            </style>
    </head>
    <body>
        <h2 class="grey-text text-darken-1">Evidencija prisustva i zarade</h2>
        <h4 id = "radnik" class="grey-text text-darken-1"><cite lang="sr">Radnik: {{$employee->prezime}} {{$employee->ime}} - {{$employee->pozicija}}</h4> 
        <h5 id="dept" class="grey-text text-darken-1"><cite lang="sr">Departman: {{$employee->department->naziv}}</h5>
        <br>
        <h6 class="grey-text text-darken-1 right">Period: {{$date_from}} - {{$date_to}}</h6>
        <br>
        <br>
        <table id="attendances">
            <thead class="white-text text-darken-1">
                <tr>
                  
                    <th style="text-align:center">Datum</th>
                    <th style="text-align:center">Prijava</th>
                    <th style="text-align:center">Odjava</th>
                    <th style="text-align:center">Dnevnica</th>

                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
              
                        <td style="text-align:right">{{$attendance->datum}}</td>
                        <td style="text-align:right">{{$attendance->prijava}}</td>
                        <td style="text-align:right">{{$attendance->odjava}}</td>
                        <td style="text-align:right">{{$attendance->employee->satnica}}.00</td>

                    </tr>
                @endforeach
            </tbody>
        </table>


<br>
<br>

<input class="right" name="zarada" id="zarada" type="text" value="{{$zarada}}.00" style="text-align:right" readonly>
<label class="grey-text text-darken-1 right" id="zaradal" for="zarada">Zarada: </label>

<br>

    </body>
</html>