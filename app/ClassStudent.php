<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'student_id','fullname'
    ];

    /**
     * Get the user  for class.
    */
    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
