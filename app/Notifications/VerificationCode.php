<?php

namespace Zhiyi\Plus\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Zhiyi\Plus\Models\VerificationCode as VerificationCodeModel;

class VerificationCode extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The notification verification code model.
     *
     * @var \Zhiyi\Plus\Models\VerificationCode
     */
    protected $model;

    /**
     * Create the verification notification instance.
     *
     * @param \Zhiyi\Plus\Models\VerificationCode $model
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function __construct(VerificationCodeModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param \Zhiyi\Plus\Models\VerificationCode $notifiable
     * @return array
     */
    public function via(VerificationCodeModel $notifiable)
    {
        return [$notifiable->channel];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param \Zhiyi\Plus\Models\VerificationCode $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(VerificationCodeModel $notifiable)
    {
        return (new MailMessage)->markdown('mail.varification_code', [
            'model' => $notifiable,
            'user' => $notifiable->user,
        ])->from('service@mail.medz.cn', 'ThinkSNS+');
    }

    /**
     * Get the SMS representation of the norification.
     *
     * @param \Zhiyi\Plus\Models\VerificationCode $notifiable
     * @return [type]
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function toSms(VerificationCodeModel $notifiable)
    {
        unset($notifiable);
        // todo.
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray(): array
    {
        return $this->model->toArray();
    }
}