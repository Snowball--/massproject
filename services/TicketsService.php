<?php
declare(strict_types=1);

namespace app\services;

use app\events\TicketReply;
use app\models\Tickets\CreateTicketFormInterface;
use app\models\Tickets\ReplyTicketFormInterface;
use app\models\Tickets\Ticket;
use app\models\Tickets\TicketStatusEnum;
use yii\base\Component;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

/**
 * Class TicketsService
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\services
 */
class TicketsService extends Component
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

    /**
     * @throws NotFoundHttpException|Exception
     */
    public function reply(ReplyTicketFormInterface $form): Ticket
    {
        $ticket = Ticket::repository()->findById($form->getTicketId())->one();
        if ($ticket === null) {
            throw new NotFoundHttpException("Заявка не найдена");
        }

        $ticket->comment = $form->getComment();
        $ticket->status = TicketStatusEnum::Resolved->name;
        if ($ticket->save()) {
            $event = new TicketReply($ticket);
            $this->trigger(TicketReply::EVENT_REPLY, $event);
        }

        return $ticket;
    }
}