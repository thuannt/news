<?php
namespace common\components;

use common\models\JobSearch;
use yii;
use yii\helpers\Json;

class Statistics {
    const URL = "http://cellphones.1office.vn/Api/Recruiment/Candidate/Index?key=MTQzMDcyMTM5M1BFUlNPTk5FT&action=numberofrecruiment";
    private function getCacheKey(){
        $encode = json_encode([$this->condition,$this->sort_condition]);
        return "cache_job_query_".md5($encode);
    }
    public static function getTotalJob(){
        $cache_key = "cache_job_static_total";
        if(Yii::$app->cache->exists($cache_key)){
            return Yii::$app->cache->get($cache_key);
        }
        $url = self::URL."&type=total";
        $json = file_get_contents($url);
        $data = Json::decode($json);
        return $data["num"];
    }
    public static function getAvailableJob(){
        $cache_key = "cache_job_static_available";
        if(Yii::$app->cache->exists($cache_key)){
            return Yii::$app->cache->get($cache_key);
        }
        $url = self::URL."&type=still";
        $json = file_get_contents($url);
        $data = Json::decode($json);
        return $data["num"];
    }
    public static function getSubscribeJob(){
        $cache_key = "cache_job_static_subscribe";
        if(Yii::$app->cache->exists($cache_key)){
            return Yii::$app->cache->get($cache_key);
        }
        $url = "http://cellphones.1office.vn/Api/Recruiment/Candidate/Index?key=MTQzMDcyMTM5M1BFUlNPTk5FT&action=getsubscribes";
        $json = file_get_contents($url);
        $data = Json::decode($json);
        return $data["NumOfSubscribes"];
    }

    public static function getJobNewest($limit)
    {
        $search = new JobSearch();
        $search->setLimit($limit);
        $search->sortByTime();
        $search->filterAvailable();
        $data = $search->queryAll();
        return $data["jobs"];
    }
    public static function getJobFeature($limit)
    {
        $search = new JobSearch();
        $search->setLimit($limit);
        $search->sortByView();
        $search->filterAvailable();
        $data = $search->queryAll();
        return $data["jobs"];
    }
}