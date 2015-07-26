<?php
use common\models\Config;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $job common\models\Job */
/* @var $form yii\widgets\ActiveForm */
/* @var $apply_form common\models\ApplyForm */
$this->title = $job->title;
$this->params['breadcrumbs'][] = ['label' => 'Tuyển dụng', 'url' => Url::to(['job/index'])];
$this->params['breadcrumbs'][] = $job->title;
$contact_key = "apply_contact";
$location = Yii::$app->session->get("user_location",-1);
if($location == 4){
    $contact_key = "apply_contact_hn";
}
else if($location == 5){
    $contact_key = "apply_contact_sg";
}


?>
<!-- main -->
<div id="main">
    <div class="container">
        <div class="row">
            <!-- content -->
            <div id="content-wrap" class="col-lg-9">
                <!--begin Breadcrumbs-->
                <?=$this->render('/widget/breadcrumbs')?>
                <!--end Breadcrumbs-->
                <div id="content" class="recruitment recruitment-view">
                    <h1><?= $job->title?></h1>
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-join">Ứng tuyển công việc này</button>
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-success btn-join-m">Ứng tuyển công việc này</button>
                    <ul class="job-desc">
                        <li><strong>Vị trí tuyển dụng:</strong><?= $job->position_title?></li>
<!--                        <li><strong>Chức vụ:</strong></li>-->
                        <li><strong>Yêu cầu bằng cấp:</strong><?= $job->degree_title?></li>
                        <li><strong>Hình thức:</strong><?= $job->type_title?></li>
                        <li><strong>Số lượng cần tuyển:</strong><?= $job->amount?> người</li>
                        <li><strong>Số năm kinh nghiệm:</strong> <?= $job->experience_title?></li>
<!--                        <li><strong>Yêu cầu độ tuổi:</strong> 18-30 tuổi</li>-->
                        <li><strong>Mức lương:</strong><?= $job->salary?></li>
                        <li><strong>Địa điểm làm việc:</strong><?= $job->location_title?></li>
                        <li><strong>Ngày hết hạn:</strong> <?= $job->deadline?></li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="content">
                        <h4>Mô tả công việc</h4>
                        <p><?= $job->desc?></p>
                        <?php if($job->contract_req && !empty($job->contract_req)):?>
                        <h4>Thông tin hồ sơ</h4>
                        <p><?= $job->contract_req?></p>
                        <?php endif;?>
                        <?php if($job->rules && !empty($job->rules)):?>
                        <h4>Quyền lợi</h4>
                        <p><?= $job->rules?></p>
                        <?php endif;?>
                        <?php if($job->desc_info && !empty($job->desc_info)):?>
                        <h4>Yêu cầu khác</h4>
                        <p><?= $job->desc_info?></p>
                        <?php endif;?>
<!--begin apply_contact-->
                        <?= Config::findConfig($contact_key)?>
<!--end apply_contact-->
                        <div class="btn-bottom">
                            <button data-toggle="modal" data-target="#myModal" class="btn btn-lg btn-success btn-join">Ứng tuyển công việc này</button>
                        </div>
                        <div class="block view-tools">
                            <div class="row">
                                <div class="col-lg-8 vt-file">
<!--                                    <strong>Tải file ứng tuyển công việc</strong>-->
<!--                                    <div class="block mt10">-->
<!--                                        <a href="#" title="Tải file .pdf" class="mr10"><i class="fa-cv fa-pdf"></i></a><a href="#" title="Tải file .doc"><i class="fa-cv fa-word"></i></a>-->
<!--                                    </div>-->
                                </div>
                                <div class="col-lg-4 vt-share">
                                    <strong>Chia sẻ công việc này tới bạn bè</strong>
                                    <div class="fb-like" data-href="<?=$job->viewUrl?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                                    <div class="g-plusone" data-size="medium"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Begin comment-->
                    <?=$this->render('/widget/comment',["comments"=>$comments,"min_cmt_id"=>$min_cmt_id])?>
                    <!--End comment-->
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
                <?=$this->render('/widget/feature_job')?>
                <!--/ work list -->
            </div>
            <!--/ sidebar -->
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--/ main -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Thông tin cá nhân ứng tuyển</h4>
            </div>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="modal-body">
                    <div class="form-block">
                        <label class="block" for="name">Họ tên</label>
                        <input type="text" class="form-control" name="ApplyForm[name]" id="name" required="true">
                    </div>
                    <div class="form-block mt10 md-birthday">
                        <label class="block" for="birthday">Ngày sinh</label>
                        <div class="input-group date" id="datetimepicker">
                            <input type="text" name="ApplyForm[dob]" id="datetimeinput" class="form-control" required="true" />
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                        </div>
                    </div>
<!--                    <div class="form-block mt10 md-birthday-m">-->
<!--                        <label class="block" for="birthday">Ngày sinh</label>-->
<!--                        <input type="date" name="birthday" style="width: 100%;" class="form-control" />-->
<!--                    </div>-->
                    <div class="form-block mt10">
                        <label class="block" for="address">Địa chỉ</label>
                        <input type="text" class="form-control" name="ApplyForm[address]" id="address" required="true">
                    </div>
                    <div class="row mt10">
                        <div class="col-lg-6 md-phone">
                            <label class="block" for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" name="ApplyForm[phone]" id="phone" required="true">
                        </div>
                        <div class="col-lg-6 md-email">
                            <label class="block" for="email">Email</label>
                            <input type="email" class="form-control" name="ApplyForm[email]" id="email" placeholder="Email" required="true">
                        </div>
                    </div>
                    <div class="form-block mt10">
                        <label class="block" for="job">Vị trí ứng tuyển</label>
                        <input type="text" class="form-control" value="<?= $job->position_title?>" name="ApplyForm[position]" id="job" required="true">
                    </div>
                    <div class="form-block mt10">
                        <label class="block" for="reason">Vì sao bạn ứng tuyển vị trí này?</label>
                        <textarea class="form-control" name="ApplyForm[reason]" required="required"></textarea>
                    </div>
                    <div class="form-block mt20">
                        <label class="block" for="cv-file">Đính kèm hồ sơ (CV)</label>
                        <input type="file" name="ApplyForm[attach]" id="cv-file" required="true">
                        <p class="help-block">(*.DOC, *.DOCX, *.PDF), dung lượng tối đa 5MBs</p>
                    </div>
                    <div class="form-block mt20">
                        <label class="block" for="cv-file">Mã xác nhận</label>
<!--                        <p><img src="images/captcha.png" /></p>-->
<!--                        <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Nhập mã xác nhận">-->
                        <?= $form->field($apply_form, 'captcha')->widget(Captcha::className(), [
                            'template' => '<p>{image}</p>{input}',
                        ])->label(false) ?>

                    </div>
            </div>
            <div class="modal-footer" style="text-align: left">
                <button type="submit" class="btn btn-success btn-approve">Hoàn thành</button>
                <button data-dismiss="modal" class="btn btn-default" type="button">Bỏ qua</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!--/ modal -->
