<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GuruMataPelajaran;

/**
 * GuruMapelSearch represents the model behind the search form about `common\models\GuruMataPelajaran`.
 */
class GuruMapelSearch extends GuruMataPelajaran
{
    public $cari_guru;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_guru', 'id_mata_pelajaran'], 'integer'],
            // [['id_guru', 'id_mata_pelajaran'], 'safe'],
            [['cari_guru'], 'safe'],
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
        $query = GuruMataPelajaran::find()->joinWith('namaGuru');
        
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
            'id_guru' => $this->id_guru,
            'id_mata_pelajaran' => $this->id_mata_pelajaran,
            // 'cari_guru' => $this->id_guru,
        ]);

        $query->andFilterWhere(['like', 'LOWER(nama_guru)', strtolower($this->cari_guru)]);

        return $dataProvider;
    }
}