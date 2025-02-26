<?php

declare(strict_types=1);

namespace app\modules\Api\Contract;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER | Attribute::IS_REPEATABLE)]
class RequestBody extends OA\RequestBody
{
    public function __construct(string $schema) {
        parent::__construct(required: true, content: new OA\JsonContent(ref: $schema));
    }
}
