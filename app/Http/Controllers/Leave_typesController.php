<?php

namespace App\Http\Controllers;

use App\Leave_type;
use Illuminate\Http\Request;

class Leave_typesController extends Controller
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
        $leave_types = Leave_type::orderBy('naziv','asc')->Paginate(4);

        return view('leave_types.index')->with('leave_types',$leave_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
            'naziv' => 'required|min:4|unique:leave_types'
        ]);

         $leave_type = new Leave_type();
        $leave_type->naziv = $request->input('naziv');
        $leave_type->procenat_satnice = $request->input('procenat_satnice');
        
        $leave_type->save();

        return redirect('/leave_types')->with('info','tip odsustva je uspešno kreiran!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave_type  $leave_type
     * @return \Illuminate\Http\Response
     */
    public function show(Leave_type $leave_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave_type  $leave_type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leave_type = Leave_type::find($id);
        
         /**
         *  return the view with the specified resource.
         */
        
         return view('leave_types.edit')->with('leave_type',$leave_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave_type  $leave_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'naziv' => 'required|unique:leave_types,naziv,'.$id.'|min:4'
        ]);
        
        /**
         *  it's the same as creating a new resource,
         *  but we are modifying an existing resource
         *  so first we'll find it by it's id then, save it. 
         */
        
        $leave_type = Leave_type::Find($id);
        $leave_type->naziv = $request->input('naziv');
        $leave_type->procenat_satnice = $request->input('procenat_satnice');
        $leave_type->save();

        /**
         *  redirecting with a message.
         */
        return redirect('/leave_types')->with('info','Odabrani tip je uspešno izmenjen!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave_type  $leave_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave_type = Leave_type::find($id);
        $leave_type->delete();
        return redirect('/leave_types')->with('info','Odabrani yip je obrisan!');
    }


    public function search(Request $request){
        $this->validate($request,[
            'search' => 'required'
        ]);
        $str = $request->input('search');
        $leave_types = Leave_type::where( 'naziv' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('naziv','asc')
            ->paginate(4);
        return view('leave_types.index')->with([ 'leave_types' => $leave_types ,'search' => true ]);
    }
}
