<?php

namespace kotchuprik\sortable\assets;

use yii\web\AssetBundle;

class WidgetCdnAsset extends AssetBundle
{
    public $sourcePath = '@vendor/kotchuprik/yii2-sortable-widgets/assets/files';

    public $js = [
        'js/jquery.binding.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'kotchuprik\sortable\assets\RubaxaCdnAsset',
    ];
}
