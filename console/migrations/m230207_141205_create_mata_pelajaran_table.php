<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mata_pelajaran}}`.
 */
class m230207_141205_create_mata_pelajaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mata_pelajaran}}', [
            'id' => $this->primaryKey(),
            'mata_pelajaran' => $this->string(25),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mata_pelajaran}}');
    }
}
