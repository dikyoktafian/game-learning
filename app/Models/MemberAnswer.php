<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MemberAnswer
 * @package App\Models
 * @version September 6, 2020, 11:57 pm UTC
 *
 * @property integer member_id
 * @property integer task_id
 * @property integer question_id
 * @property integer answer_id
 */
class MemberAnswer extends Model
{
    use SoftDeletes;

    public $table = 'member_answers';
    

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // protected $with = ['correct:id,question_id,correct'];

    public $fillable = [
        'member_task_id',
        'question_id',
        'answer_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'member_task_id' => 'integer',
        'question_id' => 'integer',
        'answer_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function correct()
    {
        return $this->hasOne('App\Models\TaskAnswer', 'id', 'answer_id');
    }
    
    public function taskquest()
    {
        return $this->hasOne('App\Models\TaskQuestion', 'id', 'question_id');
    }
    
}
