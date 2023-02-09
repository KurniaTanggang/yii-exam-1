<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_jurusan}}`.
 */
class m230209_045117_create_ref_jurusan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_jurusan}}', [
            'id' => $this->primaryKey(),
            'jurusan' => $this->string(10),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ref_jurusan}}');
    }
}