<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use johnitvn\ajaxcrud\CrudAsset; 

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
$this->title = 'Biodata';

?>
<div class="siswa-view">
  <div class="form-group text-right">
    <?=  Html::a('Ubah',['update'],['class'=>'btn btn-primary','role'=>'modal-remote', 'title'=> 'Ubah Biodata']) ?>

  </div>
  <div class="table-responsive mt-3">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nis',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat:ntext',
        ],
    ]) ?>
  </div>

</div>