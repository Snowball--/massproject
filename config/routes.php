<?php

declare(strict_types=1);

use app\modules\Api\controllers\TicketsController;

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => TicketsController::class,
    ],
    '/tickets' => 'tickets/index',
    '/swagger/<moduleId>' => 'swagger/default/index',

    'OPTIONS /api/requests' => 'api/tickets/options',
    'POST /api/requests' => 'api/tickets/create',
    'GET /api/requests' => 'api/tickets/list',
    'PUT /api/requests/<id>' => 'api/tickets/reply',

];
