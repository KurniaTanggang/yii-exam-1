<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
?>
<div class="mata-pelajaran-view">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mata_pelajaran',
            'id_tingkat_kelas',
            'id_jurusan',
        ],
    ]) ?>
    </div>

</div>
