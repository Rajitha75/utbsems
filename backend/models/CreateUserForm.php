<?php

namespace backend\models;
use yii\base\Model;
/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_profile_id
 * @property integer $user_ref_id
 * @property string $fname
 * @property string $lname
 * @property string $dob
 * @property string $gender
 * @property string $user_image
 * @property string $citizen
 * @property string $domicile
 * @property string $current_location
 * @property string $occupation
 * @property string $domain_expertise
 * @property integer $modified_by
 * @property string $modified_date
 *
 * @property User $userRef
 */
class CreateUserForm extends \yii\db\ActiveRecord
{
    public $email;
    public $name;
    public $rollno;
    public $rumpun;
	public $nationality;
    public $passportno;
    public $race;
	public $religion;
    public $gender;
    public $martial_status;
    public $dob;
    public $place_of_birth;
    public $telephone_mobile;
    public $tele_home;
    public $lastschoolname;
    public $type_of_entry;
    public $specialneeds;
    public $father_name;
    public $fathericno;  
	public $father_mobile;  
	public $mother_name;  
	public $mothericno;
	public $mother_mobile;
	public $address;
	public $address2;
	public $address3;
	public $postal_code;
	public $bank_name;
	public $account_no;
    public $programme_name;
    public $programme_code;
    public $intake;
    public $entry;
    public $user_image;
   
    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
     
			
        ];
    }
    
 /*   public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['CSR'] = ['email', 'password', 'confirmpassword', 'mobile', 'gender','dob', 'citizen', 'domicile', 'current_location', 'latitude', 'longitude'];
        $scenarios['individual'] = ['email', 'password', 'confirmpassword', 'fname', 'lname', 'mobile', 'gender','dob', 'citizen', 'domicile', 'current_location', 'latitude', 'longitude'];
        return $scenarios;
    }
*/

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }
    
    

    /**
     * @return \yii\db\ActiveQuery
     */
    //public function getUserRef()
    //{
     //   return $this->hasOne(User::className(), ['id' => 'user_ref_id']);
   // }
}
