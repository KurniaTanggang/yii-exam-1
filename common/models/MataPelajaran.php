<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mata_pelajaran".
 *
 * @property int $id
 * @property string|null $mata_pelajaran
 * @property int|null $id_tingkat_kelas
 * @property int|null $id_jurusan
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
            [['id_tingkat_kelas', 'id_jurusan'], 'default', 'value' => null],
            [['id_tingkat_kelas', 'id_jurusan'], 'integer'],
            [['mata_pelajaran'], 'string', 'max' => 125],
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
            'id_tingkat_kelas' => 'Id Tingkat Kelas',
            'id_jurusan' => 'Id Jurusan',
        ];
    }

    public function getRefTingkatKelas()
    {
        return $this->hasOne(RefTingkatKelas::className(), ['id' => 'id_tingkat_kelas']);
    }

    public function getRefJurusan()
    {
        return $this->hasOne(RefJurusan::className(), ['id' => 'id_jurusan']);
    }
}