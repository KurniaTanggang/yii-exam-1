<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mata_pelajaran".
 *
 * @property int $id
 * @property string|null $mata_pelajaran
 */
class MataPelajaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mata_pelajaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mata_pelajaran'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mata_pelajaran' => 'Mata Pelajaran',
        ];
    }
}
