<?php
use backend\assets_b\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--    <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">-->

    <style type="text/css">
        /*
 * Base structure
 */

        /* Move down content because we have a fixed navbar that is 50px tall */
        body {
            padding-top: 50px;
        }

        /*
         * Global add-ons
         */

        .sub-header {
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        /*
         * Sidebar
         */

        /* Hide for mobile, show later */
        .sidebar {
            display: none;
        }

        @media (min-width: 768px) {
            .sidebar {
                position: fixed;
                top: 51px;
                bottom: 0;
                left: 0;
                z-index: 1000;
                display: block;
                padding: 20px;
                overflow-x: hidden;
                overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
                background-color: #f5f5f5;
                border-right: 1px solid #eee;
            }
        }

        /* Sidebar navigation */
        .nav-sidebar {
            margin-right: -21px; /* 20px padding + 1px border */
            margin-bottom: 20px;
            margin-left: -20px;
        }

        .nav-sidebar > li > a {
            padding-right: 20px;
            padding-left: 20px;
        }

        .nav-sidebar > .active > a {
            color: #fff;
            background-color: #428bca;
        }

        /*
         * Main content
         */

        .main {
            padding: 20px;
        }

        @media (min-width: 768px) {
            .main {
                padding-right: 40px;
                padding-left: 40px;
            }
        }

        .main .page-header {
            margin-top: 0;
        }

        /*
         * Placeholder dashboard ideas
         */

        .placeholders {
            margin-bottom: 30px;
            text-align: center;
        }

        .placeholders h4 {
            margin-bottom: 0;
        }

        .placeholder {
            margin-bottom: 20px;
        }

        .placeholder img {
            display: inline-block;
            border-radius: 50%;
        }

    </style>

    <script src="<?= Yii::$app->urlManager->createAbsoluteUrl('js/Chart.Line.js') ?>"></script>

</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Tuyển Dụng CellphoneS',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->email . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <div class="col-sm-3 col-md-2 sidebar">

            <ul class="nav nav-pills nav-stacked">
                <li><p class="lead">Quản trị</p></li>
                <li><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('comment'); ?>">Bình Luận</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('slide'); ?>">Hình ảnh nổi bật</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('blog'); ?>">Blog - Tin tức</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('menu'); ?>">Menu</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('page'); ?>">Quản lý trang</a></li>
                <li><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('system'); ?>">Cài đặt site</a></li>

            </ul>


        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

</div>


<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; @CellphoneS <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script src="http://getbootstrap.com/assets/js/docs.min.js"></script>
<script>
    function showReply(id){
        $('#reply-id').val(id);
        $('#btn-show-reply').click();
    };
    $(document).ready(function(){

    });
</script>
</body>
</html>
<?php $this->endPage() ?>






