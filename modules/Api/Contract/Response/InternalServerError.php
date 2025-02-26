<?php

declare(strict_types=1);

namespace app\modules\Api\Contract\Response;

use app\modules\Api\Contract\ResponseError;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class InternalServerError extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(
            response: 500,
            description: 'Internal Server Error',
            ref: ResponseError::class,
            example: [
                'name' => 'Exception',
                'message' => 'An error occurred while processing the request.',
                'code' => 0,
            ],
        );
    }
}
