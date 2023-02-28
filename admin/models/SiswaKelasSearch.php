<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Kelas;

/**
 * SiswaKelasSearch represents the model behind the search form about `common\models\Kelas`.
 */
class SiswaKelasSearch extends Kelas
{
    public $tahun_ajaran;
    public $tingkat_kelas;
    public $jurusan;
    public $nama_guru;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas', 'id_jurusan'], 'integer'],
            [['nama_kelas', 'tahun_ajaran', 'tingkat_kelas', 'jurusan', 'nama_guru'], 'safe'],
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
        $query = Kelas::find()->joinWith('refTahunAjaran')
                              ->joinWith('refTingkatKelas')
                              ->joinWith('refJurusan')
                              ->joinWith('namaGuru');

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

        $query->andFilterWhere(['like', 'LOWER(nama_kelas)', strtolower($this->nama_kelas)])
              ->andFilterWhere(['like', 'tahun_ajaran', $this->tahun_ajaran])
              ->andFilterWhere(['like', 'LOWER(tingkat_kelas)', strtolower($this->tingkat_kelas)])
              ->andFilterWhere(['like', 'LOWER(jurusan)', strtolower($this->jurusan)])
              ->andFilterWhere(['like', 'LOWER(nama_guru)', strtolower($this->nama_guru)]);


        return $dataProvider;
    }
}