<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
/**
 * Class Member
 * @package App\Models
 * @version September 6, 2020, 11:55 pm UTC
 *
 * @property string email
 * @property string password
 * @property integer role_id
 */
class Member extends Authenticatable
{
    use SoftDeletes;

    public $table = 'members';
    
    protected $guarded = ['id'];
    protected $guard = 'members';   

    protected $dates = ['deleted_at'];

    protected $hidden = ['password', 'created_at', 'email_verified_at', 'remember_token', 'updated_at', 'deleted_at'];

    public $fillable = [
        'name',
        'email',
        'password',
        // 'role_id',
        'photo',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'email_verified_at' => 'string',
        'remember_token' => 'string',
        'photo' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'min:6|max:20|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:6|max:20',
    ];

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::make($value);
    }

    public function class()
    {
        return $this->hasOne('App\Models\ClassroomDetail', 'member_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id', 'id');
    }

    public function task()
    {
        return $this->hasMany('App\Models\Task', 'created_by', 'id');

    }

    public function membertask()
    {
        return $this->hasMany('App\Models\MemberTask', 'member_id', 'id');

    }
}
