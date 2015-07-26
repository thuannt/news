<?php
/* @var $this \yii\web\View */
?>
<div id="bread">
    <ol class="breadcrumb">
        <li><a href="/">Trang chủ</a></li>
        <?php if(isset($this->params['breadcrumbs'])):
            foreach ($this->params['breadcrumbs'] as $breadcrumbs) :
                ?>
                <?php if(!is_array($breadcrumbs)):?>
                <li class="active"><?= $breadcrumbs?></li>
                <?php elseif(!isset($breadcrumbs["url"])):?>
                    <li class="active"><?= $breadcrumbs["label"]?></li>
                <?php else:?>
                    <li><a href="<?=$breadcrumbs["url"]?>"><?=$breadcrumbs["label"]?></a></li>
                <?php endif;?>
        <?php
        endforeach;
        endif;?>
    </ol>
</div>
