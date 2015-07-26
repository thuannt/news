<?php

namespace frontend\controllers;

use common\models\Page;
use yii\web\NotFoundHttpException;

class PageController extends \yii\web\Controller
{
    public function actionView($slug)
    {
        $page = $this->findModelBySlug($slug);
        return $this->render('view',["page"=>$page]);
    }
    protected function findModelBySlug($slug)
    {
        if (($model = Page::find()->where("status = 1 and slug = :slug",[":slug"=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
