<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Attendance;
use PDF;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade;
use DB;
use Yajra\DataTables\Facades\DataTables;

class ReportsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function index()
    {
         $attendances = Attendance::Paginate(20);
        $employees = Employee::orderBy('prezime','asc')->get();
        $departments = Department::orderBy('naziv','asc')->get();

        return view('reports.index')->with([
            'employees'     => $employees,
            'attendances'   => $attendances,
            'departments'   => $departments

        ]);
    }


    public function get_datatable()
    {
        return Datatables::eloquent(Attendance::query())->make(true);

    }


    public function getEmployees(Request $request)
    {
          $employees = Employee::where('department_id', $department_id)->pluck('ime', 'id');
       
        return response()->json($employees);
    }


    public function getAttendances(Request $request)
    {
        $attendances = Attendance::orderBy('employee_id','asc')->where("employee_id", $request->employee_id);
        return response()->json($attendances);

    }



    public function makeReport(Request $request){
        $this->validate($request,[
            'date_from' => 'required',
            'date_to'   => 'required',
            'employee'  => 'required'
        ]);
        
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $employee = Employee::find($request->input('employee'));

      

        $attendances = Attendance::whereBetween('datum' ,[new Carbon($date_from),new Carbon($date_to)])->where('employee_id',$employee->id)->orderBy('datum','asc')->get();
      	
        $zarada = 0;

        foreach ($attendances as $attendance) {
            $zarada += $attendance->employee->satnica;
        }
      

        //generate pdf
        $pdf = PDF::loadView('reports.report',[

            'attendances' => $attendances,
            'employee' => $employee,
            'zarada' => $zarada,
            'date_from' => $date_from,
            'date_to' => $date_to

        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Payroll_report_from_'.$date_from.'_to_'.$date_to.'.pdf');
    }


}
