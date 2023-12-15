<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class stokWarning extends Notification
{
    use Queueable;
    private $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        return $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line($this->data['nama'])
                    ->line('Peringatan Stok Barang Menipis :')
                    ->line($this->data['pesan'])
                    ->action('Cek Barang', url('/dashboard/list'))
                    ->line('Terima Kasih!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'pesan' => 'Peringatan Stok Menipis',
            'url' => url('/dashboard/list')
        ];
    }
}
