<?php

namespace admin\controllers;

use Yii;
use common\models\GuruMataPelajaran;
use admin\models\GuruMapelSearch;
use admin\models\GuruSearch;
use common\models\Guru;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\MataPelajaran;


/**
 * GuruMapelController implements the CRUD actions for GuruMataPelajaran model.
 */
class GuruMapelController extends Controller
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
     * Lists all GuruMataPelajaran models.
     * @return mixed
     */
    public function actionIndex($id_mapel)
    {    
        $searchModel = new GuruMapelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['id_mata_pelajaran'=>$id_mapel]);

        $MataPelajaran=MataPelajaran::find()->where(['id'=>$id_mapel])->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'MataPelajaran' => $MataPelajaran,
            'id_mapel' => $id_mapel,
        ]);
    }


    /**
     * Displays a single GuruMataPelajaran model.
     * @param integer $id_guru
     * @param integer $id_mata_pelajaran
     * @return mixed
     */
    public function actionView($id_guru, $id_mata_pelajaran)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "GuruMataPelajaran ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id_guru, $id_mata_pelajaran),
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update','id_guru' => $id_guru, 'id_mata_pelajaran' => $id_mata_pelajaran],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id_guru, $id_mata_pelajaran),
            ]);
        }
    }

    /**
     * Creates a new GuruMataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_mapel)
    {
        $searchModel = new GuruSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $request = Yii::$app->request;
        $model = new GuruMataPelajaran();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah GuruMataPelajaran",
                    'content'=>$this->renderAjax('index2', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'id_mapel' => $id_mapel,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-warning float-left','data-dismiss'=>"modal"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah GuruMataPelajaran",
                    'content'=>'<span class="text-success">Create GuruMataPelajaran berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-warning float-left','data-dismiss'=>"modal"])
        
                ];         
            }else{           
                return [
                    'title'=> "Tambah GuruMataPelajaran",
                    'content'=>$this->renderAjax('index2', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'id_mapel' => $id_mapel,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-warning float-left','data-dismiss'=>"modal"])
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_guru' => $model->id_guru, 'id_mata_pelajaran' => $model->id_mata_pelajaran]);
            } else {
                return $this->render('index2', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'id_mapel' => $id_mapel,
                ]);
            }
        }
       
    }

    public function actionPilihGuru($id_guru, $id_mapel)
    {
        $request = Yii::$app->request;
        $searchModel = new GuruSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new GuruMataPelajaran(); 
        $model->id_guru = $id_guru; 
        $model->id_mata_pelajaran = $id_mapel;
        // $model->save();
        $model->setStatusGuruMapel();
        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "Tambah GuruMataPelajaran",
                'forceReload'=>'#crud-datatable-pjax',
                'content' => $this->renderAjax('index2', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'id_mapel' => $id_mapel,
                ]),
                'footer'=> Html::button('Tutup',['class'=>'btn btn-warning float-left','data-dismiss'=>"modal"])
            ];
        }
        else{
            // return [
            //     // 'forceReload'=>'#crud-datatable-pjax',
            // ];
            return $this->redirect(['index2']);
        }
       
    }

    /**
     * Updates an existing GuruMataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_guru
     * @param integer $id_mata_pelajaran
     * @return mixed
     */
    public function actionUpdate($id_guru, $id_mata_pelajaran)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id_guru, $id_mata_pelajaran);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah GuruMataPelajaran",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "GuruMataPelajaran ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                            Html::a('Ubah',['update', 'id_guru' => $model->id_guru, 'id_mata_pelajaran' => $model->id_mata_pelajaran],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Ubah GuruMataPelajaran ",
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
                return $this->redirect(['view', 'id_guru' => $model->id_guru, 'id_mata_pelajaran' => $model->id_mata_pelajaran]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing GuruMataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_guru
     * @param integer $id_mata_pelajaran
     * @return mixed
     */
    public function actionDelete($id_guru, $id_mata_pelajaran)
    {
        $request = Yii::$app->request;
        $this->findModel($id_guru, $id_mata_pelajaran)->delete();

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
     * Delete multiple existing GuruMataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_guru
     * @param integer $id_mata_pelajaran
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
     * Finds the GuruMataPelajaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_guru
     * @param integer $id_mata_pelajaran
     * @return GuruMataPelajaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_guru, $id_mata_pelajaran)
    {
        if (($model = GuruMataPelajaran::findOne(['id_guru' => $id_guru, 'id_mata_pelajaran' => $id_mata_pelajaran])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}