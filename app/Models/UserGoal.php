<?php
/**
 * Created by PhpStorm.
 * User: sacram
 * Date: 17.11.2018
 * Time: 7:58
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserGoal
 * @package App\Models
 */
class UserGoal extends Model
{
    protected $table = 'goal_setby_users';

    protected $fillable = ['set_by', 'client_activity', 'client_add', 'candidate_add', 'oppo_add'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'set_by');
    }
}