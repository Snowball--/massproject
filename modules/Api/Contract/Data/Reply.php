<?php
declare(strict_types=1);

namespace app\modules\Api\Contract\Data;

use OpenApi\Attributes as OA;

/**
 * Class Reply
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api\Contract\Data
 */
#[OA\Schema]
readonly class Reply
{
    public function __construct(
        #[OA\Property(description: 'Текст ответа', type: 'string')]
        public readonly string $comment
    ) {
    }
}