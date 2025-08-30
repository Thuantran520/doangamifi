<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        $expire = Config::get('auth.passwords.' . Config::get('auth.defaults.passwords') . '.expire');

        return (new MailMessage)
            ->subject('Đặt lại mật khẩu — Gamification')
            ->greeting('Xin chào ' . ($notifiable->name ?? $notifiable->email) . ',')
            ->line('Bạn nhận được email này vì chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.')
            ->action('Đặt lại mật khẩu', $url)
            ->line("Link sẽ hết hạn trong $expire phút.")
            ->line('Nếu bạn không yêu cầu, hãy bỏ qua email này.')
            ->salutation('Trân trọng, Đội ngũ Gamification');
    }
}