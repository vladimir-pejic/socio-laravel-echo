<?php

namespace App\Notifications;

use App\Models\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Liked extends Notification implements ShouldQueue
{
    use Queueable;

    protected $liked;
    protected $liked_by;

    /**
     * Create a new notification instance.
     *
     * @param $liked
     * @param $liked_by
     */
    public function __construct($liked, User $liked_by)
    {
        //
        $this->liked = $liked;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->liked_by->id,
            'user_status_content' => $this->liked_by->first_name . ' ' . $this->liked_by->last_name,
            'user_status_id' => $this->liked->id,
        ];
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
            'content' => $this->liked->content,
            'liked_by' => $this->liked_by->first_name . ' ' . $this->liked_by->last_name,
        ];
    }
}
