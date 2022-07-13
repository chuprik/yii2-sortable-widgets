<?php

namespace kotchuprik\sortable\assets;

use yii\web\AssetBundle;

class RubaxaLocalAsset extends AssetBundle
{
    public $sourcePath = '@vendor/kotchuprik/yii2-sortable-widgets/assets/files';

    public $js = [
        'js/Sortable.min.js',
    ];
}
