<?php
return [
    'timeZone' => 'Asia/Ho_Chi_Minh',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules'=>[
        'dynagrid'=>[
            'class'=>'\kartik\dynagrid\Module',
            // other settings (refer documentation)
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
//            'class'=>'system.caching.CDbCache'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
