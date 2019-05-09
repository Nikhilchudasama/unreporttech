<?php

namespace App;

use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Student extends Model implements HasMedia
{
    use LogsActivity, HasMediaTrait, CausesActivity;

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id',
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'mobile_no',
        'finger',
    ];

    /**
     * Validation rules
     *
     * @return array validation rules
     **/
    public static function validationRules($student = null)
    {
        $required = 'required';

        if ($student) {
            $required = 'nullable';
        }

        return [
            'branch_id' => 'required|numeric',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:12',
            'student_image' => $required . '|image|mimes:jpeg,jpg',
        ];
    }


    /**
    * Bootstrap any application services.
    */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($student) {
            $uuid = uniqid();
            while (Student::where('uuid', '=', $uuid)->count() > 0) {
                $uuid = uniqid();
            }
            $student->uuid = $uuid;
        });
    }

    /**
     * regiter media for user
     *
     **/
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('student_image')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this
            ->addMediaConversion('thumb')
            ->width(108)
            ->height(108)
            ->performOnCollections('student_image');
    }

    /**
     * Get Student Full Name
     *
     * @return string
     **/
    public function getFullName()
    {
        return $this->last_name.' '.$this->first_name.' '.$this->middle_name;
    }

    /**
     * Get the user for student.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the branch for student.
     */
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    /**
     * Student list
     *
     * @param int $id user id
     * @param int $offset pagination offset
     * @param string $search search string
     * @param int $branchId Branch Id
     * @param int $academicId Academic Year Id
     * @return mixed|array
     **/
    public static function studentList($id, $offset, $search, $branchId, $academicId)
    {
        $result = static::query();
        $result->select('students.*');
        if ($academicId) {
            $result->leftJoin('student_log_infos','students.id','=','student_log_infos.student_id')->where('student_log_infos.academic_year_id', $academicId);
        }
        // $result->where('user_id', $id);
        if(!empty($search)){
        $result->where('first_name', 'LIKE', '%'.$search.'%')
                ->where('last_name', 'LIKE', '%'.$search.'%')
                ->where('middle_name', 'LIKE', '%'.$search.'%');
        }
        if($branchId){
            $result->where('branch_id', $branchId);
        }
        return $result->orderBy('created_at', 'desc')
                ->skip($offset*20)->take(20)
                ->get();
    }
}
