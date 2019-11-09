<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Opportunity
 * @package App
 */
class Opportunity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'opportunity';
    protected $fillable = [
        'name','account_id','close_date','status','next_step', 'forecast','probability','repeat_order','report','source','hotness','client_name','client_number','technology','info_field','description',
    ];

    /**
     * @param Builder $builder
     * @param integer $month
     * @return Builder
     */
    public function scopeForMonth(Builder $builder, $month)
    {
        return $builder->whereRaw('MONTH(created_at) = ?', [$month]);
    }
}
