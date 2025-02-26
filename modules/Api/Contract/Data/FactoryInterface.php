<?php
declare(strict_types=1);

namespace app\modules\Api\Contract\Data;

use yii\base\Model;

interface FactoryInterface
{
    public function createFromModel(Model $model): mixed;
}
