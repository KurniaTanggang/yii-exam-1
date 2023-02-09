<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%siswa}}`.
 */
class m230207_084939_create_siswa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%siswa}}', [
            'id' => $this->primaryKey(),
            'nis' => $this->string(10),
            'nama' => $this->string(255),
            'alamat' => $this->text(),
            'id_kelas' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%siswa}}');
    }
}