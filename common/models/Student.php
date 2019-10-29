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
    public $school;
    public $userid;
		
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

  public static function getStudentsList($studentname, $rollno, $rumpun, $nationality, $studenticno, $studenticcolor, $passportno, $race, $religion, $gender, $martialstatus, $mobile, $telehome, $email, $typeofentry, $address, $bankname, $accountno, $fathername, $fathericno, $mothername, $mothericno, $sponsortype, $progname, $entry, $status, $intake, $mode, $utbemail, $degree, $dateofregistration, $dateofleaving, $prevrollno, $prevprogname, $previntakeno, $prevutbemail)
    {
       
		 $uQuery = (new Query())->select(['s.id','name','rollno','rumpun','nationality','gender','user_ref_id','status','utb_email_address','u.email','entry','ic_no','passportno'])
        ->from('student AS s')
        ->join('LEFT JOIN', 'user AS u', 'u.id = s.user_ref_id');
		
        if(!empty($studentname) || !empty($programme_name) || !empty($rollno) || !empty($rumpun) || !empty($nationality) || !empty($studenticno) || !empty($studenticcolor) || !empty($passportno) || !empty($race) || !empty($religion) || !empty($gender) || !empty($martialstatus) || !empty($mobile) || !empty($telehome) || !empty($email) || !empty($typeofentry) || !empty($address) || !empty($bankname) || !empty($accountno) || !empty($fathername) || !empty($fathericno) || !empty($mothername) || !empty($mothericno) || !empty($sponsortype) || !empty($programme_name) || !empty($entry) || !empty($status) || !empty($intake) || !empty($mode) || !empty($utbemail) || !empty($degree) || !empty($dateofregistration) || !empty($dateofleaving) || !empty($prevrollno) || !empty($prevprogname) || !empty($previntakeno) || !empty($prevutbemail)) {
            /*if(!empty($name))   $uQuery->andWhere(['LIKE' , 'name', $name])->orWhere(['LIKE' , 'ic_no', $name])->orWhere(['LIKE' , 'passportno', $name]);
            if(!empty($programme_name))   $uQuery->andWhere(['LIKE' , 'programme_name', $programme_name]);*/

            if(!empty($studentname))   $uQuery->andWhere(['LIKE' , 'name', $studentname]);
            if(!empty($programme_name))   $uQuery->andWhere(['LIKE' , 'programme_name', $programme_name]);
            if(!empty($rollno))   $uQuery->andWhere(['LIKE' , 'rollno', $rollno]);
            if(!empty($rumpun))   $uQuery->andWhere(['LIKE' , 'rumpun', $rumpun]);
            if(!empty($nationality))   $uQuery->andWhere('s.nationality LIKE "%'.$nationality.'%" OR nationalityother LIKE "%'.$nationality.'%"');
            if(!empty($studenticno))   $uQuery->andWhere(['LIKE' , 'ic_no', $studenticno]);
            if(!empty($studenticcolor))   $uQuery->andWhere(['LIKE' , 'ic_color', $studenticcolor]);
            if(!empty($passportno))   $uQuery->andWhere(['LIKE' , 'passportno', $passportno]);
            if(!empty($race))   $uQuery->andWhere('s.race LIKE "%'.$race.'%" OR raceother LIKE "%'.$race.'%"');
            if(!empty($religion))   $uQuery->andWhere('s.religion LIKE "%'.$religion.'%" OR religionother LIKE "%'.$religion.'%"');
            if(!empty($gender))   $uQuery->andWhere(['LIKE' , 'gender', $gender]);
            if(!empty($martialstatus))   $uQuery->andWhere(['LIKE' , 'martial_status', $martialstatus]);
            if(!empty($mobile))   $uQuery->andWhere(['LIKE' , 'telephone_mobile', $mobile]);
            if(!empty($telehome))   $uQuery->andWhere(['LIKE' , 'tele_home', $telehome]);
            if(!empty($email))   $uQuery->andWhere('s.email LIKE "%'.$email.'%"');
            
            if(!empty($typeofentry))   $uQuery->andWhere('s.type_of_entry LIKE "%'.$typeofentry.'%"');
            if(!empty($address))   $uQuery->andWhere('s.address LIKE "%'.$address.'%" OR address2 LIKE "%'.$address.'%" OR address3 LIKE "%'.$address.'%"');
            if(!empty($bankname))   $uQuery->andWhere(['LIKE' , 'bank_name', $bankname]);
            if(!empty($accountno))   $uQuery->andWhere(['LIKE' , 'account_no', $accountno]);
            if(!empty($fathername))   $uQuery->andWhere(['LIKE' , 'father_name', $fathername]);
            if(!empty($fathericno))   $uQuery->andWhere(['LIKE' , 'fathericno', $fathericno]);

            if(!empty($mothername))   $uQuery->andWhere(['LIKE' , 'mother_name', $mothername]);
            if(!empty($mothericno))   $uQuery->andWhere(['LIKE' , 'mothericno', $mothericno]);
            if(!empty($sponsortype))   $uQuery->andWhere('s.sponsor_type LIKE "%'.$sponsortype.'%"');
            if(!empty($programme_name))   $uQuery->andWhere(['LIKE' , 'programme_name', $programme_name]);
            if(!empty($entry))   $uQuery->andWhere(['entry' => $entry]);
            if(!empty($status))   $uQuery->andWhere(['status_of_student' => $status]);
            if(!empty($intake))   $uQuery->andWhere(['intake' => $intake]);
            if(!empty($mode))   $uQuery->andWhere(['mode' => $mode]);
            if(!empty($utbemail))   $uQuery->andWhere(['LIKE' , 'utb_email_address', $utbemail]);
            if(!empty($degree))   $uQuery->andWhere(['LIKE' , 'degree_classification', $degree]);
            if(!empty($dateofregistration))   $uQuery->andWhere(['date_of_registration' => $dateofregistration]);

            if(!empty($dateofleaving))   $uQuery->andWhere(['date_of_leaving' => $dateofleaving]);
            if(!empty($prevprogname))   $uQuery->andWhere(['LIKE' , 'previous_programme_name', $prevprogname]);
            if(!empty($previntakeno))   $uQuery->andWhere(['previous_intake_no' => $previntakeno]);
            if(!empty($prevutbemail))   $uQuery->andWhere(['LIKE' , 'previous_utb_email', $prevutbemail]);
        }
        $sort = Yii::$app->getRequest()->getQueryParam('sort') ? Yii::$app->getRequest()->getQueryParam('sort') : "";
        if (empty($sort))
            $uQuery->orderBy(['name'=>SORT_DESC]);
    //print_r($uQuery);exit;
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
