<?php
use common\models\Config;
/* @var $this \yii\web\View */
$location = Yii::$app->session->get("user_location",-1);
$footer_key = "footer";
if($location == 4){
    $footer_key = "footer_hn";
}
else if($location == 5){
    $footer_key = "footer_sg";
}
?>
<div id="footer">
    <?= Config::findConfig($footer_key)?>
</div>