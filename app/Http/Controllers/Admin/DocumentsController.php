<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Documents;
use DB;
use Session;


class DocumentsController extends Controller
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
        $emp_id = SESSION::get('id');
        $permission = [];
        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        return view('documents.index',['permission' => $permission]);
    }
    
    /*
    * @created : April 02, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get all Documents
    * @params  : None
    * @return  : None
    */

    public function getAllDocuments()
    {
        $documents = DB::table('documents')->get();
        return \Response::json($documents);
    }

    /*
    * @created : April 03, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Upload Documents
    * @params  : None
    * @return  : None
    */
    public function upload(Request $request)
    {
        if($request->hasFile('file_name'))
        {
            $file_name  = $request->file('file_name');
            $type       = $file_name->getClientOriginalExtension();
            $name       = $file_name->getClientOriginalName();
            $save       = $file_name->storeAs('documents',$name);
            $path_url   = storage_path('app/').$save;
            $allowed =  array('docx','pdf','xlsx','xls');
            if(!in_array($type,$allowed) ) {
                return redirect('admin/documents')->with('status', 'Extension of Upload File Not Allowed');
            }
            if (file_exists($save)) {
                    return redirect('admin/documents')->with('status', 'File Already Exist Please Uploade another One');
            }
            $data = array(
                'documents_name' => $name,
                'type' => $type,
                'uploaded_by' => 'Sebestian',
                'path' => $path_url,
            );
            $documents = DB::table('documents')->insert($data);
            if($documents)
            {
                return redirect('admin/documents')->with('status', 'File Uploaded Successfully');
            }
        }
        else
        {
            return redirect('admin/documents')->with('status', 'Some Error Please Upload Once Again');
        }
    }


}
