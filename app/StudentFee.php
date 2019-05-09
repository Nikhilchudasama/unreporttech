<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'paid', 'unpaid'
    ];

    /**
    * Get Student
    */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }


}
