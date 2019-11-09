<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeePermission
 * @package App
 */
class EmployeePermission extends Model
{
    protected $table = 'emp_permission';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
}
