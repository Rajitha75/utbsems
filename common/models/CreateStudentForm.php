<?php

namespace common\models;
use yii\base\Model;

class CreateStudentForm extends \yii\db\ActiveRecord
{
    public $studentid;
    public $email;
    public $password;
    public $confirmpassword;
    public $name;
    public $rollno;
    public $rumpun;
    public $nationality;
    public $nationalityother;
    public $passportno;
    public $race;
    public $raceother;
    public $religion;
    public $religionother;
    public $typeofentryother;
    public $sponsor_type;
    public $sponsor_type_other;
    public $gender;
    public $martial_status;
    public $dob;
    public $place_of_birth;
    public $telephone_mobile;
    public $tele_home;
    public $emailother;
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
    public $intake;
    public $entry;
    public $user_image;
    public $ic_no;
    public $ic_color;
    public $gaurdian_relation;
    public $mobile_home;
    public $father_ic_color;
    public $gaurdian_employment;
    public $gaurdian_employer;
    public $remarks;
    public $telphone_work;
    public $mother_ic_color;
    public $status_of_student;
    public $status_remarks;
    public $mode;
    public $utb_email_address;
    public $degree_classification;
    public $date_of_registration;
    public $date_of_leaving;
    public $previous_roll_no;
    public $previous_programme_name;
    public $previous_intake_no;
    public $previous_utb_email;
   
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }
}