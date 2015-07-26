<?php

namespace frontend\controllers;

use common\components\Format;
use common\models\Blog;
use common\models\Comment;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

class BlogController extends \yii\web\Controller
{
    const LIMIT = 15;
    public function actionIndex()
    {
        $page = 1;
        if(isset($_GET['p'])){
            $page = (int) $_GET['p'];
            $page = $page < 1 ? 1 : $page;
        }
        $query = Blog::find()->where("status = 1");
        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count()]);
        $pagination->pageSize=self::LIMIT;
        $pagination->page = $page-1;
        $blogs = $query->addOrderBy("id Desc")->limit(self::LIMIT)->offset(($page - 1) * self::LIMIT)->all();
        return $this->render('index',["blogs"=>$blogs,'pagination' => $pagination]);
    }

    public function actionView($slug,$id)
    {
        $blog = $this->findModel($id);
        if(\Yii::$app->request->isPost){
            if(isset($_POST['Comment'])){
                if(isset($_POST['parent_id'])){
                    $parent_id = (int) $_POST['parent_id'];
                    $parent = Comment::find()->where("id = :id and status = 1 and object_type = :type and object_id = :object_id",[
                        ":id" => $parent_id,
                        ":type" => Blog::className(),
                        ":object_id" => $id
                    ])->one();
                    if($parent){
                        $comment = new Comment();
                        $comment->load(\Yii::$app->request->post());
                        $comment->object_id = $id;
                        $comment->object_type = Blog::className();
                        $comment->comment_at = time();
                        $comment->ip = Format::get_ip_address();
                        $comment->parent_id = $parent_id;
                        if(\Yii::$app->user->isGuest){
                            $comment->name = Html::encode($comment->name);
                        }else{
                            $comment->user_id = \Yii::$app->user->id;
                        }
                        $comment->content = Html::encode($comment->content);
                        if(!isset($_SESSION['work_user'])){
                            $_SESSION['work_user']['email']= $comment->email;
                            $_SESSION['work_user']['name']= $comment->name;
                        }
                        $comment->save();
                        return $this->refresh();
                    }
                }else{
                    $comment = new Comment();
                    $comment->load(\Yii::$app->request->post());
                    $comment->object_id = $id;
                    $comment->object_type = Blog::className();
                    $comment->comment_at = time();
                    $comment->ip = Format::get_ip_address();
                    if(\Yii::$app->user->isGuest){
                        $comment->name = Html::encode($comment->name);
                    }else{
                        $comment->user_id = \Yii::$app->user->id;
                    }
                    $comment->content = Html::encode($comment->content);
                    if(!isset($_SESSION['work_user'])){
                        $_SESSION['work_user']['email']= $comment->email;
                        $_SESSION['work_user']['name']= $comment->name;
                    }
                    $comment->save();
                    return $this->refresh();
                }
            }
        }
        $others = Blog::find()->addOrderBy("id Desc")->limit(3)->all();
        $comments = Comment::find()->where("status = 1 and parent_id is null and object_type = :type and object_id = :object_id",[
            ":type" => Blog::className(),
            ":object_id" => $id
        ])->limit(10)->orderBy("comment_at desc")->all();
        $min_cmt = Comment::find()->where("status = 1 and parent_id is null and object_type = :type and object_id = :object_id",[
            ":type" => Blog::className(),
            ":object_id" => $id
        ])->orderBy("comment_at asc")->one();
        $min_cmt_id = 0;
        if($min_cmt){
            $min_cmt_id = $min_cmt->id;
        }
        return $this->render('view',['blog'=>$blog,"others"=>$others,"comments"=>$comments,"min_cmt_id"=>$min_cmt_id]);
    }
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
