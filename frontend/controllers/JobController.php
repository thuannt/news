<?php

namespace frontend\controllers;

use common\components\Format;
use common\models\ApplyForm;
use common\models\ApplyLog;
use common\models\Comment;
use common\models\Job;
use common\models\JobSearch;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;

class JobController extends \yii\web\Controller
{
    const LIMIT = 15;
    public function actionIndex()
    {
        $page = 1;
        if(isset($_GET['p'])){
            $tmp_page = (int)$_GET['p'];
            $page = $tmp_page > 0 ? $tmp_page : 1;
        }

        $search = new JobSearch();
        if(isset($_GET['pos']) && !empty($_GET['pos'])){
            $position_id = (int)$_GET['pos'];
            if($position_id > 0){
                $search->setPosition_id($position_id);
            }
        }
        if(isset($_GET['type']) && !empty($_GET['type'])){
            $type_id = (int)$_GET['type'];
            $search->setType_id($type_id);
        }
        if(isset($_GET['add']) && !empty($_GET['add'])){
            $location_id = (int)$_GET['add'];
            $search->setLocation($location_id);
        }

        $search->sortByTime();
        $search->setLimit(self::LIMIT);
        $search->setPage($page);
        $search->filterAvailable();
        $data = $search->queryAll();
        return $this->render('index',["data"=>$data]);
    }
    public function actionFeature()
    {
        $page = 1;
        if(isset($_GET['p'])){
            $tmp_page = (int)$_GET['p'];
            $page = $tmp_page > 0 ? $tmp_page : 1;
        }

        $search = new JobSearch();
        $search->sortByView();
        $search->setLimit(self::LIMIT);
        $search->setPage($page);
        $search->filterAvailable();
        $data = $search->queryAll();
        return $this->render('index',["data"=>$data]);
    }

    public function actionView($id,$slug)
    {
        $job = Job::find($id);
        $apply_form = new ApplyForm();
        if(\Yii::$app->request->isPost){
            if(isset($_POST['Comment'])){
                if(isset($_POST['parent_id'])){
                    $parent_id = (int) $_POST['parent_id'];
                    $parent = Comment::find()->where("id = :id and status = 1 and object_type = :type and object_id = :object_id",[
                        ":id" => $parent_id,
                        ":type" => Job::className(),
                        ":object_id" => $id
                    ])->one();
                    if($parent){
                        $comment = new Comment();
                        $comment->load(\Yii::$app->request->post());
                        $comment->object_id = $id;
                        $comment->object_type = Job::className();
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
                    $comment->object_type = Job::className();
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
            }else{
                if(isset($_POST["ApplyForm"])){
                    $apply_form->load(\Yii::$app->request->post());
                    $file = UploadedFile::getInstance($apply_form, 'attach');
                    $apply_form->attach = $file;

//                    var_dump($apply_form);
                    $dir = \Yii::getAlias("@app/web/upload").ApplyForm::UPLOAD_PATH.DIRECTORY_SEPARATOR.$job->ID;
                    $url_path = \Yii::getAlias("@upload_url").ApplyForm::UPLOAD_PATH.'/'.$job->ID;
                    if($apply_form->validate()){
                        $log = new ApplyLog();
                        $log->attributes = $apply_form->attributes;
                        $log->job_id = $id;
                        if(!file_exists ($dir)){
                            $file_helper = new BaseFileHelper();
                            $file_helper->createDirectory($dir);
                        }
                        $file_name = md5($file->baseName.time()).".".$file->extension;
                        $file->saveAs($dir.DIRECTORY_SEPARATOR.$file_name);
                        $log->attach = $url_path.'/'.$file_name;
                        $log->apply_at = time();
                        $log->save(false);
                        $ch = curl_init();
                        $postData = array(
                            'key' => 'MTQzMDcyMTM5M1BFUlNPTk5FT',
                            'action' => 'add',
                            'job_code' => $id,
                            'phone' => $log->phone,
                            'name'=>$log->name,
                            'email'=>$log->email,
                            'address'=>$log->address,
                            'file_contents' => "@" . $dir.DIRECTORY_SEPARATOR.$file_name
                        );
                        curl_setopt_array($ch, array(
                            CURLOPT_URL => 'http://cellphones.1office.vn/Api/Recruiment/Candidate/Index',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $postData,
                            CURLOPT_FOLLOWLOCATION => true
                        ));
                        $output = curl_exec($ch);
                        return $this->refresh();
                    }
                }
            }
        }
        $comments = Comment::find()->where("status = 1 and parent_id is null and object_type = :type and object_id = :object_id",[
            ":type" => Job::className(),
            ":object_id" => $id
        ])->limit(10)->orderBy("comment_at desc")->all();
        $min_cmt = Comment::find()->where("status = 1 and parent_id is null and object_type = :type and object_id = :object_id",[
            ":type" => Job::className(),
            ":object_id" => $id
        ])->orderBy("comment_at asc")->one();
        $min_cmt_id = 0;
        if($min_cmt){
            $min_cmt_id = $min_cmt->id;
        }
        return $this->render('view',["job"=>$job,"comments"=>$comments,"apply_form"=>$apply_form,"min_cmt_id"=>$min_cmt_id]);
    }

}
