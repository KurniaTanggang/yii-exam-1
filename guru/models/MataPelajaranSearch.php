<?php

namespace guru\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MataPelajaran;

/**
 * MataPelajaranSearch represents the model behind the search form about `common\models\MataPelajaran`.
 */
class MataPelajaranSearch extends MataPelajaran
{
    public $cari_kelas;
    public $cari_jurusan;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tingkat_kelas', 'id_jurusan'], 'integer'],
            [['mata_pelajaran', 'cari_kelas', 'cari_jurusan'], 'safe'],
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
        $query = MataPelajaran::find()->joinWith('refTingkatKelas')->joinWith('refJurusan');

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
            'id_tingkat_kelas' => $this->id_tingkat_kelas,
            'id_jurusan' => $this->id_jurusan,
        ]);

        $query->andFilterWhere(['like', 'LOWER(mata_pelajaran)', strtolower($this->mata_pelajaran)])
              ->andFilterWhere(['like', 'LOWER(tingkat_kelas)', strtolower($this->cari_kelas)])
              ->andFilterWhere(['like', 'LOWER(jurusan)', strtolower($this->cari_jurusan)]);

        return $dataProvider;
    }
}