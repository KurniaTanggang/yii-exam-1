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
            [
                'label' => 'Tingkat Kelas',
                'attribute' => 'id_tingkat_kelas',
                'value' => function ($model) {
                    return $model->refTingkatKelas->tingkat_kelas;
                }
            ],
            [
                'label' => 'Jurusan',
                'attribute' => 'id_jurusan',
                'value' => function ($model) {
                    return $model->refJurusan->jurusan;
                }
            ],
        ],
    ]) ?>
  </div>

</div>