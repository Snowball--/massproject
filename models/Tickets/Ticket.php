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
    public ?int $id = null;
    public ?string $name = null;
    public ?string $email = null;
    public ?string $status = null;
    public ?string $message = null;
    public ?string $comment = null;
    public ?int $created_at = null;
    public ?int $updated_at = null;


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
    public static function repository(): TicketQuery
    {
        return new TicketQuery(self::class);
    }
}
