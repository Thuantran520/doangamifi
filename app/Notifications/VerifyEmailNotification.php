<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerify;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends BaseVerify
{
    public function toMail($notifiable)
    {
        $expiration = Config::get('auth.verification.expire', 60);
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes($expiration),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );

        return (new MailMessage)
            ->subject('Xác thực email — Gamification')
            ->greeting('Xin chào ' . ($notifiable->name ?? $notifiable->email) . ',')
            ->line('Vui lòng bấm nút bên dưới để xác thực địa chỉ email của bạn.')
            ->action('Xác thực email', $verificationUrl)
            ->line("Link xác thực sẽ hết hạn trong $expiration phút.")
            ->line('Nếu bạn không tạo tài khoản, hãy bỏ qua email này.')
            ->salutation('Trân trọng, Đội ngũ Gamification');
    }
}