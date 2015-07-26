<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $blogs common\models\Blog[] */

$this->title = 'Việc làm tại Cellphones';
$this->params['breadcrumbs'][] = "Hoạt động";
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
                <div id="content" class="list-news">
                    <h1>Danh sách hoạt động</h1>
                    <div id="list-news">
                        <?php foreach ($blogs as $blog) :?>
                            <div class="ln-item">
                                <a href="<?=$blog->viewUrl?>" class="thumb" style="background-image: url(<?=$blog->thumbnailUrl?>);" title="#"></a>
                                <div class="lni-content">
                                    <h2><a href="<?=$blog->viewUrl?>" title="<?= $blog->title?>"><?= $blog->title?></a></h2>
                                    <p class="time"><i class="fa fa-clock-o"></i> <?=date('d-m-Y',$blog->created_at)?></p>
                                    <p><?= $blog->description?></p>
                                    <p><a href="<?=$blog->viewUrl?>" class="more">Xem thêm</a></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php endforeach;?>
                    </div>
                    <div id="pagination">
                        <?=$this->render('/widget/pager',['pagination' => $pagination])?>
                    </div>
                </div>
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