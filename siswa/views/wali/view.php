<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Wali */
?>
<div class="wali-view">
  <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'alamat:ntext',
            'no_hp',
            [
                'label' => 'Status Wali',
                'attribute' => 'id_status_wali',
                'value' => function ($model) {
                    return $model->statusWali->status_wali;
                }
            ],
        ],
    ]) ?>
  </div>

</div>