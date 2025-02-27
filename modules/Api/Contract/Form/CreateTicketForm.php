<?php
declare(strict_types=1);

namespace app\modules\Api\Contract\Form;

use app\validator\ValidatedInterface;
use yii\base\Model;
use OpenApi\Attributes as OA;

/**
 * Class CreateTicketForm
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api\Contract\Form
 */
#[OA\Schema]
class CreateTicketForm extends Model implements ValidatedInterface
{
    #[OA\Property(example: 'Иванов Иван')]
    public string $name = '';

    #[OA\Property(example: 'foo@example.com')]
    public string $email = '';

    #[OA\Property(example: 'Описание проблемы')]
    public string $message = '';

    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'email' => 'Email',
            'message' => 'Описание проблемы',
        ];
    }

    public function rules(): array
    {
        return [
            [['name', 'email', 'message'], 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}