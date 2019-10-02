<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Candidate;
use App\Department;
use App\Employee;
use DB;

class CandidatesController extends Controller
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
        $candidates = Candidate::Paginate(4);
        return view('candidate.index')->with('candidates',$candidates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
  
        return view('candidate.create');
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

        $cvNameToStore = $this->handleCVUpload($request);


        $candidate = new Candidate();

        $this->setCandidate($candidate,$request,$fileNameToStore,$cvNameToStore);
        
        return redirect('/candidates')->with('info','Kreiran je nov kandidat!');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate = Candidate::find($id);
        return view('candidate.show')->with('candidate',$candidate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\candidate  $candidate
     * @return \Illuminate\Http\Response
     */
  public function edit($id)
    {
        $departments  = Department::orderBy('naziv','asc')->get();

        $candidate = Candidate::find($id);
        return view('candidate.edit')->with([
            'departments'  => $departments,
            'candidate'     => $candidate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequestZaposli($request,$id);
        $candidate = Candidate::find($id);
        $old_slika = $candidate->slika;
        if($request->hasFile('slika')){
            //Upload the image
            $fileNameToStore = $this->handleImageUploadEmployee($request);
            //Delete the previous image
        }else{
            $fileNameToStore = '';
        }

            Storage::delete('public/candidate_cv/'.$candidate->cv);
      
            $cvNameToStore = '';

        $employee = new Employee();
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
        $this->destroy($id);

        return redirect('/candidates')->with('info','Odabrani kandidat je zaposlen!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::find($id);
        $candidate->delete();
        Storage::delete('public/candidate_images/'.$candidate->slika);
        return redirect('/candidates')->with('info','Odabrani kandidat je obrisan!');
    }

    public function search(Request $request){
        $this->validate($request,[
            'search'   => 'required|min:1',
            'options'  => 'required'
        ]);
        $str = $request->input('search');
        $option = $request->input('options');
        $candidates = candidate::where($option, 'LIKE' , '%'.$str.'%')->Paginate(4);
        return view('candidate.index')->with(['candidates' => $candidates , 'search' => true ]);
    }

    private function validateRequest($request,$id){
    
        return $this->validate($request,[
            'ime'     =>  'required|min:3|max:50',
            'prezime'      =>  'required|min:3|max:50',
            'email'          =>  'required',
            'brTel'          =>  'required',
            'adresa'        =>  'required|min:10|max:500',
            'pol'         =>  'required',
            'datumRodjenja'       =>  'required'
            
        ]);
    }

	

    private function validateRequestZaposli($request,$id){
    
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
     * @param  App\candidate $candidate
     * @param  \Illuminate\Http\Request  $request
     * @param  string $fileNameToStore
     * @return Boolean
     */
    private function setCandidate(Candidate $candidate,Request $request,$fileNameToStore,$cvNameToStore){
        $candidate->ime   = $request->input('ime');
        $candidate->prezime    = $request->input('prezime');
        $candidate->email        = $request->input('email');
        $candidate->brTel          = $request->input('brTel');
        $candidate->adresa      = $request->input('adresa');
        $candidate->pol        = $request->input('pol');
        $candidate->datumRodjenja   = date('Y-m-d', strtotime(str_replace('-', '/', $request->input('datumRodjenja'))));
        if($request->hasFile('slika')){
            $candidate->slika = $fileNameToStore;
        }
        if($request->hasFile('cv')){
            $candidate->cv = $cvNameToStore;
        }
        
        $candidate->save();
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
            $path = $request->file('slika')->storeAs('public/candidate_images',$fileNameToStore);
        }
        /**
         *  return the file name so we can add it to database.
         */
        return $fileNameToStore;
    }


public function handleImageUploadEmployee(Request $request){
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
            $path = $request->file('cv')->storeAs('public/candidate_cv',$cvNameToStore);
        }
        else
        {
            $cvNameToStore = '';
        }
        /**
         *  return the file name so we can add it to database.
         */
        return $cvNameToStore;
    }
}
