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
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Guru Mata Pelajaran',
        // 'attribute' => 'id_guru',
        'value' => 'nama_guru'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Pilih Guru',
        'template' => '{btn_aksi}',
        'buttons' => [
            "btn_aksi" => function ($url, $model, $key) {
                return Html::a('Pilih Guru', ['pilih-guru', 'id_guru' => $model->id], [
                    'class' => 'btn btn-success btn-block',
                    'role' => 'modal-remote',
                    'title' => 'Lihat',
                    'data-toggle' => 'tooltip'
                ]);

            },

        ]
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_mata_pelajaran',
    // ],

];   