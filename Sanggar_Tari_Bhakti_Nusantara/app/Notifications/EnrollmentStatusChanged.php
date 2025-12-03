<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\ClassEnrollment;

class EnrollmentStatusChanged extends Notification
{
    use Queueable;

    protected $enrollment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ClassEnrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // deliver via database and mail if mail is configured
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $className = $this->enrollment->classModel ? $this->enrollment->classModel->name : 'Kelas';
        $status = ucfirst($this->enrollment->status);

        $mail = (new MailMessage)
                    ->subject("Status Pendaftaran: {$className} - {$status}")
                    ->greeting("Halo {$notifiable->name},")
                    ->line("Status pendaftaran Anda untuk kelas \"{$className}\" telah berubah menjadi: {$status}.");

        if ($this->enrollment->status === 'rejected' && $this->enrollment->notes) {
            $mail->line('Alasan penolakan:')
                 ->line($this->enrollment->notes);
        }

        $mail->line('Terima kasih telah menggunakan layanan kami.');

        return $mail;
    }

    /**
     * Get the array representation of the notification for the database.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'enrollment_id' => $this->enrollment->id,
            'class_id' => $this->enrollment->class_id,
            'class_name' => $this->enrollment->classModel ? $this->enrollment->classModel->name : null,
            'status' => $this->enrollment->status,
            'notes' => $this->enrollment->notes,
        ];
    }
}
