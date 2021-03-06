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
        'FName', 'LName', 'email', 'password','DOB','is_tutor','is_student','is_admin', 'NIC',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function tutor(){
        return $this->hasOne('App\Tutor','user_id','id');
    }

    public function timeslot()
    {
        // return $this->belongsTo('App\Timeslot','id','tutor_id');
        return $this->hasMany('App\Timeslot','stu_id');

    }
    // public function annouce(){
    //     return $this->hasOne('App\Announcement','admin_id','id');
    // }

    // public function creator(){
    //     return $this->belongsTo('App\Announcement','admin_id','id');
    // }
}
