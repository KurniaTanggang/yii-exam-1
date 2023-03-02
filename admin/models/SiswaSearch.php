<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Siswa;

/**
 * SiswaSearch represents the model behind the search form about `common\models\Siswa`.
 */
class SiswaSearch extends Siswa
{
    public $nama_kelas;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_kelas', 'id_user'], 'integer'],
            [['nis', 'nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'nama_kelas'], 'safe'],
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
        $query = Siswa::find()->joinWith('kelas');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['nis', 'nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'nama_kelas']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal_lahir' => $this->tanggal_lahir,
            // 'id_kelas' => $this->id_kelas,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'LOWER(nama)', strtolower($this->nama)])
            ->andFilterWhere(['like', 'LOWER(tempat_lahir)', strtolower($this->tempat_lahir)])
            ->andFilterWhere(['like', 'LOWER(alamat)', strtolower($this->alamat)])
            ->andFilterWhere(['like', 'LOWER(nama_kelas)', strtolower($this->nama_kelas)]);

        return $dataProvider;
    }
}