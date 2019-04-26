<?php

namespace App;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class FeeOffer extends Model
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
        'package_name', 'start_date', 'end_date', 'fee', 'discount', 'fee', 'user_id', 'status'
    ];

    /**
     * Validation rules
     *
     * @return array validation rules
     **/

    public static function validationRules()
    {
        return [
            'package_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'fee' => 'required|numeric',
            'discount' => 'required',
        ];
    }

    /**
     * Get Fee Status
     *
     * @return string
     **/
    public function getStatus()
    {
         return $this->status ? 'Active' : 'Inactive';
    }

    /**
     * Get the User for Offer
     *
     **/
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
