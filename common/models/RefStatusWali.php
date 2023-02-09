<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ref_status_wali".
 *
 * @property int $id
 * @property string|null $status_wali
 */
class RefStatusWali extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_status_wali';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_wali'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_wali' => 'Status Wali',
        ];
    }
}
