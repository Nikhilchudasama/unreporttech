<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use LogsActivity;

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'academic_year_id',
    ];

    /**
     * Validation rules
     *
     * @return array validation rules
     **/
    public static function validationRules()
    {
        return [
            'academic_year_id' => 'required|numeric',
        ];
    }

    /**
     * Get User For Setting
     *
     **/
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get User For Setting
     *
     **/
    public function academicYear()
    {
        return $this->belongsTo('App\AcademicYear');
    }
}
