<?php
declare(strict_types=1);

namespace app\modules\Api\Contract\Form;

use app\models\Tickets\ReplyTicketFormInterface;
use app\validator\ValidatedInterface;
use OpenApi\Attributes as OA;
use yii\base\Model;

/**
 * Class ReplyTicketForm
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api\Contract\Form
 */
#[OA\Schema]
class ReplyTicketForm extends Model implements ValidatedInterface, ReplyTicketFormInterface
{
    public int $ticketId;

    #[OA\Property(example: 'Комментарий от ответственного')]
    public string $comment;

    public function rules()
    {
        return [
            [['ticketId', 'comment'], 'required'],
            [['ticketId'], 'integer'],
            [['comment'], 'string'],
        ];
    }

    /**
     * @return int
     */
    public function getTicketId(): int
    {
        return $this->ticketId;
    }

    /**
     * @param int $ticketId
     * @return ReplyTicketForm
     */
    public function setTicketId(int $ticketId): self
    {
        $this->ticketId = $ticketId;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }
}
