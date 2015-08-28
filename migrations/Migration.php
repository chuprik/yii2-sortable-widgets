<?php

namespace kotchuprik\sortable\migrations;

use yii\db\Schema;

abstract class Migration extends \yii\db\Migration
{
    protected $tableName;

    protected $attributeName = 'order';

    public function up()
    {
        $this->addColumn($this->tableName, $this->attributeName, Schema::TYPE_SMALLINT . ' NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn($this->tableName, $this->attributeName);
    }
}
