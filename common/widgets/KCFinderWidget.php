<?php

namespace common\widgets;
use iutbay\yii2fontawesome\FontAwesome;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use iutbay\yii2kcfinder\KCFinderInputWidget;

class KCFinderWidget extends KCFinderInputWidget {
    public $buttonLabel = 'Chọn ảnh';
    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->registerClientScript();

        $button = Html::button(FontAwesome::icon('picture-o') . ' ' . $this->buttonLabel, $this->buttonOptions);

        if ($this->iframe) {
            $button.= Modal::widget([
                'id' => $this->getIFrameModalId(),
                'header' => Html::tag('h4', $this->modalTitle, ['class' => 'modal-title']),
                'size' => Modal::SIZE_LARGE,
                'options' => [
                    'class' => 'kcfinder-modal',
                ],
            ]);
        }

        $thumbs = '';
        if ($this->hasModel()) {
            if(is_array($this->model->{$this->attribute})){
                $images = $this->model->{$this->attribute};
                foreach ($images as $path) {
                    $thumbs.= strtr($this->thumbTemplate, [
                        '{thumbSrc}' => $this->getThumbSrc($path),
                        '{inputName}' => $this->getInputName(),
                        '{inputValue}' => $path,
                    ]);
                }
            }else{
                $path = $this->model->{$this->attribute};
                if($path && !empty($path)){
                    $thumbs.= strtr($this->thumbTemplate, [
                        '{thumbSrc}' => $this->getThumbSrc($path),
                        '{inputName}' => $this->getInputName(),
                        '{inputValue}' => $path,
                    ]);
                }
            }
        }
        $thumbs = Html::tag('ul', $thumbs, ['id' => $this->getThumbsId(), 'class' => 'kcf-thumbs']);

        echo Html::tag('div', strtr($this->template, [
            '{button}' => $button,
            '{thumbs}' => $thumbs,
        ]), ['class' => 'kcf-input-group']);
    }
}