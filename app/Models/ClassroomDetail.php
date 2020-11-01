<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClassroomDetail
 * @package App\Models
 * @version September 13, 2020, 4:24 pm UTC
 *
 * @property integer classroom_id
 * @property integer member_id
 */
class ClassroomDetail extends Model
{
    use SoftDeletes;

    public $table = 'classroom_details';
    

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public $fillable = [
        'classroom_id',
        'member_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'classroom_id' => 'integer',
        'member_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function class()
    {
        return $this->belongsTo('App\Models\Classroom', 'id');
    }

    public function classParent()
    {
        return $this->belongsTo('App\Models\Classroom', 'classroom_id');
    }
    
    // public function student()
    // {
    //     return $this->belongsTo('App\Models\Classroom', 'id');
    // }

    public function student()
    {
        return $this->hasOne('App\Models\Member', 'id', 'member_id');
    }

}
