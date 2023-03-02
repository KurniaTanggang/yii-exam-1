<?php
/** @var yii\web\View $this */
use dosamigos\chartjs\ChartJs;

$this->title = 'My Yii Application';

?>
<div class="site-index">

  <div class="jumbotron text-center bg-transparent">
    <h1 class="display-4">Selamat datang <?= $siswa; ?>!</h1>

  </div>

  <?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 200,
        'width' => 400,
    ],
    'clientOptions' => [
      'scales' => [
          'yAxes' => [[
              'ticks' => [
                  'beginAtZero' => 'true', # Works
              ]
          ]],
      ],
  ], 
    'data' => [
        'labels' => ["X MIPA 1-SI", "X MIPA 1-SII", "XI MIPA 1-SI", "XI MIPA 1-SII", "XII MIPA 1-SI"],
        'datasets' => [
            [
                'label' => "Perkembangan Akademik",
                'backgroundColor' => "rgba(75, 192, 192,0.2)",
                'borderColor' => "rgba(75, 192, 192,1)",
                'pointBackgroundColor' => "rgba(75, 192, 192,1)",
                'pointBorderColor' => "#2b34ed",
                'pointHoverBackgroundColor' => "#2b34ed",
                'pointHoverBorderColor' => "rgba(75, 192, 192,1)",
                'data' => [73, 81, 90, 87, 92],
                'tension' => "0.3"
            ],
        ]
    ]
]);
?>
</div>