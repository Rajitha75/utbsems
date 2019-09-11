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
 */
class Student extends \yii\db\ActiveRecord
{
	//public $name,$rollno,$nationality,$passportno,$race,$religion,$gender,$martial_status,$dob,$place_of_birth,$telephone_mobile,$email,$lastschoolname,$father_name,$fathericno,$father_mobile,$mother_name,$mothericno,$mother_mobile,$address,$address2,$address3,$postal_code,$bank_name,$account_no,$programme_name,$programme_code,$intake,$entry;
	public $studentname;
		
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
	public $otp_code;
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
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
        $data = (new Query())->select('s.*, u.user_image')
                ->from('student AS s')
                ->join('LEFT JOIN', 'user AS u', 'u.id = s.user_ref_id')
                ->where(['user_ref_id' => $userid])->all();
        return $data;
    }

    public static function findByStudentId($userid){
        $data = (new Query())->select('s.*, u.user_image')
                ->from('student AS s')
                ->join('LEFT JOIN', 'user AS u', 'u.id = s.user_ref_id')
                ->where(['s.id' => $userid])->all();
        return $data;
    }

  public static function getStudentsList($name, $programme_name)
    {
		 $uQuery = (new Query())->select(['s.id','name','rollno','rumpun','nationality','gender','user_ref_id','status','utb_email_address','u.email','entry','ic_no','passportno'])
        ->from('student AS s')
        ->join('LEFT JOIN', 'user AS u', 'u.id = s.user_ref_id');
		
        if(!empty($name) || !empty($programme_name)) {
            if(!empty($name))   $uQuery->andWhere(['LIKE' , 'name', $name])->orWhere(['LIKE' , 'ic_no', $name])->orWhere(['LIKE' , 'passportno', $name]);
            if(!empty($programme_name))   $uQuery->andWhere(['LIKE' , 'programme_name', $programme_name]);
        }
        $sort = Yii::$app->getRequest()->getQueryParam('sort') ? Yii::$app->getRequest()->getQueryParam('sort') : "";
        if (empty($sort))
            $uQuery->orderBy(['name'=>SORT_DESC]);
        //print_r($uQuery);
		return $uQuery;
    }

    public static function getStudentsData($id){
        $data = (new Query())->select('*')
        ->from('student')->where(['id' => $id])->all();
        return $data;
    }

    public static function getStudentsDataByUserRefId($id){
        $data = (new Query())->select('*')
        ->from('student')->where(['user_ref_id' => $id])->all();
        return $data;
    }
}
