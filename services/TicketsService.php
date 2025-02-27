<?php
declare(strict_types=1);

namespace app\services;

use app\models\Tickets\CreateTicketFormInterface;
use app\models\Tickets\Ticket;
use app\models\Tickets\TicketStatusEnum;

/**
 * Class TicketsService
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\services
 */
class TicketsService
{
    public function create(CreateTicketFormInterface $form): Ticket
    {
        $ticket = new Ticket();
        $ticket->name = $form->getName();
        $ticket->email = $form->getEmail();
        $ticket->message = $form->getMessage();
        $ticket->save();

        return $ticket;
    }
}