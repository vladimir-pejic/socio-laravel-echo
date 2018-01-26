<?php

namespace App\Models\Statuses;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    //
    protected $fillable = [
        'origin_user_id', 'target_user_id', 'content', 'attachment'
    ];

    public function user() {
        return $this->belongsTo('App\Models\Users\User', 'origin_user_id');
    }

    public function targetUser() {
        return $this->belongsTo('App\Models\Users\User', 'target_user_id');
    }

    public function comments() {
        return $this->hasMany('App\Models\Statuses\UserStatusComment', 'status_id');
    }

    public function likes()
    {
        return $this->morphToMany('App\Models\Users\User', 'likeable')->whereDeletedAt(null);
    }

    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(User::getUser()->id)->first();
        return (!is_null($like)) ? true : false;
    }
}
