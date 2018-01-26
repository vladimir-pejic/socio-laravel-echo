<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $fillable = ['user_id', 'gender_id', 'birth_date', 'profile_url', 'profile_photo', 'profile_background_photo', 'profile_message'];


    public function user() {
        return $this->belongsTo('App\Models\Users\User');
    }

    // Placeholder function that will have entire activity
    public function timeline() {

    }


    public function posts() {
        return $this->hasMany('App\Models\Posts\UserPost');
    }




}
