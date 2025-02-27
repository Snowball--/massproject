<?php
declare(strict_types=1);

namespace app\models\Tickets;

interface ReplyTicketFormInterface
{
    public function getTicketId(): int;
    public function getComment(): string;
}
