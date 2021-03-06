<?php

namespace App;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class AcademicYear extends Model
{
    use CausesActivity;

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    protected  $dates = ['start_date'=>'datetimes:Y-m-d', 'end_date' => 'datetimes:Y-m-d'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'start_date', 'end_date', 'status'
    ];

    /**
     * Validation rules
     *
     * @return array validation rules
     **/

    public static function validationRules()
    {
        return [
            'title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }


    /**
     * Get Setting For AcademicYear
     **/
    public function setting()
    {
        return $this->hasOne('App\Setting');
    }

    /**
     * Get The User for Finacial Year
     *
     **/
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Academic Year list
     *
     * @param int $id user id
     * @param int $offset pagination offset
     * @param string $search search string
     * @return mixed|array
     **/
    public static function ayList($id, $offset, $search)
    {
        $result = static::query();
        $result->where('user_id', $id);
        if(!empty($search)){
        $result->where('title', 'LIKE', '%'.$search.'%');
        }
        return $result->orderBy('created_at', 'desc')
                ->skip($offset*20)->take(20)
                ->get();
    }
}
