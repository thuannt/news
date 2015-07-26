<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Config;
use common\widgets\CKEditor;
use common\widgets\KCFinderWidget;


/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form yii\widgets\ActiveForm */

$kcfOptions = array_merge(\iutbay\yii2kcfinder\KCFinder::$kcfDefaultOptions, [
    'deniedExts' => "exe com msi bat cgi pl php phps phtml php3 php4 php5 php6 py pyc pyo pcgi pcgi3 pcgi4 pcgi5 pchi6",
    'maxSize' => "1M",
    'uploadURL' => Yii::getAlias("@upload_url") . Config::UPLOAD_PATH,
    'uploadDir' => Yii::getAlias("@app/web/upload") . Config::UPLOAD_PATH,
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

<div class="config-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'scope')->textInput() ?>-->

    <?= $form->field($model, 'key')->textInput(['maxlength' => 50]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>
    <?= $form->field($model, 'type')->dropDownList([
        Config::TYPE_INPUT  => "Input",
        Config::TYPE_EDITOR => "Editor",
        Config::TYPE_IMAGE  => "Hình ảnh",
    ]); ?>

    <?php if($model->type == Config::TYPE_EDITOR):
    Yii::$app->session->set('KCFINDER', $kcfOptions);
        ?>
    <?= $form->field($model, 'value')->widget(CKEditor::className(), ["enableHtml"=>true,"clientOptions"=>[],'options' => ['rows' => 6]]) ?>
    <?php elseif($model->type == Config::TYPE_IMAGE):?>
    <?= $form->field($model, 'value')->widget(KCFinderWidget::className(), [
        'multiple' => false,
        'kcfOptions' => $kcfOptions
    ]); ?>
    <?php else:?>
    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>
    <?php endif;?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
