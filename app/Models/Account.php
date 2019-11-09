<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Accounts
 * @package App
 */
class Account extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'account_name',
        'prozesse',
        'city',
        'pincode',
        'country',
        'freelancers',
        'Technology',
        'last_time_contact',
        'note',
        'client_specification',
        'owner',
        'source',
        'sub_lable',
        'telephone',
        'comments',
        'decision_maker',
        'departement_size',
        'job_outcome',
    ];

    /**
     * @param Builder $builder
     * @param integer $month
     * @return Builder
     */
    public function scopeForMonth(Builder $builder, $month)
    {
        return $builder->whereRaw('MONTH(created_at) = ?', [$month]);
    }
}