<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CompetenceSkill
 * @package App
 */
class CompetenceSkill extends Model
{
    protected $table = 'competences_skill';

    protected $fillable = ['competences_id', 'skill'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competence()
    {
        return $this->belongsTo(Competence::class, 'competences_id');
    }
}
