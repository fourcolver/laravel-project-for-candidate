<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AccountLog
 * @package App
 */
class AccountLog extends Model
{
    public $table = 'account_log';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder $builder
     * @param integer $month
     * @return Builder
     */
    public function scopeForMonth(Builder $builder, $month)
    {
        return $builder->whereRaw('MONTH(timestamp) = ?', [$month]);
    }
}
