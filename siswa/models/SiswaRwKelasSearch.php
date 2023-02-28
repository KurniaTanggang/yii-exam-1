<?php

namespace siswa\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SiswaRwKelas;
use common\models\Siswa;

/**
 * SiswaRwKelasSearch represents the model behind the search form about `common\models\SiswaRwKelas`.
 */
class SiswaRwKelasSearch extends SiswaRwKelas
{
    public $tahun_ajaran;
    public $tingkat_kelas;
    public $nama_guru;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_siswa', 'id_kelas', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas'], 'integer'],
            [['nama_kelas', 'tahun_ajaran', 'tingkat_kelas', 'nama_guru'], 'safe'],
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
        $siswa = Siswa::find()->where(['id_user' => Yii::$app->user->id])->one();
        $query = SiswaRwKelas::find()->where(['id_siswa' => $siswa->id]);

        $query->joinWith('refTahunAjaran')
              ->joinWith('kelas.refTingkatKelas')
              ->joinWith('kelas.namaGuru');
              
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['tahun_ajaran', 'nama_kelas', 'tingkat_kelas', 'nama_guru']],
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
            // 'id_tahun_ajaran' => $this->id_tahun_ajaran,
            // 'id_tingkat' => $this->id_tingkat,
            // 'id_wali_kelas' => $this->id_wali_kelas,
        ]);

        $query->andFilterWhere(['like', 'LOWER(siswa_rw_kelas.nama_kelas)', strtolower($this->nama_kelas)])
              ->andFilterWhere(['like', 'tahun_ajaran', $this->tahun_ajaran])
              ->andFilterWhere(['like', 'LOWER(tingkat_kelas)', strtolower($this->tingkat_kelas)])
              ->andFilterWhere(['like', 'LOWER(nama_guru)', strtolower($this->nama_guru)]);

        return $dataProvider;
    }
}