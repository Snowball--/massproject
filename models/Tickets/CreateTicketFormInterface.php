<?php
declare(strict_types=1);

namespace app\models\Tickets;

interface CreateTicketFormInterface
{
    public function getName(): string;
    public function getEmail(): string;
    public function getMessage(): string;
}
