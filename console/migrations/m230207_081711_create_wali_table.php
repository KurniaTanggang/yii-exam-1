<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wali}}`.
 */
class m230207_081711_create_wali_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wali}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(255),
            'alamat' => $this->text(),
            'no_hp' => $this->string(15),
            'id_status_wali' => $this->tinyInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wali}}');
    }
}