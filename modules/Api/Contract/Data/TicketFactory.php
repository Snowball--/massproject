<?php
declare(strict_types=1);

namespace app\modules\Api\Contract\Data;

use yii\base\Model;

/**
 * Class TicketFactory
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api\Contract\Data
 */
class TicketFactory implements FactoryInterface
{

    public function createFromModel(\app\models\Tickets\Ticket|Model $model): Ticket
    {
        return new Ticket(
            $model->id,
            $model->name,
            $model->email,
            $model->status,
            $model->message,
            $model->created_at,
            $model->updated_at,
            $model->comment ? new Reply($model->comment) : null
        );
    }
}
