<?php
namespace common\models;
use yii\db\Query;
use Yii;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $type_of_residential  
 */
class ExamOfficer extends \yii\db\ActiveRecord
{
	//public $name,$rollno,$nationality,$passportno,$race,$religion,$gender,$martial_status,$dob,$place_of_birth,$telephone_mobile,$email,$lastschoolname,$father_name,$fathericno,$father_mobile,$mother_name,$mothericno,$mother_mobile,$address,$address2,$address3,$postal_code,$bank_name,$account_no,$programme_name,$programme_code,$intake,$entry;		
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_officer';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  ['status', 'default', 'value' => self::STATUS_ACTIVE],
           // ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */

    public static function findByUserId($userid){
        $data = (new Query())->select('e.*, u.user_image')
                ->from('exam_officer AS e')
                ->join('LEFT JOIN', 'user AS u', 'u.id = e.user_ref_id')
                ->where(['user_ref_id' => $userid])->all();
        return $data;
    }

    public static function findByExamOfficerId($userid){
        $data = (new Query())->select('e.*, u.user_image')
                ->from('exam_officer AS e')
                ->join('LEFT JOIN', 'user AS u', 'u.id = e.user_ref_id')
                ->where(['e.id' => $userid])->all();
        return $data;
    }

	
	public function attributeLabels()
    {
        return [
        ];
    }
    
    public static function getExamOfficersList(){
	    $uQuery = (new Query())->select(['e.id','name','user_ref_id','u.email', 'u.status'])
        ->from('exam_officer AS e')
        ->join('LEFT JOIN', 'user AS u', 'u.id = e.user_ref_id')
	->where(['u.status' => 1]);
	$uQuery->orderBy(['name'=>SORT_DESC]);
    //print_r($uQuery);exit;
		return $uQuery;
    }
    
    public static function getExamOfficerDataByUserRefId($id){
        $data = (new Query())->select('*')
        ->from('exam_officer')->where(['user_ref_id' => $id])->all();
        return $data;
    }
}
