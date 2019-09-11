<?php
namespace webvimark\modules\UserManagement\models\forms;

use webvimark\helpers\LittleBigHelper;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\base\Model;
use yii\db\Query;
use Yii;

class LoginForm extends Model
{
	public $username;
	public $password;
	public $rememberMe = false;
	public $verifyCode;
	private $_user = false;

	/**
	 * @inheritdoc
	 */
	 
	public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['loginpage'] = ['username', 'password'];
		$scenarios['withCaptcha'] = ['username', 'password','verifyCode'];
        return $scenarios;
    }
	
	public function rules()
	{
		return [
			[['username', 'password'], 'required', 'on'=>'loginpage'],
			[['username', 'password'], 'required', 'on'=>'withCaptcha'],
			['rememberMe', 'boolean'],
			['password', 'validatePassword', 'on'=>'loginpage'],
			['password', 'validatePassword', 'on'=>'withCaptcha'],
		];
	}

	public function attributeLabels()
	{
		return [
			'username'   => UserManagementModule::t('front', 'Username'),
			'password'   => UserManagementModule::t('front', 'Password'),
			'rememberMe' => UserManagementModule::t('front', 'Remember me'),
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 */
	public function validatePassword()
	{
		if ( !$this->hasErrors() )
		{
			$user = $this->getUser();
			if(!$user){
				$this->addError('password', UserManagementModule::t('front', 'Incorrect username or password'));
				return false;
			}
			$userData = User::find()->where(['username' => $user->username])->one();
			$logindata = (new \yii\db\Query())->select('*')->from('login_attempts')->where(['user_ref_id' => $userData->id])->one();
			$oldcreatedate = strtotime($logindata['created_at']);
			$createdate = strtotime(date('Y-m-d H:i:s'));$created_at = date('Y-m-d H:i:s');
			$difference = round(abs($oldcreatedate - $createdate) / 60);
			$attemptcount = $this->countattempts($user->username);
			
			if ( !$user || !$user->validatePassword($this->password) )
			{
				if($user){
					if(!$this->addLoginAttempt($user->id)){
						$this->addError('password', UserManagementModule::t('front', 'Please try after 5 minutes'));
						return false;
					}
				}
				//$this->addLoginAttempt($user->id);
				$this->addError('password', UserManagementModule::t('front', 'Incorrect username or password'));
			}else if($user && $user->validatePassword($this->password) && intval($difference)<5 && $attemptcount && $attemptcount >5){
				$this->addError('password', UserManagementModule::t('front', 'Please try after 5 minutes'));
				return false;
			}
		}
	}
	
	public function captchaCodeVerify($attribute) {
        $captcha_validate  = new \yii\captcha\CaptchaAction('captcha',Yii::$app->controller);
        if($this->$attribute){
            $code = $captcha_validate->getVerifyCode();
            if($this->$attribute!=$code){
                $this->addError($attribute, 'The verification code is incorrect.');
            }
        }
	}	
	
	public function ajaxcodeVerify($attribute) {
        $captcha_validate  = new \yii\captcha\CaptchaAction('captcha',Yii::$app->controller);
		if($attribute){
            $code = $captcha_validate->getVerifyCode();
            if($attribute==$code){
                return true;
            }else{
				return false;
			}
        }
		return false;
}	
	
	public function checkattempts($uname)
    {
		$user = $this->findByUsername($uname);
		$ip = $this->get_client_ip();
		if($user){
		$data = (new Query())->select('*')	
                    ->from('login_attempts')
                    ->where(['user_ref_id' => $user['id']])
                    ->one();//print_r($data); exit;
		if($data["attempts"] >=2 && $data["attempts"] <=5){
			return true;
		}else{
			return false;
		}
		}
		return false;
	}
	
	public function countattempts($uname)
    {
		$user = $this->findByUsername($uname);
		$ip = $this->get_client_ip();
		if($user){
		$data = (new Query())->select('*')	
                    ->from('login_attempts')
                    ->where(['user_ref_id' => $user['id']])
                    ->one();
		return $data["attempts"];
		}
	}
	
	public function findByUsername($uname){
		$data = (new Query())->select('*')	
                    ->from('user')
                    ->where(['username' => $uname])
                    ->one();
		return $data;
	}
	
	public function addLoginAttempt($uid) {
	   $data = (new Query())->select('*')	
                    ->from('login_attempts')
                    ->where(['user_ref_id' => $uid])
                    ->one();
	   $oldcreatedate = strtotime($data['created_at']);
		$createdate = strtotime(date('Y-m-d H:i:s'));$created_at = date('Y-m-d H:i:s');
		$difference = round(abs($oldcreatedate - $createdate) / 60);// echo $difference; exit;
		//echo $oldcreatedate.' '.$createdate.' '.$difference.'sdsd'; exit;
		if(intval($data['attempts'])>=6 && intval($difference)<5){//echo 'true'; exit;
			return false;
		}else if(intval($data['attempts'])>=6 && intval($difference)>5){
		$this->deleteattempts($uid);
		Yii::$app->db->createCommand("INSERT into login_attempts (attempts, user_ref_id, created_at) VALUES(1,'$uid','$created_at')")->execute();
		}//echo $difference.'sdsd'; exit;
		if($data['attempts'] < 6){
	   if($data)
	   {
		 $attempts = $data["attempts"]+1;  
		 @Yii::$app->db->createCommand("UPDATE login_attempts SET attempts=".$attempts.", created_at='".$created_at."' where user_ref_id=$uid")->execute();
		}
	   else {
		Yii::$app->db->createCommand("INSERT into login_attempts (attempts, user_ref_id, created_at) VALUES(1,'$uid', '$created_at')")->execute();
	 }
	 }
	 return true;
	}
	
	public function deleteattempts($uid) { 
		Yii::$app->db->createCommand()->delete('login_attempts', ['user_ref_id' => $uid] )->query();
		return true;
	}
	
	public function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	/**
	 * Check if user is binded to IP and compare it with his actual IP
	 */
	

	/**
	 * Logs in a user using the provided username and password.
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		if ( $this->validate() )
		{
			return Yii::$app->user->login($this->getUser(), $this->rememberMe ? Yii::$app->user->cookieLifetime : 0);
		}
		else
		{
			return false;
		}
	}

	/**
	 * Finds user by [[username]]
	 * @return User|null
	 */
	public function getUser()
	{
		if ( $this->_user === false )
		{
			$u = new \Yii::$app->user->identityClass;
			$this->_user = ($u instanceof User ? $u->findByUsername($this->username) : User::findByUsername($this->username));
		}

		return $this->_user;
	}
}
