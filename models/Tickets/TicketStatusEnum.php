<?php
declare(strict_types=1);

namespace app\models\Tickets;

enum TicketStatusEnum
{
    case Active;
    case Resolved;
}
