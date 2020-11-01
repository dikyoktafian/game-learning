<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Classroom
 * @package App\Models
 * @version September 13, 2020, 4:23 pm UTC
 *
 * @property string name
 */
class Classroom extends Model
{
    use SoftDeletes;

    public $table = 'classrooms';
    

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function students()
    {
        return $this->hasMany('App\Models\ClassroomDetail', 'classroom_id', 'id');
    }
}
