<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($riwayatKelas, 'id_siswa')->widget(Select2::classname(), [
        'data' => $siswa,
        'options' => ['placeholder' => '-Pilih Siswa-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Tambah Siswa'); ?>


  <?php if (!Yii::$app->request->isAjax){ ?>
  <div class="form-group">
    <?= Html::submitButton($riwayatKelas->isNewRecord ? 'Create' : 'Update', ['class' => $riwayatKelas->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php } ?>

  <?php ActiveForm::end(); ?>

</div>