<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Guru */
?>
<div class="lihat-akun">
  <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_guru',
            'akun.username',
            'akun.email',
        ],
    ]) ?>
  </div>

</div>