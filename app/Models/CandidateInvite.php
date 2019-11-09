<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateInvite extends Model
{
    protected $table = 'candidates_invites';

    protected $fillable = ['email', 'invite_code', 'created_at', 'sent_at', 'used_at'];

    protected $dates = ['created_at', 'sent_at', 'used_at'];

    public $timestamps = false;
}