<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GuruMataPelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="guru-mata-pelajaran-form">

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Guru</th>
        <th scope="col">Pilih Guru</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 0; ?>
      <?php foreach ($guru_nama as $key) { ?>
      <tr>
        <th scope="row"><?= $j= $i+1; ?></th>
        <td><?= $key; ?></td>
        <td><?= Html::a('Pilih Guru', ['pilih-guru', 'id_guru' => $guru_id[$i], 'id_mapel'=>$model->id_mata_pelajaran], [
						'class' => 'btn btn-success btn-block',
						'role' => 'modal-remote',
						'title' => 'Lihat',
						'data-toggle' => 'tooltip'
					]); ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>
    </tbody>
  </table>




  <?= $form->field($model->mataPelajaran, 'mata_pelajaran')->textInput(['disabled'=>true]) ?>


  <?php if (!Yii::$app->request->isAjax){ ?>
  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php } ?>

  <?php ActiveForm::end(); ?>

</div>