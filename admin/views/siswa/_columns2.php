<?php
use yii\helpers\Url;
use yii\helpers\Html;

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
        'attribute'=>'nis',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'tempat_lahir',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'tanggal_lahir',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'alamat',
    ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'header' => 'Kelas',
    //     'attribute' => 'id_kelas',
    //     'value' => function ($model) {
    //         return $model->kelas->nama_kelas??"";
    //     }
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Hapus',
        'template' => '{btn_aksi}',
        'buttons' => [
            "btn_aksi" => function ($url, $model, $key) {
                return Html::a('Hapus', ['siswa-kelas/hapus-siswa', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-block',
                    'role' => 'modal-remote',
                    'title' => 'Hapus',
                    'data-toggle' => 'tooltip'
                ]);
            },

        ]
    ],
    

];   