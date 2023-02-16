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

  <?= $form->field($modelGuruMataPelajaran, 'id_guru')->widget(Select2::classname(), [
        'data' => $guru,
        'options' => ['placeholder' => '-Pilih Guru Mata Pelajaran-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Guru Mata Pelajaran'); ?>

  <?php if (!Yii::$app->request->isAjax){ ?>
  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php } ?>

  <?php ActiveForm::end(); ?>

</div>