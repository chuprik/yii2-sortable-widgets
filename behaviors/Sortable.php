<?php

namespace kotchuprik\sortable\behaviors;

use yii\db\ActiveRecord;
use yii\db\Query;

class Sortable extends \yii\base\Behavior
{
    /** @var Query */
    public $query;

    /** @var string */
    public $orderAttribute = 'order';

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    public function beforeInsert()
    {
        $last = $this->query->orderBy([$this->orderAttribute => SORT_DESC])->limit(1)->one();
        if ($last === null) {
            $this->owner->{$this->orderAttribute} = 1;
        } else {
            $this->owner->{$this->orderAttribute} = $last->{$this->orderAttribute} + 1;
        }
    }

    public function afterDelete()
    {
        /** @var ActiveRecord[] $models */
        $models = $this->query->where(':attributeName > :attributeValue', [
            ':attributeName' => $this->orderAttribute,
            ':attributeValue' => $this->{$this->orderAttribute}
        ])->all();
        foreach ($models as $model) {
            $model->{$this->orderAttribute}--;
            $model->update(false, [$this->orderAttribute]);
        }
    }
}
