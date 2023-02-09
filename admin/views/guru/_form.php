<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Guru */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guru-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'nama_guru')->textInput(['maxlength' => true]) ?>


  <?php if (!Yii::$app->request->isAjax){ ?>
  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php } ?>

  <?php ActiveForm::end(); ?>

</div>