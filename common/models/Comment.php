<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property string $content
 * @property string $name
 * @property string $email
 * @property integer $user_id
 * @property string $object_id
 * @property string $object_type
 * @property string $parent_id
 * @property string $ip
 * @property integer $comment_at
 * @property integer $status
 *
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'object_id', 'object_type', 'ip', 'comment_at'], 'required'],
            [['user_id', 'object_id', 'parent_id', 'comment_at', 'status'], 'integer'],
            [['content'], 'string', 'max' => 500],
            [['name', 'email'], 'string', 'max' => 100],
            [['object_type', 'ip'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Nội dung',
            'name' => 'Tên',
            'email' => 'Email',
            'user_id' => 'User ID',
            'object_id' => 'Object ID',
            'object_type' => 'Object Type',
            'parent_id' => 'Parent ID',
            'ip' => 'Ip',
            'comment_at' => 'Thời gian comment',
            'status' => 'Trạng thái',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
