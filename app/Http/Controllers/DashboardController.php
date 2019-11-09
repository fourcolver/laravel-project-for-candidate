<?php

namespace App\Http\Controllers;

use App\Models\UserGoal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Task;
use App\Accounts;
use App\Contacts;
use App\Opportunity;
use Mail;
use App\Skills;
use DB;
use Session;
use Response;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Check if Authorise user as admin then redirect to Admin Dashboard
     *
     * @param  array $data
     * @return User
     */
    public function index()
    {
        $user = currentUser();
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

            $pendingTask = new task;
            $pendingTask = $pendingTask
                ->join('accounts', 'accounts.id', '=', 'task.account_id')
                ->select(DB::raw('DATE_FORMAT(task_date, "%d-%m-%Y") as task_date'), 'task.id as id',
                    'task.priority', 'task.task_status', 'task.description', 'task.task_owner',
                    'accounts.id as account_id', 'accounts.account_name',
                    'accounts.account_status as account_status')
                ->orderBy('id', 'asc')
                ->where('task.task_status', '!=', 'Completed')->where('task.task_owner', $user->id);

            $comment = DB::table('user_todolist')->where('user_id', $user->id)->first();
            $emp_users = User::select('id', 'first_name', 'last_name')->where('user_role', '2')->get();
            if (!$user->isAdmin) {
                $permission = DB::table('emp_permission')->where('emp_id', $user->id)->first();
                $task_role = explode(',', $permission->task_permission);
                if (in_array('all', $task_role)) {
                    $pendingTask = $pendingTask->where('accounts.added_by', $user->id);
                }

            }
            $pendingTask = $pendingTask->get();
            $pendingtask = $pendingTask;
            return view('dashboard', compact('pendingtask', 'goal_set', 'events_view', 'permission', 'comment', 'emp_users'));
        } else {
            \Session::put('profile_img', $user->user_profile);
            \Session::put('freelancer_id', $user->id);
            \Session::put('freelancer_name', $user->first_name);
            $competences = $this->getCompetencesData();
            $details = $user->skills;
            $view = $details->count() ? 'edit_competence' : 'freelancer';

            return view($view, compact('details', 'competences'));
        }
    }

    /**
     * @return array
     */
    private function getCompetencesData()
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
     * @param Request $request
     * @return string
     */
    public function updateInfo(Request $request)
    {
        $user = Auth::user();
        $comment = $request->input('comment');
        $data = array(
            'comments' => $comment,
            'user_id' => $user->id,
        );
        if (DB::table('user_todolist')->where('user_id', '=', $user->id)->exists()) {
            $query = DB::table('user_todolist')->where('user_id', $user->id)->update($data);
            return 'success';
        } else {
            $query = DB::table('user_todolist')->insert($data);
            return 'success';
        }

    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function addEvents(Request $request)
    {
        $status = "success";
        try {
            $user = Auth::user();
            $event_date = date("Y-m-d", strtotime($request->input('event_date')));
            $data = array(
                'user_id' => $user->id,
                'task_date' => $event_date,
                'task_type' => $request->input('event_title'),
                'task_status' => $request->input('event_description'),
            );
            $query = DB::table('calendar_events')->insert($data);
            $result = "Event Added Successfully";
        } catch (QueryException $ex) {
            dd($ex->getMessage());
            $status = "error";
            $result = $ex->getMessage();
        }
        return (json_encode(array('status' => $status, 'message' => $result)));
    }

    public function profileUpdate(Request $request)
    {
        $id = Auth::id();
        if ($request->hasFile('attach_pic')) {
            $attach_pic = $request->file('attach_pic');
            $name = $attach_pic->getClientOriginalName();
            $type = $attach_pic->getClientOriginalExtension();
            $allowed = array('png', 'jpg', 'jpeg');
            if (!in_array($type, $allowed)) {
                return redirect('/dashboard')->with('image_error', 'Extension of Upload Image Not Allowed');
            }
            $size = $attach_pic->getClientSize();
            if ($size > 2097152) {
                return redirect('/dashboard')->with('image_error', 'Please Upload Image Size less then 2 MB ');
            }
            $save = $attach_pic->storeAs('Users/profile', $name);
            $path_url = storage_path('app/') . $save;

            $data = array(
                'user_profile' => $name,
            );
            $users = DB::table('users')
                ->where('id', $id)
                ->update($data);
            if ($users) {
                return redirect('/dashboard')->with('image_success', 'Profile Picture Updated Successfully');
            } else {
                return redirect('/dashboard')->with('cv_message', 'Some Error Please Upload Once Again');
            }
        } else {
            return redirect('/dashboard')->with('image_error', 'Some Error Please Upload Once Again');
        }

    }

    /**
     * @return mixed
     */
    public function getAllGaugeDetails()
    {
        $user = currentUser();
        $currentMonth = date('m');
        $data['client_activities'] = $user->accountLog()->forMonth($currentMonth)->count();
        $data['client_added'] = DB::table('accounts')
            ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->where('added_by', $user->id)
            ->count();
        $data['candidate_added'] = DB::table('users')
            ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->where('user_role', '0')
            ->where('added_by', $user->id)
            ->count();
        $data['opportunity_added'] = DB::table('opportunity')
            ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->where('added_by', $user->id)
            ->count();
        if (!$user->isAdmin) {
            $data['client_activities'] = DB::table('account_log')
                ->whereRaw('MONTH(timestamp) = ?', [$currentMonth])
                ->where('user_id', $user->id)
                ->count();
            $data['client_added'] = DB::table('accounts')
                ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
                ->where('added_by', $user->id)
                ->count();

            $data['candidate_added'] = DB::table('users')
                ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
                ->where('added_by', $user->id)
                ->count();

            $data['opportunity_added'] = DB::table('opportunity')
                ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
                ->where('added_by', $user->id)
                ->count();
        }
        return Response::json($data);

    }

    /**
     * @return mixed
     */
    public function getAllEmployeeGoals()
    {
        $emp_users = User::select('id')->where('user_role', '2')->get();
        $emp_users = $emp_users->map(function ($value) {
            $data['id'] = $value->id;
            $currentMonth = date('m');
            $goal = UserGoal::where('set_by', $value->id)->first();
            $data['client_activity_max'] = $goal && $goal->client_activity ? $goal->client_activity : 50;
            $data['client_added_max'] = $goal && $goal->client_add ? $goal->client_add : 50;
            $data['candidate_added_max'] = $goal && $goal->candidate_add ? $goal->candidate_add : 50;
            $data['opportunity_added_max'] = $goal && $goal->opportunity_add ? $goal->opportunity_add : 50;
            $data['client_activities'] = DB::table('account_log')
                ->whereRaw('MONTH(timestamp) = ?', [$currentMonth])
                ->where('user_id', $value->id)
                ->count();
            $data['client_added'] = DB::table('accounts')
                ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
                ->where('added_by', $value->id)
                ->count();
            $data['candidate_added'] = DB::table('users')
                ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
                ->where('user_role', '0')
                ->where('added_by', $value->id)
                ->count();
            $data['opportunity_added'] = DB::table('opportunity')
                ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
                ->where('added_by', $value->id)
                ->count();
            return $data;
        });
        $emp_users->all();
        return Response::json($emp_users);

    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function setGoal(Request $request)
    {
        $status = "success";
        /** @var User $user */
        $user = User::findOrFail($request->input('goal_by'));
        if(!$goal = $user->goal) {
            $goal = $user->goal()->create([]);
        }

        $goal->update([
            'client_activity' => $request->input('client_activity', $request->input('emp_client_activity')),
            'client_add' => $request->input('client_add', $request->input('emp_client_add')),
            'candidate_add' => $request->input('candidate_add', $request->input('emp_candidate_add')),
            'oppo_add' => $request->input('oppo_add', $request->input('emp_oppo_add')),
        ]);
        $result = "Goal Inserted Successfully";
        return json_encode(['status' => $status,'message' => $result]);
    }

    public function getGoals(Request $request)
    {
        $id = $request->input('id');
        $data = DB::table('goal_setby_users')->where('set_by', $id)->first();
        return Response::json($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quickSearch(Request $request)
    {
        $query = $request->get('query');

        $users = User::query()
            ->select('users.id', 'users.first_name', 'users.last_name', 'skills.id as skill_id')
            ->leftjoin('skills', 'skills.user_id', '=', 'users.id')
            ->where('users.user_role', '0')
            ->when(!empty($query), function(Builder $builder) use($query) {
                return $builder->where(function($builder) use($query) {
                    return $builder
                        ->orWhere('users.first_name', 'like', $query . '%')
                        ->orWhere('users.last_name', 'like', $query . '%');
                });
            })
            ->get();

        $accounts = Accounts::query()
            ->select('id', 'account_name')
            ->when(!empty($query), function(Builder $builder) use($query) {
                return $builder->where('account_name', 'like', $query . '%');
            })
            ->get();

        $contacts = Contacts::query()
            ->select('contacts.id', 'first_name', 'last_name', 'account_id', 'account_name')
            ->join('accounts', 'accounts.id', '=', 'contacts.account_id')
            ->when(!empty($query), function(Builder $builder) use($query) {
                return $builder
                    ->orWhere('contacts.first_name', 'like', $query . '%')
                    ->orWhere('contacts.last_name', 'like', $query . '%');
            })
            ->get();

        $opportunities = Opportunity::query()
            ->select('id', 'name')
            ->when(!empty($query), function(Builder $builder) use($query) {
                return $builder->where('name', 'like', $query . '%');
            })
            ->get();

        return view('search', compact('accounts', 'contacts', 'opportunities', 'users'));
    }
}