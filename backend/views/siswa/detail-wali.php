<?php

use yii\widgets\DetailView;

?>
<div class="siswa-view">
    <h1>NIS: <?= $nis ?></h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
            </tr>

            <?php
            foreach ($model as $value) {
            ?>
            <tr>

                <td><?= $value->waliSiswa->nama ?></td>
                <td><?= $value->waliSiswa->alamat ?></td>
            </tr>

            <?php
            }
            ?>
        </table>
    </div>

</div>