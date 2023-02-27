<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model_akun, 'username')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model_akun, 'email')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model_akun, 'password')->passWordInput(['maxlength' => true]) ?>

  <?= $form->field($model_akun, 'password_repeat')->passWordInput(['maxlength' => true]) ?>

  <?php if (!Yii::$app->request->isAjax){ ?>
  <div class="form-group">
    <?= Html::submitButton($model_akun->signup ? 'Create' : 'Update', ['class' => $model_akun->signup ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php } ?>

  <?php ActiveForm::end(); ?>

</div>