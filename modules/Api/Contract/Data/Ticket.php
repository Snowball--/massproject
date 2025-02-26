<?php
declare(strict_types=1);

namespace app\modules\Api\Contract\Data;

use OpenApi\Attributes as OA;

/**
 * Class Ticket
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api\models\Contract
 */
#[OA\Schema]
readonly class Ticket
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly int $status,
        public readonly int $message,
        public readonly string $created_at,
        public readonly string $updated_at,
        public readonly ?Reply $reply = null
    ) {
    }
}