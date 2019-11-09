<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use App\Opportunity;
use App\Accounts;
use Response;
use Session;
//use App\Http\Requests\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OpportunityRequest;
use App\Http\Requests\AddLineRequest;

class OpportunityController extends Controller
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
        $accounts = new accounts;
        $accounts = $accounts->select('id','account_name')
                    ->orderBy('account_name', 'asc');
        // if(!$user->isAdmin)
        // {
        //     $accounts = $accounts->where('accounts.added_by',$user->id);
        // }
        $opportunity_list = DB::table('opportunity_list')->select('id','list_name','oppo_technology','detailed_coding','list_type','opportunity_status','hotness_client')->get();
        if(!$user->isAdmin)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
            $opportunity_roles = explode(',', $permission->projektanfrage_permission);
            if(!in_array('all', $opportunity_roles))
            {
                $accounts = $accounts->where('accounts.added_by',$user->id);
                $opportunity_list = DB::table('opportunity_list')->select('id','list_name','oppo_technology','detailed_coding','list_type','opportunity_status','hotness_client')->where('added_by',$user->id)->get();
            }
            
        }
        $accounts = $accounts->get();
        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        $skills = \DB::table('competences_skill')->select('id','skill')->get()->toArray();
        return view('opportunity.index',compact(['accounts','countries','permission','skills','opportunity_list']));
    }

    /*
    * @created : Mar 26, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get All Opportunity
    * @params  : None
    * @return  : None
    */
    public function getAllOpportunity(Request $request)
    {  
        $user = Auth::user();
        $emp_id = SESSION::get('id');
        $permission = [];
        $opportunity = new opportunity;
        $opportunity_data = [];
        $load_list = (isset($request->datatable['query']['load_list']) && ($request->datatable['query']['load_list']!="all") ? $request->datatable['query']['load_list'] : '');
        DB::statement(DB::raw('set @rownumber= 0'));
        $opportunity = $opportunity->join('users', 'opportunity.added_by', '=', 'users.id')->join('accounts', 'accounts.id', '=', 'opportunity.account_id')
                    ->select(DB::raw('@rownumber:=@rownumber+1 as S_No'),'users.first_name','users.last_name','opportunity.*', 'accounts.id as account_id','accounts.account_name');
        // if(!$user->isAdmin)
        // {
        //     $opportunity = $opportunity->where('opportunity.added_by',$user->id);
        // }
        if(!$user->isAdmin)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
            $opportunity_roles = explode(',', $permission->projektanfrage_permission);
            if(!in_array('all', $opportunity_roles))
            {
                $opportunity = $opportunity->where('opportunity.added_by',$user->id);
            }
            
        }
        $opportunity = $opportunity->get();
        if($load_list!="")
        {
            $opportunity = DB::table($load_list)->select("users.first_name","users.last_name","$load_list.*")->join("users", "$load_list.added_by", "=", "users.id")->get();
        }          
        $opportunity = json_decode(json_encode($opportunity));
        if(!empty($opportunity))
        {
            foreach ($opportunity as $key => $value) {
                $opportunity_data[] = (array)$value;
                if($emp_id!=1)
                {
                    $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
                    $opportunity_data[$key]['permission'] = $permission;
                    $opportunity_data[$key]['load_list'] = $load_list;
                }
                else
                {
                    $permission['admin'] = 'admin';
                    $opportunity_data[$key]['permission'] = $permission;
                    $opportunity_data[$key]['load_list'] = $load_list; 
                }
            }
             return Response::json($opportunity_data);
        }
        return Response::json($opportunity);
    }

    /*
    * @created : Mar 20, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Edit Opportunity Details
    * @params  : ID
    * @return  : None
    */
    public function edit($id)
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        $competences = $this->getCompetencesData();
        $details = DB::table('opportunity')
                    ->join('accounts', 'accounts.id', '=', 'opportunity.account_id')
                    ->select('opportunity.*', 'accounts.id as account_id','accounts.account_name')
                    ->orderBy('opportunity.id', 'asc')
                    ->where('opportunity.id',$id)
                    ->get();
        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        return view('opportunity.edit_opportunity',['details' => $details,'permission' => $permission,'competences' => $competences]);
    }

    public function getCompetencesData(){
        $competences = DB::table('competences')->get()->toArray();
        if(!empty($competences)){
            $competences_array = array();
            $i = 1;
            foreach ($competences as $competences_val) {
                $competences_skill = DB::table('competences_skill')->Where('competences_id',$competences_val->id)->get()->toArray();
                $competences_val->keys = $i;
                $competences_val->competences_skill = $competences_skill;
                $competences_array[] = $competences_val;
                $i++;
            }
            return $competences_array;
        }
    }

    /*
    * @created : April 04, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Upload Documnets in Opportunity
    * @params  : ID
    * @return  : Suucess message
    */

    public function upload(Request $request,$id)
    {
        if($request->hasFile('attach_doc'))
        {
            $attach_doc  = $request->file('attach_doc');
            $name       = $attach_doc->getClientOriginalName();
            $type       = $attach_doc->getClientOriginalExtension();
            $size       = $attach_doc->getClientSize();
            $allowed =  array('docx','pdf');
            if(!in_array($type,$allowed) ) {
                return redirect('admin/opportunity/edit/'.$id)->with('upload', 'Extension of Upload File Not Allowed');
            }
            if($size > 2097152) {
                return redirect('admin/opportunity/edit/'.$id)->with('upload', 'Please Upload File Size less then 2 MB ');
            }
            $save       = $attach_doc->storeAs('admin/opportunity/documnents',$name);
            $path_url   = storage_path('app/').$save;
            $data = array(
                'attached_doc' => $name,
            );
            $documents = DB::table('opportunity')
                ->where('id', $id)
                ->update($data);
            //$documents = DB::table('users')->insert($data);
            if($documents)
            {
                return redirect('admin/opportunity/edit/'.$id)->with('upload', 'File Uploaded Successfully');
            }
            else
            {
                return redirect('admin/opportunity/edit/'.$id)->with('upload', 'Some Error Please Upload Once Again');
            }
        }
        else
        {
            return redirect('admin/opportunity/edit/'.$id)->with('upload', 'Some Error Please Upload Once Again');
        }
    }

    /*
    * @created : April 04, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Upload Voice Memo in Opportunity
    * @params  : ID
    * @return  : Suucess message
    */

    public function voiceUpload(Request $request,$id)
    {
        if($request->hasFile('attach_voice'))
        {
            $attach_voice  = $request->file('attach_voice');
            $name       = $attach_voice->getClientOriginalName();
            $type       = $attach_voice->getClientOriginalExtension();
            $allowed =  array('mp3');
            if(!in_array($type,$allowed) ) {
                return redirect('admin/opportunity/edit/'.$id)->with('voice_msg', 'Extension of Voice Upload File Not Allowed');
            }
            $size       = $attach_voice->getClientSize();
            if($size > 2097152) {
                return redirect('admin/opportunity/edit/'.$id)->with('upload', 'Please Upload Mp3 Size less then 2 MB ');
            }
            $save       = $attach_voice->storeAs('admin/opportunity/voice',$name);
            $path_url   = storage_path('app/').$save;
            
            $data = array(
                'attached_voice_memo' => $name,
            );
            $documents = DB::table('opportunity')
                ->where('id', $id)
                ->update($data);
            //$documents = DB::table('users')->insert($data);
            if($documents)
            {
                return redirect('admin/opportunity/edit/'.$id)->with('voice_msg', 'Voice Uploaded Successfully');
            }
            else
            {
                return redirect('admin/opportunity/edit/'.$id)->with('voice_msg', 'Some Error Please Upload Once Again');
            }
        }
        else
        {
            return redirect('admin/opportunity/edit/'.$id)->with('voice_msg', 'Some Error Please Upload Once Again');
        }
    }

    /*
    * @created : Mar 20, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Update Opportunity Details
    * @params  : ID
    * @return  : Suucess message
    */
    public function update(OpportunityRequest $request,$id)
    {
        $status = "success";
        try
        {
            if($request->has('opportunity_type')){$opportunity_type = '1';}else{$opportunity_type = '0';}
            if($request->has('opportunity_status')){$opportunity_status = '1';}else{$opportunity_status = '0';}
            $technologies = '';
            if ($request->has(['category_rating'])) 
            {
                $technologies = implode(",",$request->input('category_rating'));
            }
            if($request->has('process')){
            $process = implode(',', $request->process);
            }else{$process = '';}
            if($request->has('profile_sent')){
            $profile_sent = $request->profile_sent;
            }else{$profile_sent = '';}
            $hotness = $request->input('hotness');
            if($request->input('hotness')=='')
            {
              $hotness = '0';  
            }
            $data = array(
                'name'              => $request->input('name'),
                'close_date'        => $request->input('close_date'),
                'probability'       => $request->input('probability'),
                'opportunity_type'  => $opportunity_type,
                'report'            => $request->input('report'),
                'source'            => $request->input('source'),
                'hotness'           => $hotness,
                'client_name'       => $request->input('client_name'),
                'client_number'     => $request->input('client_number'),
                'technology'        => $request->input('technology'),
                'process'           => $process,
                'profile_sent'      => $profile_sent,
                'info_field'        => $request->input('info_field'),
                'description'       => $request->input('description'),
                'opportunity_status'=> $opportunity_status,
                'detailed_coding'   => $technologies,
            );
            $data = DB::table('opportunity')
                    ->where('id', $id)
                    ->update($data);
            $result = "Opportunity Updated Successfully";
        }
        catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
        }
        return (json_encode(array('status'=>$status,'message'=>$result ))) ;
    }

    public function addline(AddLineRequest $request,$id)
    {
        $line_data = [];
        $details = DB::table('opportunity')
                    ->select('opportunity_line')
                    ->where('id',$id)
                    ->get();
        $details = json_decode($details);
        $opportunity_line = $details[0]->opportunity_line;
        $data = json_decode($opportunity_line);
        $line_data = $data;
        $line_data_post = array(
            'quantity'     => $request->input('quantity'),
            'price'        => $request->input('price'),
            'product'      => $request->input('product'),
        );
        $line_data_get[] = (object) $line_data_post;
        $result = array_merge($line_data,$line_data_get);
        $opportunity_data = json_encode($result);
        $query = DB::table('opportunity')
                ->where('id', $id)
                ->update(['opportunity_line' => $opportunity_data]);
        return response()->json([
                "message" => "Success"
            ]);
        
    }

    public function CreateList(Request $request)
    {
        
        $user = Auth::user();
        $status = "success";
        $opp_coding = [];
        try
        {
            $filter['list_name']      = str_replace(' ', '', $request->input('list_name'));
            $opp_coding               = $request->input('opp_coding');
            $filter['val_technology'] = $request->input('oppo_technology');
            $filter['val_hotness'] = $request->input('hotness_client');
            $filter['val_opportunity_type'] = $request->input('list_type');
            $filter['val_opportunity_status'] = $request->input('opportunity_status');
            $query = "CREATE OR REPLACE VIEW ag_".$filter['list_name']." AS SELECT opp.id,opp.name,opp.probability,opp.hotness,opp.detailed_coding,opp.client_name,opp.client_number,opp.added_by,opp.technology,opp.info_field,opp.opportunity_type,opp.opportunity_status  from ag_opportunity as opp INNER JOIN ag_accounts as ac ON ac.id=opp.account_id WHERE opp.status = 1";
            if(!$user->isAdmin)
            {
                $permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
                $opportunity_roles = explode(',', $permission->projektanfrage_permission);
                if(!in_array('all', $opportunity_roles))
                {
                    $query = $query. " AND opp.added_by = '".$user->id."'";
                }
                
            }
            // print_r($filter);
            // echo $opp_coding;
            // die;
            $technology = '';
            if($filter['val_technology']!='')
            {
                $technology = $filter['val_technology'];
                $query = $query. " AND opp.technology = '".$technology."'";
            }
            $detailed_tech = '';
            if(!empty($opp_coding))
            {
                //$detailed_technologies = $filter['val_technology'];
                $query = $query . " AND";
                foreach ($opp_coding as $key => $value) {
                    $query = $query . " FIND_IN_SET('".$value."',opp.detailed_coding) OR";
                }
                $query = substr($query, 0, -3 );
                $detailed_tech = implode(',', $opp_coding);
            }
            if($filter['val_hotness']!='')
            {
                $query = $query. " AND opp.hotness >= ".$filter['val_hotness']."";
            }
            if($filter['val_opportunity_type']!='')
            {
                $query = $query. " AND opp.opportunity_type = ".$filter['val_opportunity_type']."";
            }
            if($filter['val_opportunity_status']!='')
            {
                $query = $query. " AND opp.opportunity_status = ".$filter['val_opportunity_status']."";
            }
            // echo $query;
            // die;
            $data = array(
                'list_name'             => $filter['list_name'],
                'oppo_technology'        => $technology,
                'detailed_coding'       => $detailed_tech,
                'hotness_client'        => $filter['val_hotness'],
                'list_type'             => $filter['val_opportunity_type'],
                'opportunity_status'    => $filter['val_opportunity_status'],
                'added_by'              => $user->id
            );
            if(!empty($data))
            {
                if (DB::table('opportunity_list')->where('list_name', '=', $filter['list_name'])->exists()) {
                    $list_data = DB::table('opportunity_list')->where('list_name', '=', $filter['list_name'])->first();
                    $list_query = DB::table('opportunity_list')->where('id',$list_data->id)->update($data);
                    $result = "List Name Exist so Updated Successfully";
                }
                else
                {
                    $list_query = DB::table('opportunity_list')->insert($data);
                    $result = "List Created Successfully";
                }
            }
            $result_statement = DB::statement($query);
        }
        catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
        }
        return (json_encode(array('status'=>$status,'message'=>$result ))) ;

    }

    public function deleteList($id)
    {
        $status = "success";
        try 
        {
            $data = DB::table('opportunity_list')->select('id','list_name')->where('id',$id)->first();
            if(\Schema::hasTable($data->list_name))
            {
                $query = 'DROP VIEW ag_'.$data->list_name;
                DB::statement($query);
            }
            $query = DB::table('opportunity_list')->where('id',$id)->delete();
            $result = "List Deleted Successfully";
        } catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
        }
        return (json_encode(array('status'=>$status,'message'=>$result ))) ;
        
    }

    /*
    * @created : Mar 23, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Delete Particular Opportunity
    * @params  : ID
    * @return  : Delete Successfully
    */
    public function delete($id)
    {
        $account = DB::table('opportunity')->where('id',$id)->delete();
        return 'success';
    }

    public function getOpportunityLines($id)
    {
        $details = DB::table('opportunity')
                    ->select('opportunity_line')
                    ->where('id',$id)
                    ->get();
        $data = json_decode($details);
        print_r($data);
        echo "sdfdsf";
        die;
        $line_data = $data[0]->opportunity_line;

        return Response::json($line_data);
    }

    /*
    * @created : Mar 26, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Add new Opportunity.
    * @params  : None
    * @return  : Success Message
    */
    public function addNewOpportunity(OpportunityRequest $request)
    {
        $user = Auth::user();
        if($request->has('repeat_order')){$repeat_order = '1';}else{$repeat_order = '0';}
        if($request->has('opportunity_status')){$opportunity_status = '1';}else{$opportunity_status = '0';}
        if($request->has('process')){
            $process = implode(',', $request->process);
        }else{$process = '';}
        if($request->has('profile_sent')){
            $profile_sent = $request->profile_sent;
        }else{$profile_sent = '';}
        $hotness = $request->input('hotness');
        if($request->input('hotness')=='')
        {
          $hotness = '0';  
        }
        $opportunity = new Opportunity;
        $opportunity->name             = $request->input('name');
        $opportunity->opportunity_type = $request->input('oppo_type');
        $opportunity->close_date       = $request->input('close_date'); 
        $opportunity->account_id       = $request->input('account_id');
        $opportunity->probability      = $request->input('probability'); 
        $opportunity->repeat_order     = $repeat_order;
        $opportunity->report           = $request->input('repeat_order');
        $opportunity->source           = $request->input('source');
        $opportunity->hotness          = $hotness;
        $opportunity->client_name      = $request->input('client_name');
        $opportunity->client_number    = $request->input('client_number'); 
        $opportunity->technology       = $request->input('technology');
        $opportunity->process          = $process;
        $opportunity->profile_sent     = $profile_sent;
        $opportunity->info_field       = $request->input('info_field');
        $opportunity->description      = $request->input('description');
        //$opportunity->opportunity_line = $line_data;
        $opportunity->opportunity_status = $opportunity_status;
        $opportunity->added_by           = $user->id;
        $opportunity->save();
        return 'success';
    }

    public function bulkProfile(Request $request)
    {
        $id = $request->opportunity_id;
        print_r($id);
        die;
    }
}
