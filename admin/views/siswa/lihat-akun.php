<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
?>
<div class="lihat-akun">
  <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
            'akun.username',
            'akun.email',
        ],
    ]) ?>
  </div>

</div>