<?php

namespace kotchuprik\sortable\assets;

use yii\web\AssetBundle;

class RubaxaAsset extends AssetBundle
{
    public $sourcePath = '@bower/Sortable';

    public $js = [
        'Sortable.js',
        'jquery.binding.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
