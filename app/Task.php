<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const STATUS_COMPLETED = 'Completed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'task';
    protected $fillable = [
        'account_id','task_date','priority','task_status', 'task_type','task_owner','description','status',
    ];

    /**
     * @param User $user
     * @return mixed
     */
    public static function pendingForUser(User $user)
    {
        return static::query()
            ->join('accounts', 'accounts.id', '=', 'task.account_id')
            ->select(DB::raw('DATE_FORMAT(task_date, "%d-%m-%Y") as task_date'), 'task.id as id',
                'task.priority', 'task.task_status', 'task.description', 'task.task_owner',
                'accounts.id as account_id', 'accounts.account_name',
                'accounts.account_status as account_status')
            ->orderBy('id', 'asc')
            ->notCompleted()
            ->forUser($user);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeNotCompleted(Builder $builder)
    {
        return $builder->where('task.task_status', '!=', static::STATUS_COMPLETED);
    }

    /**
     * @param Builder $builder
     * @param User $user
     * @return Builder
     */
    public function scopeForUser(Builder $builder, User $user)
    {
        return $builder->where('task.task_owner', $user->id);
    }
}
