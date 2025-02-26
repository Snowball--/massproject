<?php
declare(strict_types=1);

namespace app\modules\Api\controllers;

use app\services\TicketsService;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use OpenApi\Attributes as OA;


/**
 * Class TicketsController
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api\controllers
 */
class TicketsController extends  Controller
{
    public function __construct($id, $module, private readonly TicketsService $ticketsService, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    #[OA\Get(
        path: '/tickets',
        description: 'Возвращает список заявок',
        summary: 'Список заявок',
        tags: ['tickets'],
    )]
    public function actionList(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => \app\models\Tickets\Ticket::repository()->findAll(),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);
    }

    public function actionCreate()
    {

    }

    public function actionReply()
    {

    }
}