<?php
declare(strict_types=1);

namespace app\modules\Api\controllers;

use app\models\Tickets\TicketStatusEnum;
use app\modules\Api\Contract\Data\Collection;
use app\modules\Api\Contract\Data\Ticket;
use app\modules\Api\Contract\Data\TicketFactory;
use app\modules\Api\Contract\Form\CreateTicketForm;
use app\modules\Api\Contract\Form\ReplyTicketForm;
use app\modules\Api\Contract\RequestBody;
use app\modules\Api\Contract\Response;
use app\services\TicketsService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\Cors;
use yii\rest\Controller;
use OpenApi\Attributes as OA;


/**
 * Class TicketsController
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Api\controllers
 */
class TicketsController extends BaseApiController
{

    public function __construct($id, $module, private readonly TicketsService $ticketsService, $config = [])
    {
        $this->serializer = Yii::$app->get('serializer');
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors() ?? [];

        $behaviors['authenticator']['except'] = ['options'];
        return $behaviors;
    }

    public function optionalAuth(): array
    {
        return ['create'];
    }

    #[OA\Get(
        path: '/requests',
        operationId: 'list',
        description: 'Возвращает список заявок',
        summary: 'Список заявок',
        security: [['BearerAuth' => []]],
        tags: ['tickets']
    )]
    #[OA\Parameter(name: 'page', description: 'Страница', in: 'query', required: false, example: 1)]
    #[OA\Parameter(
        name: 'status',
        description: 'Статус',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'string', enum: TicketStatusEnum::class),
        example: TicketStatusEnum::Active->name
    )]
    #[Response\Collection(Ticket::class)]
    public function actionList(): Collection
    {
        return new Collection(new ActiveDataProvider([
            'query' => \app\models\Tickets\Ticket::repository()->findAllByStatus($this->request->get('status')),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]), new TicketFactory());
    }

    #[OA\Post(
        path: '/requests',
        operationId: 'create',
        description: 'Создает заявку',
        tags: ['tickets']
    )]
    #[RequestBody(CreateTicketForm::class)]
    #[Response\OK]
    public function actionCreate(): array|\app\models\Tickets\Ticket
    {
        $form = new CreateTicketForm();
        $form->load(Yii::$app->request->post(), '');

        return $form->validate() ? $this->ticketsService->create($form) : $form->getErrors();
    }

    #[OA\Put(
        path: '/requests/{id}',
        operationId: 'reply',
        description: 'Ответ на заявку',
        tags: ['tickets']
    )]
    #[OA\Parameter(
        name: 'id',
        description: 'ID заявки',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'integer')
    )]
    #[RequestBody(ReplyTicketForm::class)]
    #[Response\OK]
    #[Response\NotFound]
    public function actionReply(int $id): array|\app\models\Tickets\Ticket
    {
        $form = new ReplyTicketForm();
        $form->load(Yii::$app->request->post(), '');
        $form->setTicketId($id);

        return $form->validate() ? $this->ticketsService->reply($form) : $form->getErrors();
    }

    public function actionOptions(): null
    {
        return null;
    }
}
