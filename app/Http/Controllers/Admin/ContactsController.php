<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use App\Contacts;
use App\Accounts;
use Response;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddContactsRequest;


class ContactsController extends Controller
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
        $emp_id = SESSION::get('id');
        $permission = [];
        $countries = DB::table('countries')->get();
        $contacts = DB::table('contacts')->get();
        $accounts = new accounts;
        $accounts = $accounts->select('id','account_name')
        ->orderBy('account_name', 'asc');
        // if(!$user->isAdmin)
        // {
        //     $accounts = $accounts->where('accounts.added_by',$user->id);
        // }
        if(!$user->isAdmin)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
            $manager_roles = explode(',', $permission->knotakte_permission);
            if(!in_array('all', $manager_roles))
            {
                $accounts = $accounts->where('accounts.added_by',$user->id);
            }
            
        }
        $accounts = $accounts->get();
        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        return view('contacts.index',['accounts' => $accounts,'countries' => $countries,'contacts'=>$contacts,'permission' => $permission]);
    }

    /*
    * @created : Mar 19, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get All Contacts
    * @params  : None
    * @return  : None
    */
    public function getAllContacts()
    {   
        $user = Auth::user();
        $contacts = new contacts;
        DB::statement(DB::raw('set @rownumber= 0'));
        $contacts = $contacts
        ->join('users', 'contacts.added_by', '=', 'users.id')
        ->join('accounts', 'accounts.id', '=', 'contacts.account_id')
        ->select(DB::raw('@rownumber:=@rownumber+1 as S_No'),'users.first_name as added_by','contacts.id as id','contacts.first_name as first_name','contacts.last_name as last_name','contacts.job_title','contacts.departement','contacts.email_id','contacts.mobile','accounts.id as account_id','accounts.account_name','contacts.touch_rule');
        // if(!$user->isAdmin)
        // {
        //     $contacts = $contacts->where('contacts.added_by',$user->id);
        // }
        if(!$user->isAdmin)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
            $manager_roles = explode(',', $permission->knotakte_permission);
            if(!in_array('all', $manager_roles))
            {
                $contacts = $contacts->where('contacts.added_by',$user->id);
            }
            
        }
        $contacts = $contacts->get();
		// orderBy('contacts.id', 'asc')->
        return Response::json($contacts);
    }

    /*
    * @created : Mar 23, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Delete Particular Contacts
    * @params  : ID
    * @return  : Delete Successfully
    */
    public function delete($id)
    {
        $contacts = DB::table('contacts')->where('id',$id)->delete();
        return 'success';
    }

    /*
    * @created : Mar 19, 2018
	
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to View Contacts Details
    * @params  : ID
    * @return  : all Details of Account
    */
    public function view($id)
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        $details = DB::table('contacts')->join('accounts', 'accounts.id', '=', 'contacts.account_id')
        ->select('contacts.*', 'accounts.id', 'accounts.account_name')
        ->where('contacts.id',$id)->get();
        return view('contacts.view_contacts',['details' => $details,'permission' => $permission]);
    }

    /*
    * @created : Mar 21, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Edit Contacts Details
    * @params  : ID
    * @return  : None
    */
    public function edit($id)
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        $countries = DB::table('countries')->get();
        $users = DB::table('users')
        ->where('user_role','1')
        ->get();
        $details = DB::table('contacts')
        ->join('accounts', 'accounts.id', '=', 'contacts.account_id')
        ->select('contacts.*','contacts.id as contact_id', 'accounts.id as account_id','accounts.account_name')
        ->where('contacts.id',$id)
        ->get();
        return view('contacts.edit_contacts',['details' => $details,'user' => $users],['countries' => $countries,'permission'=>$permission]);
    }

    /*
    * @created : Mar 21, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Update Contacts Details
    * @params  : ID
    * @return  : Suucess message
    */
    public function update(AddContactsRequest $request,$id)
    {
        $status = "success";
        try
        {
            if($request->has('decision_maker')){$decision_maker = '1';}else{$decision_maker = '0';}
            if($request->has('touch_rule')){$touch_rule = implode(',',$request->touch_rule);}else{$touch_rule = '';}
            //if($request->has('touch_rule')){$decision_maker = '1';}else{$decision_maker = '0';}
            $data = array(
                'first_name'         =>  $request->input('first_name'),
                'last_name'                 => $request->input('last_name'),
                'job_title'              => $request->input('job_title'),
                'departement'          => $request->input('departement'), 
                'country'           => $request->input('country'), 
                'phone'    => $request->input('phone'),
                'mobile'                 => $request->input('mobile'),
                'notes' => $request->input('note'),
                'email_id'                => $request->input('email_id'),
                'decision_maker'       => $decision_maker,
                'city' => $request->input('city'),
                'pincode' => $request->input('zipcode'),
                'touch_rule' => $touch_rule,

            );
            $data = DB::table('contacts')
            ->where('id', $id)
            ->update($data);
            $result = "Manager Details Updated Successfully";
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
    * @Purpose : This function is use to Add new Contacts.
    * @params  : None
    * @return  : Success Message
    */
    public function addNewContacts(AddContactsRequest $request)
    {

       $user = Auth::user();
       if($request->has('decision_maker')){$decision_maker = '1';}else{$decision_maker = '0';}
       $contacts = new contacts;
       $contacts->first_name       = $request->input('first_name');
       $contacts->last_name        = $request->input('last_name'); 
       $contacts->account_id       = $request->input('account_id'); 
       $contacts->job_title        = $request->input('job_title'); 
       $contacts->departement      = $request->input('departement');
       $contacts->phone            = $request->input('phone'); 
       $contacts->mobile           = $request->input('mobile'); 
       $contacts->notes            = $request->input('note');
       $contacts->email_id            = $request->input('email_id');
       $contacts->decision_maker   = $decision_maker;
       $contacts->city             = $request->input('city');
       $contacts->pincode          = $request->input('zipcode'); 
       $contacts->country          = $request->input('country');
       $contacts->added_by         = $user->id;
       $contacts->save();
       return 'success';
   }


   public function addComment(Request $request)
   {
    $data = array(
        'account_id'         =>  $request->auth_id,
        'manager_id'         =>  $request->contact_id,
        'comment'                 => $request->comment,
        'action'                 => 'comment',
    );
    $comment_data = DB::table('account_log')->insert($data);
    if($comment_data)
    {
       return (json_encode(array('status' =>'success','message'=>'Commented Successfully')));
   }
   else
   {
       return (json_encode(array('status' =>'error','message'=>'Failed to commment')));
   }
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
}
