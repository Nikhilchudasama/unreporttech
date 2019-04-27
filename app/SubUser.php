<?php

namespace App;

use Illuminate\Validation\Rule;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubUser extends Authenticatable
{
    use LogsActivity, CausesActivity, HasApiTokens;


    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'branch_id',
        'name',
        'mobile',
        'email',
        'password',
        'active',
    ];

    /**
     * Get the user for sub-user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the branch for sub-user.
     */
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

     /**
     * Bootstrap any application services.
     */
    public static function boot()
    {
        parent::boot();

        // Create uid when creating list.
        static::creating(function ($subuser) {
            // Create new uid
            $uuid = uniqid();
            while (SubUser::where('uuid', '=', $uuid)->count() > 0) {
                $uuid = uniqid();
            }
            $subuser->uuid = $uuid;
        });
    }

     /**
     * Validation rules
     *
     * @return array validation rules
     **/

    public static function validationRules($id = null)
    {
        $uniqueRule = Rule::unique('sub_users');

        if ($id) {
            $uniqueRule->ignore($id);
        }
        return [
            'branch_id' => 'required',
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|'.$uniqueRule,
            'email' => 'required|string|email|max:255|'.$uniqueRule,
            'password' => 'sometimes|required|string|min:6|confirmed',
        ];
    }

    /** Returns the status of the user
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->active ? 'Active' : 'Inactive';
    }
}
