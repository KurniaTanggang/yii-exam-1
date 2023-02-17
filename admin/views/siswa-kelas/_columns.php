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
        'header' => 'Jurusan',
        'attribute' => 'id_jurusan',
        'value' => function ($model) {
            return $model->refJurusan->jurusan;
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
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Siswa',
        'template' => '{btn_aksi}',
        'buttons' => [
            "btn_aksi" => function ($url, $model, $key) {
                return Html::a('Lihat Siswa', ['siswa/index2', 'id' => $model->id], [
                    'class' => 'btn btn-success btn-block',
                    'role' => 'modal-remote',
                    'title' => 'Lihat',
                    'data-toggle' => 'tooltip'
                ]);

            },

        ]
    ],

];   