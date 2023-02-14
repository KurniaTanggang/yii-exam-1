<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "siswa_wali".
 *
 * @property int|null $id_siswa
 * @property int|null $id_wali
 */
class SiswaWali extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siswa_wali';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_siswa', 'id_wali'], 'default', 'value' => null],
            [['id_siswa', 'id_wali'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_siswa' => 'Id Siswa',
            'id_wali' => 'Id Wali',
        ];
    }

    public function getNamaSiswa()
    {
        return $this->hasOne(Siswa::className(), ['id' => 'id_siswa']);
    }
    public function getWaliSiswa()
    {
        return $this->hasOne(Wali::className(), ['id' => 'id_wali']);
    }
}