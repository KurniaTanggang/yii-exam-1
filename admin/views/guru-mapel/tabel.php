<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Guru</th>
      <th scope="col">Pilih Guru</th>
    </tr>
  </thead>
  <tbody>
    <?= $i = 0; ?>
    <?php foreach ($guru_nama as $key) { ?>
    <tr>
      <th scope="row"><?= $j= $i+1; ?></th>
      <td><?= $key; ?></td>
      <td><?= Html::a('Pilih Guru', ['pilih-guru', 'id_guru' => $guru_id[$i], 'id_mapel'=>$model->id_mata_pelajaran], [
						'class' => 'btn btn-success btn-block',
						'role' => 'modal-remote',
						'title' => 'Lihat',
						'data-toggle' => 'tooltip'
					]); ?></td>
    </tr>
    <?= $i++; ?>
    <?php } ?>
  </tbody>
</table>