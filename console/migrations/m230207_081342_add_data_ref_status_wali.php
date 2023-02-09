<?php

use yii\db\Migration;

/**
 * Class m230207_081342_add_data_ref_status_wali
 */
class m230207_081342_add_data_ref_status_wali extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'ref_status_wali',
            [
                'status_wali',
            ],
            [
                ['Ayah kandung'],
                ['Ibu kandung'],
                ['Keluarga'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230207_081342_add_data_ref_status_wali cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230207_081342_add_data_ref_status_wali cannot be reverted.\n";

        return false;
    }
    */
}