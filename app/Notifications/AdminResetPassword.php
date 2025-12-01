<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AdminResetPassword extends BaseResetPassword
{
    public function toMail($notifiable)
    {
        $mail = parent::toMail($notifiable);

        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');

        $adminFromAddress = env('MAIL_ADMIN_FROM_ADDRESS', $fromAddress);
        $adminFromName = env('MAIL_ADMIN_FROM_NAME', $fromName);

        if ($mail instanceof MailMessage) {
            $mail->from($adminFromAddress, $adminFromName);
            $mail->mailer('admin');
        }

        return $mail;
    }
}

