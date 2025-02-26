<?php

declare(strict_types=1);

namespace app\modules\Api\Contract\Response;

use app\modules\Api\Contract\ResponseError;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class NotFound extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(
            response: 404,
            description: 'Not Found',
            ref: ResponseError::class,
            example: [
                'name' => 'Not Found',
                'message' => 'Object not found.',
                'code' => 0,
            ],
        );
    }
}
