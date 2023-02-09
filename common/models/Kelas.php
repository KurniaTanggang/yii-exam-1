<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property int $id
 * @property string|null $nama_kelas
 * @property int|null $id_tingkat
 * @property int|null $id_wali_kelas
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tingkat', 'id_wali_kelas'], 'default', 'value' => null],
            [['id_tingkat', 'id_wali_kelas'], 'integer'],
            [['nama_kelas'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_kelas' => 'Nama Kelas',
            'id_tingkat' => 'Id Tingkat',
            'id_wali_kelas' => 'Id Wali Kelas',
        ];
    }
}
