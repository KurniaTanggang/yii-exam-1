<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
?>
<div class="kelas-view">
  <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Tahun Ajaran',
                'attribute' => 'id_tahun_ajaran',
                'value' => function ($model) {
                    return $model->refTahunAjaran->tahun_ajaran;
                }
            ],
            'nama_kelas',
            [
                'label' => 'Tingkat Kelas',
                'attribute' => 'id_tingkat',
                'value' => function ($model) {
                    return $model->refTingkatKelas->tingkat_kelas;
                }
            ],
            [
                'label' => 'Wali Kelas',
                'attribute' => 'id_wali_kelas',
                'value' => function ($model) {
                    return $model->namaGuru->nama_guru;
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