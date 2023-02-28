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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'mata_pelajaran',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Tingkat Kelas',
        'attribute' => 'cari_kelas',
        'value' => 'refTingkatKelas.tingkat_kelas'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Jurusan',
        'attribute' => 'cari_jurusan',
        'value' => 'refJurusan.jurusan'
    ],

];   