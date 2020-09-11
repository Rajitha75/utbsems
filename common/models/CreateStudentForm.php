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
	public $kin_relationship;
	public $kin_relationship_others;
	public $kin_name;
	public $kin_address;
	public $kin_address2;
	public $kin_address3;
	public $kin_id_card_no_code;
	public $kin_id_card_no;
	public $kin_phone_country_code;
	public $kin_phone;
	public $kin_mobile;
	public $kin_mobile_country_code;
	
	public $emergency_relationship;
	public $emergency_relationship_others;
	public $emergency_name;
	public $emergency_address;
	public $emergency_address2;
	public $emergency_address3;
	public $emergency_phone_country_code;
	public $emergency_phone;
	public $emergency_mobile_country_code;
	public $emergency_mobile;
	public $emergency_officeno_country_code;
	public $emergency_officeno;
	public $emergency_email;
	
	public $kin_email;
	public $kin_occupation;
	
	public $hq_a_level_year;
	public $hq_a_level_subject;
	public $hq_a_level_grade;
	public $hq_id;
   
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