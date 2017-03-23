<?php

use yii\base\InvalidConfigException;
use yii\db\Migration;
use yii\log\DbTarget;

/**
 * Handles the creation for table `log_table`.
 */
class m120609_072801_create_log_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('log', [
            'id' => $this->bigPrimaryKey(),
            'level' => $this->integer(),
            'category' => $this->string(),
            'log_time' => $this->double(),
            'prefix' => $this->text(),
            'message' => $this->text(),
        ], $tableOptions);

        $this->createIndex('idx_log_level', 'log', 'level');
        $this->createIndex('idx_log_category', 'log', 'category');

    }

    public function down()
    {
        $this->dropTable('log');
    }
}
