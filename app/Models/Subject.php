<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subject
 * @package App\Models
 * @version September 13, 2020, 2:21 pm UTC
 *
 * @property string name
 */
class Subject extends Model
{
    use SoftDeletes;

    public $table = 'subjects';
    

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

    public function teacher()
    {
        return $this->hasOne('App\User', 'subject_id', 'id');
    }
}
