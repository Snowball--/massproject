<?php
declare(strict_types=1);

namespace app\modules\Api;

use OpenApi\Attributes as OA;

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
class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
    }
}