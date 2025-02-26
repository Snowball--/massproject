<?php
declare(strict_types=1);

namespace app\controllers;

use app\services\TicketsService;
use yii\web\Controller;

/**
 * Class TicketsController
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\controllers
 */
class TicketsController extends Controller
{
    public function __construct($id, $module, $config = [], private readonly TicketsService $ticketsService)
    {
        parent::__construct($id, $module, $config);
    }


    public function actionIndex()
    {
        return $this->render('index');
    }
}