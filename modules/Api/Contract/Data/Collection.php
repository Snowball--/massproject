<?php

declare(strict_types=1);

namespace app\modules\Api\Contract\Data;

use app\modules\Api\Contract\Data\FactoryInterface;
use yii\data\DataProviderInterface;
use yii\data\Pagination;
use yii\data\Sort;

/**
 * Коллекция объектов.
 *
 * Декорирует оригинальный дата-провайдер, чтобы возвращать контрактные модели
 * вместо оригинальных.
 *
 * @template T
 *
 * @author snowball <snow-snowball@yandex.ru>
 */
class Collection implements DataProviderInterface
{
    /**
     * @var array<int, T> Список объектов.
     */
    private array $items = [];

    /**
     * Конструктор.
     *
     * @param DataProviderInterface $dataProvider Оригинальный дата-провайдер.
     * @param FactoryInterface $factory Фабрика производства контрактных моделей.
     */
    public function __construct(
        protected readonly DataProviderInterface $dataProvider,
        private readonly FactoryInterface $factory,
    ) {
    }

    /**
     * @inheritdoc
     */
    public function prepare($forcePrepare = false): bool
    {
        return $this->dataProvider->prepare();
    }

    /**
     * @inheritdoc
     */
    public function getCount(): int
    {
        return $this->dataProvider->getCount();
    }

    /**
     * @inheritdoc
     */
    public function getTotalCount(): int
    {
        return $this->dataProvider->getTotalCount();
    }

    /**
     * Возвращает список моделей текущей страницы.
     *
     * @return array<int, T>
     */
    public function getModels(): array
    {
        if ($this->items) {
            return $this->items;
        }

        $this->items = [];

        foreach ($this->dataProvider->getModels() as $model) {
            $this->items[] = $this->factory->createFromModel($model);
        }

        return $this->items;
    }

    /**
     * @inheritdoc
     */
    public function getKeys(): array
    {
        return $this->dataProvider->getKeys();
    }

    /**
     * @inheritdoc
     */
    public function getSort(): false|Sort
    {
        return $this->dataProvider->getSort();
    }

    /**
     * @inheritdoc
     */
    public function getPagination(): false|Pagination
    {
        return $this->dataProvider->getPagination();
    }
}
