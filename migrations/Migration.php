<?php

namespace kotchuprik\sortable\migrations;

abstract class Migration extends \yii\db\Migration
{
    protected $tableName;

    protected $attributeName = 'order';

    public function up()
    {
        $this->addColumn($this->tableName, $this->attributeName, 'tinyint unsigned NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn($this->tableName, $this->attributeName);
    }
}
