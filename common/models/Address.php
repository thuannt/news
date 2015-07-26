<?php
namespace common\models;


use Yii;
use yii\base\Model;

class Address extends Model {
    const URL = "http://cellphones.1office.vn/Api/Recruiment/Candidate/Index?key=MTQzMDcyMTM5M1BFUlNPTk5FT&action=getoptions&type=place";
    public $ID;
    public $title;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'title'], 'required'],
        ];
    }

    private static function getCacheKey(){
        return "cache_".self::className();
    }


    public static function findAll(){
        if(Yii::$app->cache->exists(self::getCacheKey())){
            return Yii::$app->cache->get(self::getCacheKey());
        }
        $rs = [];
        $json = file_get_contents(self::URL);
        $data = json_decode($json);
        if(property_exists($data,"options")){
            foreach ($data->options as $key => $row) {
                $position = new Address();
                $position->attributes = get_object_vars($row);
                $rs[] = $position ;
            }
        }
        if(count($rs)){
            Yii::$app->cache->set(self::getCacheKey(),$rs,Yii::$app->params['api.cache.time']);
        }
        return $rs;
    }



}