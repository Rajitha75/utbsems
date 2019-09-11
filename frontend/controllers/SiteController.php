<?php

namespace frontend\controllers;

use Yii;
use common\models\UserType;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Communique;
use frontend\models\Projects;
use common\models\EmailTemplates;
use common\models\SmsTemplates;
use yii\db\Query;
use common\models\Storage;
use common\models\Student;
use common\models\User;

date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class SiteController extends \common\controllers\CommonController {

    public $layout;
    
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                ],
            ],
                ],
                /* 'verbs' => [
                  'class' => VerbFilter::className(),
                  'actions' => [
                  'logout' => ['post'],
                  ],
                  ], */
        ];
    }

    public function beforeAction($action) {
        if (\Yii::$app->getUser()->isGuest &&
                \Yii::$app->getRequest()->url !== \yii\helpers\Url::to(\Yii::$app->getUser()->loginUrl) &&
                (Yii::$app->controller->action->id != 'student-login' && Yii::$app->controller->action->id != 'professor-login' && Yii::$app->controller->action->id != 'login' && Yii::$app->controller->action->id != 'maliciouserror' && Yii::$app->controller->action->id != 'student-register' && Yii::$app->controller->action->id != 'signupotp' && 
                Yii::$app->controller->action->id != 'request-password-reset' && Yii::$app->controller->action->id != 'reset-password' &&
                Yii::$app->controller->action->id != 'resend-email-verification' &&
                Yii::$app->controller->action->id != 'email-verification' && Yii::$app->controller->action->id != 'forgot-password-modal' &&
                Yii::$app->controller->action->id != 'index' && Yii::$app->controller->action->id != 'dynamic-map' &&
                Yii::$app->controller->action->id != 'mapdata' && Yii::$app->controller->action->id != 'get-data' &&
                Yii::$app->controller->action->id != 'is-private' && Yii::$app->controller->action->id != 'view' && Yii::$app->controller->action->id != 'contact-us' && 
                Yii::$app->controller->action->id != 'validateuser' && Yii::$app->controller->action->id != 'get-months-data' && Yii::$app->controller->action->id != 'get-months-data-for-participants' && 
                Yii::$app->controller->action->id != 'validatesignupuser' && Yii::$app->controller->action->id != 'validate-forgot-password' ) && Yii::$app->controller->action->id != 'coming-soon' && 
                Yii::$app->controller->action->id != 'is-login' && Yii::$app->controller->action->id != 'dynamic-new' && Yii::$app->controller->action->id != 'index1' && Yii::$app->controller->action->id != 'invester-list' && 
                yii::$app->controller->action->id != 'about' && yii::$app->controller->action->id != 'blog' && yii::$app->controller->action->id != 'terms-of-use' && yii::$app->controller->action->id != 'careers' &&
                yii::$app->controller->action->id != 'privacy-policy' && yii::$app->controller->action->id != 'csr' && yii::$app->controller->action->id != 'yuva' && yii::$app->controller->action->id != 'how-it-works' && 
                yii::$app->controller->action->id != 'subscribe' && yii::$app->controller->action->id != 'banks' && yii::$app->controller->action->id != 'contact' && yii::$app->controller->action->id != 'captcha'  && 
                yii::$app->controller->action->id != 'maintenance' && yii::$app->controller->action->id != 'add-guest-user' && yii::$app->controller->action->id != 'validate-guest-user-otp' && 
                yii::$app->controller->action->id != 'update-guest-user' && yii::$app->controller->action->id != 'feedback' && Yii::$app->controller->action->id != 'encryptdata' && Yii::$app->controller->action->id != 'getseckey' && 
                Yii::$app->controller->action->id != 'verifycaptchacode' && Yii::$app->controller->action->id != 'generaterandomstring' && Yii::$app->controller->action->id !=  'validate-signup-user-otp' &&
                Yii::$app->controller->action->id != 'update-signup-user' && Yii::$app->controller->action->id != 'loginwaygst' && Yii::$app->controller->action->id != 'getapprovedprojects' &&
                Yii::$app->controller->action->id != 'verifywaygstlogin' && Yii::$app->controller->action->id != 'resendotp' && Yii::$app->controller->action->id != 'get-email-template' && 
                Yii::$app->controller->action->id != 'gallery' && Yii::$app->controller->action->id != 'videos' && Yii::$app->controller->action->id != 'digital-magazine' && 
                Yii::$app->controller->action->id != 'press-release' && Yii::$app->controller->action->id != 'faqs' && Yii::$app->controller->action->id != 'social-coming-soon' && 
                Yii::$app->controller->action->id != 'global-search' && Yii::$app->controller->action->id != 'getmapdata' && Yii::$app->controller->action->id != 'getmaplocations') {
             \Yii::$app->getResponse()->redirect(Yii::$app->request->BaseUrl . '/../../');
                } /*elseif(empty(Yii::$app->user->identity->id) && empty(Yii::$app->session['signup'])) {
            if(Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id != 'index') {
                \Yii::$app->getResponse()->redirect(Yii::$app->request->BaseUrl . '/../../');
            } else {
                return parent::beforeAction($action);
            }
        }*/ else {
            return parent::beforeAction($action);
        }
    }
    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
	//	try{
            $this->view->title ='UTBSEMS - Home';
		    return $this->render('index');
		//} catch (\Exception $e) {
          //  \common\controllers\CommonController::exceptionMessage($e->getMessage());
        //}
    }

    /* end here */

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionStudentDashboard(){
        return $this->render('student-dashboard');
    }

    public function actionLogin($username = '') {
		try{
            if (!\Yii::$app->user->isGuest) {
                return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
            }

            $model = new \common\models\LoginForm();
            $model->scenario = 'loginpage';
            
            if(!empty(Yii::$app->getRequest()->getQueryParam('enc')) || !empty($username)) {
                
                if(!empty(Yii::$app->getRequest()->getQueryParam('enc'))) {
                    $user_array = explode('|', base64_decode(Yii::$app->getRequest()->getQueryParam('enc')));

                    $model->username = $user_array[2];
                } else {
                    $model->username = $username;
                }
                $model->password = '';

                /*if(!$model->validate()) {
                    print_r($model->getErrors()); //die;
                }*/
                if ($model->validate() && $model->login()) {
                    //echo 'Login'; die;
                    $userData = User::find()->where(['username' => $model->username])->one();
                    Yii::$app->session['email'] = $userData->email;
                    Yii::$app->session['userRole'] = $userData->user_role_ref_id;
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
                    die;
                } else {
                    $username = $user_array[2];
                    $firstname = $user_array[0];
                    $lastname = $user_array[1];
                    $mobile = $user_array[3];

                    return $this->redirect(Yii::$app->urlManager->createUrl('signup?username='.$username.'&mobile='.$mobile.'&firstname='.$firstname.'&lastname='.$lastname));
                    die;
                }
            }

            $captcha = false;
            if(Yii::$app->request->post()) {
                if(!empty(Yii::$app->request->post('LoginForm'))) {
                    
                    $post_variables =Yii::$app->request->post('LoginForm'); 
                    $username = $model->username = Yii::$app->request->post('LoginForm')['username'];
                    $password = $model->password = \common\controllers\Security::cryptoJsAesDecrypt(trim(\Yii::$app->params['secretkey']), trim(Yii::$app->request->post('LoginForm')['password']));
                }
				
                $userData = User::find()->where(['username' => $username])->one();
				if($userData){
                $attemptcount = $model->checkattempts($username);//print_r($userData->id); exit;
                $logindata = (new \yii\db\Query())->select('*')->from('login_attempts')->where(['user_ref_id' => $userData->id])->one();
                $oldcreatedate = strtotime($logindata['created_at']);
                $createdate = strtotime(date('Y-m-d H:i:s'));$created_at = date('Y-m-d H:i:s');
                $difference = round(abs($oldcreatedate - $createdate) / 60);
                if ($attemptcount && ($attemptcount >=2 && $attemptcount <=5) && (!$userData || !Yii::$app->getSecurity()->validatePassword($password, $userData->password_hash))) {
                    $model->scenario = 'withCaptcha'; //useful only for view
                    $captcha = true;
                }else if($attemptcount && $attemptcount >5 && intval($difference)<5){
                    $model->scenario = 'limitExceed';
                }
                if((isset($post_variables['pageVerifyCode']) && $post_variables['pageVerifyCode'] && $post_variables['pageVerifyCode']=='') || ($captcha && isset($post_variables['pageVerifyCode']) && $post_variables['pageVerifyCode']=='')){
                    Yii::$app->session->setFlash('emptycaptcha', "Please enter Verification code");
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
                }else if ((isset($post_variables['pageVerifyCode']) && $post_variables['pageVerifyCode'] && !$model->ajaxcodeVerify($post_variables['pageVerifyCode'])) || ($captcha && isset($post_variables['pageVerifyCode']) && !$model->ajaxcodeVerify($post_variables['pageVerifyCode']))) {
                    Yii::$app->session->setFlash('incorrectcaptcha', "Verification code is incorrect");
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
                }
				}
            }
            
            
            if (Yii::$app->request->post() && $model->validate()) {
                $userData = User::find()->where(['username' => addslashes($username)])->one();
                if(preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/', $username)){
                    if ($userData->email_confirmed != 1) {
                         Yii::$app->session->setFlash('mailnotconfirmed', "Your email is not yet activated. Please check your mail for activation link.<a href='" . Yii::$app->getUrlManager()->getBaseUrl() . "/site/resend-email-verification?id=" . base64_encode($userData->id) . "'>Resend email</a>");
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
                    } 
                }
                if ($userData->status != 1) {
                    Yii::$app->session->setFlash('statusnotenabled', 'Admin activation is pending.');
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
                } else if ($model->login()) {
                    $deleteattempt = $model->deleteattempts(Yii::$app->user->id);
                    Yii::$app->session['email'] = $userData->email;
                    Yii::$app->session['userRole'] = $userData->user_role_ref_id;
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
                }
            } else {
                return $this->render('login', [
                            'model' => $model, 'captcha' => $captcha,
                        ]);
            }
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }

    public function actionStudentLogin($username = '') {
		try{
            if(!Yii::$app->user->id){
            $model = new \common\models\LoginForm();
            $model->scenario = 'loginpage';
            

            $captcha = false;
            if(Yii::$app->request->post()) {
                if(!empty(Yii::$app->request->post('LoginForm'))) {
                    $post_variables =Yii::$app->request->post('LoginForm'); 
                    $username = $model->username = Yii::$app->request->post('LoginForm')['username'];
                    $password = $model->password = Yii::$app->request->post('LoginForm')['password'];
                }
				
                $userData = User::find()->where(['username' => $username])->one();
				if($userData){
                $attemptcount = $model->checkattempts($username);//print_r($userData->id); exit;
                $logindata = (new \yii\db\Query())->select('*')->from('login_attempts')->where(['user_ref_id' => $userData->id])->one();
                $oldcreatedate = strtotime($logindata['created_at']);
                $createdate = strtotime(date('Y-m-d H:i:s'));$created_at = date('Y-m-d H:i:s');
                $difference = round(abs($oldcreatedate - $createdate) / 60);
                if ($attemptcount && ($attemptcount >=2 && $attemptcount <=5) && (!$userData || !Yii::$app->getSecurity()->validatePassword($password, $userData->password_hash))) {
                    $model->scenario = 'withCaptcha'; //useful only for view
                    $captcha = true;
                }else if($attemptcount && $attemptcount >5 && intval($difference)<5){
                    $model->scenario = 'limitExceed';
                }
                if((isset($post_variables['pageVerifyCode']) && $post_variables['pageVerifyCode'] && $post_variables['pageVerifyCode']=='') || ($captcha && isset($post_variables['pageVerifyCode']) && $post_variables['pageVerifyCode']=='')){
                    Yii::$app->session->setFlash('emptycaptcha', "Please enter Verification code");
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
                }else if ((isset($post_variables['pageVerifyCode']) && $post_variables['pageVerifyCode'] && !$model->ajaxcodeVerify($post_variables['pageVerifyCode'])) || ($captcha && isset($post_variables['pageVerifyCode']) && !$model->ajaxcodeVerify($post_variables['pageVerifyCode']))) {
                    Yii::$app->session->setFlash('incorrectcaptcha', "Verification code is incorrect");
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
                }
				}
            }
            
            if (Yii::$app->request->post() && $model->validate()) {
                $userData = User::find()->where(['username' => addslashes($username)])->one();
               if ($model->login()) {
                    $deleteattempt = $model->deleteattempts(Yii::$app->user->id);
                    Yii::$app->session['email'] = $userData->email;
                    Yii::$app->session['userRole'] = $userData->user_role_ref_id;
                    return $this->redirect('student-profile');
                    die;
                }
            } else {
                return $this->render('student-login', [
                            'model' => $model, 'captcha' => $captcha,
                        ]);
            }
        }else{
            return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
        }
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }


    public function actionProfessorLogin($username = '') {
		try{
            if(!Yii::$app->user->id){
            $model = new \common\models\LoginForm();
            $model->scenario = 'loginpage';
            

            $captcha = false;
            if(Yii::$app->request->post()) {
                if(!empty(Yii::$app->request->post('LoginForm'))) {
                    $post_variables =Yii::$app->request->post('LoginForm'); 
                    $username = $model->username = Yii::$app->request->post('LoginForm')['username'];
                    $password = $model->password = Yii::$app->request->post('LoginForm')['password'];
                }
				
                $userData = User::find()->where(['username' => $username])->one();
				if($userData){
                $attemptcount = $model->checkattempts($username);//print_r($userData->id); exit;
                $logindata = (new \yii\db\Query())->select('*')->from('login_attempts')->where(['user_ref_id' => $userData->id])->one();
                $oldcreatedate = strtotime($logindata['created_at']);
                $createdate = strtotime(date('Y-m-d H:i:s'));$created_at = date('Y-m-d H:i:s');
                $difference = round(abs($oldcreatedate - $createdate) / 60);
                if ($attemptcount && ($attemptcount >=2 && $attemptcount <=5) && (!$userData || !Yii::$app->getSecurity()->validatePassword($password, $userData->password_hash))) {
                    $model->scenario = 'withCaptcha'; //useful only for view
                    $captcha = true;
                }else if($attemptcount && $attemptcount >5 && intval($difference)<5){
                    $model->scenario = 'limitExceed';
                }
                if((isset($post_variables['pageVerifyCode']) && $post_variables['pageVerifyCode'] && $post_variables['pageVerifyCode']=='') || ($captcha && isset($post_variables['pageVerifyCode']) && $post_variables['pageVerifyCode']=='')){
                    Yii::$app->session->setFlash('emptycaptcha', "Please enter Verification code");
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
                }else if ((isset($post_variables['pageVerifyCode']) && $post_variables['pageVerifyCode'] && !$model->ajaxcodeVerify($post_variables['pageVerifyCode'])) || ($captcha && isset($post_variables['pageVerifyCode']) && !$model->ajaxcodeVerify($post_variables['pageVerifyCode']))) {
                    Yii::$app->session->setFlash('incorrectcaptcha', "Verification code is incorrect");
                    return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
                }
				}
            }
            
            
            if (Yii::$app->request->post() && $model->validate()) {
                $userData = User::find()->where(['username' => addslashes($username)])->one();
                if ($model->login()) {
                    $deleteattempt = $model->deleteattempts(Yii::$app->user->id);
                    Yii::$app->session['email'] = $userData->email;
                    Yii::$app->session['userRole'] = $userData->user_role_ref_id;
                    return $this->redirect('professor-dashboard');
                }
            } else {
                return $this->render('professor-login', [
                            'model' => $model, 'captcha' => $captcha,
                        ]);
            }
        }else{
            return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
        }
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
		try{
        Yii::$app->user->logout();
        if (Yii::$app->getRequest()->getQueryParam('status') == 'logout') {            
            Yii::$app->session->setFlash('password_changed', "<div class='update-created'> <div class='header-flash-msg' style='text-align: center; padding: 20px 10px;'><span class='lnr lnr-checkmark-circle'></span></div><div class='success-msg'>Success!</div><div class='head-text'>Password changed successfully!</div><div class='flash-content'>&nbsp;</div><div class='button-sucess'><input type='button' class='button-ok' data-dismiss='alert' aria-hidden='true' value='OK'></div></div>");
            return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
        } else {
             return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
        }
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    
	public function actionMaliciouserror(){
		return $this->render('malicious-error');
    }
    
    public function actionStudentRegister()
    {
            $userformmodel = new \common\models\CreateStudentForm();
            $signup = new \frontend\models\SignupForm();
            $student = new Student;
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateStudentForm');
                $signup->password = $postvariable['password'];
                $signup->email = $postvariable['email'];
                $signup->username = $postvariable['email'];
                $signup->user_role_ref_id = 2;
                $postvariable=Yii::$app->request->post('CreateStudentForm');
				
                $student->name = isset($postvariable['name']) ? $postvariable['name'] : '';
                $student->rollno = isset($postvariable['rollno']) ? $postvariable['rollno'] : '';
                $student->rumpun = isset($postvariable['rumpun']) ? $postvariable['rumpun'] : '';
                $student->nationality = isset($postvariable['nationality']) ? $postvariable['nationality'] : '';
                $student->nationalityother = isset($postvariable['nationalityother']) ? $postvariable['nationalityother'] : '';
                $student->passportno = isset($postvariable['passportno']) ? $postvariable['passportno'] : '';
                $student->race = isset($postvariable['race']) ? $postvariable['race'] : '';
                $student->raceother = isset($postvariable['raceother']) ? $postvariable['raceother'] : '';
                $student->religion = isset($postvariable['religion']) ? $postvariable['religion'] : '';
                $student->religionother = isset($postvariable['religionother']) ? $postvariable['religionother'] : '';
                $student->typeofentryother = isset($postvariable['typeofentryother']) ? $postvariable['typeofentryother'] : '';
                $student->gender = isset($postvariable['gender']) ? $postvariable['gender'] : '';
                $student->martial_status = isset($postvariable['martial_status']) ? $postvariable['martial_status'] : '';
                $student->dob = isset($postvariable['dob']) ? $postvariable['dob'] : '';
                $student->specialneeds = isset($postvariable['specialneeds']) ? $postvariable['specialneeds'] : '';
                $student->type_of_entry = isset($postvariable['type_of_entry']) ? $postvariable['type_of_entry'] : '';
                $student->place_of_birth = isset($postvariable['place_of_birth']) ? $postvariable['place_of_birth'] : '';
                $student->telephone_mobile = isset($postvariable['telephone_mobile']) ? $postvariable['telephone_mobile'] : '';
                $student->tele_home = isset($postvariable['tele_home']) ? $postvariable['tele_home'] : '';
                $student->email = isset($postvariable['email']) ? $postvariable['email'] : '';
                $student->emailother = isset($postvariable['emailother']) ? $postvariable['emailother'] : '';
                $student->lastschoolname = isset($postvariable['lastschoolname']) ? $postvariable['lastschoolname'] : '';
                $student->father_name = isset($postvariable['father_name']) ? $postvariable['father_name'] : '';
                $student->fathericno = isset($postvariable['fathericno']) ? $postvariable['fathericno'] : '';
                $student->father_mobile = isset($postvariable['father_mobile']) ? $postvariable['father_mobile'] : '';
                $student->mother_name = isset($postvariable['mother_name']) ? $postvariable['mother_name'] : '';
                $student->mothericno = isset($postvariable['mothericno']) ? $postvariable['mothericno'] : '';
                $student->mother_mobile = isset($postvariable['mother_mobile']) ? $postvariable['mother_mobile'] : '';
                $student->address = isset($postvariable['address']) ? $postvariable['address'] : '';
                $student->address2 = isset($postvariable['address2']) ? $postvariable['address2'] : '';
                $student->address3 = isset($postvariable['address3']) ? $postvariable['address3'] : '';
                $student->postal_code = isset($postvariable['postal_code']) ? $postvariable['postal_code'] : '';
                $student->bank_name = isset($postvariable['bank_name']) ? $postvariable['bank_name'] : '';
                $student->account_no = isset($postvariable['account_no']) ? $postvariable['account_no'] : '';
                $student->sponsor_type = isset($postvariable['sponsor_type']) ? $postvariable['sponsor_type'] : '';
                $student->sponsor_type_other = isset($postvariable['sponsor_type_other']) ? $postvariable['sponsor_type_other'] : '';
                $student->programme_name = isset($postvariable['programme_name']) ? $postvariable['programme_name'] : '';
                $student->intake = isset($postvariable['intake']) ? $postvariable['intake'] : '';
                $student->entry = isset($postvariable['entry']) ? $postvariable['entry'] : '';
                $student->ic_no = isset($postvariable['ic_no']) ? $postvariable['ic_no'] : '';
                $student->ic_color = isset($postvariable['ic_color']) ? $postvariable['ic_color'] : '';
                $student->gaurdian_relation = isset($postvariable['gaurdian_relation']) ? $postvariable['gaurdian_relation'] : '';
                $student->mobile_home = isset($postvariable['mobile_home']) ? $postvariable['mobile_home'] : '';
                $student->father_ic_color = isset($postvariable['father_ic_color']) ? $postvariable['father_ic_color'] : '';
                $student->gaurdian_employment = isset($postvariable['gaurdian_employment']) ? $postvariable['gaurdian_employment'] : '';
                $student->gaurdian_employer = isset($postvariable['gaurdian_employer']) ? $postvariable['gaurdian_employer'] : '';
                $student->remarks = isset($postvariable['remarks']) ? $postvariable['remarks'] : '';
                $student->telphone_work = isset($postvariable['telphone_work']) ? $postvariable['telphone_work'] : '';
                $student->mother_ic_color = isset($postvariable['mother_ic_color']) ? $postvariable['mother_ic_color'] : '';
                
                $student->status_of_student = isset($postvariable['status_of_student']) ? $postvariable['status_of_student'] : '';
                $student->status_remarks = isset($postvariable['status_remarks']) ? $postvariable['status_remarks'] : '';
                $student->mode = isset($postvariable['mode']) ? $postvariable['mode'] : '';
                $student->utb_email_address = isset($postvariable['utb_email_address']) ? $postvariable['utb_email_address'] : '';
                $student->degree_classification = isset($postvariable['degree_classification']) ? $postvariable['degree_classification'] : '';
                $student->date_of_registration = isset($postvariable['date_of_registration']) ? $postvariable['date_of_registration'] : '';
                $student->date_of_leaving = isset($postvariable['date_of_leaving']) ? $postvariable['date_of_leaving'] : '';
                $student->previous_roll_no = isset($postvariable['previous_roll_no']) ? $postvariable['previous_roll_no'] : '';
                $student->previous_programme_name = isset($postvariable['previous_programme_name']) ? $postvariable['previous_programme_name'] : '';
                $student->previous_intake_no = isset($postvariable['previous_intake_no']) ? $postvariable['previous_intake_no'] : '';
                $student->previous_utb_email = isset($postvariable['previous_utb_email']) ? $postvariable['previous_utb_email'] : '';

                    if ($user = $signup->signup()) {
                    Yii::$app->cache->flush();
                    $userid = Yii::$app->db->getLastInsertID();
                    $student->user_ref_id = $userid;
                     $student->save(false)   ;
				$storagemodel = new \common\models\Storage();
				
			$studentimage = $storagemodel->user_image = \yii\web\UploadedFile::getInstance($userformmodel, 'user_image');
			if(count($storagemodel->user_image)>0){
                if ($storagemodel->upload($userid)) {
                }
				}
				/*---------------------------------------------------------*/
			$user->user_image = $studentimage;

				

				if($user->save(false)){
						}
						            
                        Yii::$app->session->setFlash('signupsuccess', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">You are registered successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
                        return $this->redirect(['/']);
                    }
            }
            return $this->render('student-register',[
                'userformmodel'=>$userformmodel,
                    ]);
    }
	
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionStudentProfile(){
		try{
        $student = new Student();
        $student = Student::findByUserId(Yii::$app->user->id);
        return $this->render('student-profile',[
            'studentdetails'=>$student[0],
        ]);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }

    public function actionStudentEditProfile(){
        
        //print_r($studentdata[0]['name']); exit;
            $userformmodel = new \common\models\CreateStudentForm();
        if($userformmodel->load(Yii::$app->request->post())){
            print_r($postvariable); exit;
            $postvariable=Yii::$app->request->post('CreateStudentForm');
            print_r($postvariable); exit;
                $student = Student::find()->where(['user_ref_id'=>$postvariable['studentid']])->one();
                $student->name = isset($postvariable['name']) ? $postvariable['name'] : '';
                $student->rollno = isset($postvariable['rollno']) ? $postvariable['rollno'] : '';
                $student->rumpun = isset($postvariable['rumpun']) ? $postvariable['rumpun'] : '';
                $student->nationality = isset($postvariable['nationality']) ? $postvariable['nationality'] : '';
                if($postvariable['nationality'] == 'Other'){
                    $student->nationalityother = isset($postvariable['nationalityother']) ? $postvariable['nationalityother'] : '';
                }else{
                    $student->nationalityother = '';
                }
                $student->passportno = isset($postvariable['passportno']) ? $postvariable['passportno'] : '';
                $student->race = isset($postvariable['race']) ? $postvariable['race'] : '';
                if($postvariable['race'] == 'Other'){
                    $student->raceother = isset($postvariable['raceother']) ? $postvariable['raceother'] : '';
                }else{
                    $student->raceother = '';
                }
                $student->religion = isset($postvariable['religion']) ? $postvariable['religion'] : '';
                if($postvariable['religion'] == 'Other'){
                    $student->religionother = isset($postvariable['religionother']) ? $postvariable['religionother'] : '';
                }else{
                    $student->religionother = '';
                }
                $student->type_of_entry = isset($postvariable['type_of_entry']) ? $postvariable['type_of_entry'] : '';
                if($postvariable['type_of_entry'] == 'Other'){
                    $student->typeofentryother = isset($postvariable['typeofentryother']) ? $postvariable['typeofentryother'] : '';
                }else{
                    $student->typeofentryother = '';
                }
                $student->gender = isset($postvariable['gender']) ? $postvariable['gender'] : '';
                $student->martial_status = isset($postvariable['martial_status']) ? $postvariable['martial_status'] : '';
                $student->dob = isset($postvariable['dob']) ? $postvariable['dob'] : '';
                $student->specialneeds = isset($postvariable['specialneeds']) ? $postvariable['specialneeds'] : '';
                $student->place_of_birth = isset($postvariable['place_of_birth']) ? $postvariable['place_of_birth'] : '';
                $student->telephone_mobile = isset($postvariable['telephone_mobile']) ? $postvariable['telephone_mobile'] : '';
                $student->tele_home = isset($postvariable['tele_home']) ? $postvariable['tele_home'] : '';
                $student->email = isset($postvariable['email']) ? $postvariable['email'] : '';
                $student->emailother = isset($postvariable['emailother']) ? $postvariable['emailother'] : '';
                $student->lastschoolname = isset($postvariable['lastschoolname']) ? $postvariable['lastschoolname'] : '';
                $student->father_name = isset($postvariable['father_name']) ? $postvariable['father_name'] : '';
                $student->fathericno = isset($postvariable['fathericno']) ? $postvariable['fathericno'] : '';
                $student->father_mobile = isset($postvariable['father_mobile']) ? $postvariable['father_mobile'] : '';
                $student->mother_name = isset($postvariable['mother_name']) ? $postvariable['mother_name'] : '';
                $student->mothericno = isset($postvariable['mothericno']) ? $postvariable['mothericno'] : '';
                $student->mother_mobile = isset($postvariable['mother_mobile']) ? $postvariable['mother_mobile'] : '';
                $student->address = isset($postvariable['address']) ? $postvariable['address'] : '';
                $student->address2 = isset($postvariable['address2']) ? $postvariable['address2'] : '';
                $student->address3 = isset($postvariable['address3']) ? $postvariable['address3'] : '';
                $student->postal_code = isset($postvariable['postal_code']) ? $postvariable['postal_code'] : '';
                $student->bank_name = isset($postvariable['bank_name']) ? $postvariable['bank_name'] : '';
                $student->account_no = isset($postvariable['account_no']) ? $postvariable['account_no'] : '';
                $student->sponsor_type = isset($postvariable['sponsor_type']) ? $postvariable['sponsor_type'] : '';
                $student->sponsor_type_other = isset($postvariable['sponsor_type_other']) ? $postvariable['sponsor_type_other'] : '';
                $student->programme_name = isset($postvariable['programme_name']) ? $postvariable['programme_name'] : '';
                $student->intake = isset($postvariable['intake']) ? $postvariable['intake'] : '';
                $student->entry = isset($postvariable['entry']) ? $postvariable['entry'] : '';
                $student->ic_no = isset($postvariable['ic_no']) ? $postvariable['ic_no'] : '';
                $student->ic_color = isset($postvariable['ic_color']) ? $studentdetails['ic_color'] : '';
                $student->gaurdian_relation = isset($postvariable['gaurdian_relation']) ? $postvariable['gaurdian_relation'] : '';
                $student->mobile_home = isset($postvariable['mobile_home']) ? $postvariable['mobile_home'] : '';
                $student->father_ic_color = isset($postvariable['father_ic_color']) ? $postvariable['father_ic_color'] : '';
                $student->gaurdian_employment = isset($postvariable['gaurdian_employment']) ? $postvariable['gaurdian_employment'] : '';
                $student->gaurdian_employer = isset($postvariable['gaurdian_employer']) ? $postvariable['gaurdian_employer'] : '';
                $student->remarks = isset($postvariable['remarks']) ? $postvariable['remarks'] : '';
                $student->telphone_work = isset($postvariable['telphone_work']) ? $postvariable['telphone_work'] : '';
                $student->mother_ic_color = isset($postvariable['mother_ic_color']) ? $postvariable['mother_ic_color'] : '';
                $student->user_image = isset($postvariable['user_image']) ? $postvariable['user_image'] : '';
                $storagemodel = new \common\models\Storage();
				$userid = $student->user_ref_id;
            $storagemodel->user_image = \yii\web\UploadedFile::getInstance($userformmodel, 'user_image');
            if(count($storagemodel->user_image)>0){
                $studentimage = $student->user_image = $storagemodel->user_image->name;
                if ($storagemodel->upload($userid)) {
                }
				}
            if($student->save(false)){
                if(count($storagemodel->user_image)>0){
                    $user = User::find()->where(['id'=>$student->user_ref_id])->one();
                    $user->user_image = $studentimage;
                if($user->save(false)){}
                }
                Yii::$app->session->setFlash('studentupdatesuccess', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Profile Updated successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
                return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../student-profile');
            }
        }else{     
            $studentdata=Student::getStudentsDataByUserRefId(Yii::$app->user->id);
        return $this->render('student-edit-profile',[
            'userformmodel'=>$userformmodel,
            'studentdata'=>$studentdata[0],
                ]);
        }
    }
	
	
}
