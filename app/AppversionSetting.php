<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppversionSetting extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'android', 'ios'
    ];
}
