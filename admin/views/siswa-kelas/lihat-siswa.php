<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
?>
<div class="kelas-view">
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td><?= $model->nama??""; ?></td>
        </tr>
      </tbody>
    </table>
    <!-- <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_tahun_ajaran',
            'nama_kelas',
            'id_tingkat',
            'id_wali_kelas',
            'id_jurusan',
        ],
    ]) ?> -->
  </div>

</div>