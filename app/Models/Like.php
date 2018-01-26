<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    protected $table = 'likeables';

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];



    public function userStatuses()
    {
        return $this->morphedByMany('App\Models\Statuses\UserStatus', 'likeable');
    }

    public function userStatusesComments()
    {
        return $this->morphedByMany('App\Models\Statuses\UserStatusComment', 'likeable');
    }

//    public function photos()
//    {
//        return $this->morphedByMany('App\Models\Photos\Photo', 'likeable');
//    }
}
