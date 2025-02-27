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
    public function findAllByStatus(string $status = null): self
    {
        $query = $this->where([]);
        if ($status !== null) {
            $query->andWhere(['status' => $status]);
        }

        return $query;
    }

    public function findById(int $id): self
    {
        return $this->andWhere(['id' => $id]);
    }
}
