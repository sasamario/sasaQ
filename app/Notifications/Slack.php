<?php

namespace App\Notifications;

use App\Article;
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
    public $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $name, string $title, int $id, int $status)
    {
        $this->channel = config('app.SLACK_CHANNEL');
        $this->slackName = config('app.SLACK_NAME');
        $this->name = $name;
        $this->title = $title;
        $this->id = $id;
        $this->status = $status;
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
                       'リンク' => $url,
                       '重要度' => $this->getStatus($this->status)
                   ]);
            });
    }

    /**
     * @param int $status
     * @return string
     */
    public function getStatus(int $status)
    {
        if ($status == Article::STATUS_NOT_HURRY) {
            return 'お手すきに';
        } elseif ($status == Article::STATUS_HURRY) {
            return 'お急ぎ';
        } else {
            return 'その他';
        }
    }
}
