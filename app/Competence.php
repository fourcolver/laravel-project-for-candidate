<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    public function skills()
    {
        return $this->hasMany(CompetenceSkill::class, 'competences_id');
    }

    /**
     * @return mixed
     */
    public function getCompetencesSkillAttribute()
    {
        return $this->skills;
    }
}
