<?php
declare(strict_types=1);

namespace app\modules\Api\Contract\Data;

use yii\base\Model;

/**
 * Class ReplyFactory
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api\Contract\Data
 */
class ReplyFactory implements FactoryInterface
{

    public function createFromModel(\app\models\Tickets\Ticket|Model $model): Reply
    {
        return new Reply($model->comment);
    }
}
