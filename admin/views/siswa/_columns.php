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
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Kelas',
        'attribute' => 'id_kelas',
        'value' => function ($model) {
            return $model->kelas->refTingkatKelas->tingkat_kelas;
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Akun Guru',
        'template' => '{btn_aksi}',
        'buttons' => [
            "btn_aksi" => function ($url, $model, $key) {
                if($model->id_user){
                    return Html::a('Lihat Akun', ['lihat-akun', 'id' => $model->id], [
                        'class' => 'btn btn-success btn-block',
                        'role' => 'modal-remote',
                        'title' => 'Lihat',
                        'data-toggle' => 'tooltip'
                    ]);
                } else {
                    return Html::a('Tambah Akun', ['create-akun', 'id' => $model->id], [
                        'class' => 'btn btn-primary btn-block',
                        'role' => 'modal-remote',
                        'title' => 'Lihat',
                        'data-toggle' => 'tooltip'
                    ]);
                }
            },

        ]
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Lihat','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Ubah', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Hapus', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Peringatan',
                          'data-confirm-message'=>'Apakah anda yakin ingin menghapus data ini?'], 
    ],

];   