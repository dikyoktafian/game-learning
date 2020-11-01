<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MemberPoint
 * @package App\Models
 * @version September 19, 2020, 4:20 am UTC
 *
 * @property integer member_id
 * @property string model_type
 * @property integer model_id
 * @property integer point
 */
class MemberPoint extends Model
{
    use SoftDeletes;

    public $table = 'member_points';
    

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public $fillable = [
        'member_id',
        'model_type',
        'model_id',
        'point'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'member_id' => 'integer',
        'model_type' => 'string',
        'model_id' => 'integer',
        'point' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
