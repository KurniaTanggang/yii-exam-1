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
    //     'attribute'=>'id_kelas',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Tahun Ajaran',
        'attribute' => 'tahun_ajaran',
        'value' => 'refTahunAjaran.tahun_ajaran'
        // 'value' => function ($model) {
        //     return $model->siswa->kelas->refTahunAjaran->tahun_ajaran;
        // }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama_kelas',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Tingkat Kelas',
        'attribute' => 'tingkat_kelas',
        'value' => 'kelas.refTingkatKelas.tingkat_kelas'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Wali Kelas',
        'attribute' => 'nama_guru',
        'value' => 'kelas.namaGuru.nama_guru'
    ],

];   