<?php
declare(strict_types=1);

namespace app\modules\Api\controllers;

use app\modules\Api\Contract\Data\Collection;
use app\modules\Api\Contract\Data\TicketFactory;
use app\modules\Api\Contract\Form\CreateTicketForm;
use app\modules\Api\Contract\RequestBody;
use app\modules\Api\Contract\Response;
use app\services\TicketsService;
use Yii;
use yii\data\ActiveDataProvider;
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

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = \yii\web\Response::FORMAT_JSON;
        $behaviors['contentNegotiator']['formats']['text/html'] = \yii\web\Response::FORMAT_JSON;
        return $behaviors;
    }

    #[OA\Get(
        path: '/requests',
        operationId: 'list',
        description: 'Возвращает список заявок',
        summary: 'Список заявок',
        tags: ['tickets'],
        responses: [
            new OA\Response(response: 200, description: 'Список заявок')
        ]
    )]
    public function actionList(): Collection
    {
        return new Collection(new ActiveDataProvider([
            'query' => \app\models\Tickets\Ticket::repository()->findAll(),
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

        if ($form->validate()) {
            $response = $this->ticketsService->create($form);
        } else {
            $response = $form->getErrors();
        }
        return $response;
    }

    #[OA\Put(
        path: '/requests/{id}',
        operationId: 'reply',
        description: 'Ответ на заявку',
        tags: ['tickets']
    )]
    #[Response\OK]
    public function actionReply(int $id)
    {

    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        return $this->serializeData($result);
    }

    protected function serializeData($data)
    {
        return $this->serializer->serialize($data);
    }
}