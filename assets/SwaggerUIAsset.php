<?php

namespace app\assets;

use yii\web\AssetBundle;

class SwaggerUIAsset extends AssetBundle
{
    public $sourcePath = '@bower/swagger-ui/dist';

    public $js = [
        'swagger-ui-bundle.js',
    ];

    public $css = [
        'swagger-ui.css',
    ];
}
