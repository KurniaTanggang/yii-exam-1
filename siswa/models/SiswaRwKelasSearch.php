<?php

namespace siswa\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SiswaRwKelas;

/**
 * SiswaRwKelasSearch represents the model behind the search form about `common\models\SiswaRwKelas`.
 */
class SiswaRwKelasSearch extends SiswaRwKelas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_siswa', 'id_kelas', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas'], 'integer'],
            [['nama_kelas'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SiswaRwKelas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_siswa' => $this->id_siswa,
            'id_kelas' => $this->id_kelas,
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'id_tingkat' => $this->id_tingkat,
            'id_wali_kelas' => $this->id_wali_kelas,
        ]);

        $query->andFilterWhere(['like', 'nama_kelas', $this->nama_kelas]);

        return $dataProvider;
    }
}
