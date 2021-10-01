<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewStatus extends Notification
{
    use Queueable;

    public $id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id)
    {
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
      file_get_contents("https://api.iqsms.ru/messages/v2/send/?login=z1532608605361&password=854817&phone=%2B" . $notifiable->phone . "&text=Статус+Вашего+заказа+№+" . $this->id . "+изменился,+проверьте+на+сайте.");
      return (new MailMessage)
                  ->subject('Информация по заказу №'.$this->id.'')
                  ->greeting('Здравствуйте!')
                  ->line('Статус Вашего заказа изменился. Пройдите на сайт, чтобы проверить новую информацию')
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
