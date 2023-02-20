<?php

use yii\db\Migration;

/**
 * Class m230220_080306_role_guru
 */
class m230220_080306_role_guru extends Migration
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
                    'Guru', 1, NULL, NULL, NULL, time(), time()
                ],
                [
                    '/daftar-siswa/*', 2, NULL, NULL, NULL, time(), time()
                ],
                [
                    '/guru-mata-pelajaran/*', 2, NULL, NULL, NULL, time(), time()
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
                    'Guru', '/daftar-siswa/*'
                ],
                [
                    'Guru', '/mata-pelajaran/*'
                ],
                [
                    'Guru', '/guru-mata-pelajaran/*'
                ],
                [
                    'Guru', '/kelas/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230220_080306_role_guru cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230220_080306_role_guru cannot be reverted.\n";

        return false;
    }
    */
}