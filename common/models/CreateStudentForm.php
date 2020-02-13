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
	public $age;
	public $highest_qualification;
	public $highestqualificationother;
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
	public $countrycode;
	public $state;
	public $district;
	public $postal_code;
	public $mailing_address;
	public $mailing_address2;
	public $mailing_address3;
	public $mailing_countrycode;
	public $mailing_state;
	public $mailing_district;
	public $mailing_postal_code;
	public $mailing_permanent;
	public $type_of_residential;
	public $typeofresidentialother;
	public $bank_name;
	public $bank_name_other;
	public $bank_account_name;
	public $bank_terms;
	public $account_no;
    public $programme_name;
    public $intake;
    public $entry;
    public $user_image;
	public $ic_no_format;
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
    public $type_of_programme;
    public $school;
    public $employer_name;
    public $employer_address;
    public $employer_address2;
    public $employer_address3;
    public $employer_postal_code;
    public $position_held;
    public $employment_mode;
    public $emp_from_month;
    public $emp_from_year;
    public $emp_to_month;
    public $emp_to_year;
	public $title;
	public $retype_password;
	public $is_submit;
   
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