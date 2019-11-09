<?php

namespace App;

use App\Models\Account;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\OpportunityList;
use App\Models\Skill;
use App\Models\UserGoal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

/**
 * Class User
 * @package App
 * @property boolean $isFreelancer
 * @property boolean $isAdmin
 * @property boolean $isEmployee
 * @property boolean $fullName
 * @property EmployeePermission $permissions
 */
class User extends Authenticatable
{
    use Notifiable;

    const FREELANCE_ROLE = 0;
    const ADMIN_ROLE = 1;
    const EMPLOYEE_ROLE = 2;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','middle_name','last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return bool
     */
    public function getIsFreelancerAttribute()
    {
        return $this->user_role == static::FREELANCE_ROLE;
    }

    /**
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->user_role == static::ADMIN_ROLE;
    }

    /**
     * @return bool
     */
    public function getIsEmployeeAttribute()
    {
        return $this->user_role == static::EMPLOYEE_ROLE;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountLog()
    {
        return $this->hasMany(AccountLog::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountLists()
    {
        return $this->hasMany(AccountList::class, 'added_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts()
    {
        return $this->hasMany(Account::class, 'added_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'added_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opportunityLists()
    {
        return $this->hasMany(OpportunityList::class, 'added_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'added_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_owner');
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeIsEmployee(Builder $builder)
    {
        return $builder->where('user_role', static::EMPLOYEE_ROLE);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeIsAdmin(Builder $builder)
    {
        return $builder->where('user_role', static::ADMIN_ROLE);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeIsFreelancer(Builder $builder)
    {
        return $builder->where('user_role', e(static::FREELANCE_ROLE));
    }

    /**
     * @param Builder $builder
     * @param Carbon $availableDate
     * @return Builder
     */
    public function scopeWillBeAvailableFrom(Builder $builder, Carbon $availableDate)
    {
        return $builder->whereHas('skills', function($builder) use($availableDate) {
            return $builder->where('availability_date', $availableDate->toDateString());
        });
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeIsActive(Builder $builder)
    {
        return $builder->where('status', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employeePermission()
    {
        return $this->hasOne(EmployeePermission::class, 'emp_id');
    }

    /**
     * @return EmployeePermission
     */
    public function getPermissionsAttribute()
    {
        return $this->employeePermission ?? new EmployeePermission();
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function candidates()
    {
        return $this->hasMany(User::class, 'added_by');
    }

    /**
     * @param Builder $builder
     * @param integer $month
     * @return Builder
     */
    public function scopeForMonth(Builder $builder, $month)
    {
        return $builder->whereRaw('MONTH(created_at) = ?', [$month]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function goal()
    {
        return $this->hasOne(UserGoal::class, 'set_by');
    }
}