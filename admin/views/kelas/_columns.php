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
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Tahun Ajaran',
        'attribute' => 'id_tahun_ajaran',
        'value' => function ($model) {
            return $model->refTahunAjaran->tahun_ajaran;
        }
    ],
    [
        'header' => 'Nama Kelas',
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama_kelas',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Tingkat Kelas',
        'attribute' => 'id_tingkat',
        'value' => function ($model) {
            return $model->refTingkatKelas->tingkat_kelas;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Wali Kelas',
        'attribute' => 'id_wali_kelas',
        'value' => function ($model) {
            return $model->namaGuru->nama_guru;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'header' => 'Jurusan',
        'attribute' => 'id_jurusan',
        'value' => function ($model) {
            return $model->refJurusan->jurusan;
        }
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