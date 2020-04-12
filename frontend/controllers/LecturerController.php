<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use common\models\Lecturer;
use common\models\Module;
use common\models\User;
use common\models\AddStudentMarks;
use common\models\Student;

date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class LecturerController extends \common\controllers\CommonController {

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
                 Yii::$app->controller->action->id != 'lecturer-login' && Yii::$app->controller->action->id != 'validate-email'  && Yii::$app->controller->action->id != 'validate-rollno') {
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
	 
	  public function actionLecturerLogin($username = '') {
		//try{
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
                    return $this->redirect('lecturer-dashboard');
                    die;
                }
            } else {
                return $this->render('lecturer-login', [
                            'model' => $model, 'captcha' => $captcha,
                        ]);
            }
        }else{
            return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/../../');
        }
		/*} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }*/
    }
	
	public function actionLecturerDashboard()
    {
	    try{
			
			return $this->render('lecturer-dashboard');
			
			} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	 
    public function actionCreateLecturer()
    {
	   // try{
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
				$signup->is_verified = 1;
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
                        Yii::$app->session->setFlash('lecturercreate', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">You have successfully created Lecturers</div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
                        return $this->redirect(['lecturers-list']);
                    }
            }
	return $this->render('create-lecturer',[
		'userformmodel'=>$userformmodel
	    ]);    
	   // } catch (\Exception $e) {
          //  \common\controllers\CommonController::exceptionMessage($e->getMessage());
        //}
    }
    
    public function actionUpdateLecturer()
    {
	    //try{
	    Yii::$app->cache->flush();
	    $userformmodel = new \common\models\CreateLecturerForm();
	    $lecturerdata=Lecturer::getLecturersDataByUserRefId(Yii::$app->request->get('id'));
	    
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateLecturerForm');
				$lecturer = Lecturer::find()->where(['user_ref_id'=>$postvariable['lecturerid']])->one();
                $lecturer->email = isset($postvariable['email']) ? $postvariable['email'] : '';
				$lecturer->name = isset($postvariable['name']) ? $postvariable['name'] : '';
				 $lecturer->save(false)   ;
                        Yii::$app->session->setFlash('lecturerupdate', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Lecturer Updated Successfully </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>');
                        return $this->redirect(['lecturers-list']);
                  }
		  
	return $this->render('update-lecturer',[
		'lecturerdata'=>$lecturerdata[0],
		'userformmodel'=>$userformmodel
	    ]);    
	  //  } catch (\Exception $e) {
            //\common\controllers\CommonController::exceptionMessage($e->getMessage());
       // }
    }
    
    
    
    public function actionLecturersList(){
    //try{
	    $lecturer = new Lecturer();
	  $uQuery=Lecturer::getLecturersListRecords();
		$query = $uQuery;		
		$count = $uQuery->count();
           return $this->render('lecturers-list',[
            'model'=>$lecturer,
            'query'=>$query,
            'count'=>$count
                ]);
        //} catch (\Exception $e) {
          //  \common\controllers\CommonController::exceptionMessage($e->getMessage());
        //}
	
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
	
	public function actionAddMarks(){
	   // try{
        Yii::$app->cache->flush();
        //print_r($studentdata[0]['name']); exit;
            $marksformmodel = new \common\models\AddStudentMarksForm();
			$studentmarksmodule = new AddStudentMarks();
        if($marksformmodel->load(Yii::$app->request->post())){
            $postvariable=Yii::$app->request->post('AddStudentMarksForm');
			$previd = $postvariable['previd'];
			if($previd != ''){
				$studentmarksmodule = AddStudentMarks::find()->where(['id' => $previd])->one();
			}
			$studentmarksmodule->semister = $postvariable['semister'];
			$studentmarksmodule->module_id = $postvariable['module_id'];
			$studentmarksmodule->student_id = $postvariable['student_id'];
			$studentmarksmodule->ew_percentage = $postvariable['ew_percentage'];
			$studentmarksmodule->ew_marks = $postvariable['ew_marks'];
			$studentmarksmodule->cw_percentage = $postvariable['cw_percentage'];
			$studentmarksmodule->cw_marks = $postvariable['cw_marks'];
			
			$ew_total_percentage = ($postvariable['ew_marks']/100)*$postvariable['ew_percentage'];
			$cw_total_percentage = ($postvariable['cw_marks']/100)*$postvariable['cw_percentage'];
			$total_percentage = $ew_total_percentage+$cw_total_percentage;
			
			$studentmarksmodule->ew_total_percentage = $ew_total_percentage;
			$studentmarksmodule->cw_total_percentage = $cw_total_percentage;
			$studentmarksmodule->total_percentage = $total_percentage;
			$studentmarksmodule->is_pass = ($total_percentage < 40) ? 0 : 1;
			$grade = '';
			$grade_definition = '';
			if($total_percentage >= 0 && $total_percentage <= 39){
				$grade = 'F';
				$grade_definition = 'Fail';
			}else if($total_percentage >= 40 && $total_percentage <= 44){
				$grade = 'E';
				$grade_definition = 'Marginal';
			}else if($total_percentage >= 45 && $total_percentage <= 49){
				$grade = 'D';
				$grade_definition = 'Satisfactory';
			}else if($total_percentage >= 50 && $total_percentage <= 54){
				$grade = 'D+';
				$grade_definition = 'Satisfactory';
			}else if($total_percentage >= 55 && $total_percentage <= 59){
				$grade = 'C';
				$grade_definition = 'Good';
			}else if($total_percentage >= 60 && $total_percentage <= 64){
				$grade = 'C+';
				$grade_definition = 'Good';
			}else if($total_percentage >= 65 && $total_percentage <= 69){
				$grade = 'B';
				$grade_definition = 'Very Good';
			}else if($total_percentage >= 70 && $total_percentage <= 74){
				$grade = 'B+';
				$grade_definition = 'Very Good';
			}else if($total_percentage >= 75 && $total_percentage <= 84){
				$grade = 'A';
				$grade_definition = 'Excellent';
			}else if($total_percentage >= 85 && $total_percentage <= 100){
				$grade = 'A+';
				$grade_definition = 'Excellent';
			}
			$studentmarksmodule->grade = $grade;
			$studentmarksmodule->grade_definition = $grade_definition;
			$studentmarksmodule->entered_by = Yii::$app->user->id;
			$studentmarksmodule->save(false);
			return $this->redirect('add-marks');
			}
			return $this->render('add-marks',[
				'marksformmodel'=>$marksformmodel
					]);
		/*} catch (\Exception $e) {
				\common\controllers\CommonController::exceptionMessage($e->getMessage());
			}*/
		}
		
		public function actionGetModulesByLecturerSemister(){
			
	    //try{
			$semister = Yii::$app->request->get('semister');
			$userid = Yii::$app->request->get('userid');
			$modules = Module::getModulesByLecturer($semister,$userid);
			return json_encode($modules);
			/*} catch (\Exception $e) {
				\common\controllers\CommonController::exceptionMessage($e->getMessage());
			}*/
		}
		
		public function actionGetStudentsByLecturer(){
			
	    try{
			$moduleid = Yii::$app->request->get('moduleid');
			$userid = Yii::$app->request->get('userid');
			$students = Student::getStudentsByLecturer($moduleid,$userid);
			return json_encode($students);
			} catch (\Exception $e) {
				\common\controllers\CommonController::exceptionMessage($e->getMessage());
			}
		}
		
		public function actionGetStudentsMarks(){
			
	    try{
			$semister = Yii::$app->request->get('semister');
			$moduleid = Yii::$app->request->get('moduleid');
			$studentid = Yii::$app->request->get('studentid');
			$userid = Yii::$app->request->get('userid');
			$students = AddStudentMarks::getStudentsMarks($semister, $moduleid, $studentid, $userid);
			return json_encode($students);
			} catch (\Exception $e) {
				\common\controllers\CommonController::exceptionMessage($e->getMessage());
			}
		}	 
}
