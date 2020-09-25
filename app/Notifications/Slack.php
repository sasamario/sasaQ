<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class Slack extends Notification
{
    use Queueable;

    protected $channel;
    protected $slackName;
    public $name;
    public $title;
    public $id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $name, string $title, int $id)
    {
        $this->channel = env('SLACK_CHANNEL');
        $this->slackName = env('SLACK_NAME');
        $this->name = $name;
        $this->title = $title;
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
            ->content('記事が投稿されました')
            ->attachment(function ($attachment) use ($url) {
               $attachment->fields([
                       'タイトル' => $this->title,
                       '投稿者' => $this->name,
                       'リンク' => $url
                   ]);
            });
    }
}
