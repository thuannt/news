<?php
use common\components\Statistics;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Config;
/* @var $this yii\web\View */
/* @var $job common\models\Job */
$this->title = 'Việc làm tại CellphoneS';
?>
<!-- slider -->
<?= $this->render('/widget/slider')?>
<!--/ slider -->
<div class="clearfix"></div>
<!-- main -->
<div id="main">
    <div class="container">
        <!-- list work -->
        <div id="home-work">
            <div class="row">
                <!-- home list -->
                <div id="home-list" class="col-lg-9 pull-right">
                    <div class="box">
                        <div class="box-title">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#featured" role="tab" data-toggle="tab">Việc làm nổi bật</a></li>
                                <li><a href="#latest" role="tab" data-toggle="tab">Tuyển dụng gần đây</a></li>
                            </ul>
                        </div>
                        <div class="box-content">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane in fade active" id="featured">
                                    <ul class="work-list">
                                        <?php foreach (Statistics::getJobFeature(4) as $job) :?>
                                            <li>
                                                <?php if(!$job->isOutDate()):?>
                                                    <div class="wl-time focus"><span><?=$job->formatDeadline("d")?></span><?=$job->formatDeadline("M")?></div>
                                                <?php else:?>
                                                    <div class="wl-time"><span><?=$job->formatDeadline("d")?></span><?=$job->formatDeadline("M")?></div>
                                                <?php endif;?>
                                                <h2 class="wl-name"><a href="<?=$job->viewUrl?>" title="<?=$job->title?>"><?=$job->title?></a></h2>
                                                <div class="wl-user">Số lượng:  <strong><?=$job->amount?></strong> <i class="fa fa-user"></i></div>
                                                <?php if(!$job->isOutDate()):?>
                                                    <a href="<?=$job->viewUrl?>" class="btn btn-success pull-right">Ứng tuyển</a>
                                                <?php else:?>
                                                    <button class="btn btn-success btn-old pull-right">Hết hạn</button>
                                                <?php endif;?>
                                                <div class="clearfix"></div>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                    <div class="pagination">
                                        <div class="pull-right"><a href="<?= Url::to(['job/feature'])?>" title="Xem tất cả">Xem tất cả <i class="fa fa-angle-right"></i></a></div>
                                        <ul class="pull-left">
                                            <li class="title">Trang</li>
                                            <li class="active"><a href="#" title="Page 1">1</a></li>
                                            <li><a href="<?= Url::to(['job/feature'])?>" title="Page 2">2</a></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="latest">
                                    <ul class="work-list">
                                        <?php foreach (Statistics::getJobNewest(4) as $job) :?>
                                        <li>
                                            <?php if(!$job->isOutDate()):?>
                                                <div class="wl-time focus"><span><?=$job->formatDeadline("d")?></span><?=$job->formatDeadline("M")?></div>
                                            <?php else:?>
                                                <div class="wl-time"><span><?=$job->formatDeadline("d")?></span><?=$job->formatDeadline("M")?></div>
                                            <?php endif;?>
                                            <h2 class="wl-name"><a href="<?=$job->viewUrl?>" title="<?=$job->title?>"><?=$job->title?></a></h2>
                                            <div class="wl-user">Số lượng:  <strong><?=$job->amount?></strong> <i class="fa fa-user"></i></div>
                                            <?php if(!$job->isOutDate()):?>
                                                <a href="<?=$job->viewUrl?>" class="btn btn-success pull-right">Ứng tuyển</a>
                                            <?php else:?>
                                                <button class="btn btn-success btn-old pull-right">Hết hạn</button>
                                            <?php endif;?>
                                            <div class="clearfix"></div>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                    <div class="pagination">
                                        <div class="pull-right"><a href="<?= Url::to(['job/index'])?>" title="Xem tất cả">Xem tất cả <i class="fa fa-angle-right"></i></a></div>
                                        <ul class="pull-left">
                                            <li class="title">Trang</li>
                                            <li class="active"><a href="#" title="Page 1">1</a></li>
                                            <li><a href="<?= Url::to(['job/index'])?>" title="Page 2">2</a></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ home list -->
                <!-- search -->
                <div id="search" class="col-lg-3 pull-left">
                    <!--begin find_job_box-->
                    <?=$this->render('/widget/find_job_box')?>
                    <!--end find_job_box-->
                </div>
                <!--/ search -->
                <div class="clearfix"></div>
            </div>
        </div>
        <!--/ list work -->
        <div class="clearfix"></div>
        <!-- about -->
        <div id="home-about">
            <?=Config::findConfig("home_about") ;?>
        </div>
        <!--/ about -->
        <div class="clearfix"></div>
        <!-- stats -->
        <div id="stats">
            <div class="box">
                <div class="row">
                    <div class="col-lg-6 stats-infor">
                        <div class="block">Tổng số công việc <span><?= Statistics::getTotalJob()?></span></div>
                        <div class="block">Công việc hiện có <span><?= Statistics::getAvailableJob()?></span></div>
                        <div class="block end">Lượt quan tâm <span><?= Statistics::getSubscribeJob()?></span></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-lg-6 newsletter">
                        <?php $form = ActiveForm::begin(); ?>
                            <div class="block">
                                <div class="pull-left"><i class="fa-newsletter mr10 mt5"></i></div>
                                <strong>Nhận mail tuyển dụng</strong>
                                <p>Stay stylishly up-to-date with the latest news direct to your inbox. </p>
                            </div>
                            <div class="nlt-input">
                                <input class="form-control" type="text" placeholder="Địa chỉ Email của bạn" name="email" />
                                <button class="btn btn-cellphones" type="submit">Đăng ký</button>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--/ stats -->
    </div>
</div>
<!--/ main -->