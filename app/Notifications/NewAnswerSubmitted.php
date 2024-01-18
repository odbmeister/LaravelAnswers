<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAnswerSubmitted extends Notification
{
    use Queueable;

    public $question;
    public $answer;
    public $name;

    /**
     * Create a new notification instance.
     */
    public function __construct($answer, $question, $name)
    {
        $this->question = $question;
        $this->answer = $answer;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('A new answer was submitted to your question!')
                    ->line($this->name . ' just suggested: '. $this->answer->content)
                    ->action('View All Answers', route('questions.show', $this->question->id))
                    ->line('Thank you for using LaravelAnswers!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
