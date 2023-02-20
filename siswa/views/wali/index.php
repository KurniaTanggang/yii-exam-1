<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel siswa\models\WaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Walis';
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
          <div id="table-responsive">
            <?=GridView::widget([
                            'id'=>'crud-datatable',
                            'pager' => [
                                'firstPageLabel' => 'Awal',
                                'lastPageLabel'  => 'Akhir'
                            ],
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'pjax'=>true,
                            'columns' => require(__DIR__.'/_columns.php'),
                            'toolbar'=> [
                                // ['content'=>
                                //     // Html::a('<i class="fas fa-redo"></i> ', [''],
                                //     // ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                                //     // '{toggleData}'
                                //     // .'{export}'
                                // ],
                            ],          
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,          
                            'panel' => [
                                // 'type' => 'primary', 
                                // 'heading' => '<i class="glyphicon glyphicon-list"></i> Walis listing',
                                'before'=>Html::a('Tambah Data Wali', ['create'],
                                    ['role'=>'modal-remote','title'=> 'Create new Walis','class'=>'btn btn-primary']),
                                // 'after'=>BulkButtonWidget::widget([
                                //             'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                //                 ["bulk-delete"] ,
                                //                 [
                                //                     "class"=>"btn btn-danger btn-xs",
                                //                     'role'=>'modal-remote-bulk',
                                //                     'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                //                     'data-request-method'=>'post',
                                //                     'data-confirm-title'=>'Are you sure?',
                                //                     'data-confirm-message'=>'Are you sure want to delete this item'
                                //                 ]),
                                //         ]).                        
                                        '<div class="clearfix"></div>',
                            ]
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