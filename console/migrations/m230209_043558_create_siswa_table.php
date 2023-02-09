<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%siswa}}`.
 */
class m230209_043558_create_siswa_table extends Migration
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
            'tempat_lahir' => $this->string(255),
            'tanggal_lahir' => $this->date(),
            'alamat' => $this->text(),
            'id_kelas' => $this->integer(),
            'id_user' => $this->integer(),
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