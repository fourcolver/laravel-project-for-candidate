<?php

namespace App\Http\Controllers\Admin;
use App\Competence;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Skills;
use Response;
use Session;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\SkillsRequest;

use App\Mail\sendFreelancerMail;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
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
    * @created : Mar 19, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get Dashboard of Freelancers
    * @params  : None
    * @return  : None
    */
    public function index()
    {
        $user = Auth::user();
        $permission = [];
        if(!$user->isAdmin)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$user->id)->first();
        }
        $rate=array("1"=>"50-60 €","2"=>"60-70 €","3"=>"70-80 €","4"=>"80-90 €","5"=>"90-100 €","6"=>"100-110 €","7"=>"110-120 €");
        $role=array("1"=>"Entwickler","2"=>"Architekt","3"=>"Support","4"=>"Projektmanager","5"=>"Berater","6"=>"Administrator","7"=>"SCRUM Master","8"=>"Tester","9"=>"Test Manager","10"=>"Hardware Entwickler","11"=>"Web Developer","12"=>"Security","13"=>"Frontend","14"=>"Backend");
        $availability=array("1"=>"1 Tag","2"=>"2 Tage","3"=>"3 Tage","4"=>"4 Tage","5"=>"5 Tage","6"=>"Update","7"=>"No Update");
        $skills = \DB::table('competences_skill')->select('id','skill')->get()->toArray();

        $travelling = array("1" =>"Weltweit","2"=>"Europaweit","3"=>"Deutschlandweit","4"=>"Bundesland","5"=>"Stadt");

        $account_list = DB::table('users_list')->get();

        return view('freelancer.index',compact(['rate','role','availability','skills','permission', 'travelling', 'account_list']));
    }

    public function addfreelancerview()
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        $competences = $this->getCompetencesData();
        if($emp_id!=1) {
            $permission = currentUser()->employeePermission;
        }
        return view('freelancer.add_freelancers',['competences' => $competences,'permission' => $permission]);
    }

    public function addfreelancer(Request $request)
    {
        $user_id = Auth::user();
        $rules = array(
            'first_name'     => 'required',
            'last_name'     => 'required',
            'freelancer_email'     => 'required|email',
            'freelancer_mobile'     => 'required',
            // 'freelancer_home'     => 'required|numeric',
            'freelancer_password'     => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $failedRules = $validator->getMessageBag()->toArray();
            $errorMsg = "";
            if(isset($failedRules['first_name']))
              $errorMsg = $failedRules['first_name'][0] . "\n";
          if(isset($failedRules['last_name']))
              $errorMsg = $failedRules['last_name'][0] . "\n";
          if(isset($failedRules['freelancer_email']))
              $errorMsg = $failedRules['freelancer_email'][0] . "\n";
          if(isset($failedRules['freelancer_mobile']))
              $errorMsg = $failedRules['freelancer_mobile'][0] . "\n";
          // if(isset($failedRules['freelancer_home']))
          //     $errorMsg = $failedRules['freelancer_home'][0] . "\n";
          if(isset($failedRules['freelancer_password']))
              $errorMsg = $failedRules['freelancer_password'][0] . "\n";
          return Response::json((array('status'=>'error','message'=>$errorMsg. "\n" ))) ;
          
      } else{
        if(DB::table('users')->where('email',$request->input('freelancer_email'))->exists())
        {
          return Response::json((array('status'=>'error','message'=>'Email Id already exists'. "\n" ))) ;
      }
      if(DB::table('users')->where('Mobile',$request->input('freelancer_mobile'))->exists())
      {
          return Response::json((array('status'=>'error','message'=>'Mobile already exists'. "\n" ))) ;
      }
      // if(DB::table('users')->where('home_number',$request->input('freelancer_home'))->exists())
      // {

      //     return Response::json((array('status'=>'error','message'=>'Home Number already exists'. "\n" ))) ;
      // }
      $user = new User;
      $user->title = $request->input('freelancer_title');
      $user->first_name = $request->input('first_name');
      $user->last_name = $request->input('last_name');
      $user->email = $request->input('freelancer_email');
      $user->Mobile = $request->input('freelancer_mobile');
      // $Mobile=$request->input('freelancer_mobile');
      // $user->Mobile = str_replace(' ','',$Mobile);
      $user->home_number = $request->input('freelancer_home');
      $user->postal_code = $request->input('postal_code');
      $user->password    = bcrypt($request->input('freelancer_password'));
      $user->added_by    = $user_id->id;

      $user = $user->save();
      $user_id = DB::table('users')->select('id')->orderBy('id', 'desc')->limit('1')->first();
      $availability_date = $request->input('availability_date');
      $availability_date = date("Y-m-d", strtotime($availability_date));
      $category_skills ='';
      $travelling = '';
      $hourly_rate = '';
      $freelancer_roles = '';
      $availabile_days = '';
      $core_competences = '';
      $freelancer_source = '';
      if ($request->has(['core_category'])) 
      {
        $core_competences = implode(",",$request->input('core_category'));
    }
    if ($request->has(['hourly_rate'])) 
    {
        $hourly_rate = implode(",",$request->input('hourly_rate'));
    }
    if ($request->has(['freelancer_roles'])) 
    {
        $freelancer_roles = implode(",",$request->input('freelancer_roles'));
    }
    if ($request->has(['availabile_days'])) 
    {
        $availabile_days = implode(",",$request->input('availabile_days'));
    }
    if ($request->has(['can_travel_to_germany'])) 
    {
        $travelling = implode(",",$request->input('can_travel_to_germany'));
    }
    if ($request->has(['category_skills'])) 
    {
        $category_skills = implode(",",$request->input('category_skills'));
    }
    if ($request->has(['freelancer_source'])) 
    {
        $freelancer_source = implode(",",$request->input('freelancer_source'));
    }
    $hourly_rate_other_input = '';
    if ($request->has(['hourly_rate_other_input'])) 
    {
        $hourly_rate_other_input = $request->input('hourly_rate_other_input');
    }
    $freelancer_roles_other_input = '';
    if ($request->has(['freelancer_roles_other_input'])) 
    {
        $freelancer_roles_other_input = $request->input('freelancer_roles_other_input');
    }

    
    $skills  = new Skills;
    $skills->user_id                          = $user_id->id;
    $skills->reference                        = $request->input('reference');
    $skills->cv_recieved                       = $request->input('cv_recieved');
    $skills->client_name                      = $request->input('client_name');
    $skills->manager_name                     = $request->input('manager_name');
    $skills->reference_mobile                 = $request->input('reference_mobile');
    $skills->info_field                       = $request->input('info_field');
    $skills->hourly_rate                      = $hourly_rate;
    $skills->role_definition                  = $freelancer_roles;
    $skills->availability                     = $request->input('part_or_full_time');
    $skills->availability_date                = $availability_date;
    $skills->availability_per_week            = $availabile_days; 
    $skills->travelling                       = $travelling; 
    $skills->possible_extension               = $request->input('possible_extension');
    $skills->extension_text                   = $request->input('extension_text');
    $skills->other_interview                  = $request->input('other_interview');
    $skills->comment_area_text                = $request->input('comment_area_text');
    $skills->source                           = $freelancer_source;
    $skills->category_skills                  = $category_skills;
    $skills->general_notes                    = $request->input('general_notes');
    $skills->core_competences                 = $core_competences;
    $skills->save();
    return Response::json((array('status'=>'success','message'=>'Successfully Added'))) ;
}
}


    /*
    * @created : Mar 19, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get All Freelancers
    * @params  : None
    * @return  : None
    */
    public function getAllFreelancers(Request $request)
    {
        $permission = currentPermissions();
        $user = currentUser();
        $freelancer_data = [];

        $rate = (isset($request->datatable['query']['rate']) && ($request->datatable['query']['rate']!="all") ? $request->datatable['query']['rate'] : '');

        $role = (isset($request->datatable['query']['role']) && ($request->datatable['query']['role']!="all") ? $request->datatable['query']['role'] : '');
        $skills = (isset($request->datatable['query']['skills']) && ($request->datatable['query']['skills']!="all") ? $request->datatable['query']['skills'] : '');
        $core_skills = (isset($request->datatable['query']['core_skills']) && ($request->datatable['query']['core_skills']!="all") ? $request->datatable['query']['core_skills'] : '');
        $free_availabilty = (isset($request->datatable['query']['free_availabilty']) && ($request->datatable['query']['free_availabilty']!="all") ? $request->datatable['query']['free_availabilty'] : '');
        $free_per_week = (isset($request->datatable['query']['free_per_week']) && ($request->datatable['query']['free_per_week']!="all") ? $request->datatable['query']['free_per_week'] : '');
        $cv_recieved = (isset($request->datatable['query']['cv_recieved']) && ($request->datatable['query']['cv_recieved']!="all") ? $request->datatable['query']['cv_recieved'] : '');


        $travelling = (isset($request->datatable['query']['travelling']) && ($request->datatable['query']['travelling']!="all") ? $request->datatable['query']['travelling'] : '');

        $postal_code = (isset($request->datatable['query']['postal_code']) && ($request->datatable['query']['postal_code']!="all") ? $request->datatable['query']['postal_code'] : '');

        $load_list = (isset($request->datatable['query']['load_list']) && ($request->datatable['query']['load_list']!="all") ? $request->datatable['query']['load_list'] : '');

        DB::statement(DB::raw('set @rownumber= 0'));

        
        $userfilter = "SELECT @rownumber:=@rownumber+1 AS S_No,ag_users.id AS users_id,ag_users.*,ag_users.email AS mail_id,(SELECT 0) AS list_id,IFNULL(`title`, '') AS u_title,ag_skills.id as skill_id,ag_skills.*,ag_skills.hourly_rate,ag_skills.role_definition,ag_skills.category_skills FROM ag_users LEFT JOIN ag_skills ON ag_users.id = ag_skills.user_id WHERE ag_users.user_role = '0'";
 
        if($load_list !='')
        {            
            $userfilter = "SELECT @rownumber:=@rownumber+1 AS S_No, 'ag_'.$load_list.id as users_id,'ag_'.$load_list.*,skills.id as skill_id,skills.*, 'ag_'.$load_list.email as mail_id,(select id from ag_users_list WHERE list_name = '$load_list') as list_id,IFNULL(`title`, '') AS u_title FROM 'ag_'.$load_list LEFT JOIN ag_skills ON ag_skills.user_id = 'ag_'.$load_list.id WHERE 'ag_'.$load_list.user_role = '0'";

        }

        if(!empty($rate))
        {
            $userfilter .= " AND (";
            foreach ($rate as $key => $value) {
                $userfilter .= " FIND_IN_SET('".$value."',hourly_rate) OR";           
            }
            $userfilter = substr( $userfilter, 0, -3 ); 
            $userfilter .=  " ) ";
            $rate = implode(',', $rate);
        }
        
        if(!empty($role))
        {
            $userfilter .= " AND (";
            foreach ($role as $key => $value) {
                $userfilter .= " FIND_IN_SET('".$value."',role_definition) OR";  
            }
            $userfilter = substr( $userfilter, 0, -3 );
            $userfilter .=  " ) ";
            $role = implode(',', $role);
        }
        
        if(!empty($free_per_week !=''))
        {
            $userfilter .= " AND (";
            foreach ($free_per_week as $key => $value) {
                $userfilter .= " FIND_IN_SET('".$value."',availability_per_week) OR";                 
            }
            $userfilter = substr( $userfilter, 0, -3 );
            $userfilter .=  " ) ";
            $free_per_week = implode(',', $free_per_week);
        }
        
        if($free_availabilty !='')
        {
            $userfilter .=  " AND availability = '".$free_availabilty."'";            
        }
        
        if($cv_recieved !='')
        {
            $userfilter .= " AND cv_recieved = '".$cv_recieved."'";            
        }

        if(!empty($travelling !=''))
        {
            $userfilter .= " AND (";
            foreach ($travelling as $key => $value) {
                $userfilter .= " FIND_IN_SET('".$value."',travelling) OR";                 
            }
            $userfilter = substr( $userfilter, 0, -3 );
            $userfilter .=  " ) ";
            $travelling = implode(',', $travelling);
        }

        if($postal_code !='')
        {
            $userfilter .= " AND postal_code LIKE '".$postal_code."%'";           
        }

        if(!empty($skills !=''))
        {
            $userfilter .= " AND (";
            foreach ($skills as $key => $value) {
                $userfilter .= " FIND_IN_SET('".$value."',category_skills) OR";                     
            }
            $userfilter = substr( $userfilter, 0, -3 );
            $userfilter .=  " ) ";
            $skills = implode(',', $skills);
        }
        
        if(!empty($core_skills!=''))
        {
            $userfilter .= " AND (";
            foreach ($core_skills as $key => $value) {
                $userfilter .= " FIND_IN_SET('".$value."',core_competences) OR";            
            }  
            $userfilter = substr( $userfilter, 0, -3 );
            $userfilter .=  " ) ";
            $core_skills = implode(',', $core_skills);
        }

        $users = DB::select($userfilter);
        if(!empty($users))
        {
            foreach ($users as $key => $value) {
                $freelancer_data[] = (array)$value;
                if($user->isAdmin) {
                    $freelancer_data[$key]['permission']['admin'] = 'admin';
                } else {
                    $freelancer_data[$key]['permission'] = $permission;
                }
                $freelancer_data[$key]['rate'] = $rate;
                $freelancer_data[$key]['role'] = $role;
                $freelancer_data[$key]['skills'] = $skills;
                $freelancer_data[$key]['core_skills'] = $core_skills;
                $freelancer_data[$key]['free_per_week'] = $free_per_week;
                $freelancer_data[$key]['free_availabilty'] = $free_availabilty;

                $freelancer_data[$key]['travelling'] = $travelling;
                $freelancer_data[$key]['postal_code'] = $postal_code;
                $freelancer_data[$key]['load_list'] = $load_list;
            }
            return Response::json($freelancer_data);
        }
    return Response::json($users);
}

public function getAllSkills(Request $request)
{
    $query = $request->input('query');
    if($query !='')
    {
        $data = DB::table('competences')
        ->select('competences_skill.skill','competences_skill.competences_id')
        ->join('competences_skill','competences_skill.competences_id','=','competences.id')
        ->where('competences_skill.skill', 'like', $request->input('query') . '%')
        ->orderBy('competences_skill.skill','asc')
        ->get();
                //->groupBy('competences_skill.competences_id');
        return Response::json($data);
    }
    $data = DB::table('competences')
    ->select('competences_skill.skill','competences_skill.competences_id')
    ->join('competences_skill','competences_skill.competences_id','=','competences.id')
    ->orderBy('competences_skill.skill','asc')
    ->get();
                //->groupBy('competences_skill.competences_id');
    return Response::json($data);
}
    /*
    * @created : Mar 28, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get Dashboard of Freelancer
    * @params  : None
    * @return  : None
    */

    public function view()
    {
        $users = new user;
        $users = DB::table('users')
        ->where('user_role','0')
        ->orderBy('id', 'asc')
        ->get();
        return view('freelancer.view',['users' => $users]);
    }

    /*
    * @created : Mar 30, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Edit Freelancer Skills
    * @params  : None
    * @return  : None
    */

    public function editFreelancer($id, $list)
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        $competences = $this->getCompetencesData();
        $details = DB::table('users')
                    ->select('users.id as user_id','skills.id as skill_id','users.first_name','users.last_name','users.*','skills.*')
                    ->join('skills','users.id','=','skills.user_id')
                    ->where('skills.id',$id)
                    ->orderBy('skills.id', 'asc')
                    ->get();
        
        $next_id = $details[0]->skill_id;        

        $view_list = DB::table('users_list')
                    ->select('list_name')
                    ->where('id', $list)
                    ->first();        

        $list_view = "";

        if($list === '0'){
            $list_view = "users";
        }else{
            $list_view = $view_list->list_name;
        }

        $next = DB::table($list_view)
                ->select($list_view.'.id','skills.id as skill_id',$list_view.'.first_name',$list_view.'.last_name')
                ->leftjoin('skills',$list_view.'.id','=','skills.user_id')
                ->where($list_view.'.user_role','0')
                ->where('skills.id','>',$next_id)
                ->orderBy('skills.id', 'asc')
                ->first();        

        $next_count = DB::table($list_view)
                    ->select($list_view.'.id','skills.id as skill_id')
                    ->leftjoin('skills',$list_view.'.id','=','skills.user_id')
                    ->where($list_view.'.user_role','0')
                    ->where('skills.id','>',$next_id)
                    ->orderBy('skills.id', 'asc')
                    ->count();        

        $previous = DB::table($list_view)
                    ->select($list_view.'.id','skills.id as skill_id',$list_view.'.first_name',$list_view.'.last_name',$list_view.'.user_role as role')
                    ->leftjoin('skills',$list_view.'.id','=','skills.user_id')
                    ->where($list_view.'.user_role','0')
                    ->where('skills.id','<',$next_id)
                    ->orderBy('skills.id', 'desc')
                    ->first();        

        $previous_count = DB::table($list_view)
                        ->select($list_view.'.id','skills.id as skill_id')
                        ->leftjoin('skills',$list_view.'.id','=','skills.user_id')
                        ->where($list_view.'.user_role','0')
                        ->where('skills.id','<',$next_id)
                        ->orderBy('skills.id', 'asc')
                        ->count();

        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        return view('freelancer.edit_freelancer', ['details' => $details,'competences' => $competences,'permission' => $permission, 'next' =>$next, 'next_count'=>$next_count, 'previous'=>$previous, 'previous_count'=>$previous_count, 'list'=>$list]);

    }

    /*
    * @created : Mar 30, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to view Freelancer Skills Add Page
    * @params  : None
    * @return  : None
    */

    public function addFreelancerSkills($id, $list)
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        $competences = $this->getCompetencesData();
        $details = DB::table('users')
        ->where('id',$id)
        ->get();

        $skill_id = null;

        $next_id = $details[0]->id;

        $view_list = DB::table('users_list')->select('list_name')->where('id', $list)->first();
        // echo $view_list->list_name;

        $list_view = "";

        if($list === '0'){
            $list_view = "users";
        }else{
            $list_view = $view_list->list_name;
        }

        $next    = DB::table($list_view)
        ->select($list_view.'.id','first_name', 'last_name','skills.id as skill_id')
        ->leftjoin('skills', 'skills.user_id', '=', $list_view.'.id')
        ->where('user_role','0')
        ->where($list_view.'.id','>',$next_id)->first();

                    // print_r($next);die;
        $next_count = DB::table($list_view)
        ->select('id')
        ->where('user_role','0')
        ->where('id','>',$next_id)->count();
        $previous = DB::table($list_view)
        ->select($list_view.'.id','first_name', 'last_name','skills.id as skill_id')
        ->leftjoin('skills', 'skills.user_id', '=', $list_view.'.id')
        ->orderBy($list_view.'.id', 'desc')
        ->where('user_role','0')
        ->where($list_view.'.id','<',$next_id)->first();
                    // print_r($previous);die;

        $previous_count = DB::table($list_view)
        ->select('id')
        ->where('user_role','0')
        ->where('id','<',$next_id)->count();


        if($emp_id!=1)
        {
            $permission = DB::table('emp_permission')->where('emp_id',$emp_id)->first();
        }
        return view('freelancer.add_freelancer_skills',['details' => $details,'competences' => $competences,'permission' => $permission, 'next' =>$next, 'next_count'=>$next_count, 'previous'=>$previous, 'previous_count'=>$previous_count ,'list' => $list]);
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
        try 
        {
            $users = DB::table('users')->where('id',$id)->delete();
            if (Skills::where('user_id', '=', $id)->exists()) {
                $users = DB::table('skills')->where('user_id',$id)->delete();
            }
            $result = "Freelancer Data Deleted Successfully";
        } catch(QueryException $ex){ 
          dd($ex->getMessage());
          $status = "error";
          $result = $ex->getMessage();
      }
      return (json_encode(array('status'=>$status,'message'=>$result ))) ;
  }

    /*
    * @created : Mar 30, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to view Freelancer Skills Add Page
    * @params  : None
    * @return  : None
    */

    public function addSkills($id,Request $request)
    { 
        // $name = explode(' ', $request->input('freelancer_name'));

        $title = $request->input('freelancer_title');
        $first_name = $request->input('freelancer_name');
        $last_name = $request->input('freelancer_last_name');

        $user_data = array(
            'title'           => $title,
            'first_name'      => $first_name,
            'last_name'       => $last_name,
            'email'           => $request->input('freelancer_email'),
            'Mobile'          => $request->input('freelancer_mobile'),
            'home_number'     => $request->input('freelancer_home'),
            'postal_code'          => $request->input('postal_code'),
        );
        $result = DB::table('users')
        ->where('id', $id)
        ->update($user_data);
        $availability_date = $request->input('availability_date');
        $availability_date = date("Y-m-d", strtotime($availability_date));
        $category_skills ='';
        // $competences_skill_category_1 ='';
        // $competences_skill_category_2 ='';
        // $competences_skill_category_3 ='';
        // $competences_skill_category_4 ='';
        // $competences_skill_category_5 ='';
        // $competences_skill_category_6 ='';
        // $competences_skill_category_7 ='';
        // $competences_skill_category_8 ='';
        $travelling = '';
        $hourly_rate = '';
        $freelancer_roles = '';
        $availabile_days = '';
        $core_competences = '';
        $freelancer_source = '';
        if ($request->has(['core_category'])) 
        {
            $core_competences = implode(",",$request->input('core_category'));
        }
        if ($request->has(['hourly_rate'])) 
        {
            $hourly_rate = implode(",",$request->input('hourly_rate'));
        }
        if ($request->has(['freelancer_roles'])) 
        {
            $freelancer_roles = implode(",",$request->input('freelancer_roles'));
        }
        if ($request->has(['availabile_days'])) 
        {
            $availabile_days = implode(",",$request->input('availabile_days'));
        }
        if ($request->has(['can_travel_to_germany'])) 
        {
            $travelling = implode(",",$request->input('can_travel_to_germany'));
        }
        if ($request->has(['category_skills'])) 
        {
            $category_skills = implode(",",$request->input('category_skills'));
        }
        // if ($request->has(['category1_rating'])) 
        // {
        //     $competences_skill_category_1 = implode(",",$request->input('category1_rating'));
        // }
        // if ($request->has(['category2_rating'])) 
        // {
        //     $competences_skill_category_2 = implode(",",$request->input('category2_rating'));
        // }
        // if ($request->has(['category3_rating'])) 
        // {
        //     $competences_skill_category_3 = implode(",",$request->input('category3_rating'));
        // }
        // if ($request->has(['category4_rating'])) 
        // {
        //     $competences_skill_category_4 = implode(",",$request->input('category4_rating'));
        // }
        // if ($request->has(['category5_rating'])) 
        // {
        //     $competences_skill_category_5 = implode(",",$request->input('category5_rating'));
        // }
        // if ($request->has(['category6_rating'])) 
        // {
        //     $competences_skill_category_6 = implode(",",$request->input('category6_rating'));
        // }
        // if ($request->has(['category7_rating'])) 
        // {
        //     $competences_skill_category_7 = implode(",",$request->input('category7_rating'));
        // }
        // if ($request->has(['category8_rating'])) 
        // {
        //     $competences_skill_category_8 = implode(",",$request->input('category8_rating'));
        // }
        if ($request->has(['freelancer_source'])) 
        {
            $freelancer_source = implode(",",$request->input('freelancer_source'));
        }
        $hourly_rate_other_input = '';
        if ($request->has(['hourly_rate_other_input'])) 
        {
            $hourly_rate_other_input = $request->input('hourly_rate_other_input');
        }
        $freelancer_roles_other_input = '';
        if ($request->has(['freelancer_roles_other_input'])) 
        {
            $freelancer_roles_other_input = $request->input('freelancer_roles_other_input');
        }

        
        $skills  = new Skills;
        $skills->user_id                          = $id;
        $skills->reference                        = $request->input('reference');
        $skills->cv_recieved                       = $request->input('cv_recieved');
        $skills->client_name                      = $request->input('client_name');
        $skills->manager_name                     = $request->input('manager_name');
        $skills->reference_mobile                 = $request->input('reference_mobile');
        $skills->info_field                       = $request->input('info_field');
        $skills->hourly_rate                      = $hourly_rate;
        $skills->role_definition                  = $freelancer_roles;
        $skills->availability                     = $request->input('part_or_full_time');
        $skills->availability_date                = $availability_date;
        $skills->availability_per_week            = $availabile_days; 
        $skills->travelling                       = $travelling; 
        $skills->possible_extension               = $request->input('possible_extension');
        $skills->extension_text                   = $request->input('extension_text');
        $skills->other_interview                  = $request->input('other_interview');
        $skills->comment_area_text                = $request->input('comment_area_text');
        $skills->source                           = $freelancer_source;
        // $skills->competences_skill_category_1     = $competences_skill_category_1;
        // $skills->competences_skill_category_2     = $competences_skill_category_2;
        // $skills->competences_skill_category_3     = $competences_skill_category_3;
        // $skills->competences_skill_category_4     = $competences_skill_category_4;
        // $skills->competences_skill_category_5     = $competences_skill_category_5;
        // $skills->competences_skill_category_6     = $competences_skill_category_6;
        // $skills->competences_skill_category_7     = $competences_skill_category_7;
        // $skills->competences_skill_category_8     = $competences_skill_category_8;
        $skills->category_skills                    = $category_skills;
        $skills->general_notes                    = $request->input('general_notes');
        $skills->core_competences                 = $core_competences;
        $skills->save();
        return 'success';
    }

    /*
    * @created : Mar 31, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to get All Skills
    * @params  : None
    * @return  : None
    */

    public function getCompetencesData(){
        return Competence::with('skills')->get();
    }

 /*
    * @created : April 04, 2018
    * @author  : Rajnish
    * @access  : public
    * @Purpose : This function is use to Upload Documnet in Freelancer Profile by Admin.
    * @params  : None
    * @return  : None
    */

 public function upload(Request $request, $id, $list)
 {
    if($request->hasFile('attach_doc'))
    {
        $attach_doc  = $request->file('attach_doc');
        $name       = $attach_doc->getClientOriginalName();
        $type       = $attach_doc->getClientOriginalExtension();
        $save       = $attach_doc->storeAs('admin',$name);
        $path_url   = storage_path('app/').$save;
        $allowed =  array('docx','pdf');
        if(!in_array($type,$allowed) ) {
            return redirect('admin/edit/skills/'.$id.'/'.$list)->with('message', 'Extension of Upload File Not Allowed');
        }
        $data = array(
            'admin_doc' => $name,
        );
        $documents = DB::table('users')
        ->where('id', $request->users_id)
        ->update($data);
            //$documents = DB::table('users')->insert($data);
        if($documents)
        {
            return redirect('admin/edit/skills/'.$id.'/'.$list)->with('message', 'File Uploaded Successfully');
        }
        else
        {
            return redirect('admin/edit/skills/'.$id.'/'.$list)->with('message', 'Some Error Please Upload Once Again');
        }
    }
    else
    {
        return redirect('admin/edit/skills/'.$id.'/'.$list)->with('message', 'Some Error Please Upload Once Again');
    }
}

public function update($id,Request $request)
{
        // $name = explode(' ', $request->input('freelancer_name'));
    $title = $request->input('freelancer_title');
    $first_name = $request->input('freelancer_name');
    $last_name = $request->input('freelancer_last_name');

    $user_data = array(
        'title'           => $title,
        'first_name'      => $first_name,
        'last_name'       => $last_name,
        'email'           => $request->input('freelancer_email'),
        'Mobile'          => $request->input('freelancer_mobile'),
        'home_number'     => $request->input('freelancer_home'),
        'postal_code'     => $request->input('postal_code'),
    );
    $result = DB::table('users')
    ->where('id', $id)
    ->update($user_data);
    $availability_date = $request->input('availability_date');
    $availability_date = date("Y-m-d", strtotime($availability_date));
    $category_skills ='';
    $core_competences ='';
    $hourly_rate = '';
    $freelancer_roles = '';
    $availabile_days = '';
    $travelling = '';
    $freelancer_source = '';
    if ($request->has(['hourly_rate'])) 
    {
        $hourly_rate = implode(",",$request->input('hourly_rate'));
    }
    if ($request->has(['freelancer_roles'])) 
    {
        $freelancer_roles = implode(",",$request->input('freelancer_roles'));
    }
    if ($request->has(['availabile_days'])) 
    {
        $availabile_days = implode(",",$request->input('availabile_days'));
    }
    if ($request->has(['can_travel_to_germany'])) 
    {
        $travelling = implode(",",$request->input('can_travel_to_germany'));
    }
    if ($request->has(['core_category'])) 
    {
        $core_competences = implode(",",$request->input('core_category'));
    }
    if ($request->has(['category_skills'])) 
    {
        $category_skills = implode(",",$request->input('category_skills'));
    }
    if ($request->has(['freelancer_source'])) 
    {
        $freelancer_source = implode(",",$request->input('freelancer_source'));
    }

    $data = array(
        'reference'                     => $request->input('reference'),
        'cv_recieved'                   => $request->input('cv_recieved'),
        'client_name'                   => $request->input('client_name'),
        'manager_name'                  => $request->input('manager_name'),
        'reference_mobile'              => $request->input('reference_mobile'),
        'info_field'                    => $request->input('info_field'),
        'hourly_rate'                   => $hourly_rate,
        'role_definition'               => $freelancer_roles,
        'availability'                  => $request->input('part_or_full_time'),
        'availability_date'             => $availability_date, 
        'availability_per_week'         => $availabile_days,
        'travelling'                    => $travelling,
        'possible_extension'            => $request->input('possible_extension'),
        'extension_text'                => $request->input('extension_text'),
        'other_interview'               => $request->input('other_interview'),
        'comment_area_text'             => $request->input('comment_area_text'),
        'source'                        => $freelancer_source,
        'category_skills'               => $category_skills,
        'core_competences'              => $core_competences,
        'general_notes'                 => $request->input('general_notes'),
    );
    $result = DB::table('skills')
    ->where('user_id', $id)
    ->update($data);
    return 'success';
}

public function adminUpload(Request $request, $id, $list)
{
    if($request->hasFile('attach_doc'))
    {
        $attach_doc  = $request->file('attach_doc');
        $name       = $attach_doc->getClientOriginalName();
        $type       = $attach_doc->getClientOriginalExtension();
        $save       = $attach_doc->storeAs('admin',$name);
        $path_url   = storage_path('app/').$save;
        $allowed =  array('docx','pdf');
        if(!in_array($type,$allowed) ) {
            return redirect('admin/add/skills/'.$id.'/'.$list)->with('status', 'Extension of Upload File Not Allowed');
        }
        $data = array(
            'admin_doc' => $name,
        );
        $documents = DB::table('users')
        ->where('id', $id)
        ->update($data);
            //$documents = DB::table('users')->insert($data);
        if($documents)
        {
            return redirect('admin/add/skills/'.$id.'/'.$list)->with('status', 'File Uploaded Successfully');
        }
        else
        {
            return redirect('admin/add/skills/'.$id.'/'.$list)->with('status', 'Some Error Please Upload Once Again');
        }
    }
    else
    {
        return redirect('admin/add/skills/'.$id.'/'.$list)->with('status', 'Some Error Please Upload Once Again');
    }
}

public function exportfreelancerCsv(Request $request)
{
    $user = Auth::user();
    $hourlydataWithKey = array('1'=>'50-60','2'=>'60-70','3'=>'70-80','4'=>'80-90','5'=>'90-100','6'=>'100-110','7'=>'110-120');
    $roleDataWithKey = array('1'=>'Entwickler','2'=>'Architekt','3'=>'Support','4'=>'Projektmanager','5'=>'Berater','6'=>'Administrator','7'=>'SCRUM Master','8'=>'Tester','9'=>'Test Manager','10'=>'Hardware Entwickler','11'=>'Web Developer','12'=>'Security','13'=>'Frontend','14'=>'Backend');
    $availabilityDataWithKey = array("1"=>"1 Tag","2"=>"2 Tage","3"=>"3 Tage","4"=>"4 Tage","5"=>"5 Tage","6"=>"Update","7"=>"No Update");
    $travelingDataWithKey = array("1"=>"Weltweit","2"=>"Europaweit","3"=>"Deutschlandweit","4"=>"Bundesland","5"=>"Stadt");
    $filename = "freelancers.csv";
    $handle = fopen($filename, 'w+');

    fputcsv($handle, array('Kandidaten Name','Email','Home Phone','Mobile Phone','Cv Received','References','Stundensatz','Rollendefinition','Available From','Availability per Week','Traveling','Possible Extension','Other Interviews and Offers','Source Of Freelancer', 'Competences', 'Core Competences','General Notes'));
    
    $users = DB::table('users')
    ->select('users.id as users_id','users.first_name','users.last_name','users.email','users.Mobile','users.home_number','skills.id as skill_id','skills.*')
    ->leftjoin('skills', 'skills.user_id', '=', 'users.id')
    ->where('users.user_role','0')
    ->orderBy('users.id', 'asc')
    ->get()->toArray();
        //print_r($users); die;
    foreach ($users as $key => $value) {
        $hourly_rate = '';
        $role_rate = '';
        $data_availability='';
        $traveling='';
        $core_competences_data='';
        $skills='';
        $cv_recieved="No";
        $possible_extension="No";
        $other_interview="No";
        $category_skills='';
        $reference="No";
        if($value->hourly_rate !='' && $value->hourly_rate!=null)
        {
            $hourly_rate_data = array();
            $hourly_rate = explode(',', $value->hourly_rate);
                //print_r($hourly_rate);
            foreach ($hourly_rate as $key => $data) {
                if(array_key_exists($data,$hourlydataWithKey))
                {
                    $hourly_rate =  $hourlydataWithKey[$data];
                    array_push($hourly_rate_data, $hourly_rate);
                }
            }
            $hourly_rate = implode(',', $hourly_rate_data);
        }

        if($value->role_definition !='')
        {
            $role_data = array();
            $role_rate = explode(',', $value->role_definition);
            foreach ($role_rate as $key => $role_data_value) {
                if(array_key_exists($role_data_value,$roleDataWithKey))
                {
                    $role_rate =  $roleDataWithKey[$role_data_value];
                    array_push($role_data, $role_rate);
                }
            }
            $role_rate = implode(',', $role_data);
        }
        if($value->availability_per_week !='')
        {
            $data_availability_value = array();
            $availability_data_value = explode(',', $value->availability_per_week);
            foreach ($availability_data_value as $key => $availability_details) {
                if(array_key_exists($availability_details,$availabilityDataWithKey))
                {
                    $availability_value =  $availabilityDataWithKey[$availability_details];
                    array_push($data_availability_value, $availability_value);
                }
            }
            $data_availability = implode(',', $data_availability_value);
        }
        if($value->travelling !='')
        {
            $free_traveling_data = array();
            $traveling_data_value = explode(',', $value->travelling);
            foreach ($traveling_data_value as $key => $traveling_data) {
                if(array_key_exists($traveling_data,$travelingDataWithKey))
                {
                    $traveling_value =  $travelingDataWithKey[$traveling_data];
                    array_push($free_traveling_data, $traveling_value);
                }
            }
            $traveling = implode(',', $free_traveling_data);
        }
        if($value->category_skills!='')
        {
            $skill_data_value = array();
            $skill_data = explode(',', $value->category_skills);
            $skills = DB::table('competences_skill')->select('skill')->whereIn('id',$skill_data)->get()->toArray();
            foreach ($skills as $key => $skill_value) {
                array_push($skill_data_value, $skill_value->skill);
            }
            $category_skills = implode(',', $skill_data_value);
        }
        if($value->core_competences!='')
        {
            $core_skill = array();
            $core_skill_data = explode(',', $value->core_competences);
            $skills = DB::table('competences_skill')->select('skill')->whereIn('id',$core_skill_data)->get()->toArray();
            foreach ($skills as $key => $skill_value) {
                array_push($core_skill, $skill_value->skill);
            }
            $core_competences_data = implode(',', $core_skill);
        }
        if($value->availability=='1')
        {
            $availability="Full Time";
        }
        elseif($value->availability=='0')
        {
           $availability="Part Time"; 
       }
       else
       {
           $availability="Not Available";  
       }
       if($value->cv_recieved=='1')
       {
        $cv_recieved="Yes";
    }
    if($value->reference=='1')
    {
        $reference="Yes";
    }
    if($value->possible_extension=='1')
    {
        $possible_extension="Yes";
    }
    if($value->other_interview=='1')
    {
        $other_interview="Yes";
    }
    fputcsv($handle, array($value->first_name.' '.$value->last_name,$value->email,"\t".$value->home_number,"\t".$value->Mobile,$cv_recieved,$reference,$hourly_rate,$role_rate,$availability,$data_availability,$traveling,$possible_extension,$other_interview,$value->source,$category_skills,$core_competences_data,$value->general_notes,));
}
fclose($handle);
$headers = array(
 'Content-Type' => 'text/csv',
 'Content-Disposition: attachment;filename='.$filename
);

return Response::download($filename, 'freelancers.csv', $headers);

}

public function createList(Request $request){

    $user = Auth::user();
    $users = new user;
    $status = "success";

    $list_name = str_replace(' ', '', $request->input('list_name'));
    $filter = rtrim($request->input('list'),",");

        // dd($filter, ","));
    try{
        $view_create = "CREATE OR REPLACE VIEW ag_".$list_name." AS Select ag_users.id as users_id, ag_users.*, ag_skills.id as skill_id from ag_users left join ag_skills on ag_skills.user_id = ag_users.id where ag_users.id in ($filter)";


        $data = array(
            'list_name'             => $list_name,
            'added_by'        => $user->id
        );

        if(!empty($data)){
            if(DB::table('users_list')->where('list_name', '=', $list_name)->exists())
            {
             $list_data = DB::table('users_list')->where('list_name', '=', $list_name)->first();
             $list_query = DB::table('users_list')->where('id',$list_data->id)->update($data);
             $result = "List Name Exist so Updated Successfully";
         }
         else{
          $list_query = DB::table('users_list')->insert($data);
          $result = "List Created Successfully";
      }
  }
  $result_statement = DB::statement($view_create);
}
catch(QueryException $ex){
  dd($ex->getMessage());
  $status = "error";
  $result = $ex->getMessage();
}
return (json_encode(array('status'=>$status,'message'=>$result ))) ;


}

public function openMailPanel(Request $request)
{
    $id = explode(',', $request->freelancers_id);

    $freelancer = $request->freelancers_id;
    $freelancer_data = User::where('id',$freelancer)->first();
    $title_for_display = "Hallo ".$freelancer_data->title.' '.$freelancer_data->last_name;
    $title = $title_for_display;
        // $filter = rtrim($id,",");
        // print_r($id);die;
    
    $users_data = DB::table('users')->select('email', 'first_name', 'last_name')->whereIn('id', $id)->get();
        // print_r($users_data);die;
    return view('freelancer.send_mail_panel', ['users_data'=>$users_data, 'title'=>$title, 'freelancer'=>$freelancer]);
        // dd($id);
}


public function sendMail(Request $request){
 
    $status = 'success';
            // try{
    $value = explode(',', $request->freelancer_id);
    $body = $request->freelancer_mail_body;

    $users = DB::table('users')->select('id','email','first_name','last_name', DB::Raw(" IFNULL( `title`, '' ) as u_title"))->whereIn('id',$value)->get();


     $data = array();
     $subject = $request->freelancer_mail_sub;

     foreach ($users as $value) {

        $body = str_replace("((Name))", $value->u_title.' '. $value->first_name. ' '. $value->last_name.', ', $body);
                // $email = $value->email;
        $data['email'] = $value->email;
        $data['subject'] = $subject;
                // $data['value'] = $value;
        

        Mail::send('mail.mail_template', ['data'=>$data, 'content' =>$body], function ($message) use ($data)
        {

            $message->from('avinashmishra.vll@gmail.com', 'Argon Strategy');

            $message->to($data['email']);

            $message->subject($data['subject']);

        });


                // $data['id'] = $value->id;
                // $data['body'] = $body;
                // $data['name'] = $value->u_title.' '.$value->first_name.''. $value->last_name;

                // Mail::to($value->email)->queue(new sendFreelancerMail($data));
                // mail::send([], array('yourValue' => $value), function($message) use ($value) {
                //                 $MailBody = $body;
                //                 $message->setBody($MailBody, 'text/html');
                //                 $message->to($value->email);
                //                 $message->subject($request->freelancer_mail_sub);
                //                 });

    }

    // }
    // catch(QueryException $ex){
    //      dd($ex->getMessage());
    //           $status = "error";
    //           $result = $ex->getMessage();
    // }
            // dd($body);



        //     foreach ($request->users_id as $key=>$value) {
        //         // $val = $val.','.$value;
        //         if($value != 'on'){

        //              Mail::to($users->email)->queue(new sendFreelancerMail($value));
        //         }
        // }


    return (json_encode(array('status'=>$status,'message'=>'Email Send Successfully'))) ;
    }
}
