<?php

declare(strict_types=1);

namespace app\modules\Api\Contract\Response;

use app\modules\api\Contract\ResponseError;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Forbidden extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(
            response: 403,
            description: 'Forbidden',
            ref: ResponseError::class,
            example: [
                'name' => 'Forbidden',
                'message' => 'You are not allowed to perform this action.',
                'code' => 0,
            ],
        );
    }
}
