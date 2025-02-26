<?php

declare(strict_types=1);

namespace app\modules\Api\Contract;

use app\modules\Api\Contract\Response\ResponseStatus;
use OpenApi\Attributes as OA;

/**
 * Ответ.
 *
 * @author nicon <nicon.work@gmail.com>
 * @version 1.0
 */
#[OA\Schema]
readonly class Response
{
    /**
     * @var string Статус ответа.
     */
    #[OA\Property(enum: ['success', 'error'])]
    public string $status;

    /**
     * @var mixed Данные ответа.
     */
    #[OA\Property]
    public mixed $data;

    /**
     * Конструктор.
     *
     * @param int $httpStatus Http статус ответа.
     * @param mixed|null $data Данные ответа.
     */
    public function __construct(int $httpStatus, mixed $data = null)
    {
        $this->status = ResponseStatus::fromHttpStatusCode($httpStatus)->value;
        $this->data = $data;
    }
}
