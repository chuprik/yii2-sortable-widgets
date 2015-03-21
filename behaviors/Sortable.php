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
        $nextModel = $this->query->where('`' . $this->orderAttribute . '` > :attributeValue', [
            ':attributeValue' => $this->owner->{$this->orderAttribute}
        ])->orderBy([$this->orderAttribute => SORT_ASC])->one();
        if ($nextModel !== null) {
            $difference = $nextModel->{$this->orderAttribute} - $this->owner->{$this->orderAttribute};
            /** @var static[] $models */
            $models = $this->query->where('`' . $this->orderAttribute . '` > :attributeValue', [
                ':attributeValue' => $this->owner->{$this->orderAttribute}
            ])->all();
            foreach ($models as $model) {
                $model->{$this->orderAttribute} = $model->{$this->orderAttribute} - $difference;
                $model->update(false, [$this->orderAttribute]);
            }
        }
    }
}
