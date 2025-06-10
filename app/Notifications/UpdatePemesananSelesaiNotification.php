<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdatePemesananSelesaiNotification extends Notification
{
    use Queueable;

    private $pemesanan;
    private $message;

    /**
     * Create a new notification instance.
     */
    public function __construct($pemesanan, $message)
    {
        $this->pemesanan = $pemesanan;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->message)
                    ->action('Lihat Pemesanan', url('/pemesanan/' . $this->pemesanan->id))
                    ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'pemesanan_id' => $this->pemesanan->id,
            'no_nota' => $this->pemesanan->no_nota,
            'message' => $this->message,
        ];
    }
}
