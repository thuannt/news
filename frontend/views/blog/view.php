<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $blog common\models\Blog */
/* @var $others common\models\Blog[] */
$this->title = $blog->title;
$this->params['breadcrumbs'][] = ['label' => 'Các hoạt động', 'url' => Url::to(['blog/index'])];
$this->params['breadcrumbs'][] = $blog->title;

?>
<!-- main -->
<div id="main">
    <div class="container">
        <div class="row">
            <!-- content -->
            <div id="content-wrap" class="col-lg-9">
                <!--begin Breadcrumbs-->
                <?=$this->render('/widget/breadcrumbs')?>
                <!--end Breadcrumbs-->
                <div id="content" class="about">
                    <div class="time block mb10">
                        <i class="fa fa-clock-o"></i> <?= date("H:i d-m-Y",$blog->created_at)?>
                        <div class="fb-like" data-href="<?=$blog->viewUrl?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                        <div class="clearfix"></div>
                    </div>
                    <h1><?=$blog->title?></h1>
                    <h2><?=$blog->description?></h2>
                    <?=$blog->content?>
                </div>
                <br />
                <div class="fb-like" data-href="<?=$blog->viewUrl?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                <!--Begin comment-->
                <?=$this->render('/widget/comment',["comments"=>$comments,"min_cmt_id"=>$min_cmt_id])?>
                <!--End comment-->
                <?php if($others && count($others)>0):?>
                    <div class="related">
                        <h4>Hoạt động khác</h4>
                        <div id="list-news" class="mt20">
                            <?php foreach($others as $model):?>
                                <div class="ln-item">
                                    <a href="<?=$model->viewUrl?>" class="thumb" style="background-image: url(<?=$model->thumbnailUrl?>);" title="#"></a>
                                    <div class="lni-content">
                                        <h5><a href="<?=$model->viewUrl?>" title="<?=$model->title?>"><?=$model->title?></a></h5>
                                        <p class="time"><i class="fa fa-clock-o"></i> <?=date("d-m-Y",$model->created_at)?></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                <?php endif;?>
            </div>
            <!--/ content -->
            <!-- sidebar -->
            <div id="sidebar" class="col-lg-3">
                <!-- search -->
                <div id="search">
                    <!--begin find_job_box-->
                    <?=$this->render('/widget/find_job_box')?>
                    <!--end find_job_box-->
                </div>
                <!--/ search -->
                <!-- work list -->
                <?=$this->render('/widget/feature_job')?>
                <!--/ work list -->
            </div>
            <!--/ sidebar -->
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--/ main -->