<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['user_id', 'message'];

    public function user() {
        return $this->belongsTo('App\Models\Users\User', 'user_id');
    }
}
