<?php

declare(strict_types=1);

namespace app\modules\Api\Contract\Response;

use app\modules\Api\Contract\Response;
use Attribute;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class JsonResponse extends OA\Response
{
    public function __construct(
        int $response,
        string $description,
        ?string $ref = null,
        ?array $data = null,
        mixed $example = null
    ) {
        $status = ResponseStatus::fromHttpStatusCode($response)->value;

        $allOf = [
            new OA\Schema(ref: Response::class),
            new OA\Schema(
                properties: [
                    new OA\Property(property: 'status', example: $status),
                    new OA\Property(property: 'data', ref: $ref, properties: $data),
                ],
            ),
        ];

        if ($example) {
            $allOf[] = new OA\Schema(
                properties: [
                    new OA\Property(property: 'data', example: $example),
                ]
            );
        }

        parent::__construct(
            response: $response,
            description: $description,
            content: new OA\JsonContent(allOf: $allOf),
        );
    }
}
