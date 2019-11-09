<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kandidate;
use App\Mail\sendFestanstellungMail;
use App\Models\CandidateInvite;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Response;
use Session;
use Validator;

class KandidateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @return array|mixed
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $permission = [];
        if (!$user->isAdmin) {
            $permission = DB::table('emp_permission')->where('emp_id', $user->id)->first();
        }
        $rate = Kandidate::HOURLY_RATES;
        $role = Kandidate::ROLES;
        $availability = array(
            "1" => "A1",
            "2" => "A2",
            "3" => "B1",
            "4" => "B2",
            "5" => "C1",
            "6" => "C2",
        );
        $skills = \DB::table('competences_skill')->select('id', 'skill')->get()->toArray();
        $willingnessToRelocate = [
            1 => 'Weltweit',
            2 => 'Europaweit',
            3 => 'Deutschlandweit',
            4 => 'Bundesland',
            5 => 'Stadt',
        ];

        $candidates = $this->getCandidates($request);

        return view('kandidate.index', compact('rate', 'role', 'availability', 'skills', 'permission', 'willingnessToRelocate', 'candidates'));
    }

    public function show($id)
    {
        $candidate = Kandidate::findOrFail($id);
        $competences = $this->getCompetencesData();
        $candidate_experience = DB::table('work_experience')->where('kandidate_id', $id)->get();
        $candidate_education = DB::table('education')->where('kandidate_id', $id)->get();
        $skills = \DB::table('competences_skill')->select('id', 'skill')->get()->toArray();
        return view('kandidate.show', compact('candidate', 'skills', 'candidate_experience', 'candidate_education', 'competences'));
    }

    private function getCandidates(Request $request)
    {
        $permission = [];
        $freelancer_data = [];
        $rate = (isset($request->datatable['query']['rate']) && ($request->datatable['query']['rate'] != "all") ? $request->datatable['query']['rate'] : '');
        $role = (isset($request->datatable['query']['role']) && ($request->datatable['query']['role'] != "all") ? $request->datatable['query']['role'] : '');
        $skills = (isset($request->datatable['query']['skills']) && ($request->datatable['query']['skills'] != "all") ? $request->datatable['query']['skills'] : '');
        $can_travel_to_germany = (isset($request->datatable['query']['can_travel_to_germany']) && ($request->datatable['query']['can_travel_to_germany'] != "all") ? $request->datatable['query']['can_travel_to_germany'] : '');
        $free_availabilty = (isset($request->datatable['query']['free_availabilty']) && ($request->datatable['query']['free_availabilty'] != "all") ? $request->datatable['query']['free_availabilty'] : '');
        $free_per_week = (isset($request->datatable['query']['free_per_week']) && ($request->datatable['query']['free_per_week'] != "all") ? $request->datatable['query']['free_per_week'] : '');
        $free_per_week_en = (isset($request->datatable['query']['free_per_week_en']) && ($request->datatable['query']['free_per_week_en'] != "all") ? $request->datatable['query']['free_per_week_en'] : '');
        $cv_recieved = (isset($request->datatable['query']['cv_recieved']) && ($request->datatable['query']['cv_recieved'] != "all") ? $request->datatable['query']['cv_recieved'] : '');

        $userfilter = "SELECT `number` AS S_No,ag_kandidates.*,(SELECT 0) AS list_id FROM ag_kandidates WHERE id IS NOT NULL";

        if(!Auth::user()->isAdmin) {
            $userfilter .= ' AND is_active = 1 AND is_confirmed = 1';
        }

        if ($rate != '') {
            $userfilter .= " AND (";
            foreach ($rate as $key => $value) {
                $userfilter .= " FIND_IN_SET('" . $value . "',hourly_rate) OR";
            }
            $userfilter = substr($userfilter, 0, -3);
            $userfilter .= " ) ";
            $rate = implode(',', $rate);
        }

        if ($role != '') {
            $userfilter .= " AND (";
            foreach ($role as $key => $value) {
                $userfilter .= " FIND_IN_SET('" . $value . "',role_definition) OR";
            }
            $userfilter = substr($userfilter, 0, -3);
            $userfilter .= " ) ";
            $role = implode(',', $role);
        }
        if ($free_per_week != '') {
            $userfilter .= " AND (";
            foreach ($free_per_week as $key => $value) {
                $userfilter .= " FIND_IN_SET('" . $value . "',availability_per_week) OR";
            }
            $userfilter = substr($userfilter, 0, -3);
            $userfilter .= " ) ";
            $free_per_week = implode(',', $free_per_week);
        }
        if ($free_per_week_en != '') {
            $userfilter .= " AND (";
            foreach ($free_per_week_en as $key => $value) {
                $userfilter .= " FIND_IN_SET('" . $value . "',availability_per_week_en) OR";
            }
            $userfilter = substr($userfilter, 0, -3);
            $userfilter .= " ) ";
            $free_per_week_en = implode(',', $free_per_week_en);
        }
        if ($free_availabilty != '') {
            $userfilter .= " AND availability = '" . $free_availabilty . "'";
        }
        if ($cv_recieved != '') {
            $userfilter .= " AND cv_recieved = '" . $cv_recieved . "'";
        }

        if(is_array($can_travel_to_germany)) {
            foreach ($can_travel_to_germany as $key => $value) {
                $userfilter .= " AND ( ";
                $userfilter .= DB::raw('FIND_IN_SET(' . DB::connection()->getPdo()->quote($value) . ', travelling)') . " OR ";
                $userfilter .= DB::raw('FIND_IN_SET(' . DB::connection()->getPdo()->quote($value) . ', traveling_state)') . " OR ";
                $userfilter .= DB::raw('FIND_IN_SET(' . DB::connection()->getPdo()->quote($value) . ', traveling_city)');
                $userfilter .= ")";
            }
        }

        if ($skills != '') {
            $userfilter .= " AND (";
            foreach ($skills as $key => $value) {
                $userfilter .= " FIND_IN_SET('" . $value . "',category_skills) OR";
            }
            $userfilter = substr($userfilter, 0, -3);
            $userfilter .= " ) ";
            $skills = implode(',', $skills);
        }

        $userfilter .= " order By `number` asc";

        $users = DB::select($userfilter);

        foreach ($users as $key => $value) {
            $freelancer_data[] = (array)$value;
            if (!currentUser()->isAdmin) {
                $freelancer_data[$key]['permission'] = currentUser()->employeePermission;
            } else {
                $permission['admin'] = 'admin';
                $freelancer_data[$key]['permission'] = ['admin' => 'admin'];
            }
            $freelancer_data[$key]['rate'] = $rate;
            $freelancer_data[$key]['role'] = $role;
            $freelancer_data[$key]['skills'] = $skills;
            $freelancer_data[$key]['free_per_week'] = $free_per_week;
            $freelancer_data[$key]['free_per_week_en'] = $free_per_week_en;
            $freelancer_data[$key]['traveling'] = is_array($can_travel_to_germany) ? implode(',', $can_travel_to_germany) : '';
            $freelancer_data[$key]['can_travel_to_germany'] = is_array($can_travel_to_germany) ? implode(',', $can_travel_to_germany) : '';
            $freelancer_data[$key]['free_availabilty'] = $free_availabilty;
            $freelancer_data[$key]['cv_url'] = !empty($value->attached_cv) ? '/public/uploads/'. $value->attached_cv : false;
            $freelancer_data[$key]['view_url'] = route('candidates.view', $value->id);
        }

        $skills = \DB::table('competences_skill')->select('id', 'skill')->get()->keyBy('id');
        $candidates = collect($freelancer_data)->map(function($candidate) use($skills) {
            $currentSkills = array_map(function($skillId) use($skills) {
                return isset($skills[$skillId]) ? $skills[$skillId]->skill : '';
            }, explode(',', $candidate['category_skills']));

            $salaryExpectations = array_map(function($hourlyRateId) {
                return !empty(Kandidate::HOURLY_RATES_SHORT[$hourlyRateId]) ? Kandidate::HOURLY_RATES_SHORT[$hourlyRateId] : '';
            }, explode(',', $candidate['hourly_rate']));

            $linguisticProficiency = array_map(function($item) {
                return !empty(Kandidate::LINGUISTIC_PROFICIENCY[$item]) ? Kandidate::LINGUISTIC_PROFICIENCY[$item] : '';
            }, explode(',', $candidate['availability_per_week']));

            $possibleLocations = array_map(function($location) use($candidate) {
                $appendix = '';
                if($location == 4 && !empty($candidate['traveling_state'])) {
                    $appendix = " - {$candidate['traveling_state']}";
                } elseif($location == 5 && !empty($candidate['traveling_city'])) {
                    $appendix = " - {$candidate['traveling_city']}";
                }
                return !empty(Kandidate::POSSIBLE_LOCATIONS[$location]) ? Kandidate::POSSIBLE_LOCATIONS[$location] . $appendix : '';
            }, explode(',', $candidate['travelling']));

            return [
                'image' => !empty($candidate['picture']) ? '/public/uploads/' . $candidate['picture'] : '/no-photo.jpg',
                'salaryExpectations' => implode(', ', $salaryExpectations),
                'linguisticProficiency' => implode(', ', $linguisticProficiency),
                'firstName' => $candidate['first_name'],
                'techSkills' => implode(', ', $currentSkills),
                'possibleLocation' => implode(', ', $possibleLocations),
                'viewUrl' => $candidate['view_url'],
                'cvUrl' => $candidate['cv_url'],
                'hasVideo' => $candidate['video'],
                'isActive' => $candidate['is_active'],
                'isConfirmed' => $candidate['is_confirmed'],
                'raw' => $candidate
            ];
        })->filter(function($candidate) use($request) {
            $q = $request->input('q');
            if(empty($q)) {
                return true;
            }

            return in_array($q, explode(', ', $candidate['techSkills']));
        });

        return $candidates;
    }

    public function addKandidateview()
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        $competences = $this->getCompetencesData();
        if ($emp_id != 1) {
            $permission = DB::table('emp_permission')->where('emp_id', $emp_id)->first();
        }

        $candidate = new Kandidate();

        return view('kandidate.addkandidate', compact('competences', 'permission', 'candidate'));
    }

    public function addKandidate(Request $request)
    {
        $this->validate($request, [
            'number' => 'required|unique:kandidates,number'
        ]);


        $user = new Kandidate;
        $user->title = '';
        $user->education = implode(',', (array) $request->get('education'));
        $user->work_experience_sector = $request->get('work_experience_sector');
        $user->work_experience_period = $request->get('work_experience_period');
        $user->work_experience_company_name = $request->get('work_experience_company_name');
        $user->work_experience_position = $request->get('work_experience_position');
        $user->work_experience_position_description = $request->get('work_experience_position_description');
        $user->first_name = $request->get('first_name');
        $user->optional_interview = $request->get('optional_interview');
        $user->last_name = '';
        $user->email = 'generic'.time().'@example.com';
        $user->Mobile = '';
        $user->home_number = '';
        $user->password = bcrypt(time());
        $availability_date = '';
        $category_skills = '';
        $travelling = '';
        $hourly_rate = '';
        $freelancer_roles = '';
        $availabile_days = '';
        $availabile_days_en = '';
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
        if ($request->has(['availabile_days_en'])) {
            $availabile_days_en = implode(",", $request->input('availabile_days_en'));
        }
        if ($request->has(['can_travel_to_germany'])) {
            $travelling = implode(",", $request->input('can_travel_to_germany'));
        }
        if ($request->has(['category_skills'])) {
            $category_skills = implode(",", $request->input('category_skills'));
        }
        if ($request->has(['freelancer_source'])) {
            $freelancer_source = implode(",", $request->input('freelancer_source'));
        }
        $hourly_rate_other_input = '';
        if ($request->has(['hourly_rate_other_input'])) {
            $hourly_rate_other_input = $request->input('hourly_rate_other_input');
        }
        $freelancer_roles_other_input = '';
        if ($request->has(['freelancer_roles_other_input'])) {
            $freelancer_roles_other_input = $request->input('freelancer_roles_other_input');
        }

        $user->reference = $request->input('reference');

        if($request->file('attached_cv')) {
            $user->attached_cv = $request->file('attached_cv')->store('cv');
        }

        if($request->file('picture')) {
            $user->picture = $request->file('picture')->store('picture');
        }
        $user->client_name = $request->input('client_name');
        $user->manager_name = $request->input('manager_name');
        $user->reference_mobile = $request->input('reference_mobile');
        $user->info_field = $request->input('info_field');
        $user->hourly_rate = $hourly_rate;
        $user->role_definition = $freelancer_roles;
        $user->availability = $request->input('part_or_full_time');
        $user->availability_date = $availability_date;
        $user->availability_per_week = $availabile_days;
        $user->availability_per_week_en = $availabile_days;
        $user->travelling = $travelling;
        $user->possible_extension = $request->input('possible_extension');
        $user->extension_text = $request->input('extension_text');
        $user->other_interview = $request->input('other_interview');
        $user->comment_area_text = $request->input('comment_area_text');
        $user->source = $freelancer_source;
        $user->category_skills = $category_skills;
        $user->general_notes = $request->input('general_notes');
        $user->core_competences = $core_competences;
        $user->traveling_state = implode(',', $request->get('traveling_state', []));
        $user->traveling_city = implode(',', $request->get('traveling_city', []));
        $user->video = $request->get('video');
        $user->number = $request->get('number');
        $user->is_confirmed = $request->has('is_confirmed');
        $user->save();

        $request->session()->flash('status', 'Successfully Added');
        return redirect(route('candidates.index'));
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function getAllFestanstellung(Request $request)
    {
        return Response::json($this->getCandidates($request));
    }

    public function getAllSkills(Request $request)
    {
        $query = $request->input('query');
        if ($query != '') {
            $data = DB::table('competences')
                ->select('competences_skill.skill', 'competences_skill.competences_id')
                ->join('competences_skill', 'competences_skill.competences_id', '=', 'competences.id')
                ->where('competences_skill.skill', 'like', $request->input('query') . '%')
                ->orderBy('competences_skill.skill', 'asc')
                ->get();
            //->groupBy('competences_skill.competences_id');
            return Response::json($data);
        }
        $data = DB::table('competences')
            ->select('competences_skill.skill', 'competences_skill.competences_id')
            ->join('competences_skill', 'competences_skill.competences_id', '=', 'competences.id')
            ->orderBy('competences_skill.skill', 'asc')
            ->get();
        //->groupBy('competences_skill.competences_id');
        return Response::json($data);
    }

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function view()
    {
        $users = new user;
        $users = DB::table('users')
            ->where('user_role', '0')
            ->orderBy('id', 'asc')
            ->get();
        return view('freelancer.view', ['users' => $users]);
    }

    /**
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function editKandidate($id)
    {
        $emp_id = SESSION::get('id');
        $permission = [];
        $competences = $this->getCompetencesData();
        // $lastwork = DB::table('work_experience')->latest('id')->first();
        // $lastedu = DB::table('education')->latest('id')->first();
        $candidate_experience = DB::table('work_experience')->where('kandidate_id', $id)->get();
        $candidate_education = DB::table('education')->where('kandidate_id', $id)->get();
        $candidate = Kandidate::findOrFail($id);
        if ($emp_id != 1) {
            $permission = DB::table('emp_permission')->where('emp_id', $emp_id)->first();
        }
        $previous_count = 0;
        $next_count = 0;

        return view('kandidate.editkandidate', compact(
            'previous_count',
            'next_count',
            'candidate',
            'competences',
            'permission',
            'candidate_experience',
            'candidate_education'
        ));
    }

    /**
     * @param $id
     * @return false|string
     */
    public function delete($id)
    {
        $status = "success";
        try {
            $users = DB::table('kandidates')->where('id', $id)->delete();
            $result = "Festanstellung Data Deleted Successfully";
        } catch (QueryException $ex) {
            $status = "error";
            $result = $ex->getMessage();
        }
        return (json_encode(array('status' => $status, 'message' => $result)));
    }

    /**
     * @return array
     */
    public function getCompetencesData()
    {
        $competences = DB::table('competences')->get()->toArray();
        if (!empty($competences)) {
            $competences_array = array();
            $i = 1;
            foreach ($competences as $competences_val) {
                $competences_skill = DB::table('competences_skill')->Where('competences_id',
                    $competences_val->id)->get()->toArray();
                $competences_val->keys = $i;
                $competences_val->competences_skill = $competences_skill;
                $competences_array[] = $competences_val;
                $i++;
            }
            return $competences_array;
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function update_experience($id, Request $request){
        if($request->work_skills != null){
            $skills_with_work = implode(",", $request->get('work_skills'));
        }
        else {
            $skills_with_work = '';
        }
    
        // $skills_with_work = implode(",", $request->work_skills);
        // echo $skills_with_work;
        DB::table('work_experience')
            ->where('id', $request->currentIndex)
            ->where('kandidate_id', $id)
            ->update(['experience_sector' => $request->work_sector,
                    'experience_start' => $request->work_start,
                    'experience_end' => $request->work_end,
                    'experience_company' => $request->work_company,
                    'experience_postion' => $request->work_position,
                    'skills_with_work' => $skills_with_work,
                    'experience_description' => $request->work_description]);
        $roles = \App\Kandidate::ROLES;
        $competences = $this->getCompetencesData();
        $sectors = \App\Kandidate::WORK_EXPERIENCE_SECTORS;

        $content_experience="
        <div class='box-container'>
            <div class='hf'>
                <div class='sector'>{$sectors[$request->work_sector]}</div>                                    
                <div class='period'>{$request->work_end}</div> 
                <div class='period'>~</div> 
                <div class='period'>{$request->work_start}</div> 
            </div>
            <div class='com-name'>{$request->work_company}</div>
            <div class='exp-position'>{$roles[$request->work_position]}</div>
            <div class='prof-experience'>
                <ui class='list-style ui-margin'>";
                    foreach($competences as $competence){
                        foreach ($competence->competences_skill as $skill){
                            if(isset($request->work_skills) && in_array($skill->id, $request->work_skills)){
                                $content_experience.="<li class='li-margin'>".$skill->skill."<li>";
                            }
                        }
                    }                        
        $content_experience.="</ui>
            </div>
            <div class='prof-experience'>{$request->work_description}</div>
        </div>
        <div class='btn_place'>
            <div class='w-100'>
                <button type='button' class='btn btn-light btn-edit id_btn_edit' id='edit_btn_{$request->currentIndex}'><i class='fa fa-edit'></i></button>
            </div>
            <div class='w-100'>
                <button type='button' class='btn btn-light btn-edit id_btn_trash' id='trash_btn_{$request->currentIndex}'><i class='fa fa-trash'></i></button>
            </div>
        </div>";
        echo($content_experience);
    }
    public function update_education($id, Request $request){
        DB::table('education')
            ->where('id', $request->currentIndex)
            ->where('kandidate_id', $id)
            ->update(['graduation' => $request->edu_graduation,
                    'education_start' => $request->edu_start,
                    'education_end' => $request->edu_end,
                    'training_facility' => $request->edu_training,
                    'description' => $request->edu_description]);
        $facility = \App\Kandidate::EDUCATION_ITEMS;
        $content_experience="
            <div class='box-container'>
                <div class='hf'>
                    <div class='sector'>{$request->edu_graduation}</div>                 
                    <div class='period'>{$request->edu_end}</div> 
                    <div class='period'>~</div>
                    <div class='period'>{$request->edu_start}</div> 
                </div>
                <div class='com-name'>{$facility[$request->edu_training]}</div>
                <div class='prof-experience'>{$request->edu_description}</div>
            </div>
            <div class='btn_place'>
                <div class='w-100'>
                    <button type='button' class='btn btn-light btn-edit id_btn_edit_edu' id='edit_btn_{$request->currentIndex}'><i class='fa fa-edit'></i></button>
                </div>
                <div class='w-100'>
                    <button type='button' class='btn btn-light btn-edit id_btn_trash_edu' id='trash_btn_{$request->currentIndex}'><i class='fa fa-trash'></i></button>
                </div>
            </div>";
        echo($content_experience);
    }
    public function delete_experience($id, Request $request){
        DB::table('work_experience')->where('id', $request->currentIndex)->delete();
        echo "";
    }

    public function delete_education($id, Request $request){
        DB::table('education')->where('id', $request->currentIndex)->delete();
        echo "";
    }
    public function add_experience($id, Request $request){
        // print_r($request->all()); exit();
        if($request->get('category_skillers') != null){
            $skills_with_work = implode(",", $request->get('category_skillers'));
        }
        else {
            $skills_with_work = '';
        }
        // echo $skills_with_work; exit();
        DB::table('work_experience')->insert(['kandidate_id' => $id,
                                    'experience_sector' => $request->get('work_exp_sector'),
                                    'experience_start' => $request->get('work_start'),
                                    'experience_end'=> $request->get('work_end'),
                                    'experience_company'=> $request->get('work_exp_company_name'),
                                    'experience_postion'=> $request->get('work_exp_position'),
                                    'skills_with_work' => $skills_with_work,
                                    'experience_description'=> $request->get('work_exp_pos_description')]);
        return redirect('/admin/kandidaten/'.$id.'/edit');
    }
    public function add_education($id, Request $request){
        DB::table('education')->insert(['kandidate_id' => $id,
                                    'graduation' => $request->get('education_graduation'),
                                    'training_facility' => $request->get('edu_traning'),
                                    'education_start'=> $request->get('edu_start'),
                                    'education_end'=> $request->get('edu_end'),
                                    'description'=> $request->get('edu_description')]);
        return redirect('/admin/kandidaten/'.$id.'/edit');
    }
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'number' => 'required|unique:kandidates,number,'.$id
        ]);

        $user = Kandidate::findOrFail($id);
        $user->title = '';

        $user->education = implode(',', $request->get('education', []));
        $user->work_experience_sector = $request->get('work_experience_sector');
        $user->work_experience_period = $request->get('work_experience_period');
        $user->work_experience_company_name = $request->get('work_experience_company_name');
        $user->work_experience_position = $request->get('work_experience_position');
        $user->work_experience_position_description = $request->get('work_experience_position_description');
        $user->first_name = $request->get('first_name');
        $user->optional_interview = $request->get('optional_interview');
        $user->last_name = '';
        $user->Mobile = '';
        $user->home_number = '';
        $user->password = bcrypt(time());
        $availability_date = '';
        $category_skills = '';
        $travelling = '';
        $hourly_rate = '';
        $freelancer_roles = '';
        $availabile_days = '';
        $availabile_days_en = '';
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
        if ($request->has(['availabile_days_en'])) {
            $availabile_days_en = implode(",", $request->input('availabile_days_en'));
        }
        if ($request->has(['can_travel_to_germany'])) {
            $travelling = implode(",", $request->input('can_travel_to_germany'));
        }
        if ($request->has(['category_skills'])) {
            $category_skills = implode(",", $request->input('category_skills'));
        }
        if ($request->has(['freelancer_source'])) {
            $freelancer_source = implode(",", $request->input('freelancer_source'));
        }
        $hourly_rate_other_input = '';
        if ($request->has(['hourly_rate_other_input'])) {
            $hourly_rate_other_input = $request->input('hourly_rate_other_input');
        }
        $freelancer_roles_other_input = '';
        if ($request->has(['freelancer_roles_other_input'])) {
            $freelancer_roles_other_input = $request->input('freelancer_roles_other_input');
        }

        $user->reference = $request->input('reference');
        if($request->file('attached_cv')) {
            \File::delete($user->attached_cv);
            $user->attached_cv = $request->file('attached_cv')->store('cv');
        }
        if($request->file('picture')) {
            \File::delete($user->picture);
            $user->picture = $request->file('picture')->store('picture');
        }
        $user->client_name = $request->input('client_name');
        $user->manager_name = $request->input('manager_name');
        $user->reference_mobile = $request->input('reference_mobile');
        $user->info_field = $request->input('info_field');
        $user->hourly_rate = $hourly_rate;
        $user->role_definition = $freelancer_roles;
        $user->availability = $request->input('part_or_full_time');
        $user->availability_date = $availability_date;
        $user->availability_per_week = $availabile_days;
        $user->availability_per_week_en = $availabile_days_en;
        $user->travelling = $travelling;
        $user->possible_extension = $request->input('possible_extension');
        $user->extension_text = $request->input('extension_text');
        $user->other_interview = $request->input('other_interview');
        $user->comment_area_text = $request->input('comment_area_text');
        $user->source = $freelancer_source;
        $user->category_skills = $category_skills;
        $user->general_notes = $request->input('general_notes');
        $user->core_competences = $core_competences;
        $user->traveling_state = implode(',', $request->get('traveling_state', []));
        $user->traveling_city = implode(',', $request->get('traveling_city', []));
        $user->video = $request->get('video');
        $user->number = $request->get('number');
        $user->is_confirmed = $request->has('is_confirmed');
        $user->save();

        $request->session()->flash('status', 'Successfully Updated');
        return redirect(route('candidates.index'));
    }

    /**
     * @param $id
     * @param $list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editFestanstellung($id, $list)
    {
        $permission = [];
        $competences = $this->getCompetencesData();

        $candidate = Kandidate::findOrFail($id);

        $next = DB::table('kandidates')
            ->select('kandidates.id', 'first_name', 'last_name')
            ->where('kandidates.id', '>', $id)->first();
        $next_count = DB::table('kandidates')
            ->select('id')
            ->where('id', '>', $id)->count();

        $previous = DB::table('kandidates')
            ->select('kandidates.id', 'first_name', 'last_name')
            ->orderBy('kandidates.id', 'desc')
            ->where('kandidates.id', '<', $id)->first();

        $previous_count = DB::table('kandidates')
            ->select('id')
            ->where('id', '<', $id)->count();

        if (!currentUser()->isAdmin) {
            $permission = currentUser()->employeePermission;
        }
        return view('kandidate.editkandidate', [
            'candidate' => $candidate,
            'competences' => $competences,
            'permission' => $permission,
            'next' => $next,
            'next_count' => $next_count,
            'previous' => $previous,
            'previous_count' => $previous_count,
            'list' => $list
        ]);
    }

    public function openMailPanel(Request $request)
    {

        $id = explode(',', $request->festanstellung_id);

        $festanstellung = $request->festanstellung_id;
        $festanstellung_data = Kandidate::where('id', $festanstellung)->first();
        $title_for_display = "Hallo " . $festanstellung_data->title . ' ' . $festanstellung_data->last_name;
        $title = $title_for_display;

        //$title = '"Hallo ';


        $users_data = DB::table('kandidates')->select('email', 'first_name', 'last_name')->whereIn('id', $id)->get();
        // print_r($users_data);die;
        return view('kandidate.send_mail_panel',
            ['users_data' => $users_data, 'title' => $title, 'festanstellung' => $festanstellung]);
        // dd($id);
    }

    public function sendMail(Request $request)
    {


        $status = 'success';
        $value = explode(',', $request->freelancer_id);
        $body = $request->freelancer_mail_body;

        $users = DB::table('kandidates')->select('id', 'email', 'first_name', 'last_name',
            DB::Raw(" IFNULL( `title`, '' ) as u_title"))->whereIn('id', $value)->get();

        $data = array();
        $subject = $request->freelancer_mail_sub;

        foreach ($users as $value) {

            $body = str_replace("((Name))", $value->u_title . ' ' . $value->first_name . ' ' . $value->last_name . ', ',
                $body);

            $data['email'] = $value->email;
            $data['subject'] = $subject;

            Mail::send('mail.mail_template', ['data' => $data, 'content' => $body], function ($message) use ($data) {
                $message->from('avinashmishra.vll@gmail.com', 'Argon Strategy');

                $message->to($data['email']);

                $message->subject($data['subject']);
            });
        }
        return (json_encode(array('status' => $status, 'message' => 'Email Send Successfully')));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function passwordChange(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'new_password' => [
                'required',
                'min:12',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
                'confirmed'
            ]
        ]);

        if(Hash::check($request->get('password'), Auth::user()->password)){
            currentUser()->password = Hash::make($request->get('new_password'));
            currentUser()->save();

            return response()->json([
                'success' => true
            ]);
        }

        return response(['password' => ['Old password does not match'],], \Symfony\Component\HttpFoundation\Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function activate(Request $request, $id)
    {
        $candidate = Kandidate::findOrFail($id);

        $candidate->is_active = 1;
        $candidate->save();

        $request->session()->flash('status', 'Kandidate was activated');
        return redirect(route('candidates.index'));
    }

    public function deactivate(Request $request, $id)
    {
        $candidate = Kandidate::findOrFail($id);

        $candidate->is_active = 0;
        $candidate->save();

        $request->session()->flash('status', 'Kandidate was deactivated');
        return redirect(route('candidates.index'));
    }

    public function invite()
    {
        if (!Auth::user()->isAdmin) {
            abort(404);
        }
        return view('kandidate.invite');
    }

    public function sendInvite(Request $request)
    {
        if (!Auth::user()->isAdmin) {
            abort(404);
        }

        $this->validate($request, [
            'email' => 'required|email|unique:candidates_invites,email'
        ]);

        $invite = new CandidateInvite();
        $invite->email = $request->get('email');
        $invite->invitation_code = Str::random(35);
        $invite->created_at = Carbon::now();
        $invite->sent_at = Carbon::now();
        $invite->save();

        $inviteLink = route('candidate.public_form', $invite->invitation_code);

        Mail::send('mail.invite', compact('inviteLink'), function ($message) use($invite) {
            $message->to($invite->email);
            $message->subject('Invitation to join kandidaten.org');
        });

        $request->session()->flash('status', 'Successfully Invited');
        return redirect()->to(route('candidates.index'));
    }
}