<?php

namespace App\Http\Controllers\Admin;
use App\AccountList;
use App\CompetenceSkill;
use App\Country;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Accounts;
use App\Contacts;
use App\Opportunity;
use App\Task;
use App\AccountLog;
use Response;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddAccountsRequest;
use App\Http\Requests\EditAccountsRequest;


class AccountsAdminController extends Controller
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
        $countries = Country::all();
        $users = User::isAdmin()->get();
        $accountLists = AccountList::forUser(currentUser());
        $skills = CompetenceSkill::get();

        return view('accounts_admin.index',compact(
            'countries',
            'permission',
            'users',
            'accountLists',
            'skills'
        ));
    }

    /*
    * @created : April 24, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get All Accounts
    * @params  : None
    * @return  : None
    */
    public function getAllAccounts(Request $request)
    {
        $user = Auth::user();
        $accounts = new accounts;
        DB::statement(DB::raw('set @rownumber= 0'));
        $accounts = $accounts->select(DB::raw('@rownumber:=@rownumber+1 as S_No'),'users.first_name','users.last_name','accounts.*')->join('users', 'accounts.added_by', '=', 'users.id')->where('accounts.account_status','1')->orderBy('accounts.id', 'asc');
        if(!$user->isAdmin)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
            $kunden_role = explode(',', $permission->kunden_permission);
            if(!in_array('all', $kunden_role))
            {
                $accounts = $accounts->where('accounts.added_by',$user->id);
            }
            
        }
        $val = (isset($request->datatable['query']['searchhotness']) && ($request->datatable['query']['searchhotness']!="all") ? $request->datatable['query']['searchhotness'] : '');
        if($val!="")
        {
            $range = explode("-",$val);
            $min = $range[0];
            $max = $range[1]+1;
            $account = [];
            $accounts = $accounts->whereBetween('accounts.client_specification', array($min, $max));
        }
        $accounts = $accounts->get();
        $accounts = json_decode(json_encode($accounts));
        if(!empty($accounts)){
        foreach ($accounts as $key => $value) {
            $account[] = (array)$value;
            $data = DB::table('account_log')
                    ->select(DB::raw('DATE_FORMAT(timestamp, "%d-%m-%Y") as timestamp'))
                    ->where('account_id',$value->id)
                    ->orderBy('id', 'desc')
                    ->first();
            $account[$key]['last_activity'] = (isset($data->timestamp) ? $data->timestamp : null);
            $account[$key]['searchhotness'] = $val;
        }
        return Response::json($account);}
        return Response::json($accounts);
    }

    /*
    * @created : April 24, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Delete Particular Account
    * @params  : ID
    * @return  : Delete Successfully
    */
    public function delete($id)
    {
        $status = "success";
        try 
        {
            $account = DB::table('accounts')->where('id',$id)->delete();
            $result = "Client Deleted Successfully";
        } catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
        }
        return (json_encode(array('status'=>$status,'message'=>$result ))) ;
    }

    /*
    * @created : April 24, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to View accounts Details
    * @params  : ID
    * @return  : all Details of Account
    */
    public function view($id)
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        $details = DB::table('accounts')->where('id',$id)->get();
        $next_id = $details[0]->id;
        $next    = DB::table('accounts')
                    ->select('id','account_name')
                    ->where('account_status','1')
                    ->where('id','>',$next_id)->first();
        $next_count = DB::table('accounts')
                    ->select('id')
                    ->where('account_status','1')
                    ->where('id','>',$next_id)->count();
        $previous = DB::table('accounts')
                    ->select('id','account_name')
                    ->orderBy('id', 'desc')
                    ->where('account_status','1')
                    ->where('id','<',$next_id)->first();
        $previous_count = DB::table('accounts')
                    ->select('id')
                    ->where('account_status','1')
                    ->where('id','<',$next_id)->count();
        $users = DB::table('users')
                    ->where('user_role','1')
                    ->get();
        $countries = DB::table('countries')->get();
        $contacts = DB::table('contacts')
                    ->where('account_id',$id)
                    ->get();
        $accounts = DB::table('accounts')
                    ->select('id','account_name')
                    ->where('account_status','1')
                    ->get();
        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        $task_type = array('Call','Email','Follow Up','Note','Meeting');
        return view('accounts_admin.view_accounts',compact('details','task_type','users','countries','next','next_count','previous','previous_count','contacts','accounts','permission'));
    }

    /*
    * @created : April 24, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Edit accounts Details
    * @params  : ID
    * @return  : None
    */
    public function edit($id)
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        $countries = DB::table('countries')->get();
        $users = DB::table('users')
                    ->where('user_role','1')
                    ->get();
        $details = DB::table('accounts')->where('id',$id)->get();
        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        return view('accounts_admin.edit_accounts',['details' => $details,'user' => $users],['countries' => $countries,'permission'=>$permission]);
    }

    /*
    * @created : April 24, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Update accounts Details
    * @params  : ID
    * @return  : Suucess message
    */
    public function update(EditAccountsRequest $request,$id)
    {
        $status = "success";
        try
        {
            if($request->has('Technology'))
            {
                $technology = implode(",",$request->input('Technology'));
            }else{ $technology = '';}
            if($request->has('sub_lable'))
            {
                $sub_lable                      = implode(",",$request->input('sub_lable'));
            }else{ $sub_lable = '';}
            if($request->has('decision_maker')){$decision_maker = '1';}else{$decision_maker = '0';}
            if($request->has('job_outcome')){$job_outcome = '1';}else{$job_outcome = '0';}
                $data = array(
                    'account_name'         =>  $request->input('account_name'),
                    'prozesse'             =>  $request->input('prozesse'),
                    'city'                 => $request->input('city'),
                    'pincode'              => $request->input('pincode'),
                    'country'              => $request->input('country'),
                    'freelancers'          => $request->input('freelancers'), 
                    'Technology'           => $technology, 
                    'last_time_contact'    => $request->input('last_time_contact'),
                    'type_of_client'       => $request->input('type_of_client'),
                    'client_specification' => $request->input('client_specification'),
                    'owner'                => $request->input('owner'),
                    'source'               => $request->input('source'),
                    'sub_lable'            => $sub_lable,
                    'telephone'            => $request->input('telephone'),
                    'comments'             => $request->input('comments'),
                    'decision_maker'       => $decision_maker,
                    'departement_size'     => $request->input('departement_size'),
                    'job_outcome'          => $job_outcome,
                    'account_status'       => '1',
            );
            
            $data = DB::table('accounts')
                    ->where('id', $id)
                    ->update($data);
            $result = "Kunden Details Updated Successfully";
        }
        catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
        }
        return (json_encode(array('status'=>$status,'message'=>$result ))) ;
    }

    /*
    * @created : April 24, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Show contacts related to account
    * @params  : ID
    * @return  : all Details of Contacts
    */
    public function ContactsDetails($id)
    {
        $user = Auth::user();
        $emp_id = SESSION::get('id');
        $permission = [];
        $contact_data = [];
        $contacts = new contacts;
        $contacts = $contacts
                    ->join('accounts', 'accounts.id', '=', 'contacts.account_id')
                    ->select('contacts.*', 'accounts.id as account_id','accounts.account_name')
                    ->where('account_id',$id);
        if(!$user->isAdmin)
        {
            $emp_permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
            $manager_roles = explode(',', $emp_permission->knotakte_permission);
            if(!in_array('all', $manager_roles))
            {
                $contacts = $contacts->where('accounts.added_by',$user->id);
            }
            
        }
        $contacts = $contacts->get();
        $contacts = json_decode(json_encode($contacts));
        if(!empty($contacts))
        {
            foreach ($contacts as $key => $value) {
                $contact_data[] = (array)$value;
                if($emp_id!=1)
                {
                    $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
                    $contact_data[$key]['permission'] = $permission;
                }
                else
                {
                    $permission['admin'] = 'admin';
                    $contact_data[$key]['permission'] = $permission;  
                }
            }
             return Response::json($contact_data);
        }
        return Response::json($contacts);
    }

    /*
    * @created : Mar 22, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Show Opportunity related to account
    * @params  : ID
    * @return  : all Details of Contacts
    */
    public function OpportunityDetails($id)
    {
        $user = Auth::user();
        $emp_id = SESSION::get('id');
        $permission = [];
        $opportunity = new opportunity;
        $opportunity_data = [];
        $opportunity = $opportunity
                    ->join('accounts', 'accounts.id', '=', 'opportunity.account_id')
                    ->select('opportunity.*', 'accounts.id as account_id','accounts.account_name')
                    ->where('account_id',$id);
        if(!$user->isAdmin)
        {
            $emp_permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
            $opportunity_roles = explode(',', $emp_permission->projektanfrage_permission);
            if(!in_array('all', $opportunity_roles))
            {
                $opportunity = $opportunity->where('accounts.added_by',$user->id);
            }
            
        }
        $opportunity = $opportunity->get();
        $opportunity = json_decode(json_encode($opportunity));
        if(!empty($opportunity))
        {
            foreach ($opportunity as $key => $value) {
                $opportunity_data[] = (array)$value;
                if($emp_id!=1)
                {
                    $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
                    $opportunity_data[$key]['permission'] = $permission;
                }
                else
                {
                    $permission['admin'] = 'admin';
                    $opportunity_data[$key]['permission'] = $permission;  
                }
            }
             return Response::json($opportunity_data);
        }
        return Response::json($opportunity);
    }

    /*
    * @created : Mar 22, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Show Task related to account
    * @params  : ID
    * @return  : all Details of Contacts
    */
    public function TaskDetails($id)
    {
        $user = Auth::user();
        $emp_id = SESSION::get('id');
        $permission = [];
        $task_data = [];
        $task = new task;
        $task = $task
                    ->join('accounts', 'accounts.id', '=', 'task.account_id')
                    ->select(DB::raw('DATE_FORMAT(task_date, "%d-%m-%Y") as task_date'),'task.id as id','task.priority','task.task_status','task.description','task.task_owner','accounts.id as account_id','accounts.account_name','accounts.account_status as account_status')
                    ->where('task.account_id',$id)
                    ->where([['task.task_status', '!=', 'Completed']]);
        if(!$user->isAdmin)
        {
            $emp_permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
            $task_roles = explode(',', $emp_permission->task_permission);
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
    * @created : April 24, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Delete Account Comment
    * @params  : ID
    * @return  : none
    */

    public function deleteComment($acc_id,$id)
    {
        $status = "success";
        try { //->update(['name' => $request->name])
            $data = DB::table('account_log')
                        ->where([['id', '=', $id],['account_id', '=', $acc_id],])
                        ->delete();
            $result = "Comment Deleted Successfully";
        } catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
        }
        return (json_encode(array('status'=>$status,'message'=>$result ))) ;
    }

    /*
    * @created : April 24, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Delete Account Comment
    * @params  : ID
    * @return  : none
    */

    public function editComment(Request $request,$acc_id,$id)
    {
        $comment = $_GET['comment_text'];
        $status = "success";
        $data = array(
                'comment'         =>  $comment,
                'timestamp'       => date('Y-m-d H:i:s'),
        );
        try { //->update(['name' => $request->name])
            $data = DB::table('account_log')
                ->where([['id', '=', $id],['account_id', '=', $acc_id],])
                ->update($data);
            $result = "Comment Updated Successfully";
        } catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
        }
        return (json_encode(array('status'=>$status,'message'=>$result ))) ;
    }

     public function CommentsDetails($id,$acc_id)
    {
        $user = Auth::user();
        $comments = new AccountLog();
        $comments = $comments
                    ->join('contacts', 'account_log.manager_id', '=', 'contacts.id')
                    ->join('users', 'users.id', '=', 'account_log.user_id')
                    ->select(DB::raw('DATE_FORMAT(timestamp, "%d-%m-%Y %H:%i:%s") as timestamp_date'),'account_log.*', 'users.first_name as user_firstname','users.middle_name as user_middlename','users.last_name as user_lastname','contacts.first_name as contact_firstname','contacts.last_name as contact_lastname');
        if($user->id!='1')
        {
            $comments = $comments->where([['account_log.user_id', '=', $id],['account_log.account_id', '=', $acc_id]]);
        }
        else{
            $comments = $comments->where([['account_log.account_id', '=', $acc_id]]);
        }
        $comments = $comments->orderBy('account_log.timestamp', 'desc')
                    ->get();
        return Response::json($comments);
    }

    public function getByHotness($min,$max)
    {
        $min  = $min-1;
        $max  = $max+1;
        $accounts = new accounts;
        $account = [];
        $accounts = DB::table('accounts')
                    ->whereBetween('client_specification', array($min, $max))
                    ->orderBy('id', 'asc')
                    ->get();
        $accounts = json_decode(json_encode($accounts));
        foreach ($accounts as $key => $value) {
            $account[] = (array)$value;
            $data = DB::table('account_log')
                    ->select('timestamp','account_id')
                    ->where('account_id',$value->id)
                    ->orderBy('id', 'desc')
                    ->first();
            $account[$key]['data'] = $data;
        }
        return Response::json($account);        
    }

    /*
    * @created : April 24, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Add new Account.
    * @params  : None
    * @return  : Success Message
    */
    public function addNewAccounts(AddAccountsRequest $request)
    {
        if($request->has('Technology'))
        {
            $technology = implode(",",$request->input('Technology'));
        }else{ $technology = '';}
        if($request->has('decision_maker')){$decision_maker = '1';}else{$decision_maker = '0';}
        if($request->has('job_outcome')){$job_outcome = '1';}else{$job_outcome = '0';}
        if($request->has('sub_lable'))
        {
            $sub_lable                      = implode(",",$request->input('sub_lable'));
        }else{ $sub_lable = '';}
        $accounts                       = new accounts;
        $accounts->account_name         = $request->input('account_name');
        $accounts->prozesse             = $request->input('prozesse');
        $accounts->city                 = $request->input('city'); 
        $accounts->pincode              = $request->input('pincode'); 
        $accounts->country              = $request->input('country');
        $accounts->freelancers          = $request->input('freelancers'); 
        $accounts->Technology           = $technology;
        $accounts->type_of_client       = $request->input('type_of_client');
        $accounts->client_specification = $request->input('client_specification');
        $accounts->owner                = $request->input('owner');
        $accounts->source               = $request->input('source');
        $accounts->sub_lable            = $sub_lable;
        $accounts->telephone            = $request->input('telephone');
        $accounts->comments             = $request->input('comments');
        $accounts->decision_maker       = $decision_maker;
        $accounts->departement_size     = $request->input('departement_size');
        $accounts->job_outcome          = $job_outcome;
        $accounts->account_status       = '1';
        $accounts->added_by             = currentUser()->id;
        $accounts->save();
        return 'success';
    }


     public function showData(Request $request)
    {
      if($request->ajax())
      {
        $status = "success";
        try { //->update(['name' => $request->name])
          $result = DB::table('accounts')->find($request->id);
        } catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
        }
        return (json_encode(array('status'=>$status,'message'=>$result ))) ;         
      }
    }

    public function updateGeneralNote(Request $request,$id)
    {
        $comment = $request->input('comment');
        $data = array(
            'comments' => $comment,
        );
        $query = DB::table('accounts')->where('id',$id)->update($data);
        return 'success';
    }
   

}
