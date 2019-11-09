<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use App\Contacts;
use App\Task;
use App\Accounts;
use Response;
use Session;
use App\Http\Requests;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddTasksRequest;


class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard After Login.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $permission = [];
        if(!$user->isAdmin)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
        }
        $countries = DB::table('task')->get();
        $accounts = DB::table('accounts')
        ->select('id','account_name')
        ->get();
        return view('task.index',['accounts' => $accounts,'countries' => $countries,'permission' => $permission]);
    }

    /*
    * @created : Mar 19, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get All Tasks
    * @params  : None
    * @return  : None
    */
    public function getAllTasks()
    {   
        $user = Auth::user();
        $emp_id = SESSION::get('id');
        $permission = [];
        $task_data = [];
        $task = new task;
        DB::statement(DB::raw('set @rownumber= 0'));
        $task = $task->join('accounts', 'accounts.id', '=', 'task.account_id')
        ->select(DB::raw('DATE_FORMAT(task_date, "%d-%m-%Y") as task_date'),DB::raw('@rownumber:=@rownumber+1 as S_No'),'task.id as id','task.priority','task.task_status','task.description','task.task_owner','accounts.id as account_id','accounts.account_name','accounts.account_status as account_status')
                    // ->orderBy('task.id', 'asc')
        ->where('task.task_status', '!=', 'Completed');
        // if(!$user->isAdmin)
        // {
        //     $task = $task->where('accounts.added_by',$user->id);
        // } 
        if(!$user->isAdmin)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
            $task_roles = explode(',', $permission->task_permission);
            if(!in_array('all', $task_roles))
            {
                $task = $task->where('accounts.added_by',$user->id);
            }
            
        }
        $task = $task->get();
        $task = json_decode(json_encode($task));
        if(!empty($task))
        {
            foreach ($task as $key => $value) {
                $task_data[] = (array)$value;
                if($emp_id!=1)
                {
                    $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
                    $task_data[$key]['permission'] = $permission;
                }
                else
                {
                    $permission['admin'] = 'admin';
                    $task_data[$key]['permission'] = $permission;  
                }
            }
            return Response::json($task_data);
        }
        return Response::json($task);
    }

    /*
    * @created : Mar 23, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Delete Particular Task
    * @params  : ID
    * @return  : Delete Successfully
    */
    public function delete($id)
    {
        $task = DB::table('task')->where('id',$id)->delete();
        return 'success';
    }

    /*
    * @created : Mar 20, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Edit Task Details
    * @params  : ID
    * @return  : None
    */
    public function edit($id)
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        $users = DB::table('users')
        ->whereIn('user_role', array('1','2'))
        ->get();
        $task_type = array('Call','Email','Follow Up','Note','Meeting');
        $details = DB::table('task')
        ->join('accounts', 'accounts.id', '=', 'task.account_id')
        ->join('users as ac', 'ac.id', '=', 'task.task_owner')
        ->select('task.*', 'accounts.id as account_id','accounts.account_name', 'ac.id as owner_id','ac.first_name as owner_name')
        ->orderBy('id', 'asc')
        ->where('task.id',$id)
        ->get();
        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        return view('task.edit_task',['details' => $details,'task_type' => $task_type],['users' => $users,'permission' => $permission]);
    }

    /*
    * @created : Mar 20, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Update Task Details
    * @params  : ID
    * @return  : Suucess message
    */
    public function update(AddTasksRequest $request,$id)
    {
        $status = "success";
        try
        {
            $data = array(
                'task_date'         =>  $request->input('task_date'),
                'priority'          => $request->input('task_priority'),
                'task_status'       => $request->input('task_status'),
                'task_type'         => $request->input('task_type'),
                'task_owner'        => $request->input('task_owner'), 
                'description'        => $request->input('description'),
            );
            
            $data = DB::table('task')
            ->where('id', $id)
            ->update($data);
            $result = "Task Updated Successfully";
        }
        catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
      }
      return (json_encode(array('status'=>$status,'message'=>$result ))) ;
  }

    /*
    * @created : Mar 20, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Update Task Details
    * @params  : ID
    * @return  : Suucess message
    */
    public function changeStatus($id)
    {
        $data = DB::table('task')
        ->select('task_status')
        ->where('id', $id)
        ->get();
        $data = json_decode(json_encode($data));
        $task_status = $data[0]->task_status;
        if($task_status !='Completed')
        {
            redirect('admin/tasks/edit/'.$id)->with('error_msg', 'Please change the status of Task Completed First');
            return response()->json([
                "message" => "Error"
            ]);
        }
        $task = DB::table('task')->where('id',$id)->delete();
        return response()->json([
            "message" => "Success"
        ]);
    }

    /*
    * @created : Mar 20, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Add new Task.
    * @params  : None
    * @return  : Success Message
    */
    public function addNewTask(AddTasksRequest $request)
    {
        $tasks = new Task;
        $tasks->task_date      = $request->input('task_date');
        $tasks->account_id     = $request->input('account_id'); 
        $tasks->priority       = $request->input('task_priority'); 
        $tasks->task_status    = $request->input('task_status'); 
        $tasks->task_type      = $request->input('task_type');
        $tasks->task_owner     = $request->input('task_owner'); 
        $tasks->description    = $request->input('description');
        $tasks->save();
        return 'success';
    }

    public function getTasksCalendar()
    {
        $user = Auth::user();
        $task = new task;
        $task = $task->join('accounts', 'accounts.id', '=', 'task.account_id')
                    //->join('calendar_events','calendar_events.user_id','=','accounts.added_by')
        ->where('task.task_status', '!=', 'Completed');
        // if(!$user->isAdmin)
        // {
        //     $task = $task->where('accounts.added_by',$user->id);
        // }
        if(!$user->isAdmin)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
            $task_role = explode(',', $permission->task_permission);
            if(!in_array('all', $task_role))
            {
                $task = $task->where('accounts.added_by',$user->id);
            }
            
        } 
        $task = $task->get()->toArray();
        $events_data = DB::table('calendar_events')->get()->toArray();
        //print_r($events_data);
        //die;
        $task = array_merge($task, $events_data);
        return \Response::json($task);
    }
    
    public function getTasksData()
    { 
        $user = Auth::user();  
        $task = new task;
        $task = $task->join('accounts', 'accounts.id', '=', 'task.account_id')
        ->join('users', 'users.id', '=', 'task.task_owner')
        ->select(DB::raw('DATE_FORMAT(task_date, "%d-%m-%Y") as task_date'),'task.id as id','task.priority','task.task_status','task.description','task.task_owner','accounts.id as account_id','accounts.account_name','accounts.account_status as account_status', 'users.first_name');
        $task = $task->where('task.task_status', '!=', 'Completed')->where('task.task_owner',$user->id);
        $task = $task->orderBy('id', 'asc')->get();
        return Response::json($task);
    }

}
