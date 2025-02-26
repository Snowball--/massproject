<?php

declare(strict_types=1);

namespace app\modules\Api\Contract\Response;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class OK extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(
            response: 200,
            description: 'OK',
        );
    }
}
