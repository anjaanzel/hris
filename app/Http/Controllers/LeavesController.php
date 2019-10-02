<?php

namespace App\Http\Controllers;

use App\Leave;
use Illuminate\Http\Request;
use App\Leave_type;
use App\Employee;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $leaves = Leave::Paginate(4);
        return view('leaves.index')->with('leaves',$leaves);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::orderBy('ime','asc')->get();
        $leave_types = Leave_types::orderBy('naziv','asc')->get();
  
        return view('leaves.create')->with([
            'employees'  => $employees,
            'leave_types' => $leave_types

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
        $this->validateRequest($request,null);

        $leave = new Leave();

        $this->setLeave($leave,$request);
        
        return redirect('/leaves')->with('info','Kreiran je novi zahtev za odsustvom!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $leave = Leave::find($id);
        return view('leaves.show')->with('leave',$leave);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees  = Employee::orderBy('ime','asc')->get();
        $leave_types  = Leave_type::orderBy('naziv','asc')->get();

        $leave = Leave::find($id);
        return view('leaves.edit')->with([
            'employees'  => $employees,
            'leave_types'  => $leave_types,
            'leave'     => $leave
        ]);
    }

    public function destroy($id)
    {

        $leave = Leave::find($id);
        
        $leave->delete();
        return redirect('/leaves')->with('info','Odabrani zahtev je obrisan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request,$id);
        $leave = Leave::find($id);
        
        /**
         *  updating an existing leave with setleave
         *  method
         */
        $this->setLeave($leave,$request);
        return redirect('/leaves')->with('info','Zahtev je ažuriran.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
   

    public function search(Request $request){
        $this->validate($request,[
            'search'   => 'required|min:1',
            'options'  => 'required'
        ]);
        $str = $request->input('search');
        $option = $request->input('options');
        $leaves = leave::where($option, 'LIKE' , '%'.$str.'%')->Paginate(4);
        return view('leave.index')->with(['leaves' => $leaves , 'search' => true ]);
    }

    private function validateRequest($request,$id){
    
        return $this->validate($request,[

            'status'         =>  'required'

            
        ]);
    }

    /**
     * Save a new resource or update an existing resource.
     *
     * @param  App\leave $leave
     * @param  \Illuminate\Http\Request  $request
     * @param  string $fileNameToStore
     * @return Boolean
     */
    private function setLeave(leave $leave,Request $request){
      
        $leave->status  = $request->input('status');

        $leave->save();
    }
}
