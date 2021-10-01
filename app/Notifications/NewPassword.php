<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPassword extends Notification
{
    use Queueable;

    protected $pass;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
     public function __construct($pass) {
         $this->pass = $pass;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      file_get_contents("https://api.iqsms.ru/messages/v2/send/?login=z1532608605361&password=854817&phone=%2B" . $notifiable->phone . "&text=Новые+данные+для+доступа+к+сервису.+Логин:+". $notifiable->phone."+Пароль+для+доступа+к+сервису:+" . $this->pass . "");
      return (new MailMessage)
                  ->subject('Новые данные для доступа к сервису')
                  ->greeting('Здравствуйте!')
                  ->line('Мы восстановили Ваш пароль.')
                  ->line('Новые данные:')
                  ->line('Логин для входа: '.$notifiable->phone.'')
                  ->line(' Пароль для входа: '.$this->pass)
                  ->action('Перейти на сайт', url('/'))
                  ->line('Спасибо, что выбрали наш сервис!');
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
            //
        ];
    }
}
