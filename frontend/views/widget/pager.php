<?php
if(isset($pageInfo)){

    $pagination = new \yii\data\Pagination();
    $pagination->totalCount = $pageInfo['total_page'];
    $pagination->pageSize = $pageInfo['range_page'];
    $pagination->page=$pageInfo['current_page']-1;
}
$pagination->pageParam = "p";
$pagination->pageSizeParam = false;
echo \yii\widgets\LinkPager::widget([
    'pagination' => $pagination,
]);
?>
