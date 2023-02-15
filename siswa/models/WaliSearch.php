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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_status_wali'], 'integer'],
            [['nama', 'alamat', 'no_hp'], 'safe'],
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
        // $siswa = Siswa::find()->where(['id_user' => Yii::$app->user->id])->one();
        // $waliSiswa = SiswaWali::find()->where(['id_siswa' => $siswa->id])->one();
        // if($waliSiswa)
        //     $query = Wali::find()->where(['id' => $waliSiswa->id_wali ]);
        // else
        //     return array();
        $query = Wali::find();


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
            'id_status_wali' => $this->id_status_wali,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp]);

        return $dataProvider;
    }
}