<?php

namespace guru\controllers;

use common\models\Guru;
use common\models\GuruMataPelajaran;
use Yii;
use common\models\MataPelajaran;
use common\models\RefJurusan;
use common\models\RefTingkatKelas;
use guru\models\GuruMataPelajaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * GuruMataPelajaranController implements the CRUD actions for MataPelajaran model.
 */
class GuruMataPelajaranController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all MataPelajaran models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new GuruMataPelajaranSearch();

        $guru = Guru::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        
        $guruMataPelajaran = GuruMataPelajaran::find()->where(['id_guru' => $guru->id])->asArray()->all();
        $guruMataPelajaran = array_column($guruMataPelajaran, 'id_mata_pelajaran');
        
        $mataPelajaran = MataPelajaran::find()->where(['id' => $guruMataPelajaran])->asArray()->all();
        $mataPelajaran = array_column($mataPelajaran, 'id');

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['id' => $mataPelajaran]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single MataPelajaran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "MataPelajaran ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update','id' => $id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;

        $guru = Guru::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $tingkatKelas = ArrayHelper::map(RefTingkatKelas::find()->all(), 'id', 'tingkat_kelas');
        $jurusan = ArrayHelper::map(RefJurusan::find()->all(), 'id', 'jurusan');
        
        $model = new MataPelajaran();  
        $modelGuruMataPelajaran = new GuruMataPelajaran(); 

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah MataPelajaran",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'tingkatKelas' => $tingkatKelas,
                        'jurusan' => $jurusan,
                        'modelGuruMataPelajaran' => $modelGuruMataPelajaran,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if ($model->load($request->post())){
                $id_guru = null;
                if($guru){
                    $id_guru = $guru->id;
                }

                if ($model->save()) {
                    $modelGuruMataPelajaran->id_guru = $id_guru;
                    $modelGuruMataPelajaran->id_mata_pelajaran = $model->id;

                    if ($modelGuruMataPelajaran->save()) {
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Tambah Mata Pelajaran",
                            'content' => '<span class="text-success">Create Mata Pelajaran berhasil</span>',
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                                Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                    }
                }   
                
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah Mata Pelajaran",
                    'content' => '<span class="text-danger">Create Mata Pelajaran gagal!</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])

                ];
            }else{           
                return [
                    'title'=> "Tambah MataPelajaran",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'tingkatKelas' => $tingkatKelas,
                        'jurusan' => $jurusan,
                        'modelGuruMataPelajaran' => $modelGuruMataPelajaran,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())){
                $id_guru = null;
                if($guru){
                    $id_guru = $guru->id;
                }

                if ($model->save()) {
                    $modelGuruMataPelajaran->id_guru = $id_guru;
                    $modelGuruMataPelajaran->id_mata_pelajaran = $model->id;

                    if ($modelGuruMataPelajaran->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
                
                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->render('create', [
                    'model' => $model,
                    'tingkatKelas' => $tingkatKelas,
                    'jurusan' => $jurusan,
                    'modelGuruMataPelajaran' => $modelGuruMataPelajaran,

                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'tingkatKelas' => $tingkatKelas,
                    'jurusan' => $jurusan,
                    'modelGuruMataPelajaran' => $modelGuruMataPelajaran,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        
        $guru = Guru::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $tingkatKelas = ArrayHelper::map(RefTingkatKelas::find()->all(), 'id', 'tingkat_kelas');
        $jurusan = ArrayHelper::map(RefJurusan::find()->all(), 'id', 'jurusan');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah MataPelajaran",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'tingkatKelas' => $tingkatKelas,
                        'jurusan' => $jurusan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){
                $id_guru = $guru->id;

                if ($model->save()) {
                    $modelGuruMataPelajaran = GuruMataPelajaran::find()->where(['id_guru' => $id_guru, 'id_mata_pelajaran' => $model->id])->one();

                    if (!$modelGuruMataPelajaran) {
                        $modelGuruMataPelajaran = new GuruMataPelajaran();
                    }
                    $modelGuruMataPelajaran->id_guru = $id_guru;
                    $modelGuruMataPelajaran->id_mata_pelajaran = $model->id;

                    if ($modelGuruMataPelajaran->save()) {
                        return [

                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Mata Pelajaran ",
                            'content' => $this->renderAjax('view', [
                                'model' => $model,
                                'tingkatKelas' => $tingkatKelas,
                                'jurusan' => $jurusan,
                            ]),
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                                Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                    }
                }


                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah Mata Pelajaran",
                    'content' => '<span class="text-danger">Create Mata Pelajaran gagal!</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];  
            }else{
                 return [
                    'title'=> "Ubah MataPelajaran ",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'tingkatKelas' => $tingkatKelas,
                        'jurusan' => $jurusan,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $id_guru = $guru->id;

                if ($model->save()) {
                    $modelGuruMataPelajaran = GuruMataPelajaran::find()->where(['id_guru' => $id_guru, 'id_mata_pelajaran' => $model->id])->one();

                    if (!$modelGuruMataPelajaran) {
                        $modelGuruMataPelajaran = new GuruMataPelajaran();
                    }
                    $modelGuruMataPelajaran->id_guru = $id_guru;
                    $modelGuruMataPelajaran->id_mata_pelajaran = $model->id;

                    if ($modelGuruMataPelajaran->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

                return $this->render('create', [
                    'model' => $model,
                    'tingkatKelas' => $tingkatKelas,
                    'jurusan' => $jurusan,

                ]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'tingkatKelas' => $tingkatKelas,
                    'jurusan' => $jurusan,
                ]);
            }
        }
    }

    /**
     * Delete an existing MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);

        if ($model->guruMataPelajaran) {
            $model->guruMataPelajaran->delete();
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the MataPelajaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MataPelajaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MataPelajaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}