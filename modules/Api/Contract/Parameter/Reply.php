<?php
declare(strict_types=1);

namespace app\modules\Api\Contract\Parameter;

use OpenApi\Attributes as OA;

/**
 * Class Reply
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api\Contract\Parameter
 */
class Reply extends OA\Parameter
{
    public function __construct()
    {
        parent::__construct(
            name: 'reply',
            description: 'Текст ответа',
            schema: new OA\Schema(type: \app\modules\Api\Contract\Data\Reply::class),
            example: new \app\modules\Api\Contract\Data\Reply("Текст ответа")
        );
    }
}
