<?php
use \common\models\Position;
use \common\models\Address;
use \common\models\WorkType;
use yii\helpers\Url;
/* @var $this \yii\web\View */
$position_id = "";
$type_id = "";
$location_id = "";
if(isset($_GET['pos']) && !empty($_GET['pos'])){
    $position_id = (int)$_GET['pos'];
}
if(isset($_GET['type']) && !empty($_GET['type'])){
    $type_id = (int)$_GET['type'];
}
if(isset($_GET['add']) && !empty($_GET['add'])){
    $location_id = (int)$_GET['add'];
}
?>
<div class="box">
    <div class="box-title">Tìm việc nhanh</div>
    <!-- for mobile -->
    <a id="search-content" class="box-title">
        <i class="fa fa-search mr10"></i>Tìm việc nhanh
        <span class="pull-right">Mở rộng<i class="ml10 fa fa-angle-down"></i></span>
        <span class="pull-right colls">Rút gọn<i class="ml10 fa fa-angle-up"></i></span>
    </a>
    <!--/ for mobile -->
    <div class="box-content">
        <p>Điền vào mẫu bên dưới và tìm kiếm những cơ hội phù hợp với bạn.</p>
        <form method="get" action="<?= Url::to(['job/index'])?>">
            <select name="pos" class="selectpicker">
                <option value="">Tất cả ngành nghề</option>
                <?php foreach (Position::findAll() as $row) :?>
                    <option value="<?=$row->ID?>" <?= $row->ID == $position_id ? "selected = 'selected'" : ""?>><?=$row->title?></option>
                <?php endforeach;?>
            </select>
            <select name="type" class="selectpicker">
                <option value="">Tất cả hình thức</option>
                <?php foreach (WorkType::findAll() as $row) :?>
                    <option value="<?=$row->ID?>" <?= $row->ID == $type_id ? "selected = 'selected'" : ""?>><?=$row->title?></option>
                <?php endforeach;?>
            </select>
            <select name="add" class="selectpicker">
                <option value="">Tất cả địa điểm</option>
                <?php foreach (Address::findAll() as $row) :?>
                    <option value="<?=$row->ID?>" <?= $row->ID == $location_id ? "selected = 'selected'" : ""?>><?=$row->title?></option>
                <?php endforeach;?>
            </select>
            <button class="btn btn-success btn-block" type="submit">Tìm nhanh</button>
        </form>
    </div>
</div>