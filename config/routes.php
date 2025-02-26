<?php

declare(strict_types=1);

use app\modules\Api\controllers\TicketsController;

return [
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => TicketsController::class,
    ],
    '/tickets' => 'tickets/index',
    'POST /requests' => 'api/tickets/create',
    'GET /requests' => 'api/tickets/list',
    'PUT /requests/<id>' => 'api/tickets/reply',

    '/swagger/<moduleId>' => 'swagger/default/index',
];
