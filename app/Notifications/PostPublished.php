<?php

namespace App\Notifications;

use App\Models\PostNotificationTrack;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostPublished extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var
     */
    protected $post;

    protected $subscriber;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post, $subscriber)
    {
        $this->post = $post;
        $this->subscriber = $subscriber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * @param $notifiable
     * @return false|MailMessage
     */
    public function toMail($notifiable)
    {
        if (PostNotificationTrack::check(
            $this->post->id, $this->subscriber->id)
        ) {
            return false;
        }

        PostNotificationTrack::create([
            'post_id' => $this->post->id,
            'subscriber_id' => $this->subscriber->id
        ]);

        return (new MailMessage)
            ->subject('New Post: ' . $this->post->name)
            ->line($this->post->description)
            ->action('view', url($this->post->slug))
            ->line('Thank you');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
