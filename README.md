# Yii2 Sortable widgets

[![Join the chat at https://gitter.im/kotchuprik/yii2-sortable-widgets](https://badges.gitter.im/kotchuprik/yii2-sortable-widgets.svg)](https://gitter.im/kotchuprik/yii2-sortable-widgets?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Implementation Rubaxa/Sortable for Yii2 widgets.

Supported:

- GridView widget.

![demo](https://hsto.org/files/60e/e7a/ced/60ee7aced7794a638d0a6365062397ad.gif)

[![Latest Stable Version](https://poser.pugx.org/kotchuprik/yii2-sortable-widgets/v/stable)](https://packagist.org/packages/kotchuprik/yii2-sortable-widgets)
[![Total Downloads](https://poser.pugx.org/kotchuprik/yii2-sortable-widgets/downloads)](https://packagist.org/packages/kotchuprik/yii2-sortable-widgets)
[![Monthly Downloads](https://poser.pugx.org/kotchuprik/yii2-sortable-widgets/d/monthly)](https://packagist.org/packages/kotchuprik/yii2-sortable-widgets)
[![Latest Unstable Version](https://poser.pugx.org/kotchuprik/yii2-sortable-widgets/v/unstable)](https://packagist.org/packages/kotchuprik/yii2-sortable-widgets)
[![License](https://poser.pugx.org/kotchuprik/yii2-sortable-widgets/license)](https://packagist.org/packages/kotchuprik/yii2-sortable-widgets)

## Usage

Create a new migration, change a parent to the migration class from the extension and specify the table name property:

```php
class m140811_131705_Models_order extends \kotchuprik\sortable\migrations\Migration
{
    protected $tableName = 'models';
}
```

Add the sortable behavior to your model and specify the query property:

```php
public function behaviors()
{
    return [
        'sortable' => [
            'class' => \kotchuprik\sortable\behaviors\Sortable::className(),
            'query' => self::find(),
        ],
    ];
}
```

Add the sorting action to your controller and specify the query property:

```php
public function actions()
{
    return [
        'sorting' => [
            'class' => \kotchuprik\sortable\actions\Sorting::className(),
            'query' => \vendor\namespace\Model::find(),
        ],
    ];
}
```

If you're using another primary key (not 'id'), you must specify it in 'pk' parameter:

```php
public function actions()
{
    return [
        'sorting' => [
            'class' => \kotchuprik\sortable\actions\Sorting::className(),
            'query' => \vendor\namespace\Model::find(),
            'pk' => 'modelField'
        ],
    ];
}
```

Add the column to your grid view and specify the sorting url like here:

```php
echo \yii\grid\GridView::widget([
    'dataProvider' => $model->search(),
    'rowOptions' => function ($model, $key, $index, $grid) {
        return ['data-sortable-id' => $model->id];
    },
    'columns' => [
        [
            'class' => \kotchuprik\sortable\grid\Column::className(),
        ],
        'id',
        'title',
        'order',
    ],
    'options' => [
        'data' => [
            'sortable-widget' => 1,
            'sortable-url' => \yii\helpers\Url::toRoute(['sorting']),
        ]
    ],
]);
```

If cdn is not accessible in your country, you can use Sortable library from local dependencies:

```php
...
    'columns' => [
        [
            'class' => \kotchuprik\sortable\grid\Column::className(),
            'useCdn' => false
        ],
        ...
    ],
...
```
