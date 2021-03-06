<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property integer $scope
 * @property string $key
 * @property integer $type
 * @property string $value
 * @property string $name
 */
class Config extends \yii\db\ActiveRecord
{
    const UPLOAD_PATH = "/cf";
    const TYPE_INPUT = "0";
    const TYPE_EDITOR = "1";
    const TYPE_IMAGE = "2";

    const KEY_TOP_BAR = "top_bar";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scope', 'type'], 'integer'],
            [['key', 'value', 'name','type'], 'required',"message"=>"{attribute} không được để trống."],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['key'], 'unique']
        ];
    }


    public function beforeSave($insert)
    {
        if($this->type==self::TYPE_INPUT){
            $pattern = "\<p\>|\<\/p\>";
            $this->value = preg_replace("/($pattern)/i","",$this->value);
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scope' => 'Scope',
            'key' => 'Key',
            'type' => 'Type',
            'value' => 'Value',
            'name' => 'Name',
        ];
    }

    /***
     * @param $key
     * @return null|Config
     */
    public static function findConfig($key){
        $config = Config::find()->where(Config::tableName().".key=:key",[":key"=>$key])->one();
        return $config ? $config->value : "";
    }
}
