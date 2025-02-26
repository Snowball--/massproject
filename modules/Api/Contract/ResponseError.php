<?php

declare(strict_types=1);

namespace app\modules\Api\Contract;

use OpenApi\Attributes as OA;

#[OA\Schema]
abstract class ResponseError
{
    #[OA\Property(example: 'Not Found')]
    public string $name;

    #[OA\Property(example: 'Object not found.')]
    public string $message;

    #[OA\Property(example: 0)]
    public int $code;
}
