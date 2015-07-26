<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Slide;
use common\widgets\KCFinderWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Slide */
/* @var $form yii\widgets\ActiveForm */

$kcfOptions = array_merge(\iutbay\yii2kcfinder\KCFinder::$kcfDefaultOptions, [
    'deniedExts' => "exe com msi bat cgi pl php phps phtml php3 php4 php5 php6 py pyc pyo pcgi pcgi3 pcgi4 pcgi5 pchi6",
    'maxSize' => "1M",
    'uploadURL' => Yii::getAlias("@upload_url") . Slide::UPLOAD_PATH,
    'uploadDir' => Yii::getAlias("@app/web/upload") . Slide::UPLOAD_PATH,
    'access' => [
        'files' => [
            'upload' => true,
            'delete' => true,
            'copy' => false,
            'move' => false,
            'rename' => false,
        ],
        'dirs' => [
            'create' => true,
            'delete' => false,
            'rename' => false,
        ],
    ],
    'types' => array(
        // The folowing directory types are just for an example
        'files' => "",
        'flash' => "swf",
        'media' => "swf flv avi mpg mpeg qt mov wmv asf rm",
        'misc' => "! pdf doc docx xls xlsx",
        'images' => "*img",
        'mimages' => "*mime image/gif image/png image/jpeg",
        'notimages' => "*mime ! image/gif image/png image/jpeg"
    ),]);
?>

<div class="slide-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 300]) ?>

    <?= $form->field($model, 'thumbnail')->widget(KCFinderWidget::className(), [
        'multiple' => false,
        'kcfOptions' => $kcfOptions
    ]); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([
        Slide::STATUS_ACTIVE => "Hiện",
        Slide::STATUS_DISABLE => "Ẩn",

    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
