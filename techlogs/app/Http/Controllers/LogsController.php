<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Logs;
use App\Models\User;
use App\Models\Note;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;


class LogsController extends Controller
{
  //
  public function index()
  {

    $records = Data::all();
    return view('addLog', ['records' => $records]);
  }
  public function dashboard()
  {

    $records = Logs::where('status', '=', 'Escalated')->get();

    return view('dashboard', ['records' => $records]);
  }
  public function view()
  {
    $users = User::all();
    $logs = Logs::all();
    return view(
      'viewLogs',
      ['logs' => $logs],
      ['users' => $users]
    );
  }

  public function store(Request $request)
  {
    $data = $request->all();

    foreach ($data as $key => $value) {
        if(empty(trim($value))){
            return response()->json(['error'=>'Please fill all fields' ]);
        }
    }
    try {
      $log = new Logs();
      $log->logger_email = Auth::user()->email;
      $log->station = $request->input('station');
      $log->region = $request->input('region');
      $log->event_date = $request->input('event_date');
      $log->event_time = $request->input('event_time');
      $log->event_nature = $request->input('event_nature');
      $log->priority = $request->input('priority');
      $log->programme = $request->input('programme');
      $log->service = $request->input('service');
      $log->problem_type = $request->input('problem');
      $log->description = $request->input('description');
      $log->unit = $request->input('unit');
      $log->status = 'Open';
      $log->save();
      return response()->json(['success' => 'Data Added successfully']);

      //code...
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['error' => $th]);
    }
  }

  public function show(Request $request, $id)
  {
    $logById = Logs::findOrFail($id);
    
    return response()->json($logById);
  }


  public function update(Request $request)
  {
    $note = new Note();

    $log = Logs::find($request->input('record'));

    if ($request->input('escalated_to') !== null) {
      $log->escalated_to = $request->input('escalated_to');
      $log->escalation_comment = $request->input('comments');
      $log->status = 'Escalated';
      $log->escalation_time = Carbon::now();

      $note->from = $request->input('email');
      $note->to = $request->input('escalated_to');
      $note->is_read = 0;
      $note->type = 'Escalation';
      $note->subject =$request->input('comments') ;
      $note->head = 'escalated an event to you';
      $note->nature = $request->input('nature');
      $note->save();
    } else if ($request->input('status') !== null) {
      $log->status = $request->input('status');
      $log->action_comment = $request->input('comments');
      $log->action_time = Carbon::now();
    }

    if ($log->save()) {
      return response()->json(['success' => 'Success! : Status updated successfully']);
    } else {
      return response()->json(['error' => 'Error! : An error occured. Please try again']);
    }
  }

  public function chartData()
  {
    // data for events per year(this year)
    $finalarr = array(); //negative events
    $finalarr_n = array(); //normal events
    $finalarr_p = array(); //prioroties
    $arr = array();
    $arr_n = array();
    $arr_p = array();
    $thisYear = Carbon::now()->year;
    // initialize the values
    $initvals = array("January" => 0, "February" => 0, "March" => 0, "April" => 0, "May" => 0, "June" => 0, "July" => 0, "August" => 0, "September" => 0, "October" => 0, "November" => 0, "December" => 0);
    $initvals_n = array("January" => 0, "February" => 0, "March" => 0, "April" => 0, "May" => 0, "June" => 0, "July" => 0, "August" => 0, "September" => 0, "October" => 0, "November" => 0, "December" => 0);
    $initvals_p = array("Low" => 0, "Normal" => 0, "High" => 0, "Emergency" => 0);

    // get the data from db
    $logs = Logs::all();

    //  Get escalated events
    foreach ($logs as $log) {

      $year = Carbon::createFromFormat('Y-m-d', $log->event_date)->format('Y');

      if ($year == $thisYear) {
        $month = Carbon::createFromFormat('Y-m-d', $log->event_date)->format('F');
        if ($log->event_nature == 'Normal Event') {
          array_push($arr_n, $month);
        }
        if ($log->event_nature == 'Negative Incident') {
          array_push($arr, $month);
        }
        array_push($arr_p, $log->priority);
      }
    }
    // count number of events per month
    $monthCount_n = array_count_values($arr_n);
    $monthCount = array_count_values($arr);
    $priorityCount = array_count_values($arr_p);

    //  change the month count array
    foreach ($monthCount as $key => $value) {
      $initvals[$key] = $value;
    }
    foreach ($monthCount_n as $key => $value) {
      $initvals_n[$key] = $value;
    }
    foreach ($priorityCount as $key => $value) {
      $initvals_p[$key] = $value;
    }
    // extract the value
    foreach ($initvals as $key => $value) {
      array_push($finalarr, $value);
    }
    foreach ($initvals_n as $key => $value) {
      array_push($finalarr_n, $value);
    }
    foreach ($initvals_p as $key => $value) {
      array_push($finalarr_p, $value);
    }
    //get year,month,today for all three status
    $esc_all = $this->counter('Escalated');
    
    $open_all = $this->counter('Open');
   
    $closed_all = $this->counter('Closed');

    return response(array($finalarr, $finalarr_n, $finalarr_p, $esc_all, $open_all, $closed_all));
  }

  public function counter($type)
  {

    $arr_year = 0;
    $arr_last_year = 0;
    $arr_month = 0;
    $arr_last_month = 0;
    $arr_today = 0;
    $arr_yesterday = 0;

    $thisYear = Carbon::now()->year;
    $today = Carbon::now()->format('Y-m-d');
    $thisMonth = Carbon::now()->month;
    $lastMonth = Carbon::now()->subMonth()->month;
    $yesterday = Carbon::yesterday()->format('Y-m-d');


    $logs = Logs::where('status', '=', $type)->get();


    foreach ($logs as $log) {

      $month = Carbon::createFromFormat('Y-m-d', $log->event_date)->month;
      $year = Carbon::createFromFormat('Y-m-d', $log->event_date)->format('Y');

      if ($month == $thisMonth) {
        $arr_month += 1;
      }
      if ($month == $lastMonth) {
        $arr_last_month += 1;
      }
      if ($today == $log->event_date) {
        $arr_today += 1;
      }
      if ($yesterday == $log->event_date) {
        $arr_yesterday += 1;
      }
      if ($thisYear == $year) {
        $arr_year += 1;
      }
      if (($thisYear - 1) == $year) {
        $arr_last_year += 1;
      }
    } //end foreach
    //calculate percentages
   return (array(
        $arr_today,
        $arr_month,
        $arr_year,
       $this-> percentage($arr_today,$arr_yesterday),
       $this-> percentage($arr_month,$arr_last_month),
       $this-> percentage($arr_year,$arr_last_year)
      ));
  }

  public function percentage($now,$then){
    
    if($now==0 && $then >$now){
      
      return -100;
    }elseif($then==0 && $then < $now){
        return 100;
    }
    elseif($now-$then==0){
      return 0;
  }
    else{
      return ((($now - $then)/$now) * 100);
    }
  }

}
