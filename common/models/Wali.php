<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wali".
 *
 * @property int $id
 * @property string|null $nama
 * @property string|null $alamat
 * @property string|null $no_hp
 * @property int|null $id_status_wali
 */
class Wali extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wali';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat'], 'string'],
            [['id_status_wali'], 'default', 'value' => null],
            [['id_status_wali'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['no_hp'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'no_hp' => 'No Hp',
            'id_status_wali' => 'Id Status Wali',
        ];
    }
}
