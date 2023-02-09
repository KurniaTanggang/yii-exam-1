<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ref_jurusan".
 *
 * @property int $id
 * @property string|null $jurusan
 */
class RefJurusan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_jurusan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jurusan'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jurusan' => 'Jurusan',
        ];
    }
}
