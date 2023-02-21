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

$this->registerJs(' 
$.pjax.defaults.timeout = false;      
');
?>
<div class="siswa-view">
  <div class="form-group text-right">
    <?=  Html::a('Ubah',['update', 'id'=>$model->id],['class'=>'btn btn-primary','role'=>'modal-remote', 'pjax'=>true, 'title'=> 'Ubah Biodata', 'id'=>'my_tab_id']) ?>

  </div>

  <?php Pjax::begin(['id' => 'id-pjax']) ?>
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

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>


<?php 

?>