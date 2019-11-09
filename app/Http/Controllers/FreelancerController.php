<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Response;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FreelancerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Show the application dashboard After Login.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $user = Auth::user();
        return view('freelancer_profile', compact('user'));
    }

    /*
    * @created : Mar 28, 2018
    * @author  : Anup Singh
    * @access  : public
    * @Purpose : This function is use to edit Freelancer Profile
    * @params  : None
    * @return  : None
    */
    public function edit(Request $request,$id)
    {
        $check_email=User::where(['email'=>$request->email])
        ->where(function($query) use ($id){
            if(isset($id)){
              $query->where('id' , '<>' ,$id);
            }
        })->exists();
        if($check_email)
        {
            return 'error';
        }
        $data = array(
                'first_name'      => $request->input('name'),
                'email'           => $request->input('email'),
                'Mobile'          => $request->input('phone'),
        );
        $result = DB::table('users')
                ->where('id', $id)
                ->update($data);
        return 'success';
    }

    /*
    * @created : April 04, 2018
    * @author  : Anup Singh
    * @access  : public
    * @Purpose : This function is use to Upload CV by Freelancer.
    * @params  : None
    * @return  : None
    */

    public function upload(Request $request, $id)
    {
        if($request->hasFile('attach_doc'))
        {
            $attach_doc  = $request->file('attach_doc');
            $name       = $attach_doc->getClientOriginalName();
            $type       = $attach_doc->getClientOriginalExtension();
            $allowed =  array('docx','pdf');
            if(!in_array($type,$allowed) ) {
                return redirect('/dashboard')->with('cv_message', 'Extension of Upload File Not Allowed');
            }
            $size       = $attach_doc->getClientSize();
            if($size > 2097152) {
                return redirect('/dashboard')->with('upload', 'Please Upload File Size less then 2 MB ');
            }
            $save       = $attach_doc->storeAs('Users',$name);
            $path_url   = storage_path('app/').$save;
            
            $data = array(
                'attached_cv' => $name,
            );
            $documents = DB::table('skills')
                ->where('user_id', $id)
                ->update($data);
            //$documents = DB::table('users')->insert($data);
            if($documents)
            {
                return redirect('/dashboard')->with('cv_message', 'File Uploaded Successfully');
            }
            else
            {
                return redirect('/dashboard')->with('cv_message', 'Please Add Your data and Skills First then Attach CV');
            }
        }
        else
        {
            return redirect('/dashboard')->with('cv_message', 'Some Error Please Upload Once Again');
        }
    }
}
