<?php
declare(strict_types=1);

namespace app\controllers;

use app\models\Tickets\Ticket;
use app\services\TicketsService;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Class TicketsController
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\controllers
 */
class TicketsController extends Controller
{
    public function __construct($id, $module, private readonly TicketsService $ticketsService, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ticket::repository()->findAll(),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}