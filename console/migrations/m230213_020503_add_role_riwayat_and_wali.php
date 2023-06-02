<?php

use yii\db\Migration;

/**
 * Class m230213_020503_add_role_riwayat_and_wali
 */
class m230213_020503_add_role_riwayat_and_wali extends Migration
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
                    '/siswa-rw-kelas/*', 2, NULL, NULL, NULL, time(), time()
                ],[
                    '/wali/*', 2, NULL, NULL, NULL, time(), time()
                ],
            ]
        );

        $this->batchInsert(
            'auth_item_child',
            [
                'parent',
                'child'
            ],
            [
                [
                    'Siswa', '/siswa-rw-kelas/*'
                ],
                [
                    'Siswa', '/wali/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230213_020503_add_role_riwayat_and_wali cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230213_020503_add_role_riwayat_and_wali cannot be reverted.\n";

        return false;
    }
    */
}