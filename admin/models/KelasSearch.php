<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Kelas;

/**
 * KelasSearch represents the model behind the search form about `common\models\Kelas`.
 */
class KelasSearch extends Kelas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas', 'id_jurusan'], 'integer'],
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
        $query = Kelas::find();

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
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'id_tingkat' => $this->id_tingkat,
            'id_wali_kelas' => $this->id_wali_kelas,
            'id_jurusan' => $this->id_jurusan,
        ]);

        $query->andFilterWhere(['like', 'nama_kelas', $this->nama_kelas]);

        return $dataProvider;
    }
}
