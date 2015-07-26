<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "slide".
 *
 * @property integer $id
 * @property string $name
 * @property string $thumbnail
 * @property string $url
 * @property integer $order
 * @property integer $status
 */
class Slide extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 0;
    const UPLOAD_PATH = "/slides";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slide';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['thumbnail'], 'required'],
            [['order', 'status'], 'integer'],
            [['name'], 'string', 'max' => 300],
            [['thumbnail', 'url'], 'string', 'max' => 255]
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
            'thumbnail' => 'Hình ảnh',
            'url' => 'Liên kết đích',
            'order' => 'Thứ tự',
            'status' => 'Trạng thái',
        ];
    }
}
