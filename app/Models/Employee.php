<?php

namespace App\Models;

use App\Task;
use App\User;
use Illuminate\Support\Facades\DB;

/**
 * Class Employee
 * @package App
 */
class Employee extends User
{
    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        $id = $this->id;

        if (DB::table('goal_setby_users')->where('set_by',$id)->exists()) {
            DB::table('goal_setby_users')
                ->where('set_by', $id)
                ->delete();
        }

        $this->employeePermission()->delete();
        $this->accountLists()->delete();
        $this->accountLists()->delete();
        $this->comments()->delete();
        Task::whereIn('account_id', $this->accounts->pluck('id'))->delete();
        $this->accounts()->delete();
        $this->contacts()->delete();
        $this->opportunityLists()->delete();
        $this->opportunities()->delete();
        $this->tasks()->delete();
        return parent::delete();
    }
}
