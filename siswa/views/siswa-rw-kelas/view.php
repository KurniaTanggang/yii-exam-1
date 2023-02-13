<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SiswaRwKelas */
?>
<div class="siswa-rw-kelas-view">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_siswa',
            'id_kelas',
            'id_tahun_ajaran',
            'nama_kelas',
            'id_tingkat',
            'id_wali_kelas',
        ],
    ]) ?>
    </div>

</div>
