<?php

namespace App\Models\Statuses;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class UserStatusComment extends Model
{
    //
    protected $fillable = [
        'status_id', 'user_id', 'content', 'attachment'
    ];

    public function user() {
        return $this->belongsTo('App\Models\Users\User', 'user_id');
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
