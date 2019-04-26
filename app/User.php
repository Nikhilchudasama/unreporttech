<?php

namespace App;

use Illuminate\Validation\Rule;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, CausesActivity, HasMediaTrait, HasApiTokens, LogsActivity;

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'active', 'admin_id'
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
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


    /**
     * Validation rules
     *
     * @return array validation rules
     **/

    public static function validationRules($id = null)
    {
        $uniqueRule = Rule::unique('users');

        if ($id) {
            $uniqueRule->ignore($id);
        }
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|'.$uniqueRule,
            'password' => 'sometimes|required|string|min:6|confirmed',
        ];
    }

    /**
     * regiter media for user
     *
     **/
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('profile_img')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this
            ->addMediaConversion('thumb')
            ->width(108)
            ->height(108)
            ->performOnCollections('profile_img');
    }

    /**
    * Get the Admin.
    */
    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    /** Returns the status of the user
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->active ? 'Active' : 'Inactive';
    }

    /**
     * Get the sub-users for user.
     */
    public function subuser()
    {
        return $this->hasMany('App\SubUser');
    }

    /**
     * Get the branches for user.
     *
    **/
    public function branch()
    {
        return $this->hasMany('App\Branch');
    }

    /**
     * Get the class student for user.
     *
    **/
    public function classStudent()
    {
        return $this->hasMany('App\ClassStudent');
    }

    /**
     * Get the student for user.
     *
    **/
    public function student()
    {
        return $this->hasMany('App\Student');
    }

    /**
     * Get the Fee Offer for user.
     *
    **/
    public function feeOffer()
    {
        return $this->hasMany('App\FeeOffer');
    }

    /**
     * Get the Academic Year for user.
     *
    **/
    public function academicYear()
    {
        return $this->hasMany('App\AcademicYear');
    }

    /**
     * Get the Setting for user.
     *
    **/
    public function setting()
    {
        return $this->hasOne('App\Setting');
    }

}
