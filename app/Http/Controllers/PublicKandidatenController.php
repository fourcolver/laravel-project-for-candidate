<?php


namespace App\Http\Controllers;

use App\Kandidate;
use App\Models\CandidateInvite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicKandidatenController extends Controller
{
    public function join($code)
    {
        $candidateInvite = CandidateInvite::where('invitation_code', $code)
            ->whereNull('used_at')
            ->first();

        if(!$candidateInvite) {
            abort(404);
        }

        $permission = [];
        $competences = $this->getCompetencesData();
        $candidate = new Kandidate();
        return view('kandidate.join', compact('permission', 'competences', 'candidate'));
    }

    public function postJoin(Request $request, $code)
    {
        $candidateInvite = CandidateInvite::where('invitation_code', $code)
            ->whereNull('used_at')
            ->first();

        if(!$candidateInvite) {
            abort(404);
        }

        $candidateInvite->used_at = Carbon::now();
        $candidateInvite->save();

        $number = DB::table('kandidates')
            ->select(DB::raw('max(number) + 1 AS maxNumber'))
            ->first()
            ->maxNumber;

        $user = new Kandidate;
        $user->title = '';
        $user->first_name = '';
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
        $user->number = $number;
        $user->is_confirmed = 0;
        $user->save();

        return redirect('/kandidaten/join-success');
    }

    public function joinSuccess()
    {
        return view('kandidate.join_success');
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
}