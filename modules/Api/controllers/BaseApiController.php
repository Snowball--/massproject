<?php

declare(strict_types=1);

namespace app\modules\Api\controllers;

use DomainException;
use Yii;
use yii\base\InvalidRouteException;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\UnprocessableEntityHttpException;

/**
 * Class BaseApiController
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @version 1.0
 */
class BaseApiController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        $this->serializer = Yii::$app->get('serializer');
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [
            'authenticator' => [
                'class' => HttpBearerAuth::class,
                'user' => Yii::$app->get('user'),
            ],
        ];
    }


    public function optionalAuth(): array
    {
        return [];
    }

    /**
     * @throws InvalidRouteException
     * @throws UnprocessableEntityHttpException
     */
    public function runAction($id, $params = [])
    {
        try {
            return parent::runAction($id, $params);
        } catch (DomainException $exception) {
            throw new UnprocessableEntityHttpException($exception->getMessage(), 0, $exception);
        }
    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        return $this->serializeData($result);
    }

    protected function serializeData($data)
    {
        return $this->serializer->serialize($data);
    }
}
