<?php

namespace siswa\controllers;

use Yii;
use common\models\Wali;
use siswa\models\WaliSearch;
use common\models\RefStatusWali;
use common\models\Siswa;
use common\models\SiswaWali;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * WaliController implements the CRUD actions for Wali model.
 */
class WaliController extends Controller
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
     * Lists all Wali models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new WaliSearch();
        
        
        $siswa = Siswa::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $waliSiswa = SiswaWali::find()->where(['id_siswa' => $siswa->id])->asArray()->all();
        $waliSiswa = array_column($waliSiswa, 'id_wali');
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if($waliSiswa)
            $dataProvider->query->andFilterWhere(['wali.id' => $waliSiswa]);
        else
            $dataProvider->query->andFilterWhere(['wali.id' => '0']);
            

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Wali model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Wali ",
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
     * Creates a new Wali model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $data = ArrayHelper::map(RefStatusWali::find()->all(), 'id', 'status_wali');
        $model = new Wali();
        $id_user = Yii::$app->user->identity->id;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Wali",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'data' => $data,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if ($model->load($request->post())) {
                $siswa = Siswa::find()->where(['id_user' => $id_user])->one();
                // 
                $id_siswa = null;
                if ($siswa) {
                    $id_siswa = $siswa->id;
                }

                if ($model->save()) {
                    $siswaWali = new SiswaWali();

                    $siswaWali->id_siswa = $id_siswa;
                    $siswaWali->id_wali = $model->id;

                    if ($siswaWali->save()) {
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Tambah Wali",
                            'content' => '<span class="text-success">Create Wali berhasil</span>',
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                                Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                    }
                }


                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah Wali",
                    'content' => '<span class="text-danger">Create Wali gagal!</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])

                ];
            } else {
                return [
                    'title' => "Tambah Wali",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'data' => $data,

                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $siswa = Siswa::find()->where(['id_user' => $id_user])->one();
                // 
                $id_siswa = null;
                if ($siswa) {
                    $id_siswa = $siswa->id;
                }

                if ($model->save()) {
                    $siswaWali = new SiswaWali();
                    $siswaWali->id_siswa = $id_siswa;
                    $siswaWali->id_wali = $model->id;

                    if ($siswaWali->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->render('create', [
                    'model' => $model,
                    'data' => $data,

                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'data' => $data,

                ]);
            }
        }
    }

    /**
     * Updates an existing Wali model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id); 
        $data = ArrayHelper::map(RefStatusWali::find()->all(), 'id', 'status_wali');      

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah Wali",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'data' => $data,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if ($model->load($request->post())) {

                $id_siswa = $model->siswaWali->id_siswa;


                if ($model->save()) {
                    $siswaWali = SiswaWali::find()->where(['id_siswa' => $id_siswa, 'id_wali' => $model->id])->one();


                    if (!$siswaWali) {
                        $siswaWali = new SiswaWali();
                    }
                    $siswaWali->id_siswa = $id_siswa;
                    $siswaWali->id_wali = $model->id;

                    if ($siswaWali->save()) {
                        return [

                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Wali ",
                            'content' => $this->renderAjax('view', [
                                'data' => $data,
                                'model' => $model,
                            ]),
                            'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                                Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                        ];
                    }
                }


                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Tambah Wali",
                    'content' => '<span class="text-danger">Create Wali gagal!</span>',
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Tambah Lagi', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Ubah Wali ",
                    'content' => $this->renderAjax('update', [
                        'data' => $data,
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $id_siswa = $model->siswaWali->id_siswa;

                if ($model->save()) {
                    $siswaWali = SiswaWali::find()->where(['id_siswa' => $id_siswa])->one();

                    if (!$siswaWali) {
                        $siswaWali = new SiswaWali();
                    }
                    $siswaWali->id_siswa = $id_siswa;
                    $siswaWali->id_wali = $model->id;

                    if ($siswaWali->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->render('create', [
                    'model' => $model,
                    'data' => $data,

                ]);
            } else {
                return $this->render('update', [
                    'data' => $data,
                    'model' => $model,
                ]);
            }
        }
    }


    /**
     * Delete an existing Wali model.
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

        if ($model->siswaWali) {
            $model->siswaWali->delete();
            $model->delete();
        }
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

     /**
     * Delete multiple existing Wali model.
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
     * Finds the Wali model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wali the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wali::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}