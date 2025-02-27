<?php
declare(strict_types=1);

namespace app\services;

use app\events\TicketReply;
use yii\base\Component;
use yii\symfonymailer\Mailer;

/**
 * Class Mailer
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\services
 */
class TicketsNotifyService extends Component
{
    public function __construct(private readonly Mailer $mailer, $config = [])
    {
        parent::__construct($config);
    }

    public function send(TicketReply $event): void
    {
        $this->mailer->compose()
            ->setTo($event->ticket->email)
            ->setFrom(getenv('SUPPORT_MAIL'))
            ->setSubject('Ответ на заявку №' . $event->ticket->id)
            ->setTextBody($event->ticket->comment)
            ->send();
    }
}
