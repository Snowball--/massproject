<?php
declare(strict_types=1);

namespace app\modules\Api\Contract\Response;

enum ResponseStatus: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';

    public static function fromHttpStatusCode(int $httpStatusCode): self
    {
        return match ($httpStatusCode) {
            200, 201 => self::SUCCESS,
            default => self::ERROR
        };
    }
}
