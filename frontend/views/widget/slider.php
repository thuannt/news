<?php
use common\models\Slide;
/* @var $this \yii\web\View */
$slides = Slide::find()->where("status = 1")->addOrderBy("order");
?>
<div id="slider">
    <div class="container">
        <div class="swiper-container">
            <div class="slide-next"><i class="fa fa-chevron-right"></i></div>
            <div class="slide-prev"><i class="fa fa-chevron-left"></i></div>
            <div class="swiper-wrapper">
                <?php foreach ($slides->all() as $model):?>
                <div class="swiper-slide"><a href="<?=$model->url?>" title=""><img src="<?=$model->thumbnail?>"" border="0" /></a></div>
                <?php endforeach;?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>