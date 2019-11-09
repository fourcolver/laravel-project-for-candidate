<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class Experience extends Model
{
    public $table = 'work_experience';
}
class Kandidate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "kandidates";

    const HOURLY_RATES = [
        //            "1" => "20.000 EUR - 30.000 EUR",
        "2" => "30.000 EUR - 40.000 EUR",
        "3" => "40.000 EUR - 50.000 EUR",
        "4" => "50.000 EUR - 60.000 EUR",
        "5" => "60.000 EUR - 70.000 EUR",
        "6" => "70.000 EUR - 80.000 EUR",
        "7" => "80.000 EUR - 90.000 EUR",
        "8" => "90.000 EUR - 100.000 EUR",
        "9" => "100.000 EUR - 110.000 EUR",
        "10" => "110.000 EUR - 120.000 EUR",
        "11" => "120.000 EUR +"
    ];

    const HOURLY_RATES_SHORT = [
        1 => '20-30K',
        2 => '30-40K',
        3 => '40-50K',
        4 => '50-60K',
        5 => '60-70K',
        6 => '70-80K',
        7 => '80-90K',
        8 => '90-100K',
        9 => '100-110K',
        10 => '110-120K',
        11 => '120+K'
    ];

    const ROLES = [
        "1" => "Entwickler",
        "2" => "Architekt",
        "3" => "Support",
        "4" => "Projektmanager",
        "5" => "Berater",
        "6" => "Administrator",
        "7" => "SCRUM Master",
        "8" => "Tester",
        "9" => "Test Manager",
        "10" => "Hardware Entwickler",
        "11" => "Web Developer",
        "12" => "Security",
        "13" => "Frontend",
        "14" => "Backend"
    ];

    const EDUCATION_ITEMS = [
        'Bachelor',
        'Master',
        'Diplom',
        'Doktor',
        'Fachhochschule',
        'Ausbildung',
        'Fortbildung'
    ];

    const WORK_EXPERIENCE_SECTORS = [
        '' => '',
        'Automobilindustrie',
        'Baugewerbe',
        'Bergbau',
        'Biotechnologie',
        'Chemische Stoffe',
        'Dienstleistungsbranche',
        'Elektrische Geräte',
        'Energieversorgung',
        'Energiewirtschaft',
        'Erziehung und Unterricht',
        'Finanz- und Versicherungsdienstleister',
        'Gesundheits- und Sozialwesen',
        'Grundstücks- und Wohnungswesen',
        'Handel',
        'Hotel und Gastronomie',
        'IT-Branche',
        'Kosmetika',
        'Kunst, Unterhaltung und Erholung',
        'Land- und Forstwirtschaft, Fischerei',
        'Lebensmittelindustrie',
        'Logistikbranche',
        'Luft- und Raumfahrt',
        'Medizintechnik',
        'Pharmabranche',
        'Öffentliche Verwaltung',
        'Schiffbau und Meerestechnik',
        'Spielzeugbranche',
        'Telekommunikationsbranche',
        'Textil- und Bekleidungsbranche',
        'Verkehr und Lagerei',
        'Wasser, Abwasser und Entsorgung',
    ];

    const LINGUISTIC_PROFICIENCY = ['', 'A1', 'A2', 'B1', 'B2', 'C1', 'C2'];

    const POSSIBLE_LOCATIONS = ['', 'Weltweit', 'Europaweit', 'Deutschlandweit', 'Bundesland', 'Stadt'];

    public function getRolesAttribute()
    {
        return collect(explode(',', $this->role_definition))->filter(function($i) { return is_numeric($i);})->map(function($roleId) {
            return static::ROLES[$roleId];
        });
    }

    public function getSalaryExpectationsAttribute()
    {
        return collect(explode(',', $this->hourly_rate))->filter(function($i) { return is_numeric($i);})->map(function($hourlyRateId) {
            return static::HOURLY_RATES_SHORT[$hourlyRateId];
        });
    }

    public function getLinguisticProficiencyAttribute()
    {
        return collect(explode(',', $this->availability_per_week))->filter(function($i) { return is_numeric($i);})->map(function($item) {
            return static::LINGUISTIC_PROFICIENCY[$item];
        });
    }

    public function getSkillsAttribute()
    {
        $skills = \DB::table('competences_skill')->select('id', 'skill')->get()->keyBy('id');
        return collect(explode(',', $this->category_skills))->filter(function($i) { return is_numeric($i);})->map(function($skillId) use($skills) {
            return $skills[$skillId]->skill;
        });
    }

    public function getCompetencesAttribute()
    {
        $skills = \DB::table('competences_skill')->select('id', 'skill')->get()->keyBy('id');
        return collect(explode(',', $this->category_skills))->filter(function($i) { return is_numeric($i);})->map(function($skillId) use($skills) {
            return $skills[$skillId]->skill;
        });
    }

    public function getPossibleLocationAttribute()
    {
        $candidate = $this;
        return collect(explode(',', $this->travelling))->filter(function($i) { return is_numeric($i);})->map(function($location) use($candidate) {
            $appendix = '';
            if($location == 4 && !empty($candidate['traveling_state'])) {
                $appendix = " - {$candidate['traveling_state']}";
            } elseif($location == 5 && !empty($candidate['traveling_city'])) {
                $appendix = " - {$candidate['traveling_city']}";
            }
            return Kandidate::POSSIBLE_LOCATIONS[$location] . $appendix;
        });
    }

    public function getLinguisticProficiencyEnAttribute()
    {
        $candidate = $this;
        return collect(explode(',', $candidate['availability_per_week_en']))->filter(function($i) { return is_numeric($i);})->map(function($item) {
            return Kandidate::LINGUISTIC_PROFICIENCY[$item];
        });
    }

    public function getEducationListAttribute()
    {
        $candidate = $this;
        return collect(explode(',', $candidate['education']))->filter(function($i) { return is_numeric($i);})->map(function($item) {
            return Kandidate::EDUCATION_ITEMS[$item];
        });
    }
}
