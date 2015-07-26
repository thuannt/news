<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ApplyForm extends Model
{
    const UPLOAD_PATH = "/user_attach";
    public $name;
    public $email;
    public $dob;
    public $address;
    public $phone;
    public $position;
    public $reason;
    public $attach;
    public $captcha;



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
