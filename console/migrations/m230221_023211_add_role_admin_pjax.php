<?php

use yii\db\Migration;

/**
 * Class m230221_023211_add_role_admin_pjax
 */
class m230221_023211_add_role_admin_pjax extends Migration
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
                    '/pjax-guru/*', 2, NULL, NULL, NULL, time(), time()
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
                    'Admin', '/pjax-guru/*'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230221_023211_add_role_admin_pjax cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230221_023211_add_role_admin_pjax cannot be reverted.\n";

        return false;
    }
    */
}