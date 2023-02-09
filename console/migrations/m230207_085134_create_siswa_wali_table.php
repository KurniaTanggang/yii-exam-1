<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%siswa_wali}}`.
 */
class m230207_085134_create_siswa_wali_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%siswa_wali}}', [
            'id_siswa' => $this->integer(),
            'id_wali' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%siswa_wali}}');
    }
}