<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Countries
 * @package App
 */
class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'code','name','default_country',
    ];
}
