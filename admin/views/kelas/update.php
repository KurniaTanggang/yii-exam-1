<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
?>
<div class="kelas-update">

  <?= $this->render('_form', [
        'model' => $model,
        'tahun_ajaran' => $tahun_ajaran,
        'tingkat_kelas' => $tingkat_kelas,
        'jurusan' => $jurusan,
        'guru' => $guru,
    ]) ?>

</div>