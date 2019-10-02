<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Employee;
use App\Ex_employee;
use App\Department;
use App\Attendance;
use App\Leave;
use DB;


class EmployeesController extends Controller
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
        $employees = Employee::Paginate(15);
        return view('employee.index')->with('employees',$employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::orderBy('naziv','asc')->get();
  
        return view('employee.create')->with([
            'departments'  => $departments

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
  
        $fileNameToStore = $this->handleImageUpload($request);


        $employee = new Employee();

        $this->setEmployee($employee,$request,$fileNameToStore);
        
        return redirect('/employees')->with('info','Kreiran je novi zaposleni!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.show')->with('employee',$employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments  = Department::orderBy('naziv','asc')->get();

        $employee = Employee::find($id);
        return view('employee.edit')->with([
            'departments'  => $departments,
            'employee'     => $employee
        ]);
    }

    public function otpusti($id)
    {
        $departments  = Department::orderBy('naziv','asc')->get();

        $employee = Employee::find($id);
        
        return view('employee.otpusti')->with([
            'departments'  => $departments,
            'employee'     => $employee
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->attendances()->delete();
        $employee->leaves()->delete();
        $employee->delete();
        
        Storage::delete('public/employee_images/'.$employee->slika);
        return redirect('/employees')->with('info','Odabrani zaposleni je obrisan!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request,$id);
        $employee = Employee::find($id);
        $old_slika = $employee->slika;
        if($request->hasFile('slika')){
            //Upload the image
            $fileNameToStore = $this->handleImageUpload($request);
            //Delete the previous image
            Storage::delete('public/employee_images/'.$employee->slika);
        }else{
            $fileNameToStore = '';
        }

        
        /**
         *  updating an existing employee with setEmployee
         *  method
         */
        $this->setEmployee($employee,$request,$fileNameToStore);
        return redirect('/employees')->with('info','Odabrani zaposleni je uspešno ažuriran.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    
    public function search(Request $request){
        $this->validate($request,[
            'search'   => 'required|min:1',
            'options'  => 'required'
        ]);
        $str = $request->input('search');
        $option = $request->input('options');
        $employees = Employee::where($option, 'LIKE' , '%'.$str.'%')->Paginate(10);
        return view('employee.index')->with(['employees' => $employees , 'search' => true ]);
    }

    private function validateRequest($request,$id){
    
        return $this->validate($request,[
            'ime'     =>  'required|min:3|max:50',
            'prezime'      =>  'required|min:3|max:50',
            'email'          =>  'required',
            'brTel'          =>  'required',
            'adresa'        =>  'required|min:10|max:500',
            'pol'         =>  'required',
            'datumRodjenja'       =>  'required',
            'satnica'       =>  'required',
            'status'         =>  'required',
            'pozicija'         =>  'required',
            'department'     =>  'required',
            'join_date'      =>  'required',

            
        ]);
    }

    /**
     * Save a new resource or update an existing resource.
     *
     * @param  App\Employee $employee
     * @param  \Illuminate\Http\Request  $request
     * @param  string $fileNameToStore
     * @return Boolean
     */
    private function setEmployee(Employee $employee,Request $request,$fileNameToStore){
        $employee->ime   = $request->input('ime');
        $employee->prezime    = $request->input('prezime');
        $employee->email        = $request->input('email');
        $employee->brTel          = $request->input('brTel');
        $employee->adresa      = $request->input('adresa');
        $employee->pol        = $request->input('pol');
        $employee->datumRodjenja   = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('datumRodjenja'))));
        $employee->satnica    = $request->input('satnica');
        if($request->hasFile('slika')){
            $employee->slika = $fileNameToStore;
        }
        $employee->status  = $request->input('status');
        $employee->pozicija    = $request->input('pozicija'); 
        $employee->department_id      = $request->input('department');
        $employee->join_date    = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('join_date'))));
        
        
        $employee->save();
    }
/**
    public function otpusti($id)
    {
        $departments  = Department::orderBy('naziv','asc')->get();

        $employee = Employee::find($id);
        return view('employee.otpusti')->with([
            'departments'  => $departments,
            'employee'     => $employee
        ]);
    }
*/

    public function prebaciUEx(Request $request, $id)
    {
        $this->validateRequestOtpusti($request,$id);
        $employee = Employee::find($id);
        $old_slika = $employee->slika;
        if($request->hasFile('slika')){
            //Upload the image
            $fileNameToStore = $this->handleImageUpload($request);
            //Delete the previous image
            Storage::delete('public/employee_images/'.$employee->slika);
        }else{
            $fileNameToStore = '';
        }


        $ex_employee = New Ex_employee();
        $ex_employee->ime   = $request->input('ime');
        $ex_employee->prezime    = $request->input('prezime');
        $ex_employee->email        = $request->input('email');
        $ex_employee->brTel          = $request->input('brTel');
        $ex_employee->adresa      = $request->input('adresa');
        $ex_employee->pol        = $request->input('pol');
        $ex_employee->datumRodjenja   = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('datumRodjenja'))));
        $ex_employee->satnica    = $request->input('satnica');
        if($request->hasFile('slika')){
            $ex_employee->slika = $fileNameToStore;
        }
        $ex_employee->pozicija    = $request->input('pozicija'); 
        $ex_employee->department_id      = $request->input('department');
        $ex_employee->join_date    = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('join_date'))));
        $ex_employee->datum_odlaska    = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('datum_odlaska'))));
        $ex_employee->razlog_odlaska = $request->input('razlog_odlaska');
        
        
        $ex_employee->save();
        $this->destroy($id);


        return redirect('/employees')->with('info','Odabrani radnik više nije zaposlen!');
    }


    private function validateRequestOtpusti($request,$id){
    
        return $this->validate($request,[
            'ime'     =>  'required|min:3|max:50',
            'prezime'      =>  'required|min:3|max:50',
            'email'          =>  'required',
            'brTel'          =>  'required',
            'adresa'        =>  'required|min:10|max:500',
            'pol'         =>  'required',
            'datumRodjenja'       =>  'required',
            'satnica'       =>  'required',
            'pozicija'         =>  'required',
            'department'     =>  'required',
            'join_date'      =>  'required',
            'datum_odlaska'      =>  'required',
            'razlog_odlaska'      =>  'required',
            'slika'      =>  'required',
        ]);
    }

    /**
     * Handle image upload when creating a new resource
     * or updating an existing resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handleImageUpload(Request $request){
        if( $request->hasFile('slika') ){
            
            //get filename with extension
            $filenameWithExt = $request->file('slika')->getClientOriginalName();
            
            //get just filename
            $filename = pathInfo($filenameWithExt,PATHINFO_FILENAME);
            
            // get just extension
            $extension = $request->file('slika')->getClientOriginalExtension();
            
            /**
             * filename to store
             * 
             *  we are appending timestamp to the file name
             *  and prepending it to the file extension just to
             *  make the file name unique.
             */
            $fileNameToStore = $filename.'.'.$extension;
            
            //upload the image
            $path = $request->file('slika')->storeAs('public/employee_images',$fileNameToStore);
        }
        /**
         *  return the file name so we can add it to database.
         */
        return $fileNameToStore;
    }

    public function handleCVUpload(Request $request){
        if( $request->hasFile('cv') ){
            
            //get filename with extension
            $filenameWithExt = $request->file('cv')->getClientOriginalName();
            
            //get just filename
            $filename = pathInfo($filenameWithExt,PATHINFO_FILENAME);
            
            // get just extension
            $extension = $request->file('cv')->getClientOriginalExtension();
            
            /**
             * filename to store
             * 
             *  we are appending timestamp to the file name
             *  and prepending it to the file extension just to
             *  make the file name unique.
             */
            $cvNameToStore = $filename.'.'.$extension;
            
            //upload the image
            $path = $request->file('cv')->storeAs('public/employee_cv',$cvNameToStore);
        }
        /**
         *  return the file name so we can add it to database.
         */
        return $cvNameToStore;
    }
}
