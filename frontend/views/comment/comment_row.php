<?php
use yii\bootstrap\ActiveForm;
use common\models\Comment;
/* @var $comment common\models\Comment */
/* @var $sub common\models\Comment */
/* @var $form yii\bootstrap\ActiveForm */
$sub_comments = Comment::find()->where("status = 1 and parent_id = :id and object_type = :type and object_id = :object_id",[
    ":id" => $comment->id,
    ":type" => $comment->object_type,
    ":object_id" => $comment->object_id
])->orderBy("comment_at desc")->all();
?>
<?php if($comment->user_id == null):?>
    <div class="cl-item" data-key="<?= $comment->id?>">
            <div class="cl-avatar"><img src="/images/no-avatar.jpg" border="0" /></div>
        <div class="cl-body">
            <p class="cli-name"><?= $comment->name ?><span><?= date("H:i d-m-Y",$comment->comment_at)?></span></p>
            <p><?= $comment->content ?></p>
            <a class="cl-reply">Trả lời</a>
        </div>
        <div class="clearfix"></div>
        <?php if($sub_comments && count($sub_comments) > 0):?>
            <div class="mt10 block"></div>
            <?php foreach ($sub_comments as $sub){
                echo $this->render('/comment/comment_row_sub',["sub"=>$sub]);
            }?>
        <?php endif;?>
        <div class="form-sub">
            <?php $form = ActiveForm::begin(); ?>
            <textarea class="form-control" name="Comment[content]" placeholder="Nội dung bình luận"></textarea>
            <div class="form-inline mt10">
                <?php if(\Yii::$app->user->isGuest):?>
                    <input type="text" class="form-control mr5" id="name" placeholder="Họ tên" name="Comment[name]">
                    <input type="email" class="form-control" id="email" placeholder="Địa chỉ email" name="Comment[email]">
                <?php endif; ?>
                <input type="hidden" name="parent_id" value="<?= $comment->id?>">
                <button type="submit" class="btn btn-cellphones">Gửi bình luận</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
<?php else: ?>
    <div class="cl-item cl-item-main" data-key="<?= $comment->id?>">
        <div class="cl-avatar"><img src="/images/cp-avatar.jpg" border="0" /></div>
        <div class="cl-body">
            <p class="cli-name"><?= $comment->user->username ?><span><?= date("H:i d-m-Y",$comment->comment_at)?></span></p>
            <p><?= $comment->content ?></p>
            <a class="cl-reply">Trả lời</a>
        </div>
        <div class="clearfix"></div>
        <?php if($sub_comments && count($sub_comments) > 0):?>
            <div class="mt10 block"></div>
            <?php foreach ($sub_comments as $sub){
                echo $this->render('/comment/comment_row_sub',["sub"=>$sub]);
            }?>
        <?php endif;?>
        <div class="form-sub">
            <?php $form = ActiveForm::begin(); ?>
            <textarea class="form-control" name="Comment[content]" placeholder="Nội dung bình luận"></textarea>
            <div class="form-inline mt10">
                <?php if(\Yii::$app->user->isGuest):?>
                    <input type="text" class="form-control mr5" id="name" placeholder="Họ tên" name="Comment[name]">
                    <input type="email" class="form-control" id="email" placeholder="Địa chỉ email" name="Comment[email]">
                <?php endif; ?>
                <input type="hidden" name="parent_id" value="<?= $comment->id?>">
                <button type="submit" class="btn btn-cellphones">Gửi bình luận</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
<?php endif; ?>