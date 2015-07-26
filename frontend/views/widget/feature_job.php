<?php
use common\components\Statistics;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $job common\models\Job */
?>
<div id="sb-worklist" class="box">
    <div class="box-title box-normal">Việc làm nổi bật</div>
    <div class="box-content">
        <ul class="work-list">
            <?php foreach (Statistics::getJobFeature(5) as $job) :?>
                <li>
                    <?php if(!$job->isOutDate()):?>
                        <div class="wl-time focus"><span><?=$job->formatDeadline("d")?></span><?=$job->formatDeadline("M")?></div>
                    <?php else:?>
                        <div class="wl-time"><span><?=$job->formatDeadline("d")?></span><?=$job->formatDeadline("M")?></div>
                    <?php endif;?>
                    <h2 class="wl-name"><a href="<?=$job->viewUrl?>" title="<?=$job->title?>"><?=$job->title?></a></h2>
                    <div class="wl-user">Số lượng:  <strong><?=$job->amount?></strong> <i class="fa fa-user"></i></div>
                    <div class="clearfix"></div>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="box-bottom">
        <a href="<?= Url::to(['job/feature'])?>" class="more">Xem thêm</a>
    </div>
</div>