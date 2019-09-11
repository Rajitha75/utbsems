<?php

namespace common\models;
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
class CreateAdminForm extends \yii\db\ActiveRecord
{
    public $email;
    public $name;
    public $gender;
    public $mobile;
    public $password;
    public $confirmpassword;
   
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
