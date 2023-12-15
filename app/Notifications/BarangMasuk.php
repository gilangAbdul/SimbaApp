<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BarangMasuk extends Notification
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
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line($this->data['name'])
            ->line('Ada Barang baru Masuk Nih')
            ->line('Klik Tombol/Link dibawah ini untuk masuk ke Monitoring Barang Masuk')
            ->action('Cek Disini', url('/dashboard/in'))
            ->line('Terima Kasih!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'pesan' => 'Terdapat Barang Masuk Baru',
            'url' => url('dashboard/in')
        ];
    }
}
