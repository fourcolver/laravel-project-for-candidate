<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests\AddEmployeeRequest;

/**
 * Class EmployeeController
 * @package App\Http\Controllers\Admin
 */
class EmployeeController extends Controller
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
    /*
    * @created : Mar 28, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to show all Documents
    * @params  : None
    * @return  : None
    */
    public function index()
    {
        return view('employee.index');
    }
    
    /*
    * @created : April 02, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get all Documents
    * @params  : None
    * @return  : None
    */

    public function getAllEmployees()
    {
         DB::statement(DB::raw('set @rownumber= 0'));
        // $users = DB::table('users')
        //             ->select(DB::raw('@rownumber:=@rownumber+1 as S_No'),'users.*')
        //             ->where('user_role','2')
        //             ->get();

        // Modified today

         $users = DB::table('users')
                    ->select(DB::raw('@rownumber:=@rownumber+1 as S_No'),'users.*')
                    ->where('user_role','2')
                    ->where('status','1')
                    ->get();
        return \Response::json($users);
    }

    /*
    * @created : April 26, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to add new Employee
    * @params  : None
    * @return  : None
    */

    public function add(AddEmployeeRequest $request)
    {
        $status = "success";
        try
        {
            $data = array(
                'first_name'        => $request->input('first_name'),
                'last_name'         => $request->input('last_name'),
                'email'             => $request->input('employee_email'),
                'password'          => bcrypt($request->input('employee_password')),
                'user_role'         =>'2',
                'remember_token'    => $request->input('remember_token'),
            );
            $details = DB::table('users')->insert($data);
            $emp_id = DB::table('users')
                            ->select('id')
                            ->orderBy('id', 'desc')->first();
            $emp_data = array(
            'emp_id' => $emp_id->id,
            'emp_view' => 'view',
            );
            DB::table('emp_permission')->insert($emp_data);
            $result = "Empployee Added Successfully";
        }
        catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
        }
        return (json_encode(array('status'=>$status,'message'=>$result ))) ;

    }

    /*
    * @created : April 26, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Check Email Id Exist or not
    * @params  : None
    * @return  : None
    */

    public function checkEmailExist(Request $request)
    {
        $email = $request->input('email');
        if (DB::table('users')->where('email', '=', $email)->exists()) {
            return 'error';
        }
        else
        {
            return 'available';
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view ($id)
    {
        $details = DB::table('users')
                                ->join('emp_permission', 'users.id', '=', 'emp_permission.emp_id')
                                ->where('emp_id',$id)
                                ->get();

        $employee = User::findOrFail($id);
        return view('employee.view_permission',['details' => $details, 'employee' => $employee]);
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function setGoal(Request $request)
    {
        $status = "success";
        /** @var User $user */
        $user = User::findOrFail($request->input('goal_by'));
        if(!$goal = $user->goal) {
            $goal = $user->goal()->create([]);
        }
        $goal->update([
            'client_activity' => $request->input('client_activity'),
            'client_add' => $request->input('client_add'),
            'candidate_add' => $request->input('candidate_add'),
            'oppo_add' => $request->input('oppo_add'),
        ]);
        $result = "Goal Inserted Successfully";
        return json_encode(['status' => $status,'message' => $result]);
    }

    public function getGoals(Request $request)
    {
        $id = $request->input('id');
        $data = DB::table('goal_setby_users')->where('set_by',$id)->first();
        return \Response::json($data);
    }

    public function setPermission(Request $request, $id)
    {
        $kunden_permission = '';
        $knotakte_permission = '';
        $kandidaten_permission = '';
        $projektanfrage_permission = '';
        $task_permission = '';
        $festanstellung_roles='';
        if ($request->has(['kunden_roles'])) 
        {
            $kunden_permission = implode(",",$request->input('kunden_roles'));
        }
        if ($request->has(['manager_roles'])) 
        {
            $knotakte_permission = implode(",",$request->input('manager_roles'));
        }
        if ($request->has(['opportunity_roles'])) 
        {
            $projektanfrage_permission = implode(",",$request->input('opportunity_roles'));
        }
        if ($request->has(['freelancer_roles'])) 
        {
            $kandidaten_permission = implode(",",$request->input('freelancer_roles'));
        }
        if ($request->has(['festanstellung_roles'])) 
        {
            $festanstellung_permission = implode(",",$request->input('festanstellung_roles'));
        }
        if ($request->has(['task_roles'])) 
        {
            $task_permission = implode(",",$request->input('task_roles'));
        }
        $data = array(
            'emp_id'                    => $id,
            'kunden_permission'         => $kunden_permission,
            'knotakte_permission'       => $knotakte_permission,
            'kandidaten_permission'     => $kandidaten_permission,
            'festanstellung_permission' => $festanstellung_permission,
            'projektanfrage_permission' => $projektanfrage_permission,
            'task_permission'           => $task_permission,
            );
        if (DB::table('emp_permission')->where('emp_id', '=', $id)->exists()) {
            $details = DB::table('emp_permission')->where('emp_id',$id)->update($data);
            return redirect('admin/employees/view/'.$id)->with('update', 'Permission Updated Successfully');
        }
        else
        {
            $details = DB::table('emp_permission')->insert($data);
            return redirect('admin/employees/view/'.$id)->with('update', 'Permission Updated Successfully');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $status = "success";
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            $result = "All Employee Record Deleted Succesfuuly";
        } catch(\Exception $ex) {
          $status = "error";
          $result = $ex->getMessage();
        }
        return response()->json(['status'=>$status,'message'=>$result]);
    }
}
