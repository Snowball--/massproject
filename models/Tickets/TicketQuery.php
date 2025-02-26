<?php
declare(strict_types=1);

namespace app\models\Tickets;

use yii\db\ActiveQuery;

/**
 * Class TicketQuery
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\models\Tickets
 */
class TicketQuery extends ActiveQuery
{
    public function all($db = null): self
    {
        return $this->where([]);
    }
}
