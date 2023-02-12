<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Siswa */

?>
<div class="siswa-create">
  <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
        'model_rw_siswa' => $model_rw_siswa,
    ]) ?>
</div>