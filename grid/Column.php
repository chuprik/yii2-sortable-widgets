<?php

namespace kotchuprik\sortable\grid;

use kotchuprik\sortable\assets\SortableAsset;
use kotchuprik\sortable\assets\WidgetCdnAsset;
use kotchuprik\sortable\assets\WidgetLocalAsset;
use yii\helpers\Html;
use yii\web\View;

class Column extends \yii\grid\Column
{
    public $headerOptions = ['style' => 'width: 30px;'];

    public $useCdn = true;

    public function init()
    {
        if ($this->useCdn) {
            WidgetCdnAsset::register($this->grid->view);
        } else {
            WidgetLocalAsset::register($this->grid->view);
        }
        SortableAsset::register($this->grid->view);
        $this->grid->view->registerJs('initSortableWidgets();', View::POS_READY, 'sortable');
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        $offset = 0;

        if ($this->grid->dataProvider->pagination) {
            $offset = $this->grid->dataProvider->pagination->pageSize * $this->grid->dataProvider->pagination->page;
        }
        
        return Html::tag('div', '&#9776;', [
            'class' => 'sortable-widget-handler',
            'data-id' => $model->getPrimaryKey(),
            'data-offset' => $offset
        ]);
    }
}
