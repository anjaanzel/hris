<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Employee;
use App\Department;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     
    public function index()
    {
        $employees = employee::where('status', 1)->get();
        return view('Attendances.index',compact('employees'));
    }
*/
    public function __construct(){
        $this->middleware('auth');
    }
    


    public function index() {

        $attendances = Attendance::Paginate(4);
         $employees = Employee::orderBy('ime','asc')->get();

        return view('attendances.index')->with([
            'attendances'=> $attendances,
            'employees'  => $employees

        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function insert(Request $request) {

        Attendance::create([
            
            'employee_id' => $request->employee,
            'datum' => Carbon::parse($request->datum),
            'prijava' => Carbon::parse($request->datum  . ' ' . $request->prijava),
            'odjava' => Carbon::parse($request->datum  . ' ' . $request->odjava), 
          
        ]);

        return redirect()->back()->with('success','Prisustvo uspešno sačuvano.');
    }



    

    public function create()
    {
        $employees = Employee::orderBy('ime','asc')->get();
  
        return view('attendances.create')->with([
            'employees'  => $employees

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $attendance = new Attendance();

        $attendance->employee_id = $request->input('employee');
        $attendance->datum = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('datum'))));
        $attendance->prijava = $request->input('prijava');
        $attendance->odjava = $request->input('odjava');

        
        $attendance->save();
        
        /**
         *  redirect us to the /attendances route with a message.
         *  this message will make a toast that we have created in
         *  inc/alert view which is included in layouts/app view.
         *  see the inc/alert view
         */
        
         return redirect('/attendances')->with('info','Prisustvo je zabeleženo.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $attendance = Attendance::find($id);
        
         /**
         *  return the view with the specified resource.
         */
        
         return view('attendance.edit')->with('attendance',$attendance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
       
        
        $attendance = Attendance::Find($id);
        $attendance->employee_id = $request->input('employee_id');
        $attendance->datum = $request->input('datum');
        $attendance->prijava = $request->input('prijava');
        $attendance->odjava = $request->input('odjava');
        $attendance->save();

        /**
         *  redirecting with a message.
         */
        return redirect('/attendances')->with('info','Odabrano prisustvo je uspešno izmenjeno!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance = Attendance::find($id);
        $attendance->delete();
        return redirect('/attendances')->with('info','Odabrano prisustvo je obrisano!');
    }
}
