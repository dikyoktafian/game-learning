<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TaskAnswer
 * @package App\Models
 * @version September 6, 2020, 11:55 pm UTC
 *
 * @property integer question_id
 * @property string answer
 * @property string label
 */
class TaskAnswer extends Model
{
    use SoftDeletes;

    public $table = 'task_answers';
    

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    // protected $with = ['question_id', 'correct'];

    public $fillable = [
        'question_id',
        'answer',
        'label',
        'correct',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question_id' => 'integer',
        'answer' => 'string',
        'label' => 'string',
        'correct' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\TaskQuestion', 'question_id');
    }
}
