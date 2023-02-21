<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Guru */
?>
<div class="guru-view">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama_guru',
            'id_user',
        ],
    ]) ?>
    </div>

</div>
