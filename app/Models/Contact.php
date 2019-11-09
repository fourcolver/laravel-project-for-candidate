<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * @package App\Models
 */
class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','account_id','job_tilte', 'departement','phone','mobile','email_id','notes','decision_maker','hold','city','pincode','country',
    ];
}
