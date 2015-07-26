<?php
/**
 * Created by PhpStorm.
 * User;// thuan_000
 * Date;// 5/14/2015
 * Time;// 1;//45 AM
 */

namespace common\models;


use common\components\Format;
use yii\base\Model;
use yii\helpers\Json;
use yii\helpers\Url;

class Job  extends Model
{
    const URL = "http://cellphones.1office.vn/Api/Recruiment/Candidate/Index?key=MTQzMDcyMTM5M1BFUlNPTk5FT&action=getjobdetail&job_code={{job_code}}";

    public $ID;//mã tuyển dụng
    public $code;//mã tuyển dụng
    public $title;//Tên yêu cầu tuyển dụng
    public $amount;//Số lượng tuyển
    public $salary;//lương
    public $desc;// yêu cầu
    public $desc_info;// Yêu cầu khác
    public $why_recruitment;//Vì sao tuyển
    public $rules;//quyền lợi
    public $contract_req;//Hồ sơ bao gồm
    public $contact_person;//Người liên hệ
    public $degree_title;//Bằng cấp
    public $experience_title;//Kinh nghiệm
    public $department_title;//Phòng ban
    public $position_title;//Vị trí tuyển dụng
    public $location_title;//Nơi làm việc
    public $created_person;//Người tạo
    public $approved_person;//Người duyệt
    public $type_title;//Hình thức làm việc
    private $deadline;//ngay het han


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'ID',
                    'code',
                    'title',
                    "amount",
                    "salary",
                    "desc",
                    "desc_info",
                    "why_recruitment",
                    "rules" ,
                    "contract_req",
                    "contact_person",
                    "degree_title",
                    "experience_title",
                    "department_title",
                    "position_title",
                    "location_title",
                    "created_person",
                    "approved_person",
                    "type_title",
                    "deadline",
                ],
                'required'
            ],
        ];
    }
    public static function find($ID){
        $url = str_replace("{{job_code}}",$ID,self::URL);
        $json = file_get_contents($url);
        $data = Json::decode($json);
        $job = new Job();
        $job->attributes = $data["recruiment"];
        return $job;
    }
    public function setDeadline($date){
        $date = date_create_from_format("Y-m-d H:i:s",$date." 23:59:59");
        $this->deadline = $date;
    }
    public function getDeadline(){
        return $this->deadline->format("d-m-Y");
    }
    public function isOutDate(){
        return time() > $this->deadline->getTimestamp();
    }
    public function getViewUrl(){
        return Url::to(['job/view','id'=>$this->ID,'slug'=>$this->slug]);
    }
    public function getSlug(){
        return Format::slug__filter($this->title);
    }

    public function formatDeadline($format)
    {
        return $this->deadline->format($format);
    }
}