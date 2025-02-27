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

    public static function tableName(): string
    {
        return 'tickets';
    }

    public function attributes(): array
    {
        return [
            'id',
            'name',
            'email',
            'status',
            'message',
            'comment',
            'created_at',
            'updated_at',
        ];
    }

    public function rules(): array
    {
        return [
            [['name', 'email'], 'required'],
            [['status'], 'string'],
            [['name', 'email', 'message', 'comment'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function beforeSave($insert): bool
    {
        $date = new \DateTimeImmutable();

        if ($insert) {
            $this->status = TicketStatusEnum::Active->name;
            $this->created_at = $date->format('Y-m-d H:i:s');
        } else {
            $this->updated_at = $date->format('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }

    public static function repository(): TicketQuery
    {
        return new TicketQuery(self::class);
    }
}
