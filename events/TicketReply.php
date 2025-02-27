<?php
declare(strict_types=1);

namespace app\events;

use app\models\Tickets\Ticket;
use yii\base\Event;

/**
 * Class TicketReply
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\events
 */
class TicketReply extends Event
{
    public const EVENT_REPLY = 'reply';

    public function __construct(public Ticket $ticket,$config = [])
    {
        parent::__construct($config);
    }
}
