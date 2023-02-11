<?php

namespace admin\controllers;

use Yii;
use common\models\MataPelajaran;
use admin\models\MataPelajaranSearch;
use common\models\RefTingkatKelas;
use common\models\RefJurusan;
use common\models\RefJurusan as ModelsRefJurusan;
use common\models\GuruMataPelajaran;
use common\models\Guru;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * MataPelajaranController implements the CRUD actions for MataPelajaran model.
 */
class MataPelajaranController extends Controller
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
        $searchModel = new MataPelajaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
                    'title'=> "Mata Pelajaran ",
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
        $tingkat_kelas = ArrayHelper::map(RefTingkatKelas::find()->all(), 'id', 'tingkat_kelas');
        $jurusan = ArrayHelper::map(RefJurusan::find()->all(), 'id', 'jurusan');
        $guru = ArrayHelper::map(Guru::find()->all(), 'id', 'nama_guru');
        
        $model = new MataPelajaran();  
        $model_guru_mata_pelajaran = new GuruMataPelajaran();  
        
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
                        'tingkat_kelas' => $tingkat_kelas,
                        'jurusan' => $jurusan,
                        'guru' => $guru,
                        'model_guru_mata_pelajaran' => $model_guru_mata_pelajaran,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model_guru_mata_pelajaran->load($request->post()) && $model->save()){
                $model_guru_mata_pelajaran->id_mata_pelajaran = $model->id;
                $model_guru_mata_pelajaran->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah MataPelajaran",
                    'content'=>'<span class="text-success">Create MataPelajaran berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Tambah Lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Tambah MataPelajaran",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model_guru_mata_pelajaran->load($request->post()) && $model->save()){
                $model_guru_mata_pelajaran->id_mata_pelajaran = $model->id;
                $model_guru_mata_pelajaran->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'tingkat_kelas' => $tingkat_kelas,
                    'jurusan' => $jurusan,
                    'guru' => $guru,
                    'model_guru_mata_pelajaran' => $model_guru_mata_pelajaran,
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
        $tingkat_kelas = ArrayHelper::map(RefTingkatKelas::find()->all(), 'id', 'tingkat_kelas');
        $jurusan = ArrayHelper::map(RefJurusan::find()->all(), 'id', 'jurusan');
        $guru = ArrayHelper::map(Guru::find()->all(), 'id', 'nama_guru');
        
        
        $model = $this->findModel($id);
               
        $model_guru_mata_pelajaran = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id])->one();  

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
                        'tingkat_kelas' => $tingkat_kelas,
                        'jurusan' => $jurusan,
                        'guru' => $guru,
                        'model_guru_mata_pelajaran' => $model_guru_mata_pelajaran,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save() ){
                $getDataGuru = $request->post();
                $idGuru = $getDataGuru['GuruMataPelajaran']['id_guru'];
                $model_guru_mata_pelajaran->id_guru =  $idGuru ;
                $model_guru_mata_pelajaran->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Mata Pelajaran ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'tingkat_kelas' => $tingkat_kelas,
                        'jurusan' => $jurusan,
                        'guru' => $guru,
                        'model_guru_mata_pelajaran' => $model_guru_mata_pelajaran,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update', 'id' => $model->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Ubah Mata Pelajaran ",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'tingkat_kelas' => $tingkat_kelas,
                        'jurusan' => $jurusan,
                        'guru' => $guru,
                        'model_guru_mata_pelajaran' => $model_guru_mata_pelajaran,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'tingkat_kelas' => $tingkat_kelas,
                    'jurusan' => $jurusan,
                    'guru' => $guru,
                    'model_guru_mata_pelajaran' => $model_guru_mata_pelajaran,
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
        $this->findModel($id)->delete();

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