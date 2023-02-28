<?php

namespace siswa\models;

use common\models\Siswa;
use common\models\SiswaWali;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Wali;

/**
 * WaliSearch represents the model behind the search form about `common\models\Wali`.
 */
class WaliSearch extends Wali
{
    public $status_wali;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_status_wali'], 'integer'],
            [['nama', 'alamat', 'no_hp', 'status_wali'], 'safe'],
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
        $query = Wali::find()->joinWith('statusWali');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['nama', 'alamat', 'no_hp', 'status_wali']],
        ]);

        // $dataProvider->sort->attributes['cari_status_wali'] = [
        //     'asc' => ['ref_status_wali.status_wali' => SORT_ASC],
        //     'desc' => ['ref_status_wali.status_wali' => SORT_DESC],
        //     ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'wali.id' => $this->id,
            'id_status_wali' => $this->id_status_wali,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'LOWER(status_wali)', strtoLower($this->status_wali)]);

        return $dataProvider;
    }
}