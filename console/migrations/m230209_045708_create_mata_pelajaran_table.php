<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mata_pelajaran}}`.
 */
class m230209_045708_create_mata_pelajaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mata_pelajaran}}', [
            'id' => $this->primaryKey(),
            'mata_pelajaran' => $this->string(125),
            'id_tingkat_kelas' => $this->integer(),
            'id_jurusan' => $this->integer(),
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