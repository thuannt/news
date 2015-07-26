<?php
use common\models\Menu;
use common\models\Config;
use yii\helpers\Url;
/* @var $this \yii\web\View */
$menu_query = Menu::find()->addOrderBy("position")->where("status = 1");
$location = Yii::$app->session->get("user_location",-1);
$hotline_key = "hotline";
if($location == 4){
	$hotline_key = "hotline_hn";
}
else if($location == 5){
	$hotline_key = "hotline_sg";	
}
?>
<?php //if(!Yii::$app->params["cache_active"] || $this->beginCache("cache_header",['duration'=>Yii::$app->params["html.fix.cache"]])):?>
<!-- navbar -->
<div id="navbar">
    <?=Config::findConfig(Config::KEY_TOP_BAR);?>
</div>
<!--/ navbar -->
<div class="clearfix"></div>
<!-- header -->
<div id="header">
    <div class="container">
        <div class="header-logo"><a href="/" title="Cơ hội việc làm tại Cellphones.com.vn" id="logo"><h1>Cơ hội việc làm tại Cellphones.com.vn</h1></a></div>
        <div class="header-infor pull-right">
            <div class="hi-location">
                <i class="fa fa-map-marker mr5"></i>
                <select class="selectpicker" id="drl-location">
                    <option <?= $location == 4 ? "selected":"" ?> data-url="<?= Url::to(["site/changeregion", "key" => 4]) ?>" ><a href="<?= Url::to(["site/changeregion", "key" => 4]) ?>">Hà Nội</a></option>
                    <option <?= $location == 5 ? "selected":"" ?> data-url="<?= Url::to(["site/changeregion", "key" => 5]) ?>"><a href="<?= Url::to(["site/changeregion", "key" => 5]) ?>">TP. HCM</a></option>
                </select>
            </div>
            <div class="hi-hotline"><i class="fa fa-phone mr10"></i>Hotline: <span><?=Config::findConfig($hotline_key);?></span></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--/ header -->
<div class="clearfix"></div>
<!-- menu -->
<div id="menu">
    <div class="container">
        <!-- for mobile --><a id="nav-btn"><i class="fa fa-align-justify mr10"></i>Menu</a><!--/ for mobile -->
        <ul class="top-menu fade in">
            <?php foreach($menu_query->all() as $menu): ?>
                <li  class="header-menu"><a data-url="<?= $menu->url?>" href="<?= $menu->url?>" title="<?= $menu->name?>"><?= $menu->name?></a></li>
            <?php endforeach;?>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!--/ menu -->
<div class="clearfix"></div>
<?php
//    if(Yii::$app->params["cache_active"]){
//        $this->endCache();
//    }
//    endif;
    ?>