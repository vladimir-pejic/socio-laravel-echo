<?php

namespace App\Notifications;

use App\Models\Like;
use App\Models\Statuses\UserStatus;
use App\Models\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Liked extends Notification implements ShouldQueue
{
    use Queueable;

    protected $like;
    protected $liked_by;

    /**
     * Create a new notification instance.
     *
     * @param Like $like
     * @param User $liked_by
     */
    public function __construct(Like $like, User $liked_by)
    {
        //
        $this->like = $like;
        $this->liked_by = $liked_by;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->liked_by->id,
            'user_name' => $this->liked_by->first_name . ' ' . $this->liked_by->last_name,
            'like' => $this->like->likeable_type,
            'likeable_id' => $this->like->likeable_id
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'user_id' => $this->liked_by->id,
            'user_name' => $this->liked_by->first_name . ' ' . $this->liked_by->last_name,
            'like' => $this->like->likeable_type,
            'likeable_id' => $this->like->likeable_id
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->liked_by->id,
            'user_name' => $this->liked_by->first_name . ' ' . $this->liked_by->last_name,
            'like' => $this->like->likeable_type,
            'likeable_id' => $this->like->likeable_id
        ];
    }
}
