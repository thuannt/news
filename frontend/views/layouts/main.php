<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index,follow" />
    <meta http-equiv="content-language" content="vi" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="<?=Yii::$app->request->baseUrl?>/images/favicon.ico" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script type="text/javascript" src="<?= Yii::getAlias('@base_url')?>/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<!-- begin header-->
<?= $this->render("header")?>
<!-- end header-->
<?= $content ?>
<!-- footer -->
<?= $this->render("footer");?>
<!--/ footer -->
<!-- Modal -->
<button id="btnShow" type="button" style="display: none !important;" data-toggle="modal" data-target="#my-location"></button>
<div class="modal fade" id="my-location" role="dialog">
    <div class="modal-dialog" style="transform: translate(0px, 200px)">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Chọn tỉnh thành</h4>
            </div>
            <div class="modal-body">
                Vui lòng chọn lựa tỉnh thành thích hợp cho bạn.
                <a href="<?= Url::to(["site/changeregion","key"=>4])?>" class="btn btn-default btn-block"><i class="fa fa-map-marker mr10"></i>Hà Nội<i class="fa fa-chevron-circle-right"></i></a>
                <a href="<?= Url::to(["site/changeregion","key"=>5])?>" class="btn btn-default btn-block"><i class="fa fa-map-marker mr10"></i>Hồ Chí Minh<i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
<!--/ modal -->
<?php $this->endBody() ?>
<script type="text/javascript" src="/js/moment-with-locales.js"></script>
<script type="text/javascript" src="/js/bootstrap-datetimepicker.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        loop: true,
        autoplay: 5000,
        nextButton: '.slide-next',
        prevButton: '.slide-prev'
    });
</script>
<script>
    $(document).ready(function () {
        <?php if(!Yii::$app->session->has("user_location")):?>
        $("#btnShow").click();
        <?php endif;?>
        $("li.header-menu a[data-url='<?=explode("?",Yii::$app->request->getAbsoluteUrl())[0]?>']").addClass('active');
        $("#search a.box-title").click(function (e) {
            $("#search .box").toggleClass("active");
        });
        $("#nav-btn").click(function (e) {
            $("#menu").toggleClass("active");
        });
        $("#drl-location").change(function(){
            var selected =  $("#drl-location option:selected");
            if(selected.html()!== undefined){
                var url = $(selected).attr('data-url');
                location.href = url;
            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker, #datetimeinput').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY',
        });
    });
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=727243164041505";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!-- navbar -->
</body>
</html>
<?php $this->endPage() ?>