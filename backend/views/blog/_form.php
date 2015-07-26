<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\CKEditor;
use common\widgets\KCFinderWidget;
use common\models\Blog;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */
/* @var $form yii\widgets\ActiveForm */
// kcfinder options
// http://kcfinder.sunhater.com/install#dynamic
$kcfOptions = array_merge(\iutbay\yii2kcfinder\KCFinder::$kcfDefaultOptions, [
    'deniedExts' => "exe com msi bat cgi pl php phps phtml php3 php4 php5 php6 py pyc pyo pcgi pcgi3 pcgi4 pcgi5 pchi6",
    'maxSize' => "1M",
    'uploadURL' => Yii::getAlias("@upload_url") . $model->folder,
    'uploadDir' => Yii::getAlias("@app/web/upload") . $model->folder,
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

// Set kcfinder session options
//Yii::$app->session->set('KCFINDER', $kcfOptions);
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 300]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), ['options' => ['rows' => 6]]) ?>

    <?= $form->field($model, 'thumbnail')->widget(KCFinderWidget::className(), [
        'multiple' => false,
        'kcfOptions' => $kcfOptions
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList([
        Blog::STATUS_ACTIVE => "Hiện",
        Blog::STATUS_DISABLE => "Ẩn",
    ]) ?>

    <?= $form->field($model, 'folder')->hiddenInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
