<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class EmpresaResetPassword extends BaseResetPassword
{
    public function toMail($notifiable)
    {
        $mail = parent::toMail($notifiable);

        $fromAddress = env('MAIL_EMPRESA_FROM_ADDRESS', config('mail.from.address'));
        $fromName = env('MAIL_EMPRESA_FROM_NAME', config('mail.from.name'));

        if ($mail instanceof MailMessage) {
            $mail->from($fromAddress, $fromName);
            $mail->mailer('empresa');
        }

        return $mail;
    }
}

