<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%guru}}`.
 */
class m230207_141026_create_guru_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%guru}}', [
            'id' => $this->primaryKey(),
            'nama_guru' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%guru}}');
    }
}
