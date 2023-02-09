<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mata-pelajaran-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'mata_pelajaran')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'id_tingkat_kelas')->widget(Select2::classname(), [
        'data' => $tingkat_kelas,
        'options' => ['placeholder' => '-Pilih Tingkat Kelas-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Tingkat Kelas'); ?>

  <?= $form->field($model, 'id_jurusan')->widget(Select2::classname(), [
        'data' => $jurusan,
        'options' => ['placeholder' => '-Pilih Jurusan-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Jurusan'); ?>

  <?php if (!Yii::$app->request->isAjax){ ?>
  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php } ?>

  <?php ActiveForm::end(); ?>

</div>