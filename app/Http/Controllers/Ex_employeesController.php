<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Ex_employee;
use App\Department;
use DB;

class Ex_employeesController extends Controller
{
   public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $departments = Department::orderBy('naziv','asc')->get();

        $ex_employees = Ex_employee::Paginate(4);

        return view('ex_employee.index')->with([
            'ex_employees'  =>  $ex_employees,
            'departments'   =>  $departments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::orderBy('naziv','asc')->get();
  
        return view('ex_employee.create')->with([
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


        $ex_employee = new Ex_employee();

        $this->setEx_employee($ex_employee,$request,$fileNameToStore);
        
        return redirect('/ex_employees')->with('info','Kreiran!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ex_employee  $ex_employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ex_employee = Ex_employee::find($id);
        return view('ex_employee.show')->with('ex_employee',$ex_employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ex_employee  $ex_employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments  = Department::orderBy('naziv','asc')->get();

        $ex_employee = Ex_employee::find($id);
        return view('ex_employee.edit')->with([
            'departments'  => $departments,
            'ex_employee'     => $ex_employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ex_employee  $ex_employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request,$id);
        $ex_employee = Ex_employee::find($id);
        $old_slika = $ex_employee->slika;
        if($request->hasFile('slika')){
            //Upload the image
            $fileNameToStore = $this->handleImageUpload($request);
            //Delete the previous image
            Storage::delete('public/ex_employee_images/'.$ex_employee->slika);
        }else{
            $fileNameToStore = '';
        }

        
        /**
         *  updating an existing ex_employee with setex_employee
         *  method
         */
        $this->setEx_employee($ex_employee,$request,$fileNameToStore);
        return redirect('/ex_employees')->with('info','Odabrani zaposleni je ažuriran!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ex_employee  $ex_employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ex_employee = Ex_employee::find($id);
        $ex_employee->delete();
        Storage::delete('public/ex_employee_images/'.$ex_employee->slika);
        return redirect('/ex_employees')->with('info','Odabrani zaposleni je obrisan!');
    }

    public function search(Request $request){
        $this->validate($request,[
            'search'   => 'required|min:1',
            'options'  => 'required'
        ]);
        $str = $request->input('search');
        $option = $request->input('options');
        $ex_employees = Ex_employee::where($option, 'LIKE' , '%'.$str.'%')->Paginate(4);
        return view('ex_employee.index')->with(['ex_employees' => $ex_employees , 'search' => true ]);
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
            'pozicija'         =>  'required',
            'department'     =>  'required',
            'join_date'      =>  'required',

            
        ]);
    }

    /**
     * Save a new resource or update an existing resource.
     *
     * @param  App\ex_employee $ex_employee
     * @param  \Illuminate\Http\Request  $request
     * @param  string $fileNameToStore
     * @return Boolean
     */
    private function setEx_employee(ex_employee $ex_employee,Request $request,$fileNameToStore){
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
        $ex_employee->razlog_odlaska  = $request->input('razlog_odlaska');
        $ex_employee->pozicija    = $request->input('pozicija'); 
        $ex_employee->department_id      = $request->input('department');
        $ex_employee->join_date    = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('join_date'))));
        $ex_employee->datum_odlaska    = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('datum_odlaska'))));
        
        
        $ex_employee->save();
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
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
            //upload the image
            $path = $request->file('slika')->storeAs('public/ex_employee_images',$fileNameToStore);
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
            $cvNameToStore = $filename.'_'.time().'.'.$extension;
            
            //upload the image
            $path = $request->file('cv')->storeAs('public/ex_employee_cv',$cvNameToStore);
        }
        /**
         *  return the file name so we can add it to database.
         */
        return $cvNameToStore;
    }
}
