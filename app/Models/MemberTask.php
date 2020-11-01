<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MemberTask
 * @package App\Models
 * @version September 16, 2020, 12:19 am UTC
 *
 * @property integer member_id
 * @property integer task_id
 * @property enmu status
 */
class MemberTask extends Model
{
    use SoftDeletes;

    public $table = 'member_tasks';
    

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $fillable = [
        'member_id',
        'task_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'member_id' => 'integer',
        'task_id' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function answer()
    {
        return $this->hasMany('App\Models\MemberAnswer', 'member_task_id', 'id');
    }
    public function task()
    {
        return $this->hasOne('App\Models\Task', 'id', 'task_id');
    }
    public function member()
    {
        return $this->hasOne('App\Models\Member', 'id', 'member_id');
    }
}
