<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kelas}}`.
 */
class m230207_133705_create_kelas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kelas}}', [
            'id' => $this->primaryKey(),
            'nama_kelas' => $this->string(25),
            'id_tingkat' => $this->integer(),
            'id_wali_kelas' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kelas}}');
    }
}
