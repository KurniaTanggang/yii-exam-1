<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\GuruSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gurus';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<!-- <div class="element-wrapper">
    <h6 class="element-header">
            </h6>
    <div class="element-box"> -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div id="ajaxCrudDatatable">
          <div id="table-responsive" class="mt-3">
            <?=GridView::widget([
                            'id'=>'crud-datatable',
                            'pager' => [
                                'firstPageLabel' => 'Awal',
                                'lastPageLabel'  => 'Akhir'
                            ],
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'pjax'=>true,
                            'columns' => [
                              [
                                'class' => 'kartik\grid\SerialColumn',
                                'width' => '30px',
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'label' => 'Guru Mata Pelajaran',
                                // 'attribute' => 'id_guru',
                                'value' => 'nama_guru'
                            ],
                            [
                                'class' => 'kartik\grid\ActionColumn',
                                'header' => 'Pilih Guru',
                                'template' => '{btn_aksi}',
                                'buttons' => [
                                    "btn_aksi" => function ($url, $model, $key) use ($id_mapel) {
                                      if($model->cekStatusMapel($id_mapel)){
                                        
                                        return Html::a('Terpilih', ['pilih-guru', 'id_guru' => $model->id, 'id_mapel'=>$id_mapel], [
                                          'class' => 'btn btn-info btn-block',
                                          'role' => 'modal-remote',
                                          'title' => 'Lihat',
                                          'data-toggle' => 'tooltip'
                                      ]);
                                      }else{
                                        return Html::a('Pilih Guru', ['pilih-guru', 'id_guru' => $model->id, 'id_mapel'=>$id_mapel], [
                                            'class' => 'btn btn-success btn-block',
                                            'role' => 'modal-remote',
                                            'title' => 'Lihat',
                                            'data-toggle' => 'tooltip'
                                        ]);
                                      }
                                      // if (!Yii::$app->request->isAjax){
                                      //   if($model->cekStatusMapel($id_mapel)){
                                      //     return Html::a('Terpilih', ['pilih-guru', 'id_guru' => $model->id, 'id_mapel'=>$id_mapel], [
                                      //       'class' => 'btn btn-info btn-block',
                                      //       'title' => 'Lihat',
                                      //       // 'role' => 'modal-remote',
                                      //       'data-toggle' => 'tooltip'
                                      //   ]);
                                      //   }else{
                                      //     return Html::a('Pilih Guru', ['pilih-guru', 'id_guru' => $model->id, 'id_mapel'=>$id_mapel], [
                                      //         'class' => 'btn btn-success btn-block',
                                      //         'title' => 'Lihat',
                                      //         // 'role' => 'modal-remote',
                                      //         'data-toggle' => 'tooltip'
                                      //     ]);
                                      //   }
                                      // }else{
                                      //   if($model->cekStatusMapel($id_mapel)){
                                      //     return Html::a('Terpilih', ['pilih-guru', 'id_guru' => $model->id, 'id_mapel'=>$id_mapel], [
                                      //       'class' => 'btn btn-info btn-block',
                                      //       'role' => 'modal-remote',
                                      //       'title' => 'Lihat',
                                      //       'data-toggle' => 'tooltip'
                                      //   ]);
                                      //   }else{
                                      //     return Html::a('Pilih Guru', ['pilih-guru', 'id_guru' => $model->id, 'id_mapel'=>$id_mapel], [
                                      //         'class' => 'btn btn-success btn-block',
                                      //         'role' => 'modal-remote',
                                      //         'title' => 'Lihat',
                                      //         'data-toggle' => 'tooltip'
                                      //     ]);
                                      //   }
                                      // }
                        
                                    },
                        
                                ]
                            ],
                            ],
                            'toolbar'=> [
                                // ['content'=>
                                //     Html::a('<i class="fas fa-redo"></i> ', [''],
                                //     ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                                //     '{toggleData}'
                                //     // .'{export}'
                                // ],
                            ],          
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,          
                            // 'panel' => [
                            //     // 'type' => 'primary', 
                            //     // 'heading' => '<i class="glyphicon glyphicon-list"></i> Gurus listing',
                            //     'before'=>Html::a('Tambah Data Guru', ['create'],
                            //         ['role'=>'modal-remote','title'=> 'Create new Gurus','class'=>'btn btn-default']),
                            //     // 'after'=>BulkButtonWidget::widget([
                            //     //             'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                            //     //                 ["bulk-delete"] ,
                            //     //                 [
                            //     //                     "class"=>"btn btn-danger btn-xs",
                            //     //                     'role'=>'modal-remote-bulk',
                            //     //                     'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            //     //                     'data-request-method'=>'post',
                            //     //                     'data-confirm-title'=>'Are you sure?',
                            //     //                     'data-confirm-message'=>'Are you sure want to delete this item'
                            //     //                 ]),
                            //     //         ]).                        
                            //             '<div class="clearfix"></div>',
                            // ]
                        ])?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>