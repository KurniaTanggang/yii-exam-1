<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'tahun_ajaran')->textInput(['placeholder'=>'2020/2021','maxlength' => true]) ?>

  <?php if (!Yii::$app->request->isAjax){ ?>
  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>
  <?php } ?>

  <?php ActiveForm::end(); ?>

</div>