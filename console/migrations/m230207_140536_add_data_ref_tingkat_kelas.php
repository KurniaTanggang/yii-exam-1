<?php

use yii\db\Migration;

/**
 * Class m230207_140536_add_data_ref_tingkat_kelas
 */
class m230207_140536_add_data_ref_tingkat_kelas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'ref_tingkat_kelas',
            [
                'tingkat_kelas',
            ],
            [
                ['X'],
                ['XI'],
                ['XII'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230207_140536_add_data_ref_tingkat_kelas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230207_140536_add_data_ref_tingkat_kelas cannot be reverted.\n";

        return false;
    }
    */
}
