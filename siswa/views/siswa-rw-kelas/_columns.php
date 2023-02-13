<?php
use yii\helpers\Url;

return [
    //[
        //'class' => 'kartik\grid\CheckboxColumn',
        //'width' => '20px',
    //],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_siswa',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_tahun_ajaran',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Tahun Ajaran',
        'attribute' => 'id_tahun_ajaran',
        'value' => function ($model) {
            return $model->siswa->kelas->refTahunAjaran->tahun_ajaran;
        }
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_kelas',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama_kelas',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_tingkat',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Tingkat Kelas',
        'attribute' => 'id_tingkat',
        'value' => function ($model) {
            return $model->siswa->kelas->refTingkatKelas->tingkat_kelas;
        }
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_wali_kelas',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Wali Kelas',
        'attribute' => 'id_wali_kelas',
        'value' => function ($model) {
            return $model->siswa->kelas->namaGuru->nama_guru;
        }
    ],

];   