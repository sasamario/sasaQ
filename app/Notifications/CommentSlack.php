<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class CommentSlack extends Notification
{
    use Queueable;

    protected $channel;
    protected $slackName;
    public $name;
    public $id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $name, int $id)
    {
        $this->channel = config('app.SLACK_CHANNEL');
        $this->slackName = config('app.SLACK_NAME');
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * @param $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        $url = url('/article/'.$this->id);

        return (new SlackMessage)
            ->from($this->slackName)
            ->to($this->channel)
            ->content('コメントされました')
            ->attachment(function ($attachment) use ($url) {
                $attachment->fields([
                    'リンク' => $url,
                    '投稿者' => $this->name,
                ]);
            });
    }
}
