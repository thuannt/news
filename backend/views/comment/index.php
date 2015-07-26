<?php

use backend\models\ReplyForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bình luận';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo bình luận', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'content',
            'name',
            'email:email',
//            'user_id',
            // 'object_id',
            // 'object_type',
            // 'parent_id',
            // 'ip',
            // 'comment_at',
            // 'status',
            [
//                'attribute' => 'some_title',
                'format' => 'raw',
                'value' => function ($model) {
                    return "<button onclick='showReply({$model->id});' class='btn btn-success'></i> Trả lời</button>";
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
    Modal::begin([
        'toggleButton' => [
            'header' => '<h2>Hello world</h2>',
            'label' => '<i class="glyphicon glyphicon-plus"></i> Add',
            'class' => 'btn btn-success',
            'style' =>'display: none',
            'id' => 'btn-show-reply'
        ],
        'closeButton' => [
            'label' => 'Close',
            'class' => 'btn btn-danger btn-sm pull-right',
        ],
        'size' => 'modal-lg',
    ]);?>
    <?php
    $model = new ReplyForm();
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->hiddenInput(['maxlength' => 100,'id'=>'reply-id'])->label(false) ?>
    <?= $form->field($model, 'content')->textarea(['maxlength' => 500]) ?>

    <div class="form-group">
        <?= Html::submitButton("Trả lời", ['class' =>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Modal::end();?>
</div>
