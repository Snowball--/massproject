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
        #[OA\Property(description: 'ID заявки', type: 'integer')]
        public readonly int $id,
        #[OA\Property(description: 'Имя', type: 'string')]
        public readonly string $name,
        #[OA\Property(description: 'Email', type: 'string')]
        public readonly string $email,
        #[OA\Property(description: 'Статус', type: 'string')]
        public readonly int $status,
        #[OA\Property(description: 'Сообщение', type: 'string')]
        public readonly int $message,
        #[OA\Property(description: 'Дата создания', type: 'string')]
        public readonly string $created_at,
        #[OA\Property(description: 'Дата обновления', type: 'string')]
        public readonly string $updated_at,
        #[OA\Property(description: 'Ответ', type: 'reply', nullable: true)]
        public readonly ?Reply $reply = null
    ) {
    }
}