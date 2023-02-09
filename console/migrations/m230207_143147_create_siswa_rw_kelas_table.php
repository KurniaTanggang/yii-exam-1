<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%siswa_rw_kelas}}`.
 */
class m230207_143147_create_siswa_rw_kelas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%siswa_rw_kelas}}', [
            'id' => $this->primaryKey(),
            'id_siswa' => $this->integer(),
            'id_kelas' => $this->integer(),
            'tahun_ajaran' => $this->string(25),
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
        $this->dropTable('{{%siswa_rw_kelas}}');
    }
}
