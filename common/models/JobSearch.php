<?php
/**
 * Created by PhpStorm.
 * User: thuan_000
 * Date: 5/14/2015
 * Time: 1:45 AM
 */

namespace common\models;

use Yii;
use yii\helpers\Json;

class JobSearch {
    const URL = "http://cellphones.1office.vn/Api/Recruiment/Candidate/Index?key=MTQzMDcyMTM5M1BFUlNPTk5FT&action=getrequest";
    private $condition = ["http://cellphones.1office.vn/Api/Recruiment/Candidate/Index?key=MTQzMDcyMTM5M1BFUlNPTk5FT&action=getrequest"];
    private $sort_condition;
    private function getCacheKey(){
        $encode = json_encode([$this->condition,$this->sort_condition]);
        return "cache_job_query_".md5($encode);
    }

    public function setPage($page){
        $page = (int)$page;
        $this->condition[] = "p={$page}";
    }
    public function setLimit($limit){
        $limit = (int)$limit;
        $this->condition[] = "limit={$limit}";
    }
    public function setID($id){
        $id = (int)$id;
        $this->condition[] = "s={$id}";
    }
    public function setLocation($id){
        $id = (int)$id;
        $this->condition[] = "place={$id}";
    }
    public function setPosition_id($id){
        $id = (int)$id;
        $this->condition[] = "position_id={$id}";
    }
    public function setType_id($id){
        $id = (int)$id;
        $this->condition[] = "type_id={$id}";
    }
    public function sortByTime($newest = true){
        if($newest == false){
            $this->sort_condition = "sort_by=ID&sort_type=asc";
        }else{
            $this->sort_condition = "sort_by=ID&sort_type=desc";
        }
    }
    public function sortByView($most = true){
        if($most == false){
            $this->sort_condition = "sort_by=view&sort_type=asc";
        }else{
            $this->sort_condition = "sort_by=view&sort_type=desc";
        }
    }
    public function filterAvailable($check=true){
        if($check){
            $this->condition[] = "deadline=available";
        }else{
            $this->condition[] = "deadline=unavailable";
        }
    }
    public function queryAll(){
        if(Yii::$app->cache->exists($this->getCacheKey())){
            return Yii::$app->cache->get($this->getCacheKey());
        }
        if($this->sort_condition && !empty($this->sort_condition)){
            $this->condition[]=$this->sort_condition;
        }
        $url = implode("&",$this->condition);
        $json = file_get_contents($url);
        $data = Json::decode($json);
        $jobs = [];
        foreach ($data["posts"] as $job_data) {
            $job = new Job();
            $job->attributes = $job_data;
            $jobs[]=$job;
        }
        $page_info = $data["pageInfo"];
        $item_cnt = $data["total"];
        $rs = [
            'jobs' => $jobs,
            "page_info"=> $page_info,
            "item_cnt"=>$item_cnt
        ];
        if(count($jobs)){
            Yii::$app->cache->set($this->getCacheKey(),$rs,Yii::$app->params['api.cache.time']);
        }
        return $rs;
    }
}