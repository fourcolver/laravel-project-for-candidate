<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Countries
 * @package App
 */
class AccountList extends Model
{
    protected $table = 'account_list';

    protected $dates = ['last_contact'];

    protected $dateFormat = 'd-m-Y';

    public $timestamps = false;

    protected $with = ['user'];

    /**
     * @param Builder $builder
     * @param User $user
     * @return Builder
     */
    public function scopeAddedBy(Builder $builder, User $user)
    {
        return $builder->where('added_by', $user->id);
    }

    /**
     * @param User $user
     * @return AccountList[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function forUser(User $user)
    {
        return !$user->isAdmin && !in_array('all', explode(',', $user->permissions->kunden_permission))
            ? static::addedBy($user)->get()
            : static::all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    /**
     * @return string
     */
    public function getCodeAttribute()
    {
        return static::makeCode($this->id);
    }

    /**
     * @param $id
     * @return string
     */
    public static function makeCode($id)
    {
        return 'account_list_view_' . $id;
    }
}