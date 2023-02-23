<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\PjaxGuruSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gurus';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

$this->registerJs(' 
$.pjax.defaults.timeout = false;     
');
?>
<!-- <div class="element-wrapper">
    <h6 class="element-header">
            </h6>
    <div class="element-box"> -->
<!-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="ajaxCrudDatatable">
                        <div id="table-responsive">
                        <?/*=GridView::widget([
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
                                ['content'=>
                                    Html::a('<i class="fas fa-redo"></i> ', [''],
                                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                                    '{toggleData}'
                                    // .'{export}'
                                ],
                            ],          
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,          
                            'panel' => [
                                // 'type' => 'primary', 
                                // 'heading' => '<i class="glyphicon glyphicon-list"></i> Gurus listing',
                                'before'=>Html::a('Tambah', ['create'],
                                    ['role'=>'modal-remote','title'=> 'Create new Gurus','class'=>'btn btn-default']),
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
                        ])*/?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="guru-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <!-- <p>
    <?= Html::a(Yii::t('app', 'Create {modelClass}', ['modelClass' => 'Guru',]), ['create'], ['class' => 'btn btn-success']) ?>
  </p> -->

  <!-- Render create form -->
  <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

  <?php Pjax::begin(['id' => 'guru']) ?>
  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'nama_guru',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
  <?php Pjax::end() ?>
</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>