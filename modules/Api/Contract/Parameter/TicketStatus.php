<?php
declare(strict_types=1);

namespace app\modules\Api\Contract\Parameter;

use app\models\Tickets\TicketStatusEnum;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Attachable;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\XmlContent;
use OpenApi\Generator;

/**
 * Class TicketStatus
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api\Contract\Parameter
 */
class TicketStatus extends OA\Parameter
{
    public function __construct(?string $parameter = null, ?string $name = null, ?string $description = null, ?string $in = null, ?bool $required = null, ?bool $deprecated = null, ?bool $allowEmptyValue = null, object|string|null $ref = null, ?Schema $schema = null, mixed $example = Generator::UNDEFINED, ?array $examples = null, JsonContent|array|Attachable|XmlContent|null $content = null, ?string $style = null, ?bool $explode = null, ?bool $allowReserved = null, ?array $spaceDelimited = null, ?array $pipeDelimited = null, ?array $x = null, ?array $attachables = null)
    {
        parent::__construct(
            name: 'status',
            description: 'Статус',
            in: 'query',
            schema: new OA\Schema(type: 'string', enum: TicketStatusEnum::class),
            example: new \app\modules\Api\Contract\Data\Reply("Текст ответа")
        );
    }
}