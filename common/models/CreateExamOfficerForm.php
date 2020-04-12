<?php

namespace common\models;
use yii\base\Model;

class CreateExamOfficerForm extends \yii\db\ActiveRecord
{
    public $ic_no;
    public $passportno;
    public $email;
    public $password;
    public $retype_password;
    public $gender;
    public $martial_status;
    public $name;
    public $age;
    public $dob;
    public $place_of_birth;
    public $telephone_mobile;
    public $tele_home;
    public $is_admin;
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