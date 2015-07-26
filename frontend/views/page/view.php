<?php
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $page common\models\Page */
$this->title = $page->title;
$this->params['breadcrumbs'][] = $page->name;
?>
<!-- main -->
<div id="main">
    <div class="container">
        <div class="row">
            <!-- content -->
            <div id="content-wrap" class="col-lg-9">
<!--                <div id="bread">-->
<!--                    <ol class="breadcrumb">-->
<!--                        <li><a href="index.html">Trang chủ</a></li>-->
<!--                        <li class="active">Giới thiệu về Cellphones</li>-->
<!--                    </ol>-->
<!--                </div>-->
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            <?=$page->content?>
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
