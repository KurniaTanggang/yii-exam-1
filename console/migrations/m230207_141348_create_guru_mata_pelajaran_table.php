<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%guru_mata_pelajaran}}`.
 */
class m230207_141348_create_guru_mata_pelajaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%guru_mata_pelajaran}}', [
            'id_guru' => $this->integer(),
            'id_mata_pelajaran' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%guru_mata_pelajaran}}');
    }
}
