<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kelas}}`.
 */
class m230209_043953_create_kelas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kelas}}', [
            'id' => $this->primaryKey(),
            'id_tahun_ajaran' => $this->integer(),
            'nama_kelas' => $this->string(20),
            'id_tingkat' => $this->integer(),
            'id_wali_kelas' => $this->integer(),
            'id_jurusan' => $this->integer(),
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