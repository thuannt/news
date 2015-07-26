<?php
namespace iutbay\yii2fontawesome;

use yii\helpers\Html;

class FontAwesome
{

    public static function icon($iconOptions)
    {
        if (is_string($iconOptions)) {
            $iconClasses = preg_split('/\s+/', $iconOptions);
        } else {
            return;
        }

        $options = ['class' => 'fa'];
        foreach ($iconClasses as $class) {
            Html::addCssClass($options, 'fa-' . $class);
        }

        return Html::tag('i', '', $options);
    }

}
