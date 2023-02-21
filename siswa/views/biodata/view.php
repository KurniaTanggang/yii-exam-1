<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\widgets\Pjax;
use johnitvn\ajaxcrud\CrudAsset; 

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
$this->title = 'Biodata';
CrudAsset::register($this);
?>
<div class="siswa-view">
  <div class="form-group text-right">
    <?=  Html::a('Ubah',['update'],['class'=>'btn btn-primary','role'=>'modal-remote', 'title'=> 'Ubah Biodata']) ?>

  </div>
  <div class="table-responsive mt-3">
    <?php Pjax::begin(['id'=>'id-pjax']) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nis',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat:ntext',
        ],
    ]) ?>
    <?php Pjax::end() ?>
  </div>

</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>