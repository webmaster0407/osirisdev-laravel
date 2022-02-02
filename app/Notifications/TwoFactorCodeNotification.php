<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Auth;

class TwoFactorCodeNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(__('global.two_factor.verify_mailsubject', ['appname' =>  config('app.name') ]))
            ->greeting(__('global.email_greet')." ".Auth::user()->firstname .',')
            ->line(__('global.two_factor.verify_info'))
            ->action(__('global.two_factor.verify_here'), route('twoFactor.show') . "?code=".$notifiable->two_factor_code)
            //->line(__('global.two_factor.your_code_is', ['code' => $notifiable->two_factor_code]))
            ->line(__('global.two_factor.will_expire_in', ['minutes' => 15]))
            ->line(__('global.two_factor.ignore_this'));

    }
}
