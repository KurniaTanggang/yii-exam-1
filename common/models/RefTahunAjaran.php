<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ref_tahun_ajaran".
 *
 * @property int $id
 * @property string|null $tahun_ajaran
 */
class RefTahunAjaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_tahun_ajaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun_ajaran'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun_ajaran' => 'Tahun Ajaran',
        ];
    }
}
