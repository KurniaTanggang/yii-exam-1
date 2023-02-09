<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "siswa_rw_kelas".
 *
 * @property int $id
 * @property int|null $id_siswa
 * @property int|null $id_kelas
 * @property string|null $tahun_ajaran
 * @property string|null $nama_kelas
 * @property int|null $id_tingkat
 * @property int|null $id_wali_kelas
 */
class SiswaRwKelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siswa_rw_kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_siswa', 'id_kelas', 'id_tingkat', 'id_wali_kelas'], 'default', 'value' => null],
            [['id_siswa', 'id_kelas', 'id_tingkat', 'id_wali_kelas'], 'integer'],
            [['tahun_ajaran', 'nama_kelas'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_siswa' => 'Id Siswa',
            'id_kelas' => 'Id Kelas',
            'tahun_ajaran' => 'Tahun Ajaran',
            'nama_kelas' => 'Nama Kelas',
            'id_tingkat' => 'Id Tingkat',
            'id_wali_kelas' => 'Id Wali Kelas',
        ];
    }
}
