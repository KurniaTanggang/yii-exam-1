<?php

use common\models\GuruMataPelajaran;
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
        'attribute'=>'mata_pelajaran',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Tingkat Kelas',
        'attribute' => 'id_tingkat_kelas',
        'value' => function ($model) {
            return $model->refTingkatKelas->tingkat_kelas;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Jurusan',
        'attribute' => 'id_jurusan',
        'value' => function ($model) {
            return $model->refJurusan->jurusan;
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Guru Pengampu',
        'template' => '{btn_aksi}',
        'buttons' => [
            "btn_aksi" => function ($url, $model, $key) {
                $guruMataPelajaran = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $model->id])->one();
                if(!$guruMataPelajaran){
                    return Html::a('Pilih Guru', ['pilih-guru', 'id' => $model->id], [
                        'class' => 'btn btn-primary btn-block',
                        'role' => 'modal-remote',
                        'title' => 'Lihat',
                        'data-toggle' => 'tooltip'
                    ]);
                } else {
                    return $model->guruMataPelajaran->namaGuru->nama_guru;
                }

            },

        ]
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Aksi',
        'template' => '{btn_aksi}',
        'buttons' => [
            "btn_aksi" => function ($url, $model, $key) {
                $guruMataPelajaran = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $model->id])->one();
                if($guruMataPelajaran){
                    return Html::a('Ubah Guru', ['ubah-guru', 'id' => $model->id], [
                        'class' => 'btn btn-success btn-block',
                        'role' => 'modal-remote',
                        'title' => 'Ubah',
                        'data-toggle' => 'tooltip',
                    ]);
                } else {
                    return Html::a('Ubah Guru', ['ubah-guru', 'id' => $model->id], [
                        'class' => 'btn btn-success btn-block disabled',
                    ]);
                }

            },

        ]
    ],
];   