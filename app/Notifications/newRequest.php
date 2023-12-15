<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class newRequest extends Notification
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
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $pesan = $this->data['pemohon_nama'].  ' dari '. $this->data['divisi_pemohon'];
        // dd($pesan);
        return (new MailMessage)
            ->line($this->data['nama'])
            ->line('Ada Permintaan Barang Baru :')
            ->line($pesan)
            ->line('Sejumlah '. $this->data['jumlah']. ' Barang')
            ->line('Lihat selengkapnya disini :')
            ->action('Cek Disini', url('/dashboard/req'))
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
            'pesan' => 'Permintaan Barang Baru',
            'url' => url('dashboard/req'),
        ];
    }
}
