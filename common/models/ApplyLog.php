<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apply_log".
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $dob
 * @property string $address
 * @property string $phone
 * @property string $position
 * @property string $reason
 * @property string $attach
 * @property integer $apply_at
 * @property string $job_id
 */
class ApplyLog extends \yii\db\ActiveRecord
{
    public $captcha;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apply_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'email', 'dob','address' , 'phone','position','reason' ,'attach'], 'required',"message"=>"{attribute} không được để trống"],
            // rememberMe must be a boolean value
            ['email', 'email',"message"=>"Email không đúng định dạng"],
            ['captcha', 'captcha',"message"=>"Mã xác nhận không đúng"],
            ['attach', 'file','checkExtensionByMimeType' => false,
                'extensions' => 'doc, docx, pdf', 'maxSize' => 1024 * 1024 * 5,
                "message"=>"File đính kèm không hợp lệ",
                "wrongExtension"=>"Định dạng file không đúng",
                "tooBig"=>"File định kèm vượt quá dung lượng cho phép"
            ],
            [['name', 'email', 'position'], 'string', 'max' => 100, "message"=>"{attribute} không được để trống"],
            [['dob', 'phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 200],
            [['reason'], 'string', 'max' => 500],
            [['attach'], 'string', 'max' => 255]
        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Họ tên',
            'email' => 'Email',
            'dob' => 'Ngày sinh',
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
            'position' => 'Vị trí ứng tuyển',
            'reason' => 'Lý do',
            'attach' => 'File đính kèm',
        ];
    }

}
