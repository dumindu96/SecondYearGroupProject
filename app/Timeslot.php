<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $fillable = ["day", "time","tutor_id","stu_id","isAccepted"];

    // public function teacher()
    // {
    //     return $this->hasOne('App\Tutor','user_id','tutor_id');
    // }
    public function tutor()
    {
        return $this->belongsTo('App\Tutor','tutor_id');
    }

    public function student()
    {
        return $this->belongsTo('App\User','stu_id');
    }
}
