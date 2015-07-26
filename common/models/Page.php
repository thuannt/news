<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property integer $status
 * @property integer $view_cnt
 * @property string $folder
 */
class Page extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','title', 'folder'], 'required'],
            [['content'], 'string'],
            [['status', 'view_cnt'], 'integer'],
            [['name', 'folder'], 'string', 'max' => 100],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'title' => 'Tiêu đề',
            'slug' => 'Slug',
            'content' => 'Nội dung',
            'status' => 'Trạng thái',
            'view_cnt' => 'Lượt xem',
            'folder' => '',
        ];
    }
    private function getFolderPath(){
        return "/pages/".time();
    }

    public function __construct($config = [])
    {
        parent::__construct($config); // TODO: Change the autogenerated stub
        if((is_null($this->folder) || empty($this->folder) )){
            $this->folder = $this->getFolderPath();
        }
    }
    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
        if((is_null($this->folder) || empty($this->folder) )){
            $this->folder = $this->getFolderPath();
        }
    }


    public function beforeSave($insert)
    {
        if((is_null($this->slug) || empty($this->slug) )){
            $this->slug = Format::slug__filter($this->title);
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}