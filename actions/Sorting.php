<?php

namespace kotchuprik\sortable\actions;

use yii\base\Action;
use yii\db\ActiveQuery;
use yii\web\BadRequestHttpException;

class Sorting extends Action
{
    /** @var ActiveQuery */
    public $query;

    /** @var string */
    public $orderAttribute = 'order';

    /** @var string */
    public $pk = 'id';

    /** @var int */
    public $startOrder = 0;

    public function run()
    {
        $transaction = \Yii::$app->db->beginTransaction();
        $offset = \Yii::$app->request->post('offset');
        try {
            foreach (\Yii::$app->request->post('sorting') as $order => $id) {
                $query = clone $this->query;
                $model = $query->andWhere([$this->pk => $id])->one();
                if ($model === null) {
                    throw new BadRequestHttpException();
                }
                $model->{$this->orderAttribute} = $offset + $order + $this->startOrder;
                $model->update(false, [$this->orderAttribute]);
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
    }
}
