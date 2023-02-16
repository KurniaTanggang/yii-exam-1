<?php

namespace admin\controllers;

use Yii;
use common\models\MataPelajaran;
use admin\models\GuruMataPelajaranSearch;
use common\models\Guru;
use common\models\GuruMataPelajaran;
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


    public function actionPilihGuru($id)
    {
        $request = Yii::$app->request;
        $modelGuruMataPelajaran = new GuruMataPelajaran(); 
        $model = $this->findModel($id); 

        $guru = ArrayHelper::map(Guru::find()->all(), 'id', 'nama_guru');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Pilih Guru",
                    'content'=>$this->renderAjax('_form_pilih_guru', [
                        'modelGuruMataPelajaran' => $modelGuruMataPelajaran,
                        'guru' => $guru,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($modelGuruMataPelajaran->load($request->post())){
                $modelGuruMataPelajaran->id_mata_pelajaran = $model->id;
                $modelGuruMataPelajaran->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Pilih Guru",
                    'content'=>'<span class="text-success">Pilih Guru Mata Pelajaran berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Tambah Lagi',['pilih-guru'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Pilih Guru Mata Pelajaran",
                    'content'=>$this->renderAjax('_form_pilih_guru', [
                        'modelGuruMataPelajaran' => $modelGuruMataPelajaran,
                        'guru' => $guru,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($modelGuruMataPelajaran->load($request->post())) {
                $modelGuruMataPelajaran->id_mata_pelajaran = $model->id;
                return $this->redirect(['view', 'id' => $modelGuruMataPelajaran->id]);
            } else {
                return $this->render('_form_pilih_guru', [
                    'modelGuruMataPelajaran' => $modelGuruMataPelajaran,
                    'guru' => $guru,
                ]);
            }
        }
       
    }

    public function actionUbahGuru($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id); 
        $id_guru = $model->guruMataPelajaran->namaGuru->id;
        $modelGuruMataPelajaran = GuruMataPelajaran::find()->where(['id_guru' => $id_guru, 'id_mata_pelajaran' => $model->id])->one();

        $guru = ArrayHelper::map(Guru::find()->all(), 'id', 'nama_guru');
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah Guru",
                    'content'=>$this->renderAjax('_form_pilih_guru', [
                        'modelGuruMataPelajaran' => $modelGuruMataPelajaran,
                        'guru' => $guru,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($modelGuruMataPelajaran->load($request->post())){
                $modelGuruMataPelajaran->id_mata_pelajaran = $model->id;
                $modelGuruMataPelajaran->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Ubah Mata Pelajaran ",
                    'content'=>'<span class="text-success">Ubah Guru Mata Pelajaran berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['ubah-guru', 'id' => $model->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Ubah Mata Pelajaran ",
                    'content'=>$this->renderAjax('_form_pilih_guru', [
                        'modelGuruMataPelajaran' => $modelGuruMataPelajaran,
                        'guru' => $guru,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($modelGuruMataPelajaran->load($request->post()) && $modelGuruMataPelajaran->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('_form_pilih_guru', [
                    'modelGuruMataPelajaran' => $modelGuruMataPelajaran,
                    'guru' => $guru,
                ]);
            }
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
        $model = new MataPelajaran();  

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
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
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
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
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
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "MataPelajaran ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update', 'id' => $model->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Ubah MataPelajaran ",
                    'content'=>$this->renderAjax('update', [
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
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
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