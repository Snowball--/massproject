<?php
declare(strict_types=1);

namespace app\controllers;

use yii\web\Controller;

/**
 * Class TicketsController
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\controllers
 */
class TicketsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('tickets/index');
    }
}