<?php
declare(strict_types=1);

use app\services\TicketsNotifyService;
use app\services\TicketsService;

return [
    'definitions' => [
        TicketsNotifyService::class => TicketsNotifyService::class,
        \app\events\EventsBootstrap::class => [
            'class' => \app\events\EventsBootstrap::class,
            [\yii\di\Instance::of(TicketsNotifyService::class), \yii\di\Instance::of(TicketsService::class)]
        ]
    ],
    'singletons' => [
        TicketsService::class => TicketsService::class,
    ]
];