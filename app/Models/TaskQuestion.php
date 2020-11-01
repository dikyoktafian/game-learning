<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TaskQuestion
 * @package App\Models
 * @version September 6, 2020, 11:54 pm UTC
 *
 * @property integer task_id
 * @property string image
 * @property string attach
 * @property string question
 */
class TaskQuestion extends Model
{
    use SoftDeletes;

    public $table = 'task_questions';
    

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $fillable = [
        'task_id',
        'image',
        'attach',
        'question',
        'point',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'task_id' => 'integer',
        'image' => 'string',
        'attach' => 'string',
        'question' => 'string',
        'point' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function task()
    {
        return $this->belongsTo('App\Models\Task', 'id');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\TaskAnswer', 'question_id');
    }

    public function memberanswer()
    {
        return $this->hasOne('App\Models\MemberAnswer', 'question_id');
    }


}
