<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;
use App\Task;
use Mail;
use App\Skills;
use DB;
use Session;
use Response;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function index()
    {
        /** @var User $user */
        if ($user = Auth::user()) {
            if (!$user->isFreelancer) {
                Session::put('name', $user->first_name);
                Session::put('email', $user->email);
                Session::put('profile_img', $user->user_profile);
                Session::put('user_role', $user->user_role);
                Session::put('id', $user->id);
                $goal_set = DB::table('goal_setby_users')
                    ->where('set_by', $user->user_role)
                    ->get();
                $events_view = DB::table('calendar_events')->select(DB::raw('DATE_FORMAT(task_date, "%d-%m-%Y") as task_date'),
                    'task_status', 'task_type', 'id')->get();
                $pendingtask = Task::pendingForUser();
                $comment = DB::table('user_todolist')->where('user_id', $user->id)->first();
                $permission = '';
                $emp_users = User::select('id', 'first_name', 'last_name')->where('user_role', '2')->get();
                if (!$user->isAdmin) {
                    $emp_users = array();
                    $permission = DB::table('emp_permission')->where('emp_id', $user->id)->first();
                    $task_role = explode(',', $permission->task_permission);
                    if (in_array('all', $task_role)) {
                        $pendingtask = $pendingtask->where('accounts.added_by', $user->id);
                    }

                }

                $pendingtask = $pendingtask->get();
                return view('dashboard',
                    compact(['pendingtask', 'goal_set', 'events_view', 'permission', 'comment', 'emp_users']));
            } else {
                if (Skills::where('user_id', '=', $user->id)->count() > 0) {
                    \Session::put('profile_img', $user->user_profile);
                    \Session::put('freelancer_id', $user->id);
                    \Session::put('freelancer_name', $user->first_name);
                    $competences = $this->getCompetencesData();
                    $details = DB::table('skills')
                        ->where('user_id', $user->id)
                        ->get();
                    return view('edit_competence', ['details' => $details, 'competences' => $competences]);

                }
                $competences = $this->getCompetencesData();
                \Session::put('freelancer_id', $user->id);
                \Session::put('freelancer_name', $user->first_name);
                Session::put('profile_img', $user->user_profile);
                return view('freelancer', ['competences' => $competences]);
            }
        }
        return view('login');
    }

    /**
     * Show the application dashboard After Login.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = Auth::user();
            if ($request->has('remember')) {
                Session::put('remember', '1');
            }
            return $user->status == '1' ? 'success' : 'failed';
        } else {
            return 'failed';
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function register(Request $request)
    {
        if (DB::table('users')->where('email', $request->email)->exists()) {
            return 'error';
        }
        User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => $_GET['_token'],
        ]);
        return 'saved';
    }

    /**
     * Forgot Password for All users
     *
     * @param  array $data
     * @return User
     */

    protected function forgotPassword(Request $request)
    {
        $email = $request->input('email');
        if (User::where('email', '=', $email)->exists()) {
            Mail::raw('Text to e-mail', function ($message) {
                $message->to('work.a.andrey@gmil.com');
            });
            $this->sendResetLinkEmail($request);
        } else {
            return 'failed';
        }
    }

    public function deleteEvents($id)
    {
        $status = "success";
        try {
            $query = DB::table('calendar_events')->where('id', $id)->delete();
            $result = "Event Deleted Successfully";
        } catch (QueryException $ex) {
            dd($ex->getMessage());
            $status = "error";
            $result = $ex->getMessage();
        }
        return (json_encode(array('status' => $status, 'message' => $result)));
    }

    /**
     * Create a new competences
     *
     * @param  array $data
     * @return User
     */
    public function createCompetences(Request $request, $id)
    {

        $availability_date = $request->input('availability_date');
        $availability_date = date("Y-m-d", strtotime($availability_date));
        $category_skills = '';
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
        if ($request->has(['core_category'])) {
            $core_competences = implode(",", $request->input('core_category'));
        }
        if ($request->has(['hourly_rate'])) {
            $hourly_rate = implode(",", $request->input('hourly_rate'));
        }
        if ($request->has(['freelancer_roles'])) {
            $freelancer_roles = implode(",", $request->input('freelancer_roles'));
        }
        if ($request->has(['availabile_days'])) {
            $availabile_days = implode(",", $request->input('availabile_days'));
        }
        if ($request->has(['can_travel_to_germany'])) {
            $travelling = implode(",", $request->input('can_travel_to_germany'));
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
        if ($request->has(['category_skills'])) {
            $category_skills = implode(",", $request->input('category_skills'));
        }
        $hourly_rate_other_input = '';
        if ($request->has(['hourly_rate_other_input'])) {
            $hourly_rate_other_input = $request->input('hourly_rate_other_input');
        }
        $freelancer_roles_other_input = '';
        if ($request->has(['freelancer_roles_other_input'])) {
            $freelancer_roles_other_input = $request->input('freelancer_roles_other_input');
        }
        if ($request->has(['freelancer_source'])) {
            $freelancer_source = implode(",", $request->input('freelancer_source'));
        }


        $skills = new Skills;
        $skills->user_id = $id;
        $skills->reference = $request->input('reference');
        $skills->cv_recieved = $request->input('cv_recieved');
        $skills->client_name = $request->input('client_name');
        $skills->manager_name = $request->input('manager_name');
        $skills->reference_mobile = $request->input('reference_mobile');
        $skills->info_field = $request->input('info_field');
        $skills->hourly_rate = $hourly_rate;
        $skills->role_definition = $freelancer_roles;
        $skills->availability = $request->input('part_or_full_time');
        $skills->availability_date = $availability_date;
        $skills->availability_per_week = $availabile_days;
        $skills->travelling = $travelling;
        $skills->possible_extension = $request->input('possible_extension');
        $skills->extension_text = $request->input('extension_text');
        $skills->other_interview = $request->input('other_interview');
        $skills->comment_area_text = $request->input('comment_area_text');
        $skills->source = $freelancer_source;
        // $skills->competences_skill_category_1     = $competences_skill_category_1;
        // $skills->competences_skill_category_2     = $competences_skill_category_2;
        // $skills->competences_skill_category_3     = $competences_skill_category_3;
        // $skills->competences_skill_category_4     = $competences_skill_category_4;
        // $skills->competences_skill_category_5     = $competences_skill_category_5;
        // $skills->competences_skill_category_6     = $competences_skill_category_6;
        // $skills->competences_skill_category_7     = $competences_skill_category_7;
        // $skills->competences_skill_category_8     = $competences_skill_category_8;
        $skills->category_skills = $category_skills;
        $skills->general_notes = $request->input('general_notes');
        $skills->core_competences = $core_competences;
        $skills->save();
        return 'success';
    }

    public function editCompetences(Request $request, $id)
    {
        $availability_date = $request->input('availability_date');
        $availability_date = date("Y-m-d", strtotime($availability_date));
        $category_skills = '';
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
        if ($request->has(['hourly_rate'])) {
            $hourly_rate = implode(",", $request->input('hourly_rate'));
        }
        if ($request->has(['freelancer_roles'])) {
            $freelancer_roles = implode(",", $request->input('freelancer_roles'));
        }
        if ($request->has(['availabile_days'])) {
            $availabile_days = implode(",", $request->input('availabile_days'));
        }
        if ($request->has(['can_travel_to_germany'])) {
            $travelling = implode(",", $request->input('can_travel_to_germany'));
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
        if ($request->has(['core_category'])) {
            $core_competences = implode(",", $request->input('core_category'));
        }
        if ($request->has(['category_skills'])) {
            $category_skills = implode(",", $request->input('category_skills'));
        }
        if ($request->has(['freelancer_source'])) {
            $freelancer_source = implode(",", $request->input('freelancer_source'));
        }
        // $hourly_rate_other_input = '';
        // if ($request->has(['hourly_rate_other_input'])) 
        // {
        //     $hourly_rate_other_input = $request->input('hourly_rate_other_input');
        // }
        // $freelancer_roles_other_input = '';
        // if ($request->has(['freelancer_roles_other_input'])) 
        // {
        //     $freelancer_roles_other_input = $request->input('freelancer_roles_other_input');
        // }

        $data = array(
            'reference' => $request->input('reference'),
            'cv_recieved' => $request->input('cv_recieved'),
            'client_name' => $request->input('client_name'),
            'manager_name' => $request->input('manager_name'),
            'reference_mobile' => $request->input('reference_mobile'),
            'info_field' => $request->input('info_field'),
            'hourly_rate' => $hourly_rate,
            'role_definition' => $freelancer_roles,
            'availability' => $request->input('part_or_full_time'),
            'availability_date' => $availability_date,
            'availability_per_week' => $availabile_days,
            'travelling' => $travelling,
            'possible_extension' => $request->input('possible_extension'),
            'extension_text' => $request->input('extension_text'),
            'other_interview' => $request->input('other_interview'),
            'comment_area_text' => $request->input('comment_area_text'),
            'source' => $freelancer_source,
            'category_skills' => $category_skills,
            // 'competences_skill_category_1'  => $competences_skill_category_1,
            // 'competences_skill_category_2'  => $competences_skill_category_2,
            // 'competences_skill_category_3'  => $competences_skill_category_3,
            // 'competences_skill_category_4'  => $competences_skill_category_4,
            // 'competences_skill_category_5'  => $competences_skill_category_5,
            // 'competences_skill_category_6'  => $competences_skill_category_6,
            // 'competences_skill_category_7'  => $competences_skill_category_7,
            // 'competences_skill_category_8'  => $competences_skill_category_8,
            'core_competences' => $core_competences,
            'general_notes' => $request->input('general_notes'),
        );

        $result = DB::table('skills')
            ->where('id', $id)
            ->update($data);
        return response()->json([
            "message" => "Success"
        ]);
    }
}
