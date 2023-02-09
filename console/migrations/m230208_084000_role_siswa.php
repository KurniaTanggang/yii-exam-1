<?php

use yii\db\Migration;

/**
 * Class m230208_084000_role_siswa
 */
class m230208_084000_role_siswa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'auth_item',
            [
                'name',
                'type',
                'description',
                'rule_name',
                'data',
                'created_at',
                'updated_at'
            ],
            [
                [
                    'Siswa', 1, NULL, NULL, NULL, time(), time()
                ],
            ]
        );

        $this->batchInsert(
            'auth_assignment',
            [
                'item_name',
                'user_id',
                'created_at',
            ],
            [
                [
                    'Siswa',
                    '4',
                    NULL
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230208_084000_role_siswa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230208_084000_role_siswa cannot be reverted.\n";

        return false;
    }
    */
}
