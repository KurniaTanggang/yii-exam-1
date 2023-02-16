<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */

?>
<div class="mata-pelajaran-create">
  <?= $this->render('_form', [
        'model' => $model,
        'tingkatKelas' => $tingkatKelas,
        'jurusan' => $jurusan,
        'modelGuruMataPelajaran' => $modelGuruMataPelajaran,
    ]) ?>
</div>