<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Task
 * @package App\Models
 * @version September 6, 2020, 11:44 pm UTC
 *
 * @property string task
 * @property string summary
 * @property integer created_by
 */
class Task extends Model
{
    use SoftDeletes;

    public $table = 'tasks';
    

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $fillable = [
        'task',
        'summary',
        'created_by',
        'classroom_id',
        'point',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'task' => 'string',
        'summary' => 'string',
        'created_by' => 'integer',
        'classroom_id' => 'integer',
        'point' => 'integer'
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
        return $this->hasMany('App\Models\TaskQuestion', 'task_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Member', 'created_by');
    }
    
    public function classroom()
    {
        return $this->hasOne('App\Models\Classroom', 'id', 'classroom_id');
    }

    public function membertask()
    {
        return $this->hasOne('App\Models\MemberTask', 'task_id');
    }
}
