<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $jobs common\models\Job[] */
$jobs = $data["jobs"];
$this->title = 'Tuyển dụng tại Cellphones';
$this->params['breadcrumbs'][] = "Tuyển dụng tại Cellphones";

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
                <div id="content" class="recruitment">
                    <h1>Tuyển dụng tại CellphoneS</h1>
                    <ul class="work-list work-list-full">
                        <?php foreach ($jobs as $job) :?>
                            <li>
                                <h2 class="wl-name"><a href="<?=$job->viewUrl?>" title=""><?=$job->title?></a></h2>
                                <?php if($job->isOutDate()):?>
                                    <button class="btn btn-success btn-old pull-right">Hết hạn</button>
                                <?php else:?>
                                    <a href="<?=$job->viewUrl?>" class="btn btn-success pull-right">Ứng tuyển</a>
                                <?php endif;?>
                                <div class="wl-info">
                                    <span class="mr20"><i class="fa fa-user"></i> Số lượng: <strong><?=$job->amount?></strong></span>
                                    <span class="mr20"><i class="fa fa-clock-o"></i> Hạn: <strong><?=$job->deadline?></strong></span>
                                    <span class="mr20 m-span"><i class="fa fa-map-marker"></i> <strong><?=$job->location_title?></strong></span>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <div id="pagination">
                        <?=$this->render('/widget/pager',["pageInfo"=>$data["page_info"]])?>
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