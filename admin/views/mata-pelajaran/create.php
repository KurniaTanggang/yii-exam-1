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
    ]) ?>
</div>