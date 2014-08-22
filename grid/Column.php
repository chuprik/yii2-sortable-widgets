<?php

namespace kotchuprik\sortable\grid;

use kotchuprik\sortable\assets\Asset;
use yii\helpers\Html;
use yii\helpers\Url;

class Column extends \yii\grid\Column
{
    public $headerOptions = ['style' => 'width: 30px;'];
    public $sortingUrl;

    public function init()
    {
        Asset::register($this->grid->view);
        $this->grid->tableOptions['data-sorting-url'] = Url::to($this->sortingUrl);
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        return Html::tag('div', '&#9776;', [
            'data-sortable' => 'table',
            'class' => 'sw-handler',
        ]);
    }
}
