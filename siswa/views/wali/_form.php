<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Wali */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wali-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

  <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'id_status_wali')->widget(Select2::classname(), [
        'data' => $data,
        'options' => ['placeholder' => '-Pilih Status Wali-'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Status Wali'); ?>


  <?php if (!Yii::$app->request->isAjax){ ?>
  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php } ?>

  <?php ActiveForm::end(); ?>

</div>