<?php

namespace App;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Branch extends Model
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
        'name', 'user_id','address'
    ];
    
    /**
     * Get the sub-users for brnch.
     */
    public function subuser()
    {
        return $this->hasMany('App\SubUser');
    }

    /**
     * Get the student for brnch.
     */
    public function student()
    {
        return $this->hasMany('App\Student');
    }

    /**
     * Validation rules
     *
     * @return array validation rules
     **/

    public static function validationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
        ];
    }
}
