<?php
declare(strict_types=1);

namespace app\modules\Api;

use OpenApi\Attributes as OA;
use yii\base\BootstrapInterface;
use yii\web\Response;

/**
 * Class Module
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api
 */

#[OA\Info(
    version: API_VERSION,
    title: 'Tickets API',
)]
#[OA\Server(
    url: SERVER_URL
)]
#[OA\SecurityScheme(
    securityScheme: 'BearerAuth',
    type: 'http',
    scheme: 'Bearer',
)]
#[OA\OpenApi(
    security: [[], ['BearerAuth' => []]],
)]
class Module extends \yii\base\Module implements BootstrapInterface
{
    public function init()
    {
        parent::init();
    }

    public function bootstrap($app): void
    {
        if ($app instanceof \yii\web\Application) {
            $app->on(\yii\base\Application::EVENT_BEFORE_REQUEST, function () use ($app) {
                if (str_starts_with($app->request->url, "/$this->uniqueId")) {
                    $app->request->enableCsrfValidation = false;
                    $app->response->format = Response::FORMAT_JSON;

                    $app->response->on(Response::EVENT_BEFORE_SEND, function () use ($app) {
                        $response = $app->response;
                        if ($response->format === Response::FORMAT_JSON) {
                            $response->data = new Contract\Response($response->statusCode, $response->data);
                        }
                    });
                }
            });
        }
    }
}
