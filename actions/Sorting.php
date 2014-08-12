<?php

namespace kotchuprik\sortable\actions;

use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\HttpException;

class Sorting extends \yii\base\Action
{
    /** @var Query */
    public $query;

    /** @var string */
    public $orderAttribute = 'order';

    public function run()
    {
        $prev = \Yii::$app->request->post('prev_index');
        $new = \Yii::$app->request->post('new_index');

        $draggedQuery = clone $this->query;

        /** @var ActiveRecord $dragged */
        $dragged = $draggedQuery->where(['id' => \Yii::$app->request->post('dragged')])->one();
        if ($dragged === null) {
            throw new HttpException(400, 'Dragged model not found.');
        }

        if ($prev < $new) {
            for ($order = $prev; $order <= $new; $order++) {
                $currentQuery = clone $this->query;

                /** @var ActiveRecord $model */
                $model = $currentQuery->andWhere([$this->orderAttribute => $order])->one();
                $model->{$this->orderAttribute}--;
                $model->update(false, [$this->orderAttribute]);
            }
        } else {
            for ($order = $prev; $order >= $new; $order--) {
                $currentQuery = clone $this->query;

                /** @var ActiveRecord $model */
                $model = $currentQuery->andWhere([$this->orderAttribute => $order])->one();
                $model->{$this->orderAttribute}++;
                $model->update(false, [$this->orderAttribute]);
            }
        }

        $dragged->{$this->orderAttribute} = $new;
        $dragged->update(false, [$this->orderAttribute]);
    }
}
