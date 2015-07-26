<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Viết bài mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
//            'content:ntext',
            [
                'attribute' => 'thumbnail',
                'format' => 'html',
                'value' => function ($data) {
                    return "<img src='$data->thumbnail' width='250px' />";
                },
                'hAlign' => 'center'
            ],
            // 'created_at',
            // 'updated_at',
            // 'viewed_cnt',
            // 'status',
            // 'slug',
            // 'folder',

            ['class' => 'yii\grid\ActionColumn'],

        ],
        'exportConfig' => false,
        'export'=>false
    ]); ?>

</div>
