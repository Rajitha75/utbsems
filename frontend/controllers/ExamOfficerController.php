<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use common\models\Storage;
use common\models\ExamOfficer;
use common\models\Lecturer;
use common\models\Faculty;
use common\models\User;

date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class ExamOfficerController extends \common\controllers\CommonController {

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
                 Yii::$app->controller->action->id != 'exam-officers-login' && Yii::$app->controller->action->id != 'validate-email'  && Yii::$app->controller->action->id != 'validate-rollno') {
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

    /* end here */

    /**
     * Logs in a user.
     *
     * @return mixed
     */
	 
	 public function actionValidateEmail(){
		 try{
		  $userdata = User::validateEmail($_POST['email']);
		  
		  if($userdata > 0){
			  echo 'false'; exit;
		  }else{
			  echo 'true'; exit;
		  }
		  } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	 }
	 
	 public function actionValidateRollno(){
		 try{
		  $userdata = User::validateRollno($_POST['rollno']);
		  if($userdata > 0){
			  echo 'false'; exit;
		  }else{
			  echo 'true'; exit;
		  }
		  } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	 }
	 
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

    public function actionExamOfficersLogin($username = '') {
		try{
            if(!Yii::$app->user->id){
            $model = new \common\models\LoginForm();
            $model->scenario = 'loginpage';
            
Yii::$app->cache->flush();
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
					Yii::$app->session['isEaAdmin'] = $userData->is_admin;
                    return $this->redirect('exam-officers-list');
                    die;
                }
            } else {
                return $this->render('exam-officers-login', [
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
    
    public function actionExamOfficersDashboard(){
        return $this->render('exam-officers-dashboard');
    }
	
	
    public function actionStudentRegister()
    {
	    try{
            $userformmodel = new \common\models\CreateStudentForm();
            $signup = new \frontend\models\SignupForm();
            $student = new Student();
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateStudentForm');
                $signup->email = $postvariable['email'];
                $signup->username = $postvariable['email'];
				$signup->password = $postvariable['password'];
                $signup->user_role_ref_id = 2;
				$signup->status = 2;
                $postvariable=Yii::$app->request->post('CreateStudentForm');
				
                $student->ic_no = isset($postvariable['ic_no']) ? $postvariable['ic_no'] : '';
                $student->passportno = isset($postvariable['passportno']) ? $postvariable['passportno'] : '';
                $student->email = isset($postvariable['email']) ? $postvariable['email'] : '';
                    if ($user = $signup->signup()) {
                    Yii::$app->cache->flush();
                    $userid = Yii::$app->db->getLastInsertID();
                    $student->user_ref_id = $userid;
                     $student->save(false)   ;
					 
	$emailbody= '<table width="650" border="0" align="center" cellpadding="0" cellspacing="0"><tbody><tr>';
    $emailbody .= '<td><div style="background-color:#dea1bd;height:120px;display:inline-block;width:100%;border-bottom:5px solid #629817;border-top-left-radius:10px;border-top-right-radius:10px"><img src="'.SITE_URL. yii::getAlias('@web').'/images/homepage/utb-logo.png" alt="" align="center" style="padding:20px 20px;width:260px;" class="CToWUd">
	</div></td>
	  </tr>
	<tr>
		<td bgcolor="#FFFFFF">
		
		<br>
		<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
	  <tbody><tr>
		<td style="font-family:Arial,Geneva,sans-serif;font-size:14px;color:#45482f;line-height:20px">
		
		  <p>Hi,</p>
		  <p>Thank you for registering with <span class="il">UTBSEMS</span>. Please click the below link to verify your account.</p>
		  <p><a href="'.SITE_URL.yii::getAlias('@web').'/site/student-details?id='.$userid.'" target="_blank" >Click here to verify</a></p>
		  <p>Thank You, <br>
			<strong style="color:#751d8b">Team <span class="il">UTBSEMS</span></strong></p></td>  </tr>
	</tbody></table>
		<br></td>
	  </tr>
	</tbody></table>';
			$mail = Yii::$app->mailer->compose();
            $mail->setFrom(['utbsemsuniversity@gmail.com' => 'UTBSEMS'])
                ->setTo($postvariable['email'])
                ->setSubject('Thank you for registering with UTBSEMS')
                ->setHtmlBody($emailbody)
                ->send();
            if($mail) {
                //$message = "Mail sent from RestAPI".PHP_EOL."____Record - Email: " . $to_email . "____Communication ID: " . $communique_id . ' --- Date: '.date('Y-m-d H:i:s') .  PHP_EOL;
                //file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
                $mail = '';
                unset($mail);
                //return 'true';
            } else {
                //$message = "Mail failed from RestAPI".PHP_EOL."____Record - Email: " . $to_email . "____Communication ID: " . $communique_id . ' --- Date: '.date('Y-m-d H:i:s') .  PHP_EOL;
                //file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
                $mail = '';
                unset($mail);
                //return 'false'; 
            }
                        Yii::$app->session->setFlash('signupsuccess', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">You are registered successfully! Please follow the steps in your email to verify your account </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
                        return $this->redirect(['/']);
                    }
            }
            return $this->render('student-register',[
                'userformmodel'=>$userformmodel,
                    ]);
		    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }


    public function actionStudentDetails()
    {
     try{   
        $userid = Yii::$app->getRequest()->getQueryParam('id') ? Yii::$app->getRequest()->getQueryParam('id') : "";
        $student = new Student();
        $student = Student::findByUserId($userid);
		$user = User::findIdentity($userid);
        if($userid && $userid!= '' && $userid != null && count($student) <= 0){
            echo 'You are not authorized to this page';exit;
        }
            $userformmodel = new \common\models\CreateStudentForm();
            $signup = new \frontend\models\SignupForm();
            $student = new Student();
           // print_r(Yii::$app->request->post());exit;
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateStudentForm');
                $userid = $postvariable['userid'];
                $signup->password = $postvariable['password'];
                $signup->userid = $userid;
                $postvariable=Yii::$app->request->post('CreateStudentForm');
				
                $student->type_of_programme = isset($postvariable['type_of_programme']) ? $postvariable['type_of_programme'] : '';
                $student->school = isset($postvariable['school']) ? $postvariable['school'] : '';
                if ($user = $signup->savepassword()) {
                    $userid = Yii::$app->db->getLastInsertID();
                    $student->user_ref_id = $userid;
                   
				if($student->save(false)){
						
						            
                        Yii::$app->session->setFlash('studentdetails', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Thank you for creating an account at UTBSEMS. </div><div class="flash-content">Thank you for your interest to study in UTB.</div><div class="head-text">You may now login and submit online application.</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
                        return $this->redirect(['/']);
                    }
                    }
            }else{
				if($user['is_verified'] == 1){
					Yii::$app->session->setFlash('studentdetailsverified', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Your email is already verified. </div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
                        return $this->redirect(['/']);
					
				}else{
            return $this->render('student-details',[
                'userformmodel'=>$userformmodel,
                'userid'=>$userid
                    ]);
				}
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
	    try{
        Yii::$app->cache->flush();
        //print_r($studentdata[0]['name']); exit;
            $userformmodel = new \common\models\CreateStudentForm();
            $countries = User::countrieslist();
        if($userformmodel->load(Yii::$app->request->post())){
            $postvariable=Yii::$app->request->post('CreateStudentForm');
			
                $student = Student::find()->where(['user_ref_id'=>$postvariable['studentid']])->one();
				
				$student->title = isset($postvariable['title']) ? $postvariable['title'] : '';
                $student->name = isset($postvariable['name']) ? $postvariable['name'] : '';
                $student->rollno = isset($postvariable['rollno']) ? $postvariable['rollno'] : '';
                $student->rumpun = isset($postvariable['rumpun']) ? $postvariable['rumpun'] : '';
                $student->nationality = isset($postvariable['nationality']) ? $postvariable['nationality'] : '';
                if($postvariable['nationality'] == 'Other'){
                    $student->nationalityother = isset($postvariable['nationalityother']) ? $postvariable['nationalityother'] : '';
                }else{
                    $student->nationalityother = '';
                }
				 $student->countrycode = isset($postvariable['countrycode']) ? $postvariable['countrycode'] : '';
                if($postvariable['countrycode'] == 'Brunei'){
                    $student->state = isset($postvariable['state']) ? $postvariable['state'] : '';
					$student->district = '';
                }else{
					$student->district = isset($postvariable['district']) ? $postvariable['district'] : '';
                    $student->state = '';
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
				$student->highest_qualification = isset($postvariable['highest_qualification']) ? $postvariable['highest_qualification'] : '';
                if($postvariable['highest_qualification'] == 'Other'){
                    $student->highestqualificationother = isset($postvariable['highestqualificationother']) ? $postvariable['highestqualificationother'] : '';
                }else{
                    $student->highestqualificationother = '';
                }
                $student->type_of_entry = isset($postvariable['type_of_entry']) ? $postvariable['type_of_entry'] : '';
                if($postvariable['type_of_entry'] == 'Other'){
                    $student->typeofentryother = isset($postvariable['typeofentryother']) ? $postvariable['typeofentryother'] : '';
                }else{
                    $student->typeofentryother = '';
                }
				$student->type_of_residential = isset($postvariable['type_of_residential']) ? $postvariable['type_of_residential'] : '';
                if($postvariable['type_of_residential'] == 'Other'){
                    $student->typeofresidentialother = isset($postvariable['typeofresidentialother']) ? $postvariable['typeofresidentialother'] : '';
                }else{
                    $student->typeofresidentialother = '';
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
				$student->countrycode = isset($postvariable['countrycode']) ? $postvariable['countrycode'] : '';
                $student->state = isset($postvariable['state']) ? $postvariable['state'] : '';
				$student->district = isset($postvariable['district']) ? $postvariable['district'] : '';
                $student->postal_code = isset($postvariable['postal_code']) ? $postvariable['postal_code'] : '';
				$student->mailing_address = isset($postvariable['mailing_address']) ? $postvariable['mailing_address'] : '';
                $student->mailing_address2 = isset($postvariable['mailing_address2']) ? $postvariable['mailing_address2'] : '';
                $student->mailing_address3 = isset($postvariable['mailing_address3']) ? $postvariable['mailing_address3'] : '';
				$student->mailing_countrycode = isset($postvariable['mailing_countrycode']) ? $postvariable['mailing_countrycode'] : '';
                $student->mailing_state = isset($postvariable['mailing_state']) ? $postvariable['mailing_state'] : '';
				$student->mailing_district = isset($postvariable['mailing_district']) ? $postvariable['mailing_district'] : '';
                $student->mailing_postal_code = isset($postvariable['mailing_postal_code']) ? $postvariable['mailing_postal_code'] : '';
				$student->mailing_permanent = isset($postvariable['mailing_permanent']) ? $postvariable['mailing_permanent'] : '';
				$student->bank_terms = isset($postvariable['bank_terms']) ? $postvariable['bank_terms'] : '';
                $student->bank_name = isset($postvariable['bank_name']) ? $postvariable['bank_name'] : '';
				$student->date_of_registration = isset($postvariable['date_of_registration']) ? $postvariable['date_of_registration'] : '';
				if($postvariable['bank_name'] == 'Other'){
                    $student->bank_name_other = isset($postvariable['bank_name_other']) ? $postvariable['bank_name_other'] : '';
                }else{
                    $student->bank_name_other = '';
                }
				$student->bank_account_name = isset($postvariable['bank_account_name']) ? $postvariable['bank_account_name'] : '';
                $student->account_no = isset($postvariable['account_no']) ? $postvariable['account_no'] : '';
                $student->sponsor_type = isset($postvariable['sponsor_type']) ? $postvariable['sponsor_type'] : '';
				if($postvariable['sponsor_type'] == 'Other'){
                    $student->sponsor_type_other = isset($postvariable['sponsor_type_other']) ? $postvariable['sponsor_type_other'] : '';
                }else{
                    $student->sponsor_type_other = '';
                }
                $student->type_of_programme = isset($postvariable['type_of_programme']) ? $postvariable['type_of_programme'] : '';
                $student->school = isset($postvariable['school']) ? $postvariable['school'] : '';

                /*$student->employer_name = isset($postvariable['employer_name']) ? $postvariable['employer_name'] : '';
                $student->employer_address = isset($postvariable['employer_address']) ? $postvariable['employer_address'] : '';
                $student->employer_address2 = isset($postvariable['employer_address2']) ? $postvariable['employer_address2'] : '';
                $student->employer_address3 = isset($postvariable['employer_address3']) ? $postvariable['employer_address3'] : '';
                $student->employer_postal_code = isset($postvariable['employer_postal_code']) ? $postvariable['employer_postal_code'] : '';
                $student->position_held = isset($postvariable['position_held']) ? $postvariable['position_held'] : '';
                $student->employment_mode = isset($postvariable['employment_mode']) ? $postvariable['employment_mode'] : '';
                $student->emp_from_month = isset($postvariable['emp_from_month']) ? $postvariable['emp_from_month'] : '';
                $student->emp_from_year = isset($postvariable['emp_from_year']) ? $postvariable['emp_from_year'] : '';
                $student->emp_to_month = isset($postvariable['emp_to_month']) ? $postvariable['emp_to_month'] : '';
                $student->emp_to_year = isset($postvariable['emp_to_year']) ? $postvariable['emp_to_year'] : '';*/

                $student->programme_name = isset($postvariable['programme_name']) ? $postvariable['programme_name'] : '';
                $student->intake = isset($postvariable['intake']) ? $postvariable['intake'] : '';
                $student->entry = isset($postvariable['entry']) ? $postvariable['entry'] : '';
				$student->ic_no_format = isset($postvariable['ic_no_format']) ? $postvariable['ic_no_format'] : '';
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
				$student->mode = isset($postvariable['mode']) ? $postvariable['mode'] : '';
				$student->utb_email_address = isset($postvariable['utb_email_address']) ? $postvariable['utb_email_address'] : '';
				$student->date_of_leaving = isset($postvariable['date_of_leaving']) ? $postvariable['date_of_leaving'] : '';
				$student->age = isset($postvariable['age']) ? $postvariable['age'] : '';
				$student->is_submit = isset($postvariable['is_submit']) ? $postvariable['is_submit'] : '';
                $student->user_image = isset($postvariable['user_image']) ? $postvariable['user_image'] : '';
                $storagemodel = new \common\models\Storage();
				$userid = $student->user_ref_id;
            $storagemodel->user_image = \yii\web\UploadedFile::getInstance($userformmodel, 'user_image');
	    //print_r($storagemodel);exit;
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
		if($postvariable['is_submit'] == 'submit'){
			Yii::$app->session->setFlash('studentupdatesuccesssubmit', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Profile Updated successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
		}else if($postvariable['is_submit'] == 'save'){
			Yii::$app->session->setFlash('studentupdatesuccesssave', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Profile Saved successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
		}
                return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../student-profile');
            }
        }else{     
            $studentdata=Student::getStudentsDataByUserRefId(Yii::$app->user->id);
        return $this->render('student-edit-profile',[
            'userformmodel'=>$userformmodel,
            'studentdata'=>$studentdata[0],
            'countries'=>$countries
                ]);
        }
	} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    
    
    public function actionCreateExamOfficer()
    {
	    try{
	    Yii::$app->cache->flush();
	    $userformmodel = new \common\models\CreateExamOfficerForm();
            $signup = new \frontend\models\SignupForm();
            $examofficer = new ExamOfficer();
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateExamOfficerForm');
                $signup->email = $postvariable['email'];
                $signup->username = $postvariable['email'];
				$signup->password = $postvariable['password'];
				$signup->is_admin = isset($postvariable['is_admin']) ? $postvariable['is_admin'] : '';
				$signup->is_verified = 1;
                $signup->user_role_ref_id = 3;
				$signup->status = 1;
                $postvariable=Yii::$app->request->post('CreateExamOfficerForm');                
                $examofficer->email = isset($postvariable['email']) ? $postvariable['email'] : '';
				$examofficer->name = isset($postvariable['name']) ? $postvariable['name'] : '';
                    if ($user = $signup->signup()) {
                    Yii::$app->cache->flush();
                    $userid = Yii::$app->db->getLastInsertID();
                    $examofficer->user_ref_id = $userid;
                     $examofficer->save(false)   ;
					 
	$emailbody= '<table width="650" border="0" align="center" cellpadding="0" cellspacing="0"><tbody><tr>';
    $emailbody .= '<td><div style="background-color:#dea1bd;height:120px;display:inline-block;width:100%;border-bottom:5px solid #629817;border-top-left-radius:10px;border-top-right-radius:10px"><img src="'.SITE_URL. yii::getAlias('@web').'/images/homepage/utb-logo.png" alt="" align="center" style="padding:20px 20px;width:260px;" class="CToWUd">
	</div></td>
	  </tr>
	<tr>
		<td bgcolor="#FFFFFF">
		
		<br>
		<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
	  <tbody><tr>
		<td style="font-family:Arial,Geneva,sans-serif;font-size:14px;color:#45482f;line-height:20px">
		
		  <p>Hi,</p>
		  <p>You are registered as <u>Exam Officer</u> for <span class="il">UTBSEMS</span> by one of the administrators. </p>
		  <p>Thank You, <br>
			<strong style="color:#751d8b">Team <span class="il">UTBSEMS</span></strong></p></td>  </tr>
	</tbody></table>
		<br></td>
	  </tr>
	</tbody></table>';
			$mail = Yii::$app->mailer->compose();
            $mail->setFrom(['utbsemsuniversity@gmail.com' => 'UTBSEMS'])
                ->setTo($postvariable['email'])
                ->setSubject('You are registered as Exam Officer for UTBSEMS')
                ->setHtmlBody($emailbody)
                ->send();
            if($mail) {
                //$message = "Mail sent from RestAPI".PHP_EOL."____Record - Email: " . $to_email . "____Communication ID: " . $communique_id . ' --- Date: '.date('Y-m-d H:i:s') .  PHP_EOL;
                //file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
                $mail = '';
                unset($mail);
                //return 'true';
            } else {
                //$message = "Mail failed from RestAPI".PHP_EOL."____Record - Email: " . $to_email . "____Communication ID: " . $communique_id . ' --- Date: '.date('Y-m-d H:i:s') .  PHP_EOL;
                //file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
                $mail = '';
                unset($mail);
                //return 'false'; 
            }
                        Yii::$app->session->setFlash('examofficercreate', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">You have successfully created an Exam Officer </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
                        return $this->redirect(['exam-officers-dashboard']);
                    }
            }
	return $this->render('create-exam-officer',[
		'userformmodel'=>$userformmodel
	    ]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    
    public function actionUpdateExamOfficer()
    {
	    try{
	    Yii::$app->cache->flush();
	    $userformmodel = new \common\models\CreateExamOfficerForm();
	    
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateExamOfficerForm');
				$examofficer = ExamOfficer::find()->where(['user_ref_id'=>$postvariable['examofficerid']])->one();
				$examofficer->name = isset($postvariable['name']) ? $postvariable['name'] : '';
		            
                     $examofficer->save(false)   ;
                        Yii::$app->session->setFlash('examofficerupdate', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Exam Officer Updated Successfully </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
                        return $this->redirect(['exam-officers-list']);
                  }else{
					$examofficerdata=ExamOfficer::getExamOfficerDataByUserRefId(Yii::$app->request->get('id'));
					$userdata = User::find()->where(['id'=>$examofficerdata[0]['user_ref_id']])->one();
				  }
		  
	return $this->render('update-exam-officer',[
		'examofficerdata'=>$examofficerdata[0],
		'userformmodel'=>$userformmodel,
		'isadmin'=>$userdata['is_admin']
	    ]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    
    
    
    public function actionExamOfficersList(){
    try{
	    $examofficer = new ExamOfficer();
		$name = Yii::$app->getRequest()->getQueryParam('name') ? Yii::$app->getRequest()->getQueryParam('name') : "";
		$email = Yii::$app->getRequest()->getQueryParam('email') ? Yii::$app->getRequest()->getQueryParam('email') : "";
	  $uQuery=ExamOfficer::getExamOfficersList($name,$email);
		$query = $uQuery;		
		$count = $uQuery->count();
           return $this->render('exam-officers-list',[
            'model'=>$examofficer,
            'query'=>$query,
            'count'=>$count
                ]);
        } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	
    }
    
    
    public function actionExamOfficerView($id){
		try{
        $examofficer = new ExamOfficer();
        $examofficer = ExamOfficer::findByExamOfficerId($id);
        return $this->render('exam-officers-view',[
            'examofficerdetails'=>$examofficer[0],
        ]);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    
     public function actionExamOfficerDelete($id)
    {
		try{
        $user = User::find()->where(['id' => Yii::$app->request->get('id')])->one();
        if(Yii::$app->request->get('status') == 1){
            $user->status = 2;
			Yii::$app->session->setFlash('examofficerdelete', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Exam Officer Updated Successfully </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
        }else if(Yii::$app->request->get('status') == 2){
            $user->status = 1;
			Yii::$app->session->setFlash('examofficerundodelete', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Exam Officer Updated Successfully </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
        }
        $user->save(false);
		return $this->redirect(['exam-officers-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	
    public function actionCreateLecturer()
    {
	    try{
	    Yii::$app->cache->flush();
	    $userformmodel = new \common\models\CreateLecturerForm();
            $signup = new \frontend\models\SignupForm();
            $lecturer = new Lecturer();
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateLecturerForm');
                $signup->email = $postvariable['email'];
                $signup->username = $postvariable['email'];
				$signup->password = $postvariable['password'];
                $signup->user_role_ref_id = 4;
				$signup->status = 1;
                $lecturer->email = isset($postvariable['email']) ? $postvariable['email'] : '';
				$lecturer->name = isset($postvariable['name']) ? $postvariable['name'] : '';
                    if ($user = $signup->signup()) {
                    Yii::$app->cache->flush();
                    $userid = Yii::$app->db->getLastInsertID();
                    $lecturer->user_ref_id = $userid;
                     $lecturer->save(false)   ;
					 
	$emailbody= '<table width="650" border="0" align="center" cellpadding="0" cellspacing="0"><tbody><tr>';
    $emailbody .= '<td><div style="background-color:#dea1bd;height:120px;display:inline-block;width:100%;border-bottom:5px solid #629817;border-top-left-radius:10px;border-top-right-radius:10px"><img src="'.SITE_URL. yii::getAlias('@web').'/images/homepage/utb-logo.png" alt="" align="center" style="padding:20px 20px;width:260px;" class="CToWUd">
	</div></td>
	  </tr>
	<tr>
		<td bgcolor="#FFFFFF">
		
		<br>
		<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
	  <tbody><tr>
		<td style="font-family:Arial,Geneva,sans-serif;font-size:14px;color:#45482f;line-height:20px">
		
		  <p>Hi,</p>
		  <p>You are registered as <u>Lecturer</u> for <span class="il">UTBSEMS</span> by one of the administrators. </p>
		  <p>Thank You, <br>
			<strong style="color:#751d8b">Team <span class="il">UTBSEMS</span></strong></p></td>  </tr>
	</tbody></table>
		<br></td>
	  </tr>
	</tbody></table>';
			$mail = Yii::$app->mailer->compose();
            $mail->setFrom(['utbsemsuniversity@gmail.com' => 'UTBSEMS'])
                ->setTo($postvariable['email'])
                ->setSubject('You are registered as Lecturer for UTBSEMS')
                ->setHtmlBody($emailbody)
                ->send();
            if($mail) {
                //$message = "Mail sent from RestAPI".PHP_EOL."____Record - Email: " . $to_email . "____Communication ID: " . $communique_id . ' --- Date: '.date('Y-m-d H:i:s') .  PHP_EOL;
                //file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
                $mail = '';
                unset($mail);
                //return 'true';
            } else {
                //$message = "Mail failed from RestAPI".PHP_EOL."____Record - Email: " . $to_email . "____Communication ID: " . $communique_id . ' --- Date: '.date('Y-m-d H:i:s') .  PHP_EOL;
                //file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
                $mail = '';
                unset($mail);
                //return 'false'; 
            }
                        Yii::$app->session->setFlash('lecturercreate', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">You have successfully created an Exam Officer </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
                        return $this->redirect(['lecturers-list']);
                    }
            }
	return $this->render('create-lecturer',[
		'userformmodel'=>$userformmodel
	    ]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    
    public function actionUpdateLecturer()
    {
	    try{
	    Yii::$app->cache->flush();
	    $userformmodel = new \common\models\CreateLecturerForm();
	    $lecturerdata=Lecturer::getLecturersDataByUserRefId(Yii::$app->request->get('id'));
	    
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateLecturerForm');
				$lecturer = Lecturer::find()->where(['user_ref_id'=>$postvariable['lecturerid']])->one();
                $lecturer->email = isset($postvariable['email']) ? $postvariable['email'] : '';
				$lecturer->name = isset($postvariable['name']) ? $postvariable['name'] : '';
				 $lecturer->save(false)   ;
                        Yii::$app->session->setFlash('lecturerupdate', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Exam Officer Updated Successfully </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
                        return $this->redirect(['lecturers-list']);
                  }
		  
	return $this->render('update-lecturer',[
		'lecturerdata'=>$lecturerdata[0],
		'userformmodel'=>$userformmodel
	    ]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    
    
    
    public function actionLecturersList(){
    try{
	    $lecturer = new Lecturer();
	  $uQuery=Lecturer::getLecturersListRecords();
		$query = $uQuery;		
		$count = $uQuery->count();
           return $this->render('lecturers-list',[
            'model'=>$lecturer,
            'query'=>$query,
            'count'=>$count
                ]);
        } catch (\Exception $e) {
           \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	
    }
    
    
    public function actionLecturerView($id){
		try{
        $lecturer = new Lecturer();
        $lecturer = Lecturer::findByLecturerId($id);
        return $this->render('lecturer-view',[
            'lecturerdetails'=>$lecturer[0],
        ]);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    
     public function actionLecturerDelete($id)
    {
		try{
        $user = User::find()->where(['id' => Yii::$app->request->get('id')])->one();
        if(Yii::$app->request->get('status') == 1){
            $user->status = 2;
			Yii::$app->session->setFlash('lecturerdelete', "Lecturer Deleted Successfully");
        }else if(Yii::$app->request->get('status') == 2){
            $user->status = 1;
			Yii::$app->session->setFlash('lecturerundodelete', "Lecturer Delete Undo Success");
        }
        $user->save(false);
		return $this->redirect(['lecturers-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	 
	   public function actionAddFaculty()
    {
	    try{
	    Yii::$app->cache->flush();
	    $facultyformmodel = new \common\models\CreateFacultyForm();
            $faculty = new Faculty();
            if($facultyformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateFacultyForm');
                $faculty->faculty_name = $postvariable['faculty_name'];
				$faculty->status = 1;
				$faculty->save(false);
				return $this->redirect(['faculty-list']);
			}
			return $this->render('add-faculty',[
				'facultyformmodel'=>$facultyformmodel
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   
	   public function actionUpdateFaculty()
    {
	    try{
	    Yii::$app->cache->flush();
	    $facultyformmodel = new \common\models\CreateFacultyForm();
            $faculty = new Faculty();
			$facultyid = Yii::$app->request->get('id');
				$facultymodel = Faculty::find()->where(['id' => $facultyid])->one();
            if($facultyformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateFacultyForm');
				$facultyid = $postvariable['id'];
				$facultymodel = Faculty::find()->where(['id' => $facultyid])->one();
                $facultymodel->faculty_name = $postvariable['faculty_name'];
				$facultymodel->save(false);
				return $this->redirect(['faculty-list']);
			}
			return $this->render('update-faculty',[
				'facultyformmodel'=>$facultyformmodel,
				'facultydata'=>$facultymodel
				
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	public function actionFacultyList()
    {
	    try{
	    Yii::$app->cache->flush();
		$faculty = new Faculty();
            $uQuery = Faculty::getAllFacultyList();
			$query = $uQuery;		
		$count = $uQuery->count();
			return $this->render('faculty-list',[
				 'model'=>$faculty,
				'query'=>$query,
				'count'=>$count
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	 public function actionFacultyDelete($id)
    {
		try{
        $faculty = Faculty::find()->where(['id' => $id])->one();
        if(Yii::$app->request->get('status') == 1){
            $faculty->status = 0;
        }else if(Yii::$app->request->get('status') == 0){
            $faculty->status = 1;
        }
        $faculty->save(false);
		return $this->redirect(['faculty-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public function actionAddProgramme()
    {
	    try{
	    Yii::$app->cache->flush();
		$faculty = Faculty::getAllFaculty();
	    $programmeformmodel = new \common\models\CreateProgrammeForm();
            $programme = new Programme();
            if($programmeformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateProgrammeForm');
				$programmesexist = Programme::getProgrammeIfExists($postvariable['programme_name'], $postvariable['faculty_id']);
				if(count($programmesexist) == 0){
                $programme->programme_name = $postvariable['programme_name'];
				$programme->faculty_id = $postvariable['faculty_id'];
				$programme->status = 1;
				$programme->save(false);
				}
				return $this->redirect(['programmes-list']);
			}
			
			return $this->render('add-programme',[
				'programmeformmodel'=>$programmeformmodel,
				'faculty'=>$faculty
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionUpdateProgramme()
    {
	    try{
	    Yii::$app->cache->flush();
	    $programmeformmodel = new \common\models\CreateProgrammeForm();
			$programmeid = Yii::$app->request->get('id');
			$programmemodel = Programme::find()->where(['id' => $programmeid])->one();
			$faculty = Faculty::getAllFaculty();
            if($programmeformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateProgrammeForm');
				$programmesexist = Programme::getProgrammeIfExists($postvariable['programme_name'], $postvariable['faculty_id']);
				if(count($programmesexist) == 0){
				$programmemodel = Programme::find()->where(['id' => $postvariable['programme_id']])->one();
				$programmemodel->faculty_id = $postvariable['faculty_id'];
                $programmemodel->programme_name = $postvariable['programme_name'];
				$programmemodel->save(false);
				}
				return $this->redirect(['programmes-list']);
			}
			
			return $this->render('update-programme',[
				'programmeformmodel'=>$programmeformmodel,
				'programmedata'=>$programmemodel,
				'faculty'=>$faculty
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionProgrammeDelete($id)
    {
		try{
        $programme = Programme::find()->where(['id' => $id])->one();
        if(Yii::$app->request->get('status') == 1){
            $programme->status = 0;
        }else if(Yii::$app->request->get('status') == 0){
            $programme->status = 1;
        }
        $programme->save(false);
		return $this->redirect(['programmes-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	   
	   public function actionProgrammesList()
    {
	    try{
	    Yii::$app->cache->flush();
			$programme = new Programme();
            $uQuery = Programme::getAllProgrammeList();
				$query = $uQuery;		
				$count = $uQuery->count();
				return $this->render('programmes-list',[
					 'model'=>$programme,
					'query'=>$query,
					'count'=>$count
				]);   
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionAddModule()
    {
	    try{
	    Yii::$app->cache->flush();
	    $moduleformmodel = new \common\models\CreateModuleForm();
            $module = new Module();
            if($moduleformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateModuleForm');
				$modules=Module::getModuleIfExists($postvariable['module_name']);
					if(count($modules) == 0){
						$module->module_id = $postvariable['module_id'];
						$module->module_name = ucwords($postvariable['module_name']);
						$module->status = 1;
						$module->save(false);
						}
				return $this->redirect(['modules-list']);
			}
			//print_r($programmes); exit;
			return $this->render('add-module',[
				'moduleformmodel'=>$moduleformmodel
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionUpdateModule()
    {
	    try{
	    Yii::$app->cache->flush();
	    $moduleformmodel = new \common\models\CreateModuleForm();
			$moduleid = Yii::$app->request->get('id');
			$moduledata = Module::find()->where(['id' => $moduleid])->one();
            if($moduleformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateModuleForm');
				$modules=Module::getModuleIfExists($postvariable['module_name']);
				$modulemodel = Module::find()->where(['id' => $postvariable['moduleid']])->one();
					if(count($modules) == 0){
						$modulemodel->module_id = $postvariable['module_id'];
						$modulemodel->module_name = ucwords($postvariable['module_name']);
						$modulemodel->save(false);
						}
				return $this->redirect(['modules-list']);
			}
			//print_r($programmes); exit;
			return $this->render('update-module',[
				'moduleformmodel'=>$moduleformmodel,
				'moduledata'=>$moduledata
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionModulesList()
    {
	    try{
	    Yii::$app->cache->flush();
		$module = new Module();
            $uQuery = Module::getAllModuleListRecords();
				$query = $uQuery;		
				$count = $uQuery->count();
				return $this->render('modules-list',[
					 'model'=>$module,
					'query'=>$query,
					'count'=>$count
				]);   
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionModuleDelete($id)
    {
		try{
        $module = Module::find()->where(['id' => $id])->one();
        if(Yii::$app->request->get('status') == 1){
            $module->status = 0;
        }else if(Yii::$app->request->get('status') == 0){
            $module->status = 1;
        }
        $module->save(false);
		return $this->redirect(['modules-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public function actionAddProgrammeToFaculty()
    {
	    try{
	    Yii::$app->cache->flush();
	    $programmefacultyformmodel = new \common\models\CreateProgrammeToFacultyForm();
		$faculty = Faculty::getAllFaculty();
		$programme = Programme::getAllProgrammes();
		$assignprogrammefaculty = new AssignProgrammeFaculty();
            if($programmefacultyformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateProgrammeToFacultyForm');
				$records=AssignProgrammeFaculty::checkExistingRecords($postvariable['faculty_id'],$postvariable['programme_id']);
					if(count($records) == 0){
						$assignprogrammefaculty->faculty_id = $postvariable['faculty_id'];
						$assignprogrammefaculty->programme_id = ucwords($postvariable['programme_id']);
						$assignprogrammefaculty->save(false);
						}
					return $this->redirect(['programme-to-faculty-list']); 
			}
			//print_r($programmes); exit;
			return $this->render('add-programme-to-faculty',[
				'programmefacultyformmodel'=>$programmefacultyformmodel,
				'faculty'=>$faculty,
				'programme'=>$programme
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionUpdateProgrammeToFaculty()
    {
	   try{
	    Yii::$app->cache->flush();
	    $programmefacultyformmodel = new \common\models\CreateProgrammeToFacultyForm();
		$faculty = Faculty::getAllFaculty();
		$programme = Programme::getAllProgrammes();
		$assignprogrammefaculty = AssignProgrammeFaculty::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
            if($programmefacultyformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateProgrammeToFacultyForm');
				$records=AssignProgrammeFaculty::checkExistingRecords($postvariable['faculty_id'],$postvariable['programme_id']);
					if(count($records) == 0){
						$assignprogrammefaculty = AssignProgrammeFaculty::find()->where(['id' => $postvariable['id']])->one();
						$assignprogrammefaculty->faculty_id = $postvariable['faculty_id'];
						$assignprogrammefaculty->programme_id = ucwords($postvariable['programme_id']);
						$assignprogrammefaculty->save(false);
						}
						return $this->redirect(['programme-to-faculty-list']); 
			}
			//print_r($programmes); exit;
			return $this->render('update-programme-to-faculty',[
				'programmefacultyformmodel'=>$programmefacultyformmodel,
				'faculty'=>$faculty,
				'programme'=>$programme,
				'data'=>$assignprogrammefaculty
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
				
	public function actionProgrammeToFacultyList()
    {
	    try{
	    Yii::$app->cache->flush();
		$model = new AssignProgrammeFaculty();
            $uQuery = AssignProgrammeFaculty::getAllRecords();
				$query = $uQuery;		
				$count = $uQuery->count();
				return $this->render('programme-to-faculty-list',[
					 'model'=>$model,
					'query'=>$query,
					'count'=>$count
				]);   
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionDeleteProgrammeToFaculty()
    {
	    try{
	    Yii::$app->cache->flush();
		$module = AssignProgrammeFaculty::deleteRecord(Yii::$app->getRequest()->getQueryParam('id'));
		return $this->redirect(['programme-to-faculty-list']); 
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionAddModuleToProgramme()
    {
	    try{
	    Yii::$app->cache->flush();
	    $moduleprogrammeformmodel = new \common\models\CreateModuleToProgrammeForm();
		$modules = Module::getAllModuleList();
		//print_r($modules);exit;
		$programme = Programme::getAllProgrammes();
		$assignmoduleprogramme = new AssignModuleProgramme();
            if($moduleprogrammeformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateModuleToProgrammeForm');
				$records=AssignModuleProgramme::checkExistingRecords($postvariable['module_id'],$postvariable['programme_id']);
					if(count($records) == 0){
						$assignmoduleprogramme->module_id = $postvariable['module_id'];
						$assignmoduleprogramme->programme_id = ucwords($postvariable['programme_id']);
						$assignmoduleprogramme->save(false);
						}
					return $this->redirect(['module-to-programme-list']); 
			}
			//print_r($programmes); exit;
			return $this->render('add-module-to-programme',[
				'moduleprogrammeformmodel'=>$moduleprogrammeformmodel,
				'modules'=>$modules,
				'programme'=>$programme
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionUpdateModuleToProgramme()
    {
	    try{
	    Yii::$app->cache->flush();
	    $moduleprogrammeformmodel = new \common\models\CreateModuleToProgrammeForm();
		$modules = Module::getAllModuleList();
		$programme = Programme::getAllProgrammes();
		$assignmoduleprogramme = AssignModuleProgramme::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
            if($moduleprogrammeformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateModuleToProgrammeForm');
				$records=AssignModuleProgramme::checkExistingRecords($postvariable['module_id'],$postvariable['programme_id']);
					if(count($records) == 0){
						$assignmoduleprogramme = AssignModuleProgramme::find()->where(['id' => $postvariable['id']])->one();
						$assignmoduleprogramme->module_id = $postvariable['module_id'];
						$assignmoduleprogramme->programme_id = ucwords($postvariable['programme_id']);
						$assignmoduleprogramme->save(false);
						}
						return $this->redirect(['module-to-programme-list']); 
			}
			//print_r($programmes); exit;
			return $this->render('update-module-to-programme',[
				'moduleprogrammeformmodel'=>$moduleprogrammeformmodel,
				'modules'=>$modules,
				'programme'=>$programme,
				'data'=>$assignmoduleprogramme
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
				
	public function actionModuleToProgrammeList()
    {
	    try{
	    Yii::$app->cache->flush();
		$model = new AssignModuleProgramme();
            $uQuery = AssignModuleProgramme::getAllRecords();
				$query = $uQuery;		
				$count = $uQuery->count();
				return $this->render('module-to-programme-list',[
					 'model'=>$model,
					'query'=>$query,
					'count'=>$count
				]);   
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionDeleteModuleToProgramme()
    {
	    try{
	    Yii::$app->cache->flush();
		$module = AssignModuleProgramme::deleteRecord(Yii::$app->getRequest()->getQueryParam('id'));
		return $this->redirect(['module-to-programme-list']); 
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	    public function actionAddLecturerToModule()
    {
	    try{
	    Yii::$app->cache->flush();
	    $lecturermoduleformmodel = new \common\models\CreateLecturerToModuleForm();
		$modules = Module::getAllModuleList();
		//print_r($modules);exit;
		$lecturer = Lecturer::getLecturersList();
		$assignlecturermodule = new AssignLecturerModule();
            if($lecturermoduleformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateLecturerToModuleForm');
				$records=AssignLecturerModule::checkExistingRecords($postvariable['module_id'],$postvariable['lecturer_id']);
					if(count($records) == 0){
						$assignlecturermodule->module_id = $postvariable['module_id'];
						$assignlecturermodule->lecturer_id = $postvariable['lecturer_id'];
						$assignlecturermodule->save(false);
						}
					return $this->redirect(['lecturer-to-module-list']); 
			}
			//print_r($programmes); exit;
			return $this->render('add-lecturer-to-module',[
				'lecturermoduleformmodel'=>$lecturermoduleformmodel,
				'modules'=>$modules,
				'lecturer'=>$lecturer
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionUpdateLecturerToModule()
    {
	    try{
	    Yii::$app->cache->flush();
	    $lecturermoduleformmodel = new \common\models\CreateLecturerToModuleForm();
		$modules = Module::getAllModuleList();
		$lecturer = Lecturer::getLecturersList();
		$assignlecturermodule = AssignLecturerModule::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
            if($lecturermoduleformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateLecturerToModuleForm');
				$records=AssignLecturerModule::checkExistingRecords($postvariable['module_id'],$postvariable['lecturer_id']);
					if(count($records) == 0){
						$assignlecturermodule = AssignLecturerModule::find()->where(['id' => $postvariable['id']])->one();
						$assignlecturermodule->module_id = $postvariable['module_id'];
						$assignlecturermodule->lecturer_id = ucwords($postvariable['lecturer_id']);
						$assignlecturermodule->save(false);
						}
						return $this->redirect(['lecturer-to-module-list']); 
			}
			//print_r($programmes); exit;
			return $this->render('update-lecturer-to-module',[
				'lecturermoduleformmodel'=>$lecturermoduleformmodel,
				'modules'=>$modules,
				'lecturer'=>$lecturer,
				'data'=>$assignlecturermodule
			]);    
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
				
	public function actionLecturerToModuleList()
    {
	    try{
	    Yii::$app->cache->flush();
		$model = new AssignLecturerModule();
            $uQuery = AssignLecturerModule::getAllRecords();
				$query = $uQuery;		
				$count = $uQuery->count();
				return $this->render('lecturer-to-module-list',[
					 'model'=>$model,
					'query'=>$query,
					'count'=>$count
				]);   
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   public function actionDeleteLecturerToModule()
    {
	    try{
	    Yii::$app->cache->flush();
		$module = AssignLecturerModule::deleteRecord(Yii::$app->getRequest()->getQueryParam('id'));
		return $this->redirect(['lecturer-to-module-list']); 
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   
	   
}
