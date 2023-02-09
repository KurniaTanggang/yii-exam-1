<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\WaliSearch */
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
                        <?= GridView::widget([
                            'id' => 'crud-datatable',
                            'pager' => [
                                'firstPageLabel' => 'Awal',
                                'lastPageLabel'  => 'Akhir'
                            ],
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'pjax' => true,
                            'columns' => require(__DIR__ . '/_columns.php'),
                            'toolbar' => [
                                [
                                    'content' => ''
                                ],
                            ],
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,
                            'panel' => [

                                'before' => Html::a(
                                    'Tambah',
                                    ['create'],
                                    [
                                        'role' => 'modal-remote',
                                        'title' => 'Create new Walis',
                                        'class' => 'btn btn-info '
                                    ]
                                ),

                                '<div class="clearfix"></div>',
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ],
]) ?>
<?php Modal::end(); ?>