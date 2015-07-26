<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ReplyForm extends Model
{
    public $parent_id;
    public $content;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['parent_id', 'content'], 'required',"message"=>"{attribute} không được để trống."],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'content' => 'Nội Dung',
        ];
    }

}
