<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
	public $verifyCode;
	public $pageVerifyCode;
    private $_user;
	public $encusername;
	public $encpassword;
    public $seckey;
    public $rememberMeLogin, $reference_url;

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['loginpopup'] = ['username', 'password'];
        $scenarios['loginpage'] = ['username', 'password','pageVerifyCode'];
		$scenarios['withCaptcha'] = ['username', 'password','verifyCode','pageVerifyCode'];
		$scenarios['limitExceed'] = ['username', 'password'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required', 'on'=>'loginpage'],
			[['username', 'password'], 'required', 'on'=>'withCaptcha'],
			[['username', 'password'], 'required', 'on'=>'limitExceed'],
            [['reference_url'], 'safe'],
			['verifyCode', 'codeVerify', 'on'=>'withCaptcha'],
			['pageVerifyCode', 'codeVerify', 'on'=>'withCaptcha'],
            // [['username', 'password'], 'required', 'on'=>'update'],            
           // ['username','email', 'on'=>'loginpage', 'message'=> 'Please enter a valid email address'],
			['username', 'match', 'pattern' => '/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/', 'message' => 'Please enter a valid email', 'on'=>'loginpage'],
            // ['username','email', 'on'=>'update'],
            // rememberMe must be a boolean value
           // ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword', 'on'=>'loginpage'],
            ['password', 'validatePassword', 'on'=>'loginpopup'],
			['password', 'validatePassword', 'on'=>'withCaptcha'],
			['password', 'validatelimit', 'on'=>'limitExceed'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'username' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
	 
	public function deleteattempts($uid) { 
		Yii::$app->db->createCommand()->delete('login_attempts', ['user_ref_id' => $uid] )->query();
		return true;
	}
	public function codeVerify($attribute, $params) {
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
		$user = \frontend\models\User::findByUsername($uname);
		if($user){
		$data = (new Query())->select('*')	
                    ->from('login_attempts')
                    ->where(['user_ref_id' => $user->id])
                    ->one();
		return $data["attempts"];
		/*if($data["attempts"] >=2){
			return true;
		}else{
			return false;
		}*/
		}
		return false;
	}	

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || $user->status!=1 || !$user->validatePassword($this->password)) {
			if($user){
			$this->addLoginAttempt($user->id);
			}
            $this->addError($attribute, 'Incorrect username or password');
            }
        }
    }
	
	public function validatelimit($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            //if (!$user || !$user->validatePassword($this->password)) {
			if($user){
			$this->addError($attribute, 'Please try after 5 minutes');
			}
            
            //}
        }
    }
	
	public function addLoginAttempt($uid) {
	   $data = (new Query())->select('*')	
                    ->from('login_attempts')
                    ->where(['user_ref_id' => $uid])
                    ->one();
		$oldcreatedate = strtotime($data['created_at']);
		$createdate = strtotime(date('Y-m-d H:i:s'));$created_at = date('Y-m-d H:i:s');
		$difference = round(abs($oldcreatedate - $createdate) / 60);// echo $difference; exit;
		if(intval($data['attempts'])>=6 && intval($difference)<5){//echo 'true'; exit;
			return false;
		}else if(intval($data['attempts'])>=6 && intval($difference)>5){
		$this->deleteattempts($uid);
		Yii::$app->db->createCommand("INSERT into login_attempts (attempts, user_ref_id, created_at) VALUES(1,'$uid', '$created_at')")->execute();
		}
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
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
      
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
           
        }

        return $this->_user;
    }
}
