# Yii2 Sortable widgets

Implementation the jQuery UI Sortable for Yii2 widgets.

Supported:

- GridView widget.

## Usage

Create new migration, change parent to the migration class from the extension and specify the table name:

```php
class m140811_131705_Models_order extends \kotchuprik\sortable\migrations\Migration
{
    protected $tableName = 'models';
}
```

Add Sortable behavior to your model and specify the query:

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

Add Sorting action to your controller and specify the query:

```php
public function actions()
{
    return [
        'sorting' => [
            'class' => Sorting::className(),
            'query' => Model::find(),
        ],
    ];
}
```

Add column from the extension to widget call of GridView and specify the sorting url:

```php
echo \yii\grid\GridView::widget([
    'dataProvider' => $model->search(),
    'columns' => [
        [
            'class' => \kotchuprik\sortable\grid\Column::className(),
            'sortingUrl' => ['sorting']
        ],
        'id',
        'title',
        'order',
    ],
]);
```
