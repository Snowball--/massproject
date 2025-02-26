<?php

declare(strict_types=1);

namespace app\modules\Api\Contract\Response;

use Attribute;
use OpenApi\Attributes as OA;

/**
 * Class Collection
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\ClientApi\Contract\Response
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Collection extends JsonResponse
{
    public function __construct(string $schema = null)
    {
        $link = fn($property, $description, $example) => new OA\Property(
            property: $property,
            description: $description,
            properties: [
                new OA\Property(
                    property: 'href',
                    description: 'Ссылка',
                    type: 'string',
                    example: SERVER_URL . '/items/1?page=' . $example,
                ),
            ],
        );

        $meta = fn($property, $description, $example) => new OA\Property(
            property: $property,
            description: $description,
            type: 'integer',
            example: $example
        );

        parent::__construct(
            response: 200,
            description: 'OK',
            data: [
                new OA\Property(
                    property: 'items',
                    description: 'Список объектов.',
                    type: 'array',
                    items: new OA\Items(ref: $schema),
                ),
                new OA\Property(
                    property: 'links',
                    description: 'Ссылки.',
                    properties: [
                        $link('self', 'Текущая страница.', '3'),
                        $link('first', 'Первая страница.', '1'),
                        $link('last', 'Последняя страница.', '5'),
                        $link('prev', 'Предыдущая страница.', '2'),
                        $link('next', 'Следующая страница.', '4'),
                    ],
                ),
                new OA\Property(
                    property: 'meta',
                    description: 'Мета информация (пагинация и т.д.).',
                    properties: [
                        $meta('totalCount', 'Всего элементов.', 85),
                        $meta('pageCount', 'Всего страниц.', 5),
                        $meta('currentPage', 'Текущая страница.', 3),
                        $meta('perPage', 'Элементов на страницу.', 20),
                    ],
                ),
            ],
        );
    }
}
