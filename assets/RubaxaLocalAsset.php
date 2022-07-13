<?php

namespace kotchuprik\sortable\assets;

use yii\web\AssetBundle;

class RubaxaLocalAsset extends AssetBundle
{
    public $sourcePath = '@vendor/npm-asset/sortablejs';

    public $js = [
        'Sortable.min.js',
    ];
}
