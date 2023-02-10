<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
// @var $model common\models\MataPelajaran

?>
<div class="mata-pelajaran-create">
  <?= $this->render('_form', [
        'model' => $model,
        'tingkat_kelas' => $tingkat_kelas,
        'jurusan' => $jurusan,
        'guru' => $guru,
        'model_guru_mata_pelajaran' => $model_guru_mata_pelajaran,
    ]) ?>
</div>