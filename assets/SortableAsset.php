<?php

namespace kotchuprik\sortable\assets;

use yii\web\AssetBundle;

class SortableAsset extends AssetBundle
{
    public $sourcePath = '@vendor/kotchuprik/yii2-sortable-widgets/assets/files';

    public $js = [
        'js/sortable-widgets.js',
    ];

    public $css = [
        'css/sortable-widgets.css',
    ];

    public $depends = [
        'kotchuprik\sortable\assets\RubaxaAsset',
    ];
}
