<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel siswa\models\SiswaRwKelasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Siswa Rw Kelas';
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
                            // 'pager' => [
                            //     'firstPageLabel' => 'Awal',
                            //     'lastPageLabel'  => 'Akhir'
                            // ],
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'summary' => '',
                            'pjax'=>true,
                            'columns' => require(__DIR__.'/_columns.php'),
                            'toolbar'=> [
                                
                            ],          
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,          
                            'panel' => [
                                
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