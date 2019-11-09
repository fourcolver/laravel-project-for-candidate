<?php

namespace App\Http\Controllers\Admin;

use App\Account;
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
use Illuminate\Support\Facades\Log;
use Response;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddAccountsRequest;
use App\Http\Requests\EditAccountsRequest;


class AccountsController extends Controller
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

        return view('accounts.index', compact('countries', 'users', 'accountLists', 'skills'));
    }

    /*
    * @created : Mar 19, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get All Accounts
    * @params  : None
    * @return  : None
    */
    public function getAllAccounts(Request $request)
    {
        $user = currentUser();
        $accounts = new accounts;

        DB::statement(DB::raw('set @rownumber= 0'));
        $accounts = $accounts->select(DB::raw('@rownumber:=@rownumber+1 as S_No'), 'users.first_name', 'users.last_name', 'accounts.*', DB::raw("(Select 0) as list_id"))->join('users', 'accounts.added_by', '=', 'users.id')->where('accounts.account_status', '0');
        if (!$user->isAdmin && !in_array('all', explode(',', $user->permissions->kunden_permission))) {
            $accounts = $accounts->where('accounts.added_by', $user->id);
        }
        $val = (isset($request->datatable['query']['searchhotness']) && ($request->datatable['query']['searchhotness'] != "all") ? $request->datatable['query']['searchhotness'] : '');
        $loadList = (isset($request->datatable['query']['load_list']) && ($request->datatable['query']['load_list'] != "all") ? $request->datatable['query']['load_list'] : '');
        if ($val != "") {
            $range = explode("-", $val);
            $min = $range[0];
            $max = $range[1];
            if ($range[1] == 10) {
                $max += 1;
            }
            $account = [];
            $accounts = $accounts->where('accounts.client_specification', '>=', $min);
            $accounts = $accounts->where('accounts.client_specification', '<=', $max);
        }
        $accounts = $accounts->get();

        if($accountList = AccountList::find($loadList)) {
            DB::statement(DB::raw('set @rownumber= 0'));
            $accounts = DB::table($accountList->code)->select(
                DB::raw('@rownumber:=@rownumber+1 as S_No'),
                "users.first_name",
                "users.last_name",
                "$accountList->code.*",
                DB::raw("$accountList->id as list_id")
            )->join("users", "$accountList->code.added_by", "=", "users.id")->get();
        }
        $accounts = json_decode(json_encode($accounts));
        if (!empty($accounts)) {
            foreach ($accounts as $key => $value) {
                $account[] = (array)$value;
                $data = DB::table('account_log')
                    ->select(DB::raw('DATE_FORMAT(timestamp, "%d-%m-%Y") as timestamp'))
                    ->where('account_id', $value->id)
                    ->orderBy('id', 'desc')
                    ->first();
                $account[$key]['last_activity'] = (isset($data->timestamp) ? $data->timestamp : null);
                $account[$key]['searchhotness'] = $val;
                $account[$key]['load_list'] = $accountList ? $accountList->list_name : '';
            }
            return Response::json($account);
        }
        return Response::json($accounts);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function CreateList(Request $request)
    {
        $user = Auth::user();
        $status = "success";
        try {
            $filter['list_name'] = $request->input('list_name');
            $filter['val_hotness'] = $request->input('hotness');
            $filter['val_postcode'] = $request->input('postcode');
            $filter['val_freelancer'] = $request->input('freelancer');
            $filter['val_technology'] = $request->input('technology');
            $filter['val_lastcontact'] = $request->input('lastcontact');
            $detailedTechnologies = $request->input('detailed_technologies');

            DB::statement("CREATE OR REPLACE VIEW ag_list_view_template AS SELECT ac.id as id,ac.account_name,ac.pincode,ac.touch_rule,ac.detailed_technologies,ac.freelancers,ac.account_status,ac.Technology,ac.type_of_client,ac.client_specification,ac.added_by, (SELECT al.timestamp FROM ag_account_log as al Where al.account_id = ac.id ORDER BY al.timestamp DESC limit 1) as last_activity FROM ag_accounts as ac");

            $query = "CREATE OR REPLACE VIEW ag_:account_list_view_name AS SELECT * FROM ag_list_view_template WHERE account_status = 0";
            if (!$user->isAdmin && !in_array('all', explode(',', currentUser()->permissions->kunden_permission))) {
                $query = $query . " AND added_by = '" . $user->id . "'";
            }

            if ($filter['val_hotness'] != '') {
                $range = explode("-", $filter['val_hotness']);
                $min = $range[0];
                $max = $range[1];
                if ($range[1] == 10) {
                    $max += 1;
                }
                $query = $query . " AND client_specification>=" . $min . " AND client_specification <=" . $max;
            }

            if ($filter['val_postcode'] != '') {
                $query = $query . " AND pincode LIKE '" . $filter['val_postcode'] . "%'";
            }

            if ($filter['val_freelancer'] != '') {
                $freelancers = $filter['val_freelancer'];
                $query = $query . " AND freelancers >= '" . $freelancers . "'";
            }

            $technology = '';
            if ($filter['val_technology'] != '') {
                $technology = $filter['val_technology'];
                $query = $query . " AND";
                foreach ($technology as $key => $value) {
                    $query = $query . " FIND_IN_SET('" . $value . "',Technology) OR";
                }
                $query = substr($query, 0, -3);
                $technology = implode(',', $filter['val_technology']);
            }

            $detailedTech = '';
            if (!empty($detailedTechnologies)) {
                $query = $query . " AND";
                foreach ($detailedTechnologies as $key => $value) {
                    $query = $query . " FIND_IN_SET('" . $value . "',detailed_technologies) OR";
                }
                $query = substr($query, 0, -3);
                $detailedTech = implode(',', $detailedTechnologies);
            }

            $lastContact = '';
            if ($filter['val_lastcontact'] != '') {
                $lastContact = date('Y-m-d', strtotime($filter['val_lastcontact']));
                $query = $query . " AND (last_activity < '" . $lastContact . "' OR last_activity IS NULL)";
            }

            $data = array(
                'list_name' => $filter['list_name'],
                'hotness_filter' => $filter['val_hotness'],
                'postcode_filter' => $filter['val_postcode'],
                'freelnacer_filter' => $filter['val_freelancer'],
                'technology_filter' => $technology,
                'last_contact' => $lastContact,
                'detailed_technologies' => $detailedTech,
                'added_by' => $user->id
            );
            
            if(!$accountList = AccountList::where('list_name', $filter['list_name'])->first()) {
                $accountList = new AccountList();
                $accountList->save();
                $result = "List Created Successfully";
            } else {
                $result = "List Name Exist so Updated Successfully";
            }
            $accountList->forceFill($data);
            $accountList->save();
            DB::statement(str_replace(':account_list_view_name', $accountList->code, $query));
        } catch (\Exception $ex) {
            $status = "error";
            Log::error($ex);
            $result = 'Internal Server Error';
        }

        return response()->json([
            'status' => $status,
            'message' => $result
        ]);
    }

    public function deleteList($id)
    {
        $status = "success";
        try {
            $data = DB::table('account_list')->select('id', 'list_name')->where('id', $id)->first();
            if (\Schema::hasTable($data->list_name)) {
                $query = 'DROP VIEW ag_' . $data->list_name;
                DB::statement($query);
            }
            $query = DB::table('account_list')->where('id', $id)->delete();
            $result = "List Deleted Successfully";
        } catch (QueryException $ex) {
            dd($ex->getMessage());
            $status = "error";
            $result = $ex->getMessage();
        }
        return (json_encode(array('status' => $status, 'message' => $result)));

    }

    /*
    * @created : Mar 23, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Delete Particular Account
    * @params  : ID
    * @return  : Delete Successfully
    */
    public function delete($id)
    {
        $status = "success";
        try {
            /** @var Account $account */
            $account = Account::findOrFail($id);
            $account->delete();
            $result = "Client Deleted Successfully";
        } catch (\Exception $ex) {
            $status = "error";
            $result = $ex->getMessage();
        }
        return response()->json(['status' => $status, 'message' => $result]);
    }

    /*
    * @created : Mar 19, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to View accounts Details
    * @params  : ID
    * @return  : all Details of Account
    */
    public function view($id, $list)
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        $details = DB::table('accounts')->where('id', $id)->get();
        $next_id = $details[0]->id;
        $competences = $this->getCompetencesData();


        $view_list = DB::table('account_list')->select('list_name')->where('id', $list)->first();
        // echo $view_list->list_name;

        // print_r($view_list);die();

        $list_view = "";

        if ($list === '0') {
            $list_view = "accounts";
        } else {
            $list_view = $view_list->list_name;
        }

        $next = DB::table($list_view)
            ->select('id', 'account_name')
            ->where('account_status', '0')
            ->where('id', '>', $next_id)->first();
        $next_count = DB::table($list_view)
            ->select('id')
            ->where('account_status', '0')
            ->where('id', '>', $next_id)->count();
        $previous = DB::table($list_view)
            ->select('id', 'account_name')
            ->orderBy('id', 'desc')
            ->where('account_status', '0')
            ->where('id', '<', $next_id)->first();
        $previous_count = DB::table($list_view)
            ->select('id')
            ->where('account_status', '0')
            ->where('id', '<', $next_id)->count();

        $users = DB::table('users')
            ->whereIn('user_role', array('1', '2'))
            ->get();

        $countries = DB::table('countries')->get();
        $contacts = DB::table('contacts')
            ->where('account_id', $id)
            ->get();
        $accounts = DB::table('accounts')
            ->select('id', 'account_name')
            ->where('account_status', '0')
            ->get();
        if ($emp_id != 1) {
            $permission = DB::table('emp_permission')->where('emp_id', $emp_id)->first();
        }
        $task_type = array('Call', 'Email', 'Follow Up', 'Note', 'Meeting');

        return view('accounts.view_accounts', compact(['details', 'task_type', 'users', 'countries', 'next', 'next_count', 'previous', 'previous_count', 'contacts', 'accounts', 'permission', 'competences', 'list']));
    }

    public function getCompetencesData()
    {
        $competences = DB::table('competences')->get()->toArray();
        if (!empty($competences)) {
            $competences_array = array();
            $i = 1;
            foreach ($competences as $competences_val) {
                $competences_skill = DB::table('competences_skill')->Where('competences_id', $competences_val->id)->get()->toArray();
                $competences_val->keys = $i;
                $competences_val->competences_skill = $competences_skill;
                $competences_array[] = $competences_val;
                $i++;
            }
            return $competences_array;
        }
    }

    /*
    * @created : May 10, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Save Detailed Technologies
    * @params  : ID
    * @return  : None
    */

    public function updateTechnologies(Request $request, $id)
    {

        $status = "success";
        try {
            $technologies = '';
            if ($request->has(['category_rating'])) {
                $technologies = implode(",", $request->input('category_rating'));
            }
            $data = array(
                'detailed_technologies' => $technologies,
            );
            $query = DB::table('accounts')->where('id', $id)->update($data);
            $result = "Client Detailed Technology Saved";
        } catch (QueryException $ex) {
            dd($ex->getMessage());
            $status = "error";
            $result = $ex->getMessage();
        }
        return (json_encode(array('status' => $status, 'message' => $result)));

    }


    /*
    * @created : Mar 20, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Edit accounts Details
    * @params  : ID
    * @return  : None
    */
    public function edit($id)
    {
        $permission = [];
        $countries = Country::all();
        $users = User::isAdmin()->get();
        $data = Accounts::findOrFail($id);
        if (!currentUser()->isAdmin) {
            $permission = currentUser()->employeePermission;
        }
        return view('accounts.edit_accounts', compact(
            'data',
            'users',
            'countries',
            'permission'
        ));
    }

    /*
    * @created : Mar 20, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Update accounts Details
    * @params  : ID
    * @return  : Suucess message
    */
    public function update(EditAccountsRequest $request)
    {
        $status = "success";
        try {
            $id = $request->account_id;

            if ($request->has('Technology')) {
                $technology = implode(",", $request->input('Technology'));
            } else {
                $technology = '';
            }
            if ($request->has('sub_lable')) {
                $sub_lable = implode(",", $request->input('sub_lable'));
            } else {
                $sub_lable = '';
            }
            if ($request->has('decision_maker')) {
                $decision_maker = '1';
            } else {
                $decision_maker = '0';
            }
            if ($request->has('job_outcome')) {
                $job_outcome = '1';
            } else {
                $job_outcome = '0';
            }
            $data = array(
                'account_name' => $request->input('account_name'),
                'prozesse' => $request->input('prozesse'),
                'city' => $request->input('city'),
                'pincode' => $request->input('pincode'),
                'country' => $request->input('country'),
                'freelancers' => $request->input('freelancers'),
                'Technology' => $technology,
                'last_time_contact' => $request->input('last_time_contact'),
                'type_of_client' => $request->input('type_of_client'),
                'client_specification' => $request->input('client_specification'),
                'owner' => $request->input('owner'),
                'source' => $request->input('source'),
                'sub_lable' => $sub_lable,
                'telephone' => $request->input('telephone'),
                'comments' => $request->input('comments'),
                'decision_maker' => $decision_maker,
                'departement_size' => $request->input('departement_size'),
                'job_outcome' => $job_outcome,
                'account_status' => '0',
            );

            $data = DB::table('accounts')
                ->where('id', $id)
                ->update($data);
            $result = "Kunden Details Updated Successfully";
        } catch (QueryException $ex) {
            dd($ex->getMessage());
            $status = "error";
            $result = $ex->getMessage();
        }
        return (json_encode(array('status' => $status, 'message' => $result)));
    }

    /*
    * @created : Mar 22, 2018
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
            ->select('contacts.*', 'accounts.id as account_id', 'accounts.account_name')
            ->where('account_id', $id);
        if (!$user->isAdmin) {
            $emp_permission = DB::table('emp_permission')->where('emp_id', $user->id)->first();
            $manager_roles = explode(',', $emp_permission->knotakte_permission);
            if (!in_array('all', $manager_roles)) {
                $contacts = $contacts->where('accounts.added_by', $user->id);
            }

        }
        $contacts = $contacts->get();
        $contacts = json_decode(json_encode($contacts));
        if (!empty($contacts)) {
            foreach ($contacts as $key => $value) {
                $contact_data[] = (array)$value;
                if ($emp_id != 1) {
                    $permission = DB::table('emp_permission')->where('emp_id', $emp_id)->first();
                    $contact_data[$key]['permission'] = $permission;
                } else {
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
            ->select('opportunity.*', 'accounts.id as account_id', 'accounts.account_name')
            ->where('account_id', $id);
        if (!$user->isAdmin) {
            $emp_permission = DB::table('emp_permission')->where('emp_id', $user->id)->first();
            $opportunity_roles = explode(',', $emp_permission->projektanfrage_permission);
            if (!in_array('all', $opportunity_roles)) {
                $opportunity = $opportunity->where('accounts.added_by', $user->id);
            }

        }
        $opportunity = $opportunity->get();
        $opportunity = json_decode(json_encode($opportunity));
        if (!empty($opportunity)) {
            foreach ($opportunity as $key => $value) {
                $opportunity_data[] = (array)$value;
                if ($emp_id != 1) {
                    $permission = DB::table('emp_permission')->where('emp_id', $emp_id)->first();
                    $opportunity_data[$key]['permission'] = $permission;
                } else {
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
            ->select(DB::raw('DATE_FORMAT(task_date, "%d-%m-%Y") as task_date'), 'task.id as id', 'task.priority', 'task.task_status', 'task.description', 'task.task_owner', 'accounts.id as account_id', 'accounts.account_name', 'accounts.account_status as account_status')
            ->where('task.account_id', $id)
            ->where([['task.task_status', '!=', 'Completed']]);
        if (!$user->isAdmin) {
            $emp_permission = DB::table('emp_permission')->where('emp_id', $user->id)->first();
            $task_roles = explode(',', $emp_permission->task_permission);
            if (!in_array('all', $task_roles)) {
                $task = $task->where('accounts.added_by', $user->id);
            }

        }
        $task = $task->get();
        $task = json_decode(json_encode($task));
        if (!empty($task)) {
            foreach ($task as $key => $value) {
                $task_data[] = (array)$value;
                if ($emp_id != 1) {
                    $permission = DB::table('emp_permission')->where('emp_id', $emp_id)->first();
                    $task_data[$key]['permission'] = $permission;
                } else {
                    $permission['admin'] = 'admin';
                    $task_data[$key]['permission'] = $permission;
                }
            }
            return Response::json($task_data);
        }
        return Response::json($task);
    }

    /*
    * @created : April 14, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Delete Account Comment
    * @params  : ID
    * @return  : none
    */

    public function deleteComment($acc_id, $id)
    {
        $user = Auth::user();
        if (!$user->isAdmin) {
            $status = "error";
            $result = "Only admin delete comment";
            return (json_encode(array('status' => $status, 'message' => $result)));
        } else {
            $status = "success";
            try { //->update(['name' => $request->name])
                $data = DB::table('account_log')
                    ->where([['id', '=', $id], ['account_id', '=', $acc_id],])
                    ->delete();
                $result = "Comment Deleted Successfully";
            } catch (QueryException $ex) {
                //dd($ex->getMessage());
                $status = "error";
                $result = $ex->getMessage();
            }
            return (json_encode(array('status' => $status, 'message' => $result)));
        }
    }

    /*
    * @created : April 14, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Delete Account Comment
    * @params  : ID
    * @return  : none
    */

    public function editComment(Request $request, $acc_id, $id)
    {
        $user = Auth::user();
        if (!$user->isAdmin) {
            $status = "error";
            $result = "Only admin edit comment";
            return (json_encode(array('status' => $status, 'message' => $result)));
        } else {
            $comment = $_GET['comment_text'];
            $status = "success";
            $data = array(
                'comment' => $comment,
                'timestamp' => date('Y-m-d H:i:s'),
            );
            try {
                $data = DB::table('account_log')
                    ->where([['id', '=', $id], ['account_id', '=', $acc_id],])
                    ->update($data);
                $result = "Comment Updated Successfully";
            } catch (QueryException $ex) {
                //dd($ex->getMessage());
                $status = "error";
                $result = $ex->getMessage();
            }
            return (json_encode(array('status' => $status, 'message' => $result)));
        }

    }

    public function CommentsDetails($id, $acc_id)
    {
        $user = Auth::user();
        $comments = new AccountLog();
        $comments = $comments
            ->join('users', 'users.id', '=', 'account_log.user_id')
            ->select(DB::raw('DATE_FORMAT(timestamp, "%d-%m-%Y %H:%i:%s") as timestamp_date'), 'account_log.*', 'users.first_name as user_firstname', 'users.middle_name as user_middlename', 'users.last_name as user_lastname');
        /*if($user->id!='1')
        {
            $comments = $comments->where([['account_log.user_id', '=', $id],['account_log.account_id', '=', $acc_id]]);
        }
        else{*/
        $comments = $comments->where([['account_log.account_id', '=', $acc_id]]);/*
    }*/
        $comments = $comments->orderBy('account_log.timestamp', 'desc')
            ->get();
        $comments = $comments->map(function ($value) {
            $data['id'] = $value->id;
            $data['timestamp_date'] = $value->timestamp_date;
            $data['user_firstname'] = $value->user_firstname;
            $data['user_middlename'] = $value->user_middlename;
            $data['user_lastname'] = $value->user_lastname;
            $data['comment'] = $value->comment;
            if ($value->manager_id != '') {
                $contact_data = DB::table('contacts')->select('first_name', 'last_name')->selectRaw('IFNULL(first_name,"") as first_name')->selectRaw('IFNULL(last_name,"") as last_name')->where('id', $value->manager_id)->first();
                $data['contact_firstname'] = $contact_data->first_name;
                $data['contact_lastname'] = $contact_data->last_name;
            } else {
                $data['contact_firstname'] = "";
                $data['contact_lastname'] = "";
            }
            return $data;
        });
        $comments->all();
        return Response::json($comments);
    }

    public function getByHotness($min, $max)
    {
        $min = $min - 1;
        $max = $max + 1;
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
                ->select('timestamp', 'account_id')
                ->where('account_id', $value->id)
                ->orderBy('id', 'desc')
                ->first();
            $account[$key]['data'] = $data;
        }
        return Response::json($account);
    }

    /*
    * @created : Mar 21, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Add new Account.
    * @params  : None
    * @return  : Success Message
    */
    public function addNewAccounts(AddAccountsRequest $request)
    {
        $user = Auth::user();
        if ($request->has('Technology')) {
            $technology = implode(",", $request->input('Technology'));
        } else {
            $technology = '';
        }
        if ($request->has('decision_maker')) {
            $decision_maker = '1';
        } else {
            $decision_maker = '0';
        }
        if ($request->has('job_outcome')) {
            $job_outcome = '1';
        } else {
            $job_outcome = '0';
        }
        if ($request->has('sub_lable')) {
            $sub_lable = implode(",", $request->input('sub_lable'));
        } else {
            $sub_lable = '';
        }
        $accounts = new accounts;
        $accounts->account_name = $request->input('account_name');
        $accounts->prozesse = $request->input('prozesse');
        $accounts->city = $request->input('city');
        $accounts->pincode = $request->input('pincode');
        $accounts->country = $request->input('country');
        $accounts->freelancers = $request->input('freelancers');
        $accounts->Technology = $technology;
        $accounts->type_of_client = $request->input('type_of_client');
        $accounts->client_specification = $request->input('client_specification');
        $accounts->owner = $request->input('owner');
        $accounts->source = $request->input('source');
        $accounts->sub_lable = $sub_lable;
        $accounts->telephone = $request->input('telephone');
        $accounts->comments = $request->input('comments');
        $accounts->decision_maker = $decision_maker;
        $accounts->departement_size = $request->input('departement_size');
        $accounts->job_outcome = $job_outcome;
        $accounts->account_status = '0';
        $accounts->added_by = $user->id;
        $accounts->save();
        return 'success';
    }


    public function showData(Request $request)
    {
        if ($request->ajax()) {
            $status = "success";
            try { //->update(['name' => $request->name])
                $result = DB::table('accounts')->find($request->id);
            } catch (QueryException $ex) {
                dd($ex->getMessage());
                $status = "error";
                $result = $ex->getMessage();
            }
            return (json_encode(array('status' => $status, 'message' => $result)));
        }
    }

    public function updateGeneralNote(Request $request, $id)
    {
        $comment = $request->input('comment');
        $data = array(
            'comments' => $comment,
        );
        $query = DB::table('accounts')->where('id', $id)->update($data);
        return 'success';
    }

    public function exportAccountCsv(Request $request)
    {
        $user = Auth::user();
        $filename = "client.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array(''));
        fputcsv($handle, array('Kundenname', 'Prozesse', 'Hotness Of Client', 'Postcode', 'Country', 'No.of Freelancers', '7 Touch Rule', 'Technology', 'Detailed Technology', 'Type of Client', 'Added By', 'Last Contact', 'Telephone', 'Size of IT Departments'));
        $accounts = new accounts();
        $accounts = $accounts->select('users.first_name', 'users.last_name', 'accounts.id as account_id', 'accounts.*')->join('users', 'accounts.added_by', '=', 'users.id')->where('accounts.account_status', '0');
        $accounts = $accounts->orderBy('accounts.id', 'asc')->get()->toArray();
        foreach ($accounts as $key => $value) {
            $data = DB::table('account_log')
                ->select(DB::raw('DATE_FORMAT(timestamp, "%d-%m-%Y") as timestamp'))
                ->where('account_id', $value['account_id'])
                ->orderBy('id', 'desc')
                ->first();
            $last_activity = (isset($data->timestamp) ? $data->timestamp : null);
            fputcsv($handle, array($value['account_name'], $value['prozesse'], $value['client_specification'], "\t" . $value['pincode'], $value['country'], $value['freelancers'], $value['touch_rule'], $value['Technology'], $value['detailed_technologies'], $value['type_of_client'], $value['first_name'], $last_activity, "\t" . $value['telephone'], $value['departement_size']));
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition: attachment;filename=' . $filename
        );

        return Response::download($filename, 'client.csv', $headers);

    }

    public function exportAccountDetiledCsv($id, Request $request)
    {
        $accounts = new accounts();
        $accounts = $accounts->select('users.first_name', 'users.last_name', 'accounts.id as account_id', 'accounts.*')->join('users', 'accounts.added_by', '=', 'users.id')->where('accounts.account_status', '0')->where('accounts.id', $id)->first();
        $total_contacts = DB::table('contacts')->where('account_id', $id)->count();
        $total_oppo = DB::table('opportunity')->where('account_id', $id)->count();
        $total_tasks = DB::table('task')->where('account_id', $id)->count();

        $comments = new AccountLog();
        $comments = $comments
            ->join('contacts', 'account_log.manager_id', '=', 'contacts.id')
            ->join('users', 'users.id', '=', 'account_log.user_id')
            ->select('timestamp as timestamp_date', 'account_log.*', 'users.first_name as user_firstname', 'users.middle_name as user_middlename', 'users.last_name as user_lastname', 'contacts.first_name as contact_firstname', 'contacts.last_name as contact_lastname')->where([['account_log.account_id', '=', $id]])->orderBy('account_log.timestamp', 'desc')->get()->toArray();
        $contacts = new contacts;
        $contacts = $contacts
            ->join('users', 'users.id', '=', 'contacts.added_by')
            ->join('accounts', 'accounts.id', '=', 'contacts.account_id')
            ->select('contacts.*', 'users.first_name as user_firstname', 'accounts.id as account_id', 'accounts.account_name')
            ->where('account_id', $id)->get()->toArray();
        $opportunity = new opportunity;
        $opportunity = $opportunity
            ->join('users', 'users.id', '=', 'opportunity.added_by')
            ->join('accounts', 'accounts.id', '=', 'opportunity.account_id')
            ->select('opportunity.*', 'accounts.id as account_id', 'accounts.account_name', 'users.first_name as user_firstname')
            ->where('account_id', $id)->get()->toArray();
        $task = new task;
        $task = $task
            ->join('users', 'users.id', '=', 'task.task_owner')
            ->join('accounts', 'accounts.id', '=', 'task.account_id')
            ->select('task_date', 'task.id as id', 'task.priority', 'task.task_status', 'task.description', 'task.task_owner', 'users.first_name as task_owner_name', 'accounts.id as account_id', 'accounts.account_name', 'accounts.account_status as account_status')
            ->where('task.account_id', $id)
            ->get()->toArray();
        $data = DB::table('account_log')
            ->select(DB::raw('DATE_FORMAT(timestamp, "%d-%m-%Y") as timestamp'))
            ->where('account_id', $accounts->account_id)
            ->orderBy('id', 'desc')
            ->first();
        $total_activity = DB::table('account_log')
            ->where('account_id', $accounts->account_id)
            ->count();
        $last_activity = (isset($data->timestamp) ? $data->timestamp : null);
        $filename = $accounts->account_name . ".csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array(''));
        fputcsv($handle, array('Kundenname', 'Prozesse', 'Hotness Of Client', 'Postcode', 'Country', 'No.of Freelancers', '7 Touch Rule', 'Technology', 'Detailed Technology', 'Type of Client', 'Added By', 'Last Contact', 'Telephone', 'Size of IT Departments', 'Total Comments', 'Total Managers', 'Total Projektanfragen', 'Total Tasks'));
        fputcsv($handle, array($accounts->account_name, $accounts->prozesse, $accounts->client_specification, $accounts->pincode, $accounts->country, $accounts->freelancers, $accounts->touch_rule, $accounts->Technology, $accounts->detailed_technologies, $accounts->type_of_client, $accounts->first_name, $last_activity, $accounts->telephone, $accounts->departement_size, $total_activity, $total_contacts, $total_oppo, $total_tasks));
        fputcsv($handle, array(''));
        fputcsv($handle, array(''));
        fputcsv($handle, array($accounts->account_name . ' Activity Details'));
        fputcsv($handle, array('S.No', 'Date', 'Comment', 'Contact Name', 'Recruiter'));
        $i = 1;
        foreach ($comments as $key => $value) {
            fputcsv($handle, array($i, $value['timestamp_date'], $value['comment'], $value['contact_firstname'] . ' ' . $value['contact_lastname'], $value['user_firstname']));
            $i++;
        }
        fputcsv($handle, array(''));
        fputcsv($handle, array(''));
        fputcsv($handle, array($accounts->account_name . ' Manager Details'));
        fputcsv($handle, array('S.No', 'Name', 'Job Title', 'Department', 'Phone Number', 'Mobile Number', 'Email Id', '7 Touch Rule', 'Pincode', 'Added by'));
        $j = 1;
        foreach ($contacts as $key => $value) {
            fputcsv($handle, array($j, $value['first_name'] . ' ' . $value['last_name'], $value['job_title'], $value['departement'], $value['phone'], $value['mobile'], $value['email_id'], $value['touch_rule'], $value['pincode'], $value['user_firstname']));
            $j++;
        }
        fputcsv($handle, array(''));
        fputcsv($handle, array(''));
        fputcsv($handle, array($accounts->account_name . ' Projektanfragen Details'));
        fputcsv($handle, array('S.No', 'Opportuniy Name', 'Probability', 'Technology', 'Type', 'Status', 'Source', 'Process', 'Coding', 'Added by', 'Profile Sent'));
        $k = 1;
        foreach ($opportunity as $key => $value) {
            $type = "Contract";
            $status = "Active";
            if ($value['status'] == '0') {
                $status = "InActive";
            }
            if ($value['opportunity_type'] == '1') {
                $type = "Permanent";
            }
            fputcsv($handle, array($k, $value['name'], $value['probability'] . ' %', $value['technology'], $type, $status, $value['source'], $value['process'], $value['detailed_coding'], $value['user_firstname'], $value['profile_sent']));
            $k++;
        }
        fputcsv($handle, array(''));
        fputcsv($handle, array(''));
        fputcsv($handle, array($accounts->account_name . ' Task Details'));
        fputcsv($handle, array('S.No', 'Task Date', 'Priority', 'Task_status', 'Description', 'Task Owner'));
        $m = 1;
        foreach ($task as $key => $value) {
            fputcsv($handle, array($m, $value['task_date'], $value['priority'], $value['task_status'], $value['description'], $value['task_owner_name']));
            $m++;
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition: attachment;filename=' . $filename
        );
        return Response::download($filename, $filename, $headers);

    }

    public function touch_rule_add(Request $request)
    {
        $touch_rule_value = DB::table('accounts')->select('touch_rule')->where('id', $request->id)->first();
        $rule = $touch_rule_value->touch_rule;
        if (!empty($rule)) {
            $rule = explode(',', $rule);
        } else {
            $rule = [];
        }
        $value = array();
        array_push($value, $request->value);
        $touch_value = array_merge($rule, $value);
        $touch_value = array_unique($touch_value);
        $touch_value = implode(',', $touch_value);
        $data = array(
            'touch_rule' => $touch_value
        );
        DB::table('accounts')->where('id', $request->id)->update($data);
        return 'success';
    }

    public function touch_rule_remove(Request $request)
    {
        $touch_rule_value = DB::table('accounts')->select('touch_rule')->where('id', $request->id)->first();
        $rule = $touch_rule_value->touch_rule;
        $rule = explode(',', $rule);
        $result = array_diff($rule, [$request->value]);
        $touch_value = implode(',', $result);
        $data = array(
            'touch_rule' => $touch_value
        );
        DB::table('accounts')->where('id', $request->id)->update($data);
        return 'success';
    }


}
