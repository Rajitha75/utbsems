<?php
namespace frontend\models;
use common\models\User;
use yii\base\Model;
use Yii;
use yii\db\Query;

/**
 * Signup form
 */
class SignupForm extends \yii\db\ActiveRecord
{
    public $email;
    public $password;
    public $user_role_ref_id;
    public $confirmpassword;
    public $username, $status, $user_image;
    public $userid;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['signuppopup'] = ['email'];
        $scenarios['signuppage'] = ['email'];
        return $scenarios;
    }
    
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required','on'=>'signuppage'],
            //['email', 'email','on'=>'signuppage'],
			['email', 'match', 'pattern' => '/^([0-9]{10})$|^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/', 'message' => 'Please enter a valid email / mobile', 'on'=>'signuppage'],
            ['email', 'string', 'max' => 255,'on'=>'signuppage'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.','on'=>'signuppage'],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.','on'=>'signuppopup'],

             ['password', 'string', 'min' => 6,'on'=>'signuppage'],
            
               
            [['user_role_ref_id'], 'safe'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'email' => 'Username',
            'password' => 'Password',
            'confirmpassword' => 'Confirm Password',
            'user_role_ref_id' => 'User Role',
			'countrycode' => 'Country Code',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new \common\models\User();
            $user->username = addslashes($this->username);
            $user->email = addslashes($this->email);
        $user->user_role_ref_id = $this->user_role_ref_id;
        $user->setPassword('UtBSEms2019#!');
        $user->generateAuthKey();
        $user->status = 1;
        return $user->save(false) ? $user : null;
    }

    public function savepassword()
    {
       // echo $this->password;exit;
        $user =  User::find()->where(['id' => $this->userid])->one();
        $this->password_hash = $this->password;   
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
    $user->is_verified = 1;
    return $user->save(false) ? $user : null;
    }
}