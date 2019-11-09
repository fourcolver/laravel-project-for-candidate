<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documnets extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'documents';
    protected $fillable = [
        'documents_name','uploaded_by','type','path'
    ];
}
