<?php

use app\assets\SwaggerUIAsset;
use yii\helpers\Inflector;

/** @var yii\web\View $this */
/** @var string $module */
/** @var string $url */

SwaggerUIAsset::register($this);

$js = <<<SCRIPT
window.onload = function() {
  window.ui = SwaggerUIBundle({
    url: "$url",
    dom_id: '#swagger-ui',
    deepLinking: true,
    defaultModelsExpandDepth: 0,
    presets: [
      SwaggerUIBundle.presets.apis
    ]
  })
}
SCRIPT;

$this->registerJs($js);

$css = <<<STYLE
body { margin: 0 }
.swagger-ui table.model tbody tr td:first-of-type { padding-top: 10px }
.swagger-ui .model-title { font-size: 14px }
.swagger-ui .model .description p { margin: 0; padding-top: 10px } 
.swagger-ui .model p { font-size: 12px } 
STYLE;

$this->registerCss($css);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= strip_tags(Yii::$app->name) ?> - <?= Inflector::camel2words($module) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="swagger-ui"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
