<?php
use common\models\Comment;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $comments common\models\Comment[] */

$comment = new Comment();
?>
<div class="comment">
    <h4>Bình luận</h4>
    <p>Gửi bình luận của bạn cho bài viết này.</p>
    <!--                    <div class=" alert alert-success">Phản hồi của bạn đã được gửi đi.</div>-->
    <!--                    <div class=" alert alert-danger">Bạn chưa nhập email.</div>-->
    <?php $form = ActiveForm::begin(); ?>
    <?php if(\Yii::$app->user->isGuest):?>
        <div class="form-inline">
            <input type="text" class="form-control mr5" id="name" placeholder="Họ tên" name="Comment[name]" >
            <input type="email" class="form-control" id="email" placeholder="Địa chỉ email" name="Comment[email]" >
        </div>
    <?php endif; ?>
        <textarea class="form-control mt10" name="Comment[content]" placeholder="Nội dung bình luận"></textarea>
        <button type="submit" class="btn btn-cellphones mt10">Gửi bình luận</button>
    <?php ActiveForm::end(); ?>
    <div class="comment-list">
        <?php foreach ($comments as $comment) {
            echo $this->render('/comment/comment_row',["comment"=>$comment]);
        }
        ?>
        <?php if($comments && count($comments) > 0 && $comment->id > $min_cmt_id):?>
        <button id="btn-loadmore" type="button" class="btn btn-block btn-default" data-last="<?= $min_cmt_id?>">Xem thêm</button>
        <?php endif;?>
    </div>
</div>
<script>
    $(document).ready(function () {
        // Demo comment
        $(".cl-reply").click(function (e) {
            //$(".cl-item .form-sub").hide();
            $(this).parents(".cl-item").find('.form-sub').toggle();
        });
        $("#btn-loadmore").click(function (e) {
            var key = $(".comment .cl-item:last").attr("data-key");
            $.ajax({
                type: "get",
                dataType: "json",
                url : "<?= \yii\helpers\Url::to(["site/loadcomment"])?>",
                data: {key:key},
                success : function(data){
                    if(data.status ==1){
                        $(".comment .cl-item:last").after(data.html);
                        var last_key = $(".comment .cl-item:last").attr("data-key");
                        if(last_key<=key){
                            $("#btn-loadmore").remove();
                            $(".cl-reply").click(function (e) {
                                //$(".cl-item .form-sub").hide();
                                $(this).parents(".cl-item").find('.form-sub').toggle();
                            });
                        }
                    }
                }
            })
        });
    });
</script>