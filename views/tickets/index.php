<?php
declare(strict_types=1);


use yii\data\ActiveDataProvider;
use yii\web\View;

/* @var View $this */
/* @var ActiveDataProvider $dataProvider */
?>

<?=
    \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
    ])
?>