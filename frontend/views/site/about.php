<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$page = \common\models\Page::find()->where("name = :name and status = 1",[":name"=>"about"])->one();
?>
<!-- main -->
<div id="main">
    <div class="container">
        <div class="row">
            <!-- content -->
            <div id="content-wrap" class="col-lg-9">
<!--                <div id="bread">-->
<!--                    <ol class="breadcrumb">-->
<!--                        <li><a href="index.html">Trang chủ</a></li>-->
<!--                        <li class="active">Giới thiệu về Cellphones</li>-->
<!--                    </ol>-->
<!--                </div>-->
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <div id="content" class="about">
                    <h1>Giới thiệu</h1>
                    <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h2>
                    <br />
                    <p class="text-center"><img src="images/logo.png" border="0" alt="Cellphones.com.vn" title="Cellphones.com.vn" /></p>
                    <br />
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>
                    <br />
                    <p class="text-center"><img src="images/about.jpg" border="0" alt="Cellphones.com.vn" title="Cellphones.com.vn" /></p>
                    <br />
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam.</p>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.</p>
                </div>
            </div>
            <!--/ content -->
            <!-- sidebar -->
            <div id="sidebar" class="col-lg-3">
                <!-- search -->
                <div id="search">
                    <!--begin find_job_box-->
                    <?=$this->render('/widget/find_job_box')?>
                    <!--end find_job_box-->
                </div>
                <!--/ search -->
                <!-- work list -->
                <div id="sb-worklist" class="box">
                    <div class="box-title box-normal">Việc mới nhất</div>
                    <div class="box-content">
                        <ul class="work-list">
                            <li>
                                <div class="wl-time focus"><span>8</span>APRIL</div>
                                <h2 class="wl-name"><a href="view.html" title="">Cellphones tuyển dụng nhân viên Websmarter</a></h2>
                                <div class="wl-user">Số lượng:  <strong>2</strong> <i class="fa fa-user"></i></div>
                                <div class="clearfix"></div>
                            </li>
                            <li>
                                <div class="wl-time focus"><span>22</span>APRIL</div>
                                <h2 class="wl-name"><a href="view.html" title="">Cellphones tuyển dụng nhân viên SEO</a></h2>
                                <div class="wl-user">Số lượng:  <strong>2</strong> <i class="fa fa-user"></i></div>
                                <div class="clearfix"></div>
                            </li>
                            <li>
                                <div class="wl-time"><span>17</span>May</div>
                                <h2 class="wl-name"><a href="view.html" title="">Cellphones tuyển dụng chuyên viên Digital Marketing</a></h2>
                                <div class="wl-user">Số lượng:  <strong>2</strong> <i class="fa fa-user"></i></div>
                                <div class="clearfix"></div>
                            </li>
                            <li>
                                <div class="wl-time"><span>17</span>May</div>
                                <h2 class="wl-name"><a href="view.html" title="">Cellphones tuyển Cộng tác viên Thiết kế nội thất</a></h2>
                                <div class="wl-user">Số lượng:  <strong>2</strong> <i class="fa fa-user"></i></div>
                                <div class="clearfix"></div>
                            </li>
                            <li>
                                <div class="wl-time"><span>17</span>May</div>
                                <h2 class="wl-name"><a href="view.html" title="">Cellphones tuyển nhân viên bảo vệ</a></h2>
                                <div class="wl-user">Số lượng:  <strong>2</strong> <i class="fa fa-user"></i></div>
                                <div class="clearfix"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="box-bottom">
                        <a href="#" class="more">Xem thêm</a>
                    </div>
                </div>
                <!--/ work list -->
            </div>
            <!--/ sidebar -->
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--/ main -->