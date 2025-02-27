<?php

declare(strict_types=1);

namespace app\modules\Swagger\controllers;

use OpenApi\Generator;
use Yii;
use yii\base\Module;
use yii\caching\FileDependency;
use yii\helpers\Url;
use yii\web\{Controller, NotFoundHttpException, Response};

/**
 * Class DefaultController
 *
 * @author snowball <snow-snowball@yandex.ru>
 * @package app\modules\Swagger\controllers
 */
class DefaultController extends Controller
{
    public $layout = false;

    /**
     * Страница документации апи.
     *
     * @param string $moduleId Название модуля.
     * @return Response Объект ответа.
     * @throws NotFoundHttpException Если модуль не зарегистрирован.
     */
    public function actionIndex(string $moduleId): Response
    {
        $module = $this->getModule($moduleId);

        $this->response->format = Response::FORMAT_HTML;
        $this->response->content = $this->render('index', [
            'module' => $module->getUniqueId(),
            'url' => Url::to(['schema', 'moduleId' => $module->id]),
        ]);

        return $this->response;
    }

    /**
     * Спецификация Open Api в формате yaml.
     *
     * @param string $moduleId Название модуля.
     * @return Response Объект ответа.
     * @throws NotFoundHttpException Если модуль не зарегистрирован.
     */
    public function actionSchema(string $moduleId): Response
    {
        $module = $this->getModule($moduleId);

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->set('Content-Type', 'application/x-yaml');
        $response->content = $this->generate($module);

        return $response;
    }

    /**
     * Генерирует спецификацию Open Api в формате yaml и кеширует результат.
     * В последующие вызовы берет результат из кеша.
     *
     * @param Module $module Модуль апи.
     * @return string Спецификация Open Api в формате yaml.
     */
    private function generate(Module $module): string
    {
        define('API_VERSION', $module->version);
        define('SERVER_URL', Url::base(true) . "/$module->uniqueId");

        return Generator::scan([$module->basePath])->toYaml();
        return Yii::$app->cache->getOrSet([$module->uniqueId, 'swagger'], function () use ($module) {
            define('API_VERSION', $module->version);
            define('SERVER_URL', "/requests");

            return Generator::scan([$module->basePath])->toYaml();
        }, 0, new FileDependency(['fileName' => $module->basePath]));
    }

    /**
     * Возвращает объект модуля.
     *
     * @param string $id Идентификатор модуля.
     * @return Module Объект модуля.
     * @throws NotFoundHttpException Если модуль не зарегистрирован.
     */
    private function getModule(string $id): Module
    {
        return Yii::$app->getModule($id)
            ?? throw new NotFoundHttpException('Страница не найдена.');
    }
}
