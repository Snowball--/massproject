<?php
declare(strict_types=1);

namespace app\events;

use app\services\TicketsNotifyService;
use app\services\TicketsService;
use yii\base\BootstrapInterface;
use yii\di\Container;

/**
 * Class EventsBootstrap
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\events
 */
class EventsBootstrap implements BootstrapInterface
{
    public function __construct(
        private readonly TicketsNotifyService $ticketsNotifyService,
        private readonly TicketsService $ticketsService
    ) {
    }

    public function bootstrap($app)
    {
        $ticketsNotifyService = $this->ticketsNotifyService;
        $this->ticketsService->on(TicketReply::EVENT_REPLY, function (TicketReply $event) use ($ticketsNotifyService) {
            $ticketsNotifyService->send($event);
        });
    }
}