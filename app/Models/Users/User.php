<?php

namespace App\Models\Users;


use App\Models\Statuses\UserStatus;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as Auth;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends \Cartalyst\Sentinel\Users\EloquentUser implements Auth
{
    use Notifiable;
    use AuthenticableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function profile() {
        return $this->hasOne('App\Models\Users\UserProfile');
    }


    // METHODS
    public static function getUser() {
        return User::find(Sentinel::getUser()->id);
    }

    public static function check() {
        return Sentinel::check();
    }

    public function statuses() {
        return $this->hasMany('App\Models\Statuses\UserStatus', 'target_user_id')->orderBy('created_at', 'desc');
    }

    public function likedStatuses()
    {
        return $this->morphedByMany('App\Models\Statuses\UserStatus', 'likeable')->whereDeletedAt(null);
    }

    public function likedStatusComments()
    {
        return $this->morphedByMany('App\Models\Statuses\UserStatusComment', 'likeable')->whereDeletedAt(null);
    }

    // Format notifications
    public function new_notifications() {
//        foreach ($this->unreadNotifications() as $notification)

    }

    public function all_notifications() {
        $this->notifications();
    }

    // Chat & Messages
    public function chat_messages() {
        return $this->hasmany('App\Models\Messages\ChatMessage', 'user_id');
    }

    public function messages() {
        return $this->hasmany('App\Models\Messages\Message', 'user_id');
    }
}
