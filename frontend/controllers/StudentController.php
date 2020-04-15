<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use common\models\Storage;
use common\models\Student;
use common\models\User;
use common\models\Programme;
use common\models\AddStudentMarks;
use common\models\AddStudentMarksTemporary;

date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class StudentController extends \common\controllers\CommonController {

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
                 Yii::$app->controller->action->id != 'student-login' && Yii::$app->controller->action->id != 'student-register' && Yii::$app->controller->action->id != 'validate-email'  && Yii::$app->controller->action->id != 'validate-rollno') {
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
	 
    public function actionStudentDashboard(){
        return $this->render('student-dashboard');
    }

    public function actionStudentLogin($username = '') {
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
	    try{
        Yii::$app->cache->flush();
        //print_r($studentdata[0]['name']); exit;
            $userformmodel = new \common\models\CreateStudentForm();
            $countries = User::countrieslist();
			$programme = Programme::getAllProgrammes();
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
            'countries'=>$countries,
			'programme'=>$programme
                ]);
        }
	} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public function actionCreateStudent()
    {
            $userformmodel = new \common\models\CreateStudentForm();
            $signup = new \frontend\models\SignupForm();
            $countries = User::countrieslist();
            $student = new Student;
			$programme = Programme::getAllProgrammes();
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateStudentForm');
               //print_r($postvariable['nationalityother']);exit;
                Yii::$app->cache->flush();
                $signup->password = $postvariable['password'];
                $signup->email = $postvariable['email'];
                $signup->username = $postvariable['email'];
                $signup->user_role_ref_id = 2;
				$signup->is_verified = 1;
                $postvariable=Yii::$app->request->post('CreateStudentForm');
				 
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
				$student->status_of_student = isset($postvariable['status_of_student']) ? $postvariable['status_of_student'] : '';
                $student->user_image = isset($postvariable['user_image']) ? $postvariable['user_image'] : '';
				$student->is_submit = 'submit';
                    if ($user = $signup->signup()) {
                    Yii::$app->cache->flush();
                    $userid = Yii::$app->db->getLastInsertID();
                    $student->user_ref_id = $userid;
				$storagemodel = new \common\models\Storage();
				
                $storagemodel = new \common\models\Storage();
				
                $storagemodel->user_image = \yii\web\UploadedFile::getInstance($userformmodel, 'user_image');
			if(count($storagemodel->user_image)>0){
                    $studentimage = $student->user_image = $storagemodel->user_image->name;
                    if ($storagemodel->upload($userid)) {
                    }
				}
                /*---------------------------------------------------------*/
                if($student->save(false)){
                if(count($storagemodel->user_image)>0){
                    $user = User::find()->where(['id'=>$userid])->one();
                    $user->user_image = $studentimage;
                if($user->save(false)){}
                }
            }           
                        Yii::$app->session->setFlash('studentcreated', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Student Created successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
                        return $this->redirect(['students-list']);
                    }
            }
            return $this->render('create-student',[
                'userformmodel'=>$userformmodel,
                'countries'=>$countries,
				'programme'=>$programme
                    ]);
    }

    public function actionUpdateStudent(){
      Yii::$app->cache->flush();
        //print_r($studentdata[0]['name']); exit;
            $userformmodel = new \common\models\CreateStudentForm();
            $countries = User::countrieslist();
			$programme = Programme::getAllProgrammes();
        if($userformmodel->load(Yii::$app->request->post())){
            $postvariable=Yii::$app->request->post('CreateStudentForm');
                $student = Student::find()->where(['id'=>$postvariable['studentid']])->one();
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
		$student->status_of_student = isset($postvariable['status_of_student']) ? $postvariable['status_of_student'] : '';
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
                
                Yii::$app->session->setFlash('studentupdatesuccess', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Student Updated successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
                return $this->redirect(['students-list']);
            }
        }else{     
            $id = !empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : '';
            $studentdata=Student::getStudentsData($id);
        return $this->render('update-student',[
            'userformmodel'=>$userformmodel,
            'studentdata'=>$studentdata[0],
            'countries'=>$countries,
			'programme'=>$programme
                ]);
        }
    }
	
	public function actionCreatempdf()
    {
		try{
        $id = Yii::$app->getRequest()->getQueryParam('id');
        $studentdata=Student::findByStudentId($id);
        $studentdata=array_shift($studentdata);
       
        $strarr = explode ("backend", $_SERVER['REQUEST_URI']);  
//echo '../frontend/web/uploads/profile_images/'.$studentdata['user_ref_id'].'/'.$studentdata['user_image'];exit;
       if (!file_exists('../../frontend/web/uploads/profile_images/'.$studentdata['user_ref_id'].'/'.$studentdata['user_image'])) {
         $imageurl = '<img style="width:120px; height:130px" src="frontend/web/images/avatar.png" />';
            }else{
            $imageurl = "http://".$_SERVER['HTTP_HOST'].$strarr[0]."frontend/web/uploads/profile_images/".$studentdata['user_ref_id']."/".$studentdata['user_image'];
           }
         $pdf_content=$this->renderPartial('viewpdf', [
            'studentdata' => $studentdata,
            'imageurl' => $imageurl
        ]);
        //print_r($pdf_content);exit;
        $mpdf = new \mPDF();
        $mpdf->WriteHTML($pdf_content);
        $fileName = str_replace(" ", "_", $studentdata['name']) . '.pdf';
        $mpdf->Output($fileName, 'I');
        exit;
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    
    public function actionCreateMarksmpdf()
    {
		//try{
		if(Yii::$app->session['userRole'] == 2){
			$sid = Yii::$app->user->id;
			$student = Student::find()->where(['user_ref_id' => $sid])->one();
			$studentid = $student['id'];
			$studentname = $student['name'];
		    }else{
			$studentid = Yii::$app->request->get('id');
			$student = Student::find()->where(['id' => $studentid])->one();
			$studentname = $student['name'];
		    }
			$studentmarks = [];
			$studentmarksquery1 = AddStudentMarks::getStudentFirstYearMarks($studentid);
			$studentmarksquery2 = AddStudentMarks::getStudentSecondYearMarks($studentid);
			$studentmarksquery3 = AddStudentMarks::getStudentThirdYearMarks($studentid);
			$studentmarksquery4 = AddStudentMarks::getStudentFourthYearMarks($studentid);	
			 $pdf_content=$this->renderPartial('viewmarkspdf', [
				'studentmarks1'=>$studentmarksquery1,
				'studentmarks2'=>$studentmarksquery2,
				'studentmarks3'=>$studentmarksquery3,
				'studentmarks4'=>$studentmarksquery4
			]);
        //print_r($pdf_content);exit;
        $mpdf = new \mPDF();
        $mpdf->WriteHTML($pdf_content);
        $fileName = str_replace(" ", "_", $studentname) . '.pdf';
        $mpdf->Output($fileName, 'I');
        exit;
		/*} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }*/
    }
    
    public function actionViewAllMarksPdf()
    {
		//try{
		$studentmarks = [];
			$role = Yii::$app->session['userRole'];
			if($role == 3){
			$studentmarksquery1 = AddStudentMarks::getStudentFirstYearMarks(false);
			$studentmarksquery2 = AddStudentMarks::getStudentSecondYearMarks(false);
			$studentmarksquery3 = AddStudentMarks::getStudentThirdYearMarks(false);
			$studentmarksquery4 = AddStudentMarks::getStudentFourthYearMarks(false);
			}
			if($role == 4){
			$studentmarksquery1 = AddStudentMarks::getStudentFirstYearMarksLecturer(Yii::$app->user->id,false);
			$studentmarksquery2 = AddStudentMarks::getStudentSecondYearMarksLecturer(Yii::$app->user->id,false);
			$studentmarksquery3 = AddStudentMarks::getStudentThirdYearMarksLecturer(Yii::$app->user->id,false);
			$studentmarksquery4 = AddStudentMarks::getStudentFourthYearMarksLecturer(Yii::$app->user->id,false);
			}
			 $pdf_content=$this->renderPartial('view-all-marks-pdf', [
				'studentmarks1'=>$studentmarksquery1,
				'studentmarks2'=>$studentmarksquery2,
				'studentmarks3'=>$studentmarksquery3,
				'studentmarks4'=>$studentmarksquery4
			]);
        //print_r($pdf_content);exit;
        $mpdf = new \mPDF();
        $mpdf->WriteHTML($pdf_content);
        $fileName = 'Students Marks' . '.pdf';
        $mpdf->Output($fileName, 'I');
        exit;
		/*} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }*/
    }
	
	public function actionStudentDelete($id)
    {
		try{
        $user = User::find()->where(['id' => Yii::$app->request->get('id')])->one();
        if(Yii::$app->request->get('status') == 1){
			$user->status = 2;
           Yii::$app->session->setFlash('studentdelete', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Student Deleted successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
        }else if(Yii::$app->request->get('status') == 2){
            $user->status = 1;
			Yii::$app->session->setFlash('studentundodelete', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Student Delete Undo Success! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
        }
        $user->save(false);
		return $this->redirect(['students-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }

    public function actionStudentsList(){
		//try{
			Yii::$app->cache->flush();
        $student = new Student();
		$programme = Programme::getAllProgrammes();
        $cond = $where = '';
        $studentname = Yii::$app->getRequest()->getQueryParam('name') ? Yii::$app->getRequest()->getQueryParam('name') : "";
        $progname = Yii::$app->getRequest()->getQueryParam('programme_name') ? Yii::$app->getRequest()->getQueryParam('programme_name') : "";
        $rollno = Yii::$app->getRequest()->getQueryParam('rollno') ? Yii::$app->getRequest()->getQueryParam('rollno') : "";
        $rumpun = Yii::$app->getRequest()->getQueryParam('rumpun') ? Yii::$app->getRequest()->getQueryParam('rumpun') : "";
        $nationality = Yii::$app->getRequest()->getQueryParam('nationality') ? Yii::$app->getRequest()->getQueryParam('nationality') : "";
        $studenticno = Yii::$app->getRequest()->getQueryParam('studenticno') ? Yii::$app->getRequest()->getQueryParam('studenticno') : "";
        $studenticcolor = Yii::$app->getRequest()->getQueryParam('studenticcolor') ? Yii::$app->getRequest()->getQueryParam('studenticcolor') : "";
        $passportno = Yii::$app->getRequest()->getQueryParam('passportno') ? Yii::$app->getRequest()->getQueryParam('passportno') : "";
        $race = Yii::$app->getRequest()->getQueryParam('race') ? Yii::$app->getRequest()->getQueryParam('race') : "";
        $religion = Yii::$app->getRequest()->getQueryParam('religion') ? Yii::$app->getRequest()->getQueryParam('religion') : "";
        $gender = Yii::$app->getRequest()->getQueryParam('gender') ? Yii::$app->getRequest()->getQueryParam('gender') : "";
        $martialstatus = Yii::$app->getRequest()->getQueryParam('martialstatus') ? Yii::$app->getRequest()->getQueryParam('martialstatus') : "";
        $mobile = Yii::$app->getRequest()->getQueryParam('mobile') ? Yii::$app->getRequest()->getQueryParam('mobile') : "";
        $telehome = Yii::$app->getRequest()->getQueryParam('telehome') ? Yii::$app->getRequest()->getQueryParam('telehome') : "";
        //$email = Yii::$app->getRequest()->getQueryParam('email') ? Yii::$app->getRequest()->getQueryParam('email') : "";
        $typeofentry = Yii::$app->getRequest()->getQueryParam('typeofentry') ? Yii::$app->getRequest()->getQueryParam('typeofentry') : "";
        $address = Yii::$app->getRequest()->getQueryParam('address') ? Yii::$app->getRequest()->getQueryParam('address') : "";
        $bankname = Yii::$app->getRequest()->getQueryParam('bankname') ? Yii::$app->getRequest()->getQueryParam('bankname') : "";
        $accountno = Yii::$app->getRequest()->getQueryParam('accountno') ? Yii::$app->getRequest()->getQueryParam('accountno') : "";
        $fathername = Yii::$app->getRequest()->getQueryParam('fathername') ? Yii::$app->getRequest()->getQueryParam('fathername') : "";
        $fathericno = Yii::$app->getRequest()->getQueryParam('fathericno') ? Yii::$app->getRequest()->getQueryParam('fathericno') : "";
        $mothername = Yii::$app->getRequest()->getQueryParam('mothername') ? Yii::$app->getRequest()->getQueryParam('mothername') : "";
        $mothericno = Yii::$app->getRequest()->getQueryParam('mothericno') ? Yii::$app->getRequest()->getQueryParam('mothericno') : "";
        $sponsortype = Yii::$app->getRequest()->getQueryParam('sponsortype') ? Yii::$app->getRequest()->getQueryParam('sponsortype') : "";
        $entry = Yii::$app->getRequest()->getQueryParam('entry') ? Yii::$app->getRequest()->getQueryParam('entry') : "";
        //$status = Yii::$app->getRequest()->getQueryParam('status') ? Yii::$app->getRequest()->getQueryParam('status') : "";
        $intake = Yii::$app->getRequest()->getQueryParam('intake') ? Yii::$app->getRequest()->getQueryParam('intake') : "";
        $mode = Yii::$app->getRequest()->getQueryParam('mode') ? Yii::$app->getRequest()->getQueryParam('mode') : "";
        $utbemail = Yii::$app->getRequest()->getQueryParam('utbemail') ? Yii::$app->getRequest()->getQueryParam('utbemail') : "";
        //$degree = Yii::$app->getRequest()->getQueryParam('degree') ? Yii::$app->getRequest()->getQueryParam('degree') : "";
        $dateofregistration = Yii::$app->getRequest()->getQueryParam('dateofregistration') ? Yii::$app->getRequest()->getQueryParam('dateofregistration') : "";
        $dateofleaving = Yii::$app->getRequest()->getQueryParam('dateofleaving') ? Yii::$app->getRequest()->getQueryParam('dateofleaving') : "";
        //$prevrollno = Yii::$app->getRequest()->getQueryParam('prevrollno') ? Yii::$app->getRequest()->getQueryParam('prevrollno') : "";
        //$prevprogname = Yii::$app->getRequest()->getQueryParam('prevprogname') ? Yii::$app->getRequest()->getQueryParam('prevprogname') : "";
        //$previntakeno = Yii::$app->getRequest()->getQueryParam('previntakeno') ? Yii::$app->getRequest()->getQueryParam('previntakeno') : "";
        //$prevutbemail = Yii::$app->getRequest()->getQueryParam('prevutbemail') ? Yii::$app->getRequest()->getQueryParam('prevutbemail') : "";
		$age = Yii::$app->getRequest()->getQueryParam('age') ? Yii::$app->getRequest()->getQueryParam('age') : "";
        $highest_qualification = Yii::$app->getRequest()->getQueryParam('highest_qualification') ? Yii::$app->getRequest()->getQueryParam('highest_qualification') : "";
        $lastschoolname = Yii::$app->getRequest()->getQueryParam('lastschoolname') ? Yii::$app->getRequest()->getQueryParam('lastschoolname') : "";
        $state_address = Yii::$app->getRequest()->getQueryParam('state_address') ? Yii::$app->getRequest()->getQueryParam('state_address') : "";
		 $type_of_residential = Yii::$app->getRequest()->getQueryParam('type_of_residential') ? Yii::$app->getRequest()->getQueryParam('type_of_residential') : "";
        $type_of_programme = Yii::$app->getRequest()->getQueryParam('type_of_programme') ? Yii::$app->getRequest()->getQueryParam('type_of_programme') : "";
        $bank_account_name = Yii::$app->getRequest()->getQueryParam('bank_account_name') ? Yii::$app->getRequest()->getQueryParam('bank_account_name') : "";

	$role = Yii::$app->session['userRole'];
        $uQuery=Student::getStudentsList($role,$studentname, $rollno, $rumpun, $nationality, $studenticno, $studenticcolor, $passportno, $race, $religion, $gender, $martialstatus, $mobile, $telehome, $typeofentry, $address, $bankname, $accountno, $fathername, $fathericno, $mothername, $mothericno, $sponsortype, $progname, $entry, $intake, $mode, $utbemail, $dateofregistration, $dateofleaving, $age, $highest_qualification, $lastschoolname, $state_address, $type_of_residential, $type_of_programme, $bank_account_name);
		$query = $uQuery;		
		$count = $uQuery->count();
        return $this->render('students-list',[
            'model'=>$student,
            'query'=>$query,
            'count'=>$count,
			'programme'=>$programme
        ]);
		//} catch (\Exception $e) {
          //  \common\controllers\CommonController::exceptionMessage($e->getMessage());
        //}
    }

    public function actionStudentView($id){
		try{
        $student = new Student();
        $student = Student::findByStudentId($id);
        return $this->render('student-view',[
            'studentdetails'=>$student[0],
        ]);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public function actionStudentMarks(){
			
	    //try{
		    if(Yii::$app->session['userRole'] == 2){
			$sid = Yii::$app->user->id;
			$student = Student::find()->where(['user_ref_id' => $sid])->one();
			$studentid = $student['id'];
		    }else{
			$studentid = Yii::$app->request->get('id');
		    }
			$studentmarks = [];
			$studentmarksquery1 = AddStudentMarks::getStudentFirstYearMarks($studentid);
			$studentmarksquery2 = AddStudentMarks::getStudentSecondYearMarks($studentid);
			$studentmarksquery3 = AddStudentMarks::getStudentThirdYearMarks($studentid);
			$studentmarksquery4 = AddStudentMarks::getStudentFourthYearMarks($studentid);
			return $this->render('student-marks',[
				'studentmarks1'=>$studentmarksquery1,
				'studentmarks2'=>$studentmarksquery2,
				'studentmarks3'=>$studentmarksquery3,
				'studentmarks4'=>$studentmarksquery4
			]);
			/*} catch (\Exception $e) {
				\common\controllers\CommonController::exceptionMessage($e->getMessage());
			}*/
		}
		
	public function actionAllStudentsMarks(){
			
	    //try{
			$studentmarks = [];
			$role = Yii::$app->session['userRole'];
			if($role == 3){
			$studentmarksquery1 = AddStudentMarks::getStudentFirstYearMarks(false);
			$studentmarksquery2 = AddStudentMarks::getStudentSecondYearMarks(false);
			$studentmarksquery3 = AddStudentMarks::getStudentThirdYearMarks(false);
			$studentmarksquery4 = AddStudentMarks::getStudentFourthYearMarks(false);
			}
			if($role == 4){
			$studentmarksquery1 = AddStudentMarks::getStudentFirstYearMarksLecturer(Yii::$app->user->id,false);
			$studentmarksquery2 = AddStudentMarks::getStudentSecondYearMarksLecturer(Yii::$app->user->id,false);
			$studentmarksquery3 = AddStudentMarks::getStudentThirdYearMarksLecturer(Yii::$app->user->id,false);
			$studentmarksquery4 = AddStudentMarks::getStudentFourthYearMarksLecturer(Yii::$app->user->id,false);
			}
			return $this->render('all-students-marks',[
				'studentmarks1'=>$studentmarksquery1,
				'studentmarks2'=>$studentmarksquery2,
				'studentmarks3'=>$studentmarksquery3,
				'studentmarks4'=>$studentmarksquery4
			]);
			/*} catch (\Exception $e) {
				\common\controllers\CommonController::exceptionMessage($e->getMessage());
			}*/
		}
		
		public function actionEditStudentMarks(){
			Yii::$app->cache->flush();
			
			//echo $stage;exit;
			$editstudentmarksformmodel = new \common\models\EditStudentMarksForm();
			if($editstudentmarksformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('EditStudentMarksForm');
				if(isset($postvariable['prev_id']) && count($postvariable['prev_id'])>0){
				for($i=0;$i<count($postvariable['prev_id']);$i++){
					$model = AddStudentMarksTemporary::find()->where(['id' => $postvariable['prev_id'][$i]])->one();
					$model->marks_id = $postvariable['prev_marks_id'][$i];
					$model->semister = $postvariable['prev_semister'][$i];
					$model->module_id = $postvariable['prev_module_id'][$i];
					$model->student_id = $postvariable['prev_student_id'][$i];
					$model->ew_marks = $postvariable['prev_ew_marks'][$i];
					$model->cw_marks = $postvariable['prev_cw_marks'][$i];
					$model->ew_total_percentage = $postvariable['prev_ew_total_percentage'][$i];
					$model->cw_total_percentage = $postvariable['prev_cw_total_percentage'][$i];
					$model->total_percentage = $postvariable['prev_total_percentage'][$i];
					$model->is_pass = $postvariable['prev_is_pass'][$i];
					$model->grade = $postvariable['prev_grade'][$i];
					$model->grade_definition = $postvariable['prev_grade_definition'][$i];
					$model->is_submit = $postvariable['prev_is_submit'];
					$model->entered_by = $postvariable['prev_entered_by'][$i];
					$model->updated_by = Yii::$app->user->id;
					if($postvariable['prev_is_submit'] == 'submit'){
						$stg = 'pasubmit';
					}else{
						$stg = 'pasaved';
					}
					$model->stage=$stg;
					$model->save();
				}
				}else if(isset($postvariable['marks_id']) && count($postvariable['marks_id'])>0){
				for($i=0;$i<count($postvariable['marks_id']);$i++){
					$model = new AddStudentMarksTemporary();
					$model->marks_id = $postvariable['marks_id'][$i];
					$model->semister = $postvariable['semister'][$i];
					$model->module_id = $postvariable['module_id'][$i];
					$model->student_id = $postvariable['student_id'][$i];
					$model->ew_marks = $postvariable['ew_marks'][$i];
					$model->cw_marks = $postvariable['cw_marks'][$i];
					$model->ew_total_percentage = $postvariable['ew_total_percentage'][$i];
					$model->cw_total_percentage = $postvariable['cw_total_percentage'][$i];
					$model->total_percentage = $postvariable['total_percentage'][$i];
					$model->is_pass = $postvariable['is_pass'][$i];
					$model->grade = $postvariable['grade'][$i];
					$model->grade_definition = $postvariable['grade_definition'][$i];
					$model->is_submit = $postvariable['is_submit'];
					$model->entered_by = $postvariable['entered_by'][$i];
					$model->updated_by = Yii::$app->user->id;
					if($postvariable['is_submit'] == 'submit'){
						$stg = 'pasubmit';
					}else{
						$stg = 'pasaved';
					}
					$model->stage=$stg;
					$model->save();
				}
			}else if(isset($postvariable['prev2_marks_id']) && count($postvariable['prev2_marks_id'])>0){
				$year = $postvariable['prev2_year'][0];
				$studentid = $postvariable['prev2_student_id'][0];
				$fsprevdata = AddStudentMarksTemporary::getExistingStudentsMarks($year, $studentid, 'fssaved');
				//print_r($fsprevdata);exit;
				for($i=0;$i<count($postvariable['prev2_id']);$i++){
					if(isset($fsprevdata) && count($fsprevdata)>0){
					$model = AddStudentMarksTemporary::find()->where(['id' => $postvariable['prev2_id'][$i]])->one();
					}else{
					$model = new AddStudentMarksTemporary();
					}
					$model->marks_id = $postvariable['prev2_marks_id'][$i];
					$model->semister = $postvariable['prev2_semister'][$i];
					$model->module_id = $postvariable['prev2_module_id'][$i];
					$model->student_id = $postvariable['prev2_student_id'][$i];
					$model->ew_marks = $postvariable['prev2_ew_marks'][$i];
					$model->cw_marks = $postvariable['prev2_cw_marks'][$i];
					$model->ew_total_percentage = $postvariable['prev2_ew_total_percentage'][$i];
					$model->cw_total_percentage = $postvariable['prev2_cw_total_percentage'][$i];
					$model->total_percentage = $postvariable['prev2_total_percentage'][$i];
					$model->is_pass = $postvariable['prev2_is_pass'][$i];
					$model->grade = $postvariable['prev2_grade'][$i];
					$model->grade_definition = $postvariable['prev2_grade_definition'][$i];
					$model->is_submit = $postvariable['prev2_is_submit'];
					$model->entered_by = $postvariable['prev2_entered_by'][$i];
					$model->updated_by = Yii::$app->user->id;
					if($postvariable['prev2_is_submit'] == 'submit'){
						$stg = 'fssubmit';
					}else{
						$stg = 'fssaved';
					}
					$model->stage=$stg;
					//print_r($model);exit;
					$model->save();
				}
			}else if(isset($postvariable['prev3_marks_id']) && count($postvariable['prev3_marks_id'])>0){
				$year = $postvariable['prev3_year'][0];
				$studentid = $postvariable['prev3_student_id'][0];
				$fsprevdata = AddStudentMarksTemporary::getExistingStudentsMarks($year, $studentid, 'uebsaved');
				//print_r($fsprevdata);exit;
				for($i=0;$i<count($postvariable['prev3_id']);$i++){
					if(isset($fsprevdata) && count($fsprevdata)>0){
					$model = AddStudentMarksTemporary::find()->where(['id' => $postvariable['prev3_id'][$i]])->one();
					}else{
					$model = new AddStudentMarksTemporary();
					}
					$issubmit = $postvariable['prev3_is_submit'];
					$model->marks_id = $postvariable['prev3_marks_id'][$i];
					$model->semister = $postvariable['prev3_semister'][$i];
					$model->module_id = $postvariable['prev3_module_id'][$i];
					$model->student_id = $postvariable['prev3_student_id'][$i];
					$model->ew_marks = $postvariable['prev3_ew_marks'][$i];
					$model->cw_marks = $postvariable['prev3_cw_marks'][$i];
					$model->ew_total_percentage = $postvariable['prev3_ew_total_percentage'][$i];
					$model->cw_total_percentage = $postvariable['prev3_cw_total_percentage'][$i];
					$model->total_percentage = $postvariable['prev3_total_percentage'][$i];
					$model->is_pass = $postvariable['prev3_is_pass'][$i];
					$model->grade = $postvariable['prev3_grade'][$i];
					$model->grade_definition = $postvariable['prev3_grade_definition'][$i];
					$model->is_submit = $postvariable['prev3_is_submit'];
					$model->entered_by = $postvariable['prev3_entered_by'][$i];
					$model->updated_by = Yii::$app->user->id;
					if($postvariable['prev3_is_submit'] == 'submit'){
						$stg = 'uebsubmit';
					}else{
						$stg = 'uebsaved';
					}
					$model->stage=$stg;
					//print_r($model);exit;
					$model->save();
					/*if($issubmit == 'submit'){
						$smodel = AddStudentMarks::find()->where(['id' => $postvariable['prev3_marks_id'][$i]])->one();
						$smodel->semister = $postvariable['prev3_semister'][$i];
						$smodel->module_id = $postvariable['prev3_module_id'][$i];
						$smodel->student_id = $postvariable['prev3_student_id'][$i];
						$smodel->ew_marks = $postvariable['prev3_ew_marks'][$i];
						$smodel->cw_marks = $postvariable['prev3_cw_marks'][$i];
						$smodel->ew_total_percentage = $postvariable['prev3_ew_total_percentage'][$i];
						$smodel->cw_total_percentage = $postvariable['prev3_cw_total_percentage'][$i];
						$smodel->total_percentage = $postvariable['prev3_total_percentage'][$i];
						$smodel->is_pass = $postvariable['prev3_is_pass'][$i];
						$smodel->grade = $postvariable['prev3_grade'][$i];
						$smodel->grade_definition = $postvariable['prev3_grade_definition'][$i];
						$smodel->updated_by = Yii::$app->user->id;
						$smodel->save();
					}*/
				}
			}
				return $this->redirect('all-students-marks');
			}else{
				$year = Yii::$app->getRequest()->getQueryParam('year') ? Yii::$app->getRequest()->getQueryParam('year') : "";
				$studentid = Yii::$app->getRequest()->getQueryParam('id') ? Yii::$app->getRequest()->getQueryParam('id') : "";
				$studentmarks = AddStudentMarks::getStudentSemWiseMarks($year, $studentid);
				$editstudentmarksformmodel = new \common\models\EditStudentMarksForm();
				$studentprevdata = AddStudentMarksTemporary::getAllExistingStudentsMarks($year, $studentid, 'pa', 'savesubmit');
				$studentprevdata2 = false;
				$studentprevdata3 = false;
				if($studentprevdata && $studentprevdata[0]['is_submit'] == 'submit'){
					$prvdata2 = AddStudentMarksTemporary::getAllExistingStudentsMarks($year, $studentid, 'fs', 'savesubmit');
					if(isset($prvdata2) && count($prvdata2)>0){
						$studentprevdata2 = $prvdata2;
					$prvdata3 = AddStudentMarksTemporary::getAllExistingStudentsMarks($year, $studentid, 'ueb', 'savesubmit');
					if(isset($prvdata3) && count($prvdata3)>0){
						$studentprevdata3 = $prvdata3;
					}else{
					$studentprevdata3 = AddStudentMarksTemporary::getAllExistingStudentsMarks($year, $studentid, 'fs', 'submit');
					}
					}else{
					$studentprevdata2 = AddStudentMarksTemporary::getAllExistingStudentsMarks($year, $studentid, 'pa', 'submit');
					
					
					}
				}
				if($year == 1){
					$sem1 = 1;$sem2 = 2;
				}
			
			//print_r($studentprevdata2);exit;
			//try{
				return $this->render('edit-student-marks',[ 
				'studentmarks'=>$studentmarks,
				'editstudentmarksformmodel'=>$editstudentmarksformmodel,
				'studentprevdata'=>$studentprevdata,
				'studentprevdata2'=>$studentprevdata2,
				'studentprevdata3'=>$studentprevdata3,
				'year'=>$year,
				//'fsprevdata'=>$fsprevdata
				]);
				}
			/*} catch (\Exception $e) {
				\common\controllers\CommonController::exceptionMessage($e->getMessage());
			}*/
		}
	
     
}
