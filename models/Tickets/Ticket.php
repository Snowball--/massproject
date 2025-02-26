<?php
declare(strict_types=1);

namespace app\models\Tickets;

use yii\db\ActiveRecord;

/**
 * Class Ticket
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\models
 */
class Ticket extends ActiveRecord
{
    public static function tableName()
    {
        return 'tickets';
    }
}