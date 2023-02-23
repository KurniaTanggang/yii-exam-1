<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GuruMataPelajaran */

?>
<div class="guru-mata-pelajaran-create">
  <?= $this->render('_form', [
        // 'searchModel' => $searchModel,
        // 'dataProvider' => $dataProvider,
        'model' => $model,
        'guru_nama' => $guru_nama,
        'guru_id' => $guru_id,
    ]) ?>
</div>