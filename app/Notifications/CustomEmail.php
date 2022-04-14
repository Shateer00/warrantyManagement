<?php
namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class CustomEmail extends VerifyEmail
{

    public $NameNeedAuthenticate;

    function __construct($Name) {
        $this->NameNeedAuthenticate = $Name;
      }

    protected function verificationUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }

        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(Lang::get('Verifikasi Alamat Email',[],'id'))
            ->line(Lang::get('Atas Nama : '.$this->NameNeedAuthenticate,[],'id'))
            ->line(Lang::get('Mohon Klik Tombol di bawah untuk verifikasi Alamat Email',[],'id'))
            ->action(Lang::get('Verifikasi Alamat Email',[],'id'), $url)
            ->line(Lang::get('Jika anda tidak membuat Akun, Tidak perlu dilanjutkan',[],'id'));
    }
}
