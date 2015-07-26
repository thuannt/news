<?php
/* @var $sub common\models\Comment */
?>
<?php if($sub->user_id == null):?>
    <div class="cl-item-sub">
        <div class="cl-avatar"><img src="/images/no-avatar.jpg" border="0"/></div>
        <div class="cl-body">
            <p class="cli-name"><?= $sub->name ?> <span><?= date("H:i d-m-Y",$sub->comment_at)?></span></p>
            <p><?= $sub->content ?></p>
        </div>
        <div class="clearfix"></div>
    </div>
<?php else:?>
    <div class="cl-item-sub cl-item-sub-main">
        <div class="cl-avatar"><img src="/images/cp-avatar.jpg" border="0" /></div>
        <div class="cl-body">
            <p class="cli-name"><?= $sub->user->username ?> <span><?= date("H:i d-m-Y",$sub->comment_at)?></span></p>
            <p><?= $sub->content ?></p>
        </div>
        <div class="clearfix"></div>
    </div>
<?php endif;?>