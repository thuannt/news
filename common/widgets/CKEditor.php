<?php
/**
 * Created by PhpStorm.
 * User: thuan_000
 * Date: 5/10/2015
 * Time: 1:06 AM
 */

namespace common\widgets;

use dosamigos\ckeditor\CKEditorWidgetAsset;
use yii\helpers\ArrayHelper;

use iutbay\yii2kcfinder\KCFinderAsset;
use yii\helpers\Json;

class CKEditor extends \dosamigos\ckeditor\CKEditor
{

    public $enableKCFinder = true;
    public $enableHtml = false;

    /**
     * Registers CKEditor plugin
     */
    protected function registerPlugin()
    {
        if ($this->enableKCFinder)
        {
            $this->registerKCFinder();
        }
        $js = [];

        $view = $this->getView();

        CKEditorWidgetAsset::register($view);

        $id = $this->options['id'];

        $options = $this->clientOptions !== false && !empty($this->clientOptions)
            ? Json::encode($this->clientOptions)
            : '{}';

        $js[] = "CKEDITOR.replace('$id', $options);";
        if($this->enableHtml){
            $js[] = "CKEDITOR.config.allowedContent = true;";
            $js[] = 'CKEDITOR.config.fillEmptyBlocks = false;';
            $js[] = 'CKEDITOR.dtd.$removeEmpty["i"] = false;';
        }
        $js[] = "dosamigos.ckEditorWidget.registerOnChangeHandler('$id');";

        if (isset($this->clientOptions['filebrowserUploadUrl'])) {
            $js[] = "dosamigos.ckEditorWidget.registerCsrfImageUploadHandler();";
        }

        $view->registerJs(implode("\n", $js));


//        parent::registerPlugin();
    }

    /**
     * Registers KCFinder
     */
    protected function registerKCFinder()
    {
        $register = KCFinderAsset::register($this->view);
        $kcfinderUrl = $register->baseUrl;

        $browseOptions = [
            'filebrowserBrowseUrl' => $kcfinderUrl . '/browse.php?opener=ckeditor&type=files',
            'filebrowserUploadUrl' => $kcfinderUrl . '/upload.php?opener=ckeditor&type=files',
        ];

        $this->clientOptions = ArrayHelper::merge($browseOptions, $this->clientOptions);
    }

}