<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
?>
<div class="kelas-update">

  <?= $this->render('_form', [
        'riwayatKelas' => $riwayatKelas,
        'siswa' => $siswa,
    ]) ?>

</div>