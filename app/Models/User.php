<?php

namespace App\Models;

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
        'password', 'remember_token', 'email', 'email_verified_at', 'created_at', 'updated_at'
    ];

    public static $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'password|required|min:8|max:20|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:8|max:20',
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

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    public function subject()
    {
        return $this->hasOne('App\Models\Subject', 'id', 'subject_id');
    }

}
