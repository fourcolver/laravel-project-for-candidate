<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use App\Contacts;
use App\Accounts;
use App\Comments;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CommentController extends Controller
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

    public function addComment(Request $request)
    {
        $data = array(
                'account_id'         =>  $request->account_id,
                'manager_id'         =>  $request->contact_id,
                'comment'                 => $request->comment,
                'action'                 => 'comment',
                'user_id'                 =>  $request->auth_id,
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

    public function get_account_id(Request $request)
    {
      if($request->ajax())
      {
        $status = "success";
        try { //->update(['name' => $request->name])
          $result = DB::table('contacts')->find($request->acc_id);
        } catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
        }
        return (json_encode(array('status'=>$status,'message'=>$result ))) ;         
      }
    }

    public function addUserComment(Request $request)
    {
      $data = array(
                'user_id'         =>  $request->auth_id,
                'comments'                 => $request->comment,
        );
      $comment_data = DB::table('comments')->insert($data);
      if($comment_data)
        {
       return (json_encode(array('status' =>'success','message'=>'Commented Successfully')));
      }
      else
      {
       return (json_encode(array('status' =>'error','message'=>'Failed to commment')));
      }
    }


}
