<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'subject_id',
        'photo',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email', 'role_id', 'email_verified_at', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'role_id' => 'integer',
        'subject_id' => 'integer',
        'photo' => 'string',
        'email_verified_at' => 'datetime',
    ];

    public static $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'password|min:10|max:20|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:10|max:20',
    ];

    public function task()
    {
        return $this->hasMany('App\Models\Task', 'created_by', 'id');
    }

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }
}
