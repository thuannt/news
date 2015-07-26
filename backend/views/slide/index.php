<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SlideSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banner';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo banner mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            [
                'attribute' => 'thumbnail',
                'format' => 'html',
                'value' => function ($data) {
                    return "<img src='$data->thumbnail' width='300px' />";
                },
                'hAlign' => 'center'
            ],
            'url:url',
            'order',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'exportConfig' => false,
        'export'=>false
    ]); ?>

</div>
