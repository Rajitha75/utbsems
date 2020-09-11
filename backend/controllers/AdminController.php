<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\Student;
use common\models\Programme;
use common\models\Faculty;
use common\models\Admin;
use common\models\ExamOfficer;
use common\models\StudentKinDetails;
use common\models\StudentHighestQualificationDetails;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use yii\web\UploadedFile;
use yii\web\ImportFileForm;

/**
 * AdminController implements the CRUD actions for User model.
 */
class AdminController extends \common\controllers\CommonController
{
    public function behaviors()
    {
        return [
            'ghost-access' => [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }
	
	public function beforeAction($action) {        

        if (\Yii::$app->getUser()->isGuest ){
            \Yii::$app->getResponse()->redirect(Yii::$app->request->BaseUrl . '/site/login');
        } else {
            return parent::beforeAction($action);
        }
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
	try{
	$dataProvider = new ActiveDataProvider([
            'query' => User::find()->joinWith(['adminLocations']),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }

    /**
     * Displays a single User model.
     * @param integer $id
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
	 
    public function actionAdminCreate()
    {
            $userformmodel = new \common\models\CreateAdminForm();
            $signup = new \frontend\models\SignupForm();
            $admin = new Admin;
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateAdminForm');
                $signup->password = $postvariable['password'];
                $signup->email = $postvariable['email'];
                $signup->username = $postvariable['email'];
                $signup->user_role_ref_id = 1;
				$signup->status = 2;
                $postvariable=Yii::$app->request->post('CreateAdminForm');
				
                $admin->name = $postvariable['name'];
                $admin->email = $postvariable['email'];
                $admin->gender = $postvariable['gender'];
                $admin->mobile = $postvariable['mobile'];                

                    if ($user = $signup->signup()) {
                    Yii::$app->cache->flush();
                    $userid = Yii::$app->db->getLastInsertID();
                    $admin->user_ref_id = $userid;
                     $admin->save(false)   ;
				/*---------------------------------------------------------*/
                Yii::$app->session->setFlash('admincreatesuccess', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Admin Created successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
                        return $this->redirect(['admins-list']);
                    }
            }
            return $this->render('admin-create',[
                'userformmodel'=>$userformmodel,
                    ]);
    }

    public function actionAdminsList(){
		try{
        $admin = new Admin();
        $cond = $where = '';
        $adminname = Yii::$app->getRequest()->getQueryParam('name') ? Yii::$app->getRequest()->getQueryParam('name') : "";
        $uQuery=Admin::getAdminsList($adminname);
		$query = $uQuery;		
		$count = $uQuery->count();
        return $this->render('admins-list',[
            'model'=>$admin,
            'query'=>$query,
            'count'=>$count
        ]);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public function actionCreateExamOfficer()
    {
            $examofficerformmodel = new \common\models\CreateExamOfficerForm();
            $signup = new \frontend\models\SignupForm();
            $examofficer = new ExamOfficer();
            if($examofficerformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateExamOfficerForm');
                $signup->password = $postvariable['password'];
                $signup->email = $postvariable['email'];
                $signup->username = $postvariable['email'];
				$signup->is_admin = isset($postvariable['is_admin']) ? $postvariable['is_admin'] : '';
                $signup->user_role_ref_id = 3;
				$signup->status = 1;
				
                $examofficer->name = $postvariable['name'];
                $examofficer->email = $postvariable['email'];

                    if ($user = $signup->signup()) {
                    Yii::$app->cache->flush();
                    $userid = Yii::$app->db->getLastInsertID();
                    $examofficer->user_ref_id = $userid;
                     $examofficer->save(false);
				/*---------------------------------------------------------*/
                Yii::$app->session->setFlash('examofficercreatesuccess', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Admin Created successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
                        return $this->redirect(['exam-officers-list']);
                    }
            }
            return $this->render('create-exam-officer',[
                'userformmodel'=>$examofficerformmodel,
                    ]);
    }
	
	public function actionUpdateExamOfficer()
    {
	    try{
	    Yii::$app->cache->flush();
	    $userformmodel = new \common\models\CreateExamOfficerForm();
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateExamOfficerForm');
				$examofficer = ExamOfficer::find()->where(['user_ref_id'=>$postvariable['examofficerid']])->one();
				$user = User::find()->where(['id'=>$examofficer['user_ref_id']])->one();
		        $user->is_admin = isset($postvariable['is_admin']) ? $postvariable['is_admin'] : '';
				$user->save(false)   ;
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
	
	public function actionExamOfficerDelete($id)
    {
		try{
        $user = User::find()->where(['id' => Yii::$app->request->get('id')])->one();
        if(Yii::$app->request->get('status') == 1){
            $user->status = 2;
        }else if(Yii::$app->request->get('status') == 2){
            $user->status = 1;
        }
        $user->save(false);
		return $this->redirect(['exam-officers-list']);
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
    
    public function actionStudentCreate()
    {
            $userformmodel = new \common\models\CreateStudentForm();
            $signup = new \frontend\models\SignupForm();
            $countries = User::countrieslist();
			$countriesIsoCodes = User::countrieslistByIsoCode();
            $student = new Student;
			$faculty = Faculty::getAllFaculty();
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
				if($postvariable['highest_qualification'] == 'Advanced National Diploma' || $postvariable['highest_qualification'] == 'Higher National Diploma' || $postvariable['highest_qualification'] == 'International Baccalaureate' || $postvariable['highest_qualification'] == 'Undergraduate Degree' || $postvariable['highest_qualification'] == 'Masters by Coursework' || $postvariable['highest_qualification'] == 'Masters by Research' || $postvariable['highest_qualification'] == 'Doctor of Philosophy (PhD)'){
                    $student->highestqualification_coursetaken = isset($postvariable['highestqualification_coursetaken']) ? $postvariable['highestqualification_coursetaken'] : '';
					$student->highestqualification_result = isset($postvariable['highestqualification_result']) ? $postvariable['highestqualification_result'] : '';
                }else{
                    $student->highestqualification_coursetaken = '';
					$student->highestqualification_result = '';
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
               // $student->father_name = isset($postvariable['father_name']) ? $postvariable['father_name'] : '';
               // $student->fathericno = isset($postvariable['fathericno']) ? $postvariable['fathericno'] : '';
                //$student->father_mobile = isset($postvariable['father_mobile']) ? $postvariable['father_mobile'] : '';
               // $student->mother_name = isset($postvariable['mother_name']) ? $postvariable['mother_name'] : '';
               // $student->mothericno = isset($postvariable['mothericno']) ? $postvariable['mothericno'] : '';
                //$student->mother_mobile = isset($postvariable['mother_mobile']) ? $postvariable['mother_mobile'] : '';
                $student->address = isset($postvariable['address']) ? $postvariable['address'] : '';
                //$student->address2 = isset($postvariable['address2']) ? $postvariable['address2'] : '';
                //$student->address3 = isset($postvariable['address3']) ? $postvariable['address3'] : '';
				$student->countrycode = isset($postvariable['countrycode']) ? $postvariable['countrycode'] : '';
                $student->state = isset($postvariable['state']) ? $postvariable['state'] : '';
				$student->district = isset($postvariable['district']) ? $postvariable['district'] : '';
                $student->postal_code = isset($postvariable['postal_code']) ? $postvariable['postal_code'] : '';
				$student->mailing_address = isset($postvariable['mailing_address']) ? $postvariable['mailing_address'] : '';
                //$student->mailing_address2 = isset($postvariable['mailing_address2']) ? $postvariable['mailing_address2'] : '';
                //$student->mailing_address3 = isset($postvariable['mailing_address3']) ? $postvariable['mailing_address3'] : '';
				$student->mailing_countrycode = isset($postvariable['mailing_countrycode']) ? $postvariable['mailing_countrycode'] : '';
                $student->mailing_state = isset($postvariable['mailing_state']) ? $postvariable['mailing_state'] : '';
				$student->mailing_district = isset($postvariable['mailing_district']) ? $postvariable['mailing_district'] : '';
                $student->mailing_postal_code = isset($postvariable['mailing_postal_code']) ? $postvariable['mailing_postal_code'] : '';
				$student->mailing_permanent = isset($postvariable['mailing_permanent']) ? $postvariable['mailing_permanent'] : '';
				$student->bank_terms = 1;
				$student->date_of_registration = isset($postvariable['date_of_registration']) ? $postvariable['date_of_registration'] : '';
                $student->sponsor_type = isset($postvariable['sponsor_type']) ? $postvariable['sponsor_type'] : '';
				if($postvariable['sponsor_type'] == 'Other'){
                    $student->sponsor_type_other = isset($postvariable['sponsor_type_other']) ? $postvariable['sponsor_type_other'] : '';
                }else{
                    $student->sponsor_type_other = '';
                }
				
				if($postvariable['sponsor_type'] == 'Government Scholarship' || $postvariable['sponsor_type'] == 'UTB Scholarship'){
					$student->bank_name = isset($postvariable['bank_name']) ? $postvariable['bank_name'] : '';
					if($postvariable['bank_name'] == 'Other'){
						$student->bank_name_other = isset($postvariable['bank_name_other']) ? $postvariable['bank_name_other'] : '';
					}else{
						$student->bank_name_other = '';
					}
					$student->bank_account_name = isset($postvariable['bank_account_name']) ? $postvariable['bank_account_name'] : '';
					$student->account_no = isset($postvariable['account_no']) ? $postvariable['account_no'] : '';
				}else{
					$student->bank_name = '';
					$student->bank_name_other = '';
					$student->bank_account_name = '';
					$student->account_no = '';
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
				if($postvariable['entry'] == 'Other'){
                    $student->entry_other = isset($postvariable['entry_other']) ? $postvariable['entry_other'] : '';
                }else{
                    $student->entry_other = '';
                }
				$student->ic_no_format = isset($postvariable['ic_no_format']) ? $postvariable['ic_no_format'] : '';
                $student->ic_no = isset($postvariable['ic_no']) ? $postvariable['ic_no'] : '';
                $student->ic_color = isset($postvariable['ic_color']) ? $postvariable['ic_color'] : '';
               // $student->gaurdian_relation = isset($postvariable['gaurdian_relation']) ? $postvariable['gaurdian_relation'] : '';
               // $student->mobile_home = isset($postvariable['mobile_home']) ? $postvariable['mobile_home'] : '';
               // $student->father_ic_color = isset($postvariable['father_ic_color']) ? $postvariable['father_ic_color'] : '';
               // $student->gaurdian_employment = isset($postvariable['gaurdian_employment']) ? $postvariable['gaurdian_employment'] : '';
                //$student->gaurdian_employer = isset($postvariable['gaurdian_employer']) ? $postvariable['gaurdian_employer'] : '';
               // $student->remarks = isset($postvariable['remarks']) ? $postvariable['remarks'] : '';
               // $student->telphone_work = isset($postvariable['telphone_work']) ? $postvariable['telphone_work'] : '';
               // $student->mother_ic_color = isset($postvariable['mother_ic_color']) ? $postvariable['mother_ic_color'] : '';
				   $student->emergency_relationship = isset($postvariable['emergency_relationship']) ? $postvariable['emergency_relationship'] : '';
				   $student->emergency_relationship_others = isset($postvariable['emergency_relationship_others']) ? $postvariable['emergency_relationship_others'] : '';
				   $student->emergency_name = isset($postvariable['emergency_name']) ? $postvariable['emergency_name'] : '';
				   $student->emergency_address = isset($postvariable['emergency_address']) ? $postvariable['emergency_address'] : '';
				   $student->emergency_address2 = isset($postvariable['emergency_address2']) ? $postvariable['emergency_address2'] : '';
				   $student->emergency_address3 = isset($postvariable['emergency_address3']) ? $postvariable['emergency_address3'] : '';
				   $student->emergency_phone_country_code = isset($postvariable['emergency_phone_country_code']) ? $postvariable['emergency_phone_country_code'] : '';
				   $student->emergency_phone = isset($postvariable['emergency_phone']) ? $postvariable['emergency_phone'] : '';
				   $student->emergency_mobile_country_code = isset($postvariable['emergency_mobile_country_code']) ? $postvariable['emergency_mobile_country_code'] : '';
				   $student->emergency_mobile = isset($postvariable['emergency_mobile']) ? $postvariable['emergency_mobile'] : '';
				   $student->emergency_officeno_country_code = isset($postvariable['emergency_officeno_country_code']) ? $postvariable['emergency_officeno_country_code'] : '';
				   $student->emergency_officeno = isset($postvariable['emergency_officeno']) ? $postvariable['emergency_officeno'] : '';
				   $student->emergency_email = isset($postvariable['emergency_email']) ? $postvariable['emergency_email'] : '';
				   
				$student->mode = isset($postvariable['mode']) ? $postvariable['mode'] : '';
				$student->utb_email_address = isset($postvariable['utb_email_address']) ? $postvariable['utb_email_address'] : '';
				$student->date_of_leaving = isset($postvariable['date_of_leaving']) ? $postvariable['date_of_leaving'] : '';
				$student->age = isset($postvariable['age']) ? $postvariable['age'] : '';
				$student->status_of_student = isset($postvariable['status_of_student']) ? $postvariable['status_of_student'] : '';
				if($postvariable['status_of_student'] == 'Other'){
                    $student->status_of_student_other = isset($postvariable['status_of_student_other']) ? $postvariable['status_of_student_other'] : '';
                }else{
                    $student->status_of_student_other = '';
                }
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
					$studentid = Yii::$app->db->getLastInsertID();
                if(count($storagemodel->user_image)>0){
                    $user = User::find()->where(['id'=>$userid])->one();
                    $user->user_image = $studentimage;
                if($user->save(false)){}
                }
				if($postvariable['highest_qualification'] == 'A Level'){
				for($i=0;$i<count($postvariable['hq_a_level_year']);$i++){
				   $hqdetails = new StudentHighestQualificationDetails();
				   $hqdetails->student_id = $studentid;
				   $hqdetails->hq_a_level_year = $postvariable['hq_a_level_year'][$i];
				   $hqdetails->hq_a_level_subject = $postvariable['hq_a_level_subject'][$i];
				   $hqdetails->hq_a_level_grade = $postvariable['hq_a_level_grade'][$i];
				   $hqdetails->save();
				}
				}
				
				//print_r($postvariable);exit;
			   for($i=0;$i<count($postvariable['kin_relationship']);$i++){
				   $studentkindetails = new StudentKinDetails();
				   $studentkindetails->student_id = $studentid;
				   $studentkindetails->kin_relationship = $postvariable['kin_relationship'][$i];
				   if(isset($postvariable['kin_relationship'][$i]) && $postvariable['kin_relationship'][$i] == 'Others'){
				   $studentkindetails->kin_relationship_others = $postvariable['kin_relationship_others'][$i];
				   }else{
					$studentkindetails->kin_relationship_others = '';
				   }
				   $studentkindetails->kin_name = $postvariable['kin_name'][$i];
				   $studentkindetails->kin_address = $postvariable['kin_address'][$i];
				   $studentkindetails->kin_address2 = $postvariable['kin_address2'][$i];
				   $studentkindetails->kin_address3 = $postvariable['kin_address3'][$i];
				   $studentkindetails->kin_id_card_no_code = $postvariable['kin_id_card_no_code'][$i];
				   $studentkindetails->kin_id_card_no = $postvariable['kin_id_card_no'][$i];
				   $studentkindetails->kin_phone_country_code = $postvariable['kin_phone_country_code'][$i];
				   $studentkindetails->kin_phone = $postvariable['kin_phone'][$i];
				   $studentkindetails->kin_mobile_country_code = $postvariable['kin_mobile_country_code'][$i];
				   $studentkindetails->kin_mobile = $postvariable['kin_mobile'][$i];
				   $studentkindetails->kin_email = $postvariable['kin_email'][$i];
				   $studentkindetails->kin_occupation = $postvariable['kin_occupation'][$i];
				   $studentkindetails->save();
			   }
            }           
                        Yii::$app->session->setFlash('signupsuccess', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Student Created successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
                        return $this->redirect(['students-list']);
                    }
            }
            return $this->render('student-create',[
                'userformmodel'=>$userformmodel,
                'countries'=>$countries,
				'countriesIsoCodes'=>$countriesIsoCodes,
				'programme'=>$programme,
				'faculty'=>$faculty
                    ]);
    }

    public function actionStudentUpdate(){
      Yii::$app->cache->flush();
        //print_r($studentdata[0]['name']); exit;
            $userformmodel = new \common\models\CreateStudentForm();
            $countries = User::countrieslist();
			$countriesIsoCodes = User::countrieslistByIsoCode();
			$programme = Programme::getAllProgrammes();
			$faculty = Faculty::getAllFaculty();
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
				
				if($postvariable['highest_qualification'] == 'Advanced National Diploma' || $postvariable['highest_qualification'] == 'Higher National Diploma' || $postvariable['highest_qualification'] == 'International Baccalaureate' || $postvariable['highest_qualification'] == 'Undergraduate Degree' || $postvariable['highest_qualification'] == 'Masters by Coursework' || $postvariable['highest_qualification'] == 'Masters by Research' || $postvariable['highest_qualification'] == 'Doctor of Philosophy (PhD)'){
                    $student->highestqualification_coursetaken = isset($postvariable['highestqualification_coursetaken']) ? $postvariable['highestqualification_coursetaken'] : '';
					$student->highestqualification_result = isset($postvariable['highestqualification_result']) ? $postvariable['highestqualification_result'] : '';
                }else{
                    $student->highestqualification_coursetaken = '';
					$student->highestqualification_result = '';
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
				if($postvariable['status_of_student'] == 'Other'){
                    $student->status_of_student_other = isset($postvariable['status_of_student_other']) ? $postvariable['status_of_student_other'] : '';
                }else{
                    $student->status_of_student_other = '';
                }
                $student->martial_status = isset($postvariable['martial_status']) ? $postvariable['martial_status'] : '';
                $student->dob = isset($postvariable['dob']) ? $postvariable['dob'] : '';
                $student->specialneeds = isset($postvariable['specialneeds']) ? $postvariable['specialneeds'] : '';
                $student->place_of_birth = isset($postvariable['place_of_birth']) ? $postvariable['place_of_birth'] : '';
                $student->telephone_mobile = isset($postvariable['telephone_mobile']) ? $postvariable['telephone_mobile'] : '';
                $student->tele_home = isset($postvariable['tele_home']) ? $postvariable['tele_home'] : '';
                $student->email = isset($postvariable['email']) ? $postvariable['email'] : '';
				$student->emailother = isset($postvariable['emailother']) ? $postvariable['emailother'] : '';
                $student->lastschoolname = isset($postvariable['lastschoolname']) ? $postvariable['lastschoolname'] : '';
                //$student->father_name = isset($postvariable['father_name']) ? $postvariable['father_name'] : '';
                //$student->fathericno = isset($postvariable['fathericno']) ? $postvariable['fathericno'] : '';
                //$student->father_mobile = isset($postvariable['father_mobile']) ? $postvariable['father_mobile'] : '';
                //$student->mother_name = isset($postvariable['mother_name']) ? $postvariable['mother_name'] : '';
                //$student->mothericno = isset($postvariable['mothericno']) ? $postvariable['mothericno'] : '';
                //$student->mother_mobile = isset($postvariable['mother_mobile']) ? $postvariable['mother_mobile'] : '';
                $student->address = isset($postvariable['address']) ? $postvariable['address'] : '';
                //$student->address2 = isset($postvariable['address2']) ? $postvariable['address2'] : '';
                //$student->address3 = isset($postvariable['address3']) ? $postvariable['address3'] : '';
				$student->countrycode = isset($postvariable['countrycode']) ? $postvariable['countrycode'] : '';
                $student->state = isset($postvariable['state']) ? $postvariable['state'] : '';
				$student->district = isset($postvariable['district']) ? $postvariable['district'] : '';
                $student->postal_code = isset($postvariable['postal_code']) ? $postvariable['postal_code'] : '';
				$student->mailing_address = isset($postvariable['mailing_address']) ? $postvariable['mailing_address'] : '';
                //$student->mailing_address2 = isset($postvariable['mailing_address2']) ? $postvariable['mailing_address2'] : '';
                //$student->mailing_address3 = isset($postvariable['mailing_address3']) ? $postvariable['mailing_address3'] : '';
				$student->mailing_countrycode = isset($postvariable['mailing_countrycode']) ? $postvariable['mailing_countrycode'] : '';
                $student->mailing_state = isset($postvariable['mailing_state']) ? $postvariable['mailing_state'] : '';
				$student->mailing_district = isset($postvariable['mailing_district']) ? $postvariable['mailing_district'] : '';
                $student->mailing_postal_code = isset($postvariable['mailing_postal_code']) ? $postvariable['mailing_postal_code'] : '';
				$student->mailing_permanent = isset($postvariable['mailing_permanent']) ? $postvariable['mailing_permanent'] : '';
				$student->bank_terms = 1;
				$student->date_of_registration = isset($postvariable['date_of_registration']) ? $postvariable['date_of_registration'] : '';
                $student->sponsor_type = isset($postvariable['sponsor_type']) ? $postvariable['sponsor_type'] : '';
				if($postvariable['sponsor_type'] == 'Other'){
                    $student->sponsor_type_other = isset($postvariable['sponsor_type_other']) ? $postvariable['sponsor_type_other'] : '';
                }else{
                    $student->sponsor_type_other = '';
                }
				
				if($postvariable['sponsor_type'] == 'Government Scholarship' || $postvariable['sponsor_type'] == 'UTB Scholarship'){
					$student->bank_name = isset($postvariable['bank_name']) ? $postvariable['bank_name'] : '';
					if($postvariable['bank_name'] == 'Other'){
						$student->bank_name_other = isset($postvariable['bank_name_other']) ? $postvariable['bank_name_other'] : '';
					}else{
						$student->bank_name_other = '';
					}
					$student->bank_account_name = isset($postvariable['bank_account_name']) ? $postvariable['bank_account_name'] : '';
					$student->account_no = isset($postvariable['account_no']) ? $postvariable['account_no'] : '';
				}else{
					$student->bank_name = '';
					$student->bank_name_other = '';
					$student->bank_account_name = '';
					$student->account_no = '';
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
				if($postvariable['entry'] == 'Other'){
                    $student->entry_other = isset($postvariable['entry_other']) ? $postvariable['entry_other'] : '';
                }else{
                    $student->entry_other = '';
                }
				$student->ic_no_format = isset($postvariable['ic_no_format']) ? $postvariable['ic_no_format'] : '';
                $student->ic_no = isset($postvariable['ic_no']) ? $postvariable['ic_no'] : '';
                $student->ic_color = isset($postvariable['ic_color']) ? $postvariable['ic_color'] : '';
                //$student->gaurdian_relation = isset($postvariable['gaurdian_relation']) ? $postvariable['gaurdian_relation'] : '';
                //$student->mobile_home = isset($postvariable['mobile_home']) ? $postvariable['mobile_home'] : '';
                //$student->father_ic_color = isset($postvariable['father_ic_color']) ? $postvariable['father_ic_color'] : '';
                //$student->gaurdian_employment = isset($postvariable['gaurdian_employment']) ? $postvariable['gaurdian_employment'] : '';
                //$student->gaurdian_employer = isset($postvariable['gaurdian_employer']) ? $postvariable['gaurdian_employer'] : '';
                //$student->remarks = isset($postvariable['remarks']) ? $postvariable['remarks'] : '';
                //$student->telphone_work = isset($postvariable['telphone_work']) ? $postvariable['telphone_work'] : '';
                //$student->mother_ic_color = isset($postvariable['mother_ic_color']) ? $postvariable['mother_ic_color'] : '';
					$student->emergency_relationship = isset($postvariable['emergency_relationship']) ? $postvariable['emergency_relationship'] : '';
					if($postvariable['emergency_relationship'] == 'Others'){
						$student->emergency_relationship_others = isset($postvariable['emergency_relationship_others']) ? $postvariable['emergency_relationship_others'] : '';
					}else{
						$student->emergency_relationship_others = '';
					}
				   $student->emergency_name = isset($postvariable['emergency_name']) ? $postvariable['emergency_name'] : '';
				   $student->emergency_address = isset($postvariable['emergency_address']) ? $postvariable['emergency_address'] : '';
				   $student->emergency_address2 = isset($postvariable['emergency_address2']) ? $postvariable['emergency_address2'] : '';
				   $student->emergency_address3 = isset($postvariable['emergency_address3']) ? $postvariable['emergency_address3'] : '';
				   $student->emergency_phone_country_code = isset($postvariable['emergency_phone_country_code']) ? $postvariable['emergency_phone_country_code'] : '';
				   $student->emergency_phone = isset($postvariable['emergency_phone']) ? $postvariable['emergency_phone'] : '';
				   $student->emergency_mobile_country_code = isset($postvariable['emergency_mobile_country_code']) ? $postvariable['emergency_mobile_country_code'] : '';
				   $student->emergency_mobile = isset($postvariable['emergency_mobile']) ? $postvariable['emergency_mobile'] : '';
				   $student->emergency_officeno_country_code = isset($postvariable['emergency_officeno_country_code']) ? $postvariable['emergency_officeno_country_code'] : '';
				   $student->emergency_officeno = isset($postvariable['emergency_officeno']) ? $postvariable['emergency_officeno'] : '';
				   $student->emergency_email = isset($postvariable['emergency_email']) ? $postvariable['emergency_email'] : '';
				   
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
				
				
				for($i=0;$i<count($postvariable['kin_relationship']);$i++){
					if(isset($postvariable['kin_id'][$i]) && $postvariable['kin_id'][$i] != ''){
					$studentkindetails = StudentKinDetails::find()->where(['kin_id'=>$postvariable['kin_id'][$i]])->one();
					}else{
					$studentkindetails = new StudentKinDetails();
					}
				   $studentkindetails->student_id = $postvariable['studentid'];
				   $studentkindetails->kin_relationship = $postvariable['kin_relationship'][$i];
				  // print_r($postvariable['kin_relationship_others']);exit;
				   if(isset($postvariable['kin_relationship'][$i]) && $postvariable['kin_relationship'][$i] == 'Others'){
				   //$studentkindetails->kin_relationship_others = $postvariable['kin_relationship_others'][$i];
				   }else{
					$studentkindetails->kin_relationship_others = '';
				   }
				   $studentkindetails->kin_name = $postvariable['kin_name'][$i];
				   $studentkindetails->kin_address = $postvariable['kin_address'][$i];
				   $studentkindetails->kin_address2 = $postvariable['kin_address2'][$i];
				   $studentkindetails->kin_address3 = $postvariable['kin_address3'][$i];
				   $studentkindetails->kin_id_card_no_code = $postvariable['kin_id_card_no_code'][$i];
				   $studentkindetails->kin_id_card_no = $postvariable['kin_id_card_no'][$i];
				   $studentkindetails->kin_phone_country_code = $postvariable['kin_phone_country_code'][$i];
				   $studentkindetails->kin_phone = $postvariable['kin_phone'][$i];
				   $studentkindetails->kin_mobile_country_code = $postvariable['kin_mobile_country_code'][$i];
				   $studentkindetails->kin_mobile = $postvariable['kin_mobile'][$i];
				   $studentkindetails->kin_email = $postvariable['kin_email'][$i];
				   $studentkindetails->kin_occupation = $postvariable['kin_occupation'][$i];
				   $studentkindetails->save();
			   }
			   
			   if($postvariable['highest_qualification'] == 'A Level'){
			   for($i=0;$i<count($postvariable['hq_a_level_year']);$i++){
					if(isset($postvariable['hq_id'][$i]) && $postvariable['hq_id'][$i] != ''){
					$studenthqdetails = StudentHighestQualificationDetails::find()->where(['id'=>$postvariable['hq_id'][$i]])->one();
					}else{
					$studenthqdetails = new StudentHighestQualificationDetails();
					}
				   $studenthqdetails->student_id = $postvariable['studentid'];
				   $studenthqdetails->hq_a_level_year = $postvariable['hq_a_level_year'][$i];
				   $studenthqdetails->hq_a_level_subject = $postvariable['hq_a_level_subject'][$i];
				   $studenthqdetails->hq_a_level_grade = $postvariable['hq_a_level_grade'][$i];
				   $studenthqdetails->save();
			   }
			   }else{
				   $result = StudentHighestQualificationDetails::deleteRecordByStudentId($postvariable['studentid']);
			   }
                
                Yii::$app->session->setFlash('studentupdatesuccess', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Student Updated successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
                return $this->redirect(['students-list']);
            }
        }else{     
            $id = !empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : '';
            $studentdata=Student::getStudentsData($id);
			$studentkindetails = StudentKinDetails::getStudentKinDetailsByStudentId($id);
			$studenthqdetails = StudentHighestQualificationDetails::getStudentHighestQualificationDetailsByStudentId($id);
        return $this->render('student-update',[
            'userformmodel'=>$userformmodel,
            'studentdata'=>$studentdata[0],
			'studentkindetails'=>$studentkindetails,
			'studenthqdetails'=>$studenthqdetails,
            'countries'=>$countries,
			'programme'=>$programme,
			'faculty'=>$faculty,
			'countriesIsoCodes'=>$countriesIsoCodes,
                ]);
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


        $uQuery=Student::getStudentsListAdmin(false,$studentname, $rollno, $rumpun, $nationality, $studenticno, $studenticcolor, $passportno, $race, $religion, $gender, $martialstatus, $mobile, $telehome, $typeofentry, $address, $bankname, $accountno, $fathername, $fathericno, $mothername, $mothericno, $sponsortype, $progname, $entry, $intake, $mode, $utbemail, $dateofregistration, $dateofleaving, $age, $highest_qualification, $lastschoolname, $state_address, $type_of_residential, $type_of_programme, $bank_account_name);
		$query = $uQuery;		
		$count = $uQuery->count();
        return $this->render('students-list',[
            'model'=>$student,
            'query'=>$query,
            'count'=>$count,
			'programme'=>$programme
        ]);
		/*} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }*/
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
    
    public function actionImportStudents(){
        $importformmodel = new \common\models\ImportFileForm();
        if($importformmodel->load(Yii::$app->request->post())){
            $postvariable=Yii::$app->request->post('ImportFileForm');
            $storagemodel = new \common\models\Storage();
            $storagemodel->importfile = \yii\web\UploadedFile::getInstance($importformmodel, 'importfile');
            
            if(count($storagemodel->importfile)>0){
                if ($storagemodel->uploadExcel()) {
                    define('CSV_PATH','../../frontend/web/uploads/student-data/');
                        $csv_file = CSV_PATH . $storagemodel->importfile->baseName . '.' . $storagemodel->importfile->extension;

                   
            
                        $data = \moonland\phpexcel\Excel::widget([
                            'mode' => 'import', 
                            'fileName' => $csv_file, 
                            'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
                            'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
                            'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
                        ]);
						
						for($i=0;$i<count($data);$i++){
						$signup = new \frontend\models\SignupForm();
						$student = new Student;
                        $studentdetails = $data[$i];
						if(isset($studentdetails['UTB Email']) && $studentdetails['UTB Email'] != ''){
						$user = User::find()->where(['email' => $studentdetails['UTB Email']])->orWhere(['username' => $studentdetails['UTB Email']])->all();
						if(count($user)==0){
                        $signup->password = 'utbsemspassword';
                        $signup->email = $studentdetails['UTB Email'];
                        $signup->username = $studentdetails['UTB Email'];
                        $signup->is_verified = 1;
						$student->is_submit = 'submit';
						
						$student->name = isset($studentdetails['Applicant Name']) ? $studentdetails['Applicant Name'] : '';
						$student->utb_email_address = isset($studentdetails['UTB Email']) ? $studentdetails['UTB Email'] : '';
						$student->email = isset($studentdetails['Email']) ? $studentdetails['Email'] : '';
						$icno = isset($studentdetails['IC Number']) ? $studentdetails['IC Number'] : '';
						if($icno != ''){
						$icnumber = explode('-',$icno);
							if(isset($icnumber[0])){
							$student->ic_no_format = str_replace(' ', '', $icnumber[0]);
							}
							if(isset($icnumber[1])){
							$student->ic_no = str_replace(' ', '', $icnumber[1]);
							}
						}
						$student->telephone_mobile = isset($studentdetails['Mobile No.']) ? $studentdetails['Mobile No.'] : '';
						$student->rollno = isset($studentdetails['Roll Number']) ? $studentdetails['Roll Number'] : '';
						$student->type_of_entry = isset($studentdetails['Type of Entry']) ? $studentdetails['Type of Entry'] : '';
						
                        /*$student->type_of_entry = isset($studentdetails['type_entry']) ? $studentdetails['type_entry'] : '';
                        $student->name = isset($studentdetails['name']) ? $studentdetails['name'] : '';
						$nationality = isset($studentdetails['nationality']) ? $studentdetails['nationality'] : '';
						if(strtolower($nationality) == 'other' || strtolower($nationality) == 'others'){
							$student->nationality = 'Other';
							$student->nationalityother = isset($studentdetails['other_nationality']) ? $studentdetails['other_nationality'] : '';
						}else{
							$student->nationality = $nationality;
						}
						$student->ic_no = isset($studentdetails['ic_number']) ? $studentdetails['ic_number'] : '';
						$student->passportno = isset($studentdetails['passport_number']) ? $studentdetails['passport_number'] : '';
						$student->martial_status = isset($studentdetails['marital_status']) ? $studentdetails['marital_status'] : '';
						$student->gender = isset($studentdetails['gender']) ? $studentdetails['gender'] : '';
						$race = isset($studentdetails['race']) ? $studentdetails['race'] : '';
						if(strtolower($race) == 'other' || strtolower($race) == 'others'){
							$student->race = 'Other';
							$student->raceother = isset($studentdetails['other_race']) ? $studentdetails['other_race'] : '';
						}else{
							$student->race = $race;
						}
						$religion = isset($studentdetails['religion']) ? $studentdetails['religion'] : '';
						if(strtolower($religion) == 'other' || strtolower($religion) == 'others'){
							$student->religion = 'Other';
							$student->religionother = isset($studentdetails['other_religion']) ? $studentdetails['other_religion'] : '';
						}else{
							$student->religion = $religion;
						}
						$userDob = isset($studentdetails['dob']) ? str_replace('/','-',$studentdetails['dob']) : '';
						if($userDob != ''){
						$student->dob = $userDob;
						$userDob = explode('-',$userDob);
						$age = (date("md",date("U",mktime(0,0,0,$userDob[0],$userDob[1],$userDob[2]))) > date('md') ? ((date("Y") - $userDob[2]) - 1) : (date("Y") - $userDob[2])) ;
						$student->age = $age;
						}
						$student->place_of_birth = isset($studentdetails['pob']) ? $studentdetails['pob'] : '';
						$student->address = isset($studentdetails['postal_address1']) ? $studentdetails['postal_address1'] : '';
                        $student->address2 = isset($studentdetails['postal_address2']) ? $studentdetails['postal_address2'] : '';
                        $student->postal_code = isset($studentdetails['postcode']) ? $studentdetails['postcode'] : '';
						$student->telephone_mobile = isset($studentdetails['mobile_no']) ? $studentdetails['mobile_no'] : '';
                        $student->tele_home = isset($studentdetails['telno_home']) ? $studentdetails['telno_home'] : '';
                        $student->email = isset($studentdetails['other_email']) ? $studentdetails['other_email'] : '';
						$student->lastschoolname = isset($studentdetails['last_school_attend']) ? $studentdetails['last_school_attend'] : '';
                        $student->specialneeds = isset($studentdetails['special_needs']) ? $studentdetails['special_needs'] : '';
                        $student->father_name = isset($studentdetails['guardian_name1']) ? $studentdetails['guardian_name1'] : '';
                        $student->fathericno = isset($studentdetails['guardian_icno1']) ? $studentdetails['guardian_icno1'] : '';
                        $student->father_mobile = isset($studentdetails['guardian_telno1']) ? $studentdetails['guardian_telno1'] : '';
						$student->mother_name = isset($studentdetails['guardian_name2']) ? $studentdetails['guardian_name2'] : '';
                        $student->mothericno = isset($studentdetails['guardian_icno2']) ? $studentdetails['guardian_icno2'] : '';
                        $student->mother_mobile = isset($studentdetails['guardian_telno2']) ? $studentdetails['guardian_telno2'] : '';	
                        $student->bank_name = isset($studentdetails['bankname']) ? $studentdetails['bankname'] : '';
						$student->account_no = isset($studentdetails['bankaccountno']) ? $studentdetails['bankaccountno'] : '';
						$student->utb_email_address = isset($studentdetails['itbemail']) ? $studentdetails['itbemail'] : '';
                        $student->rumpun = isset($studentdetails['rumpun']) ? $studentdetails['rumpun'] : '';
                        $student->rollno = isset($studentdetails['roll_number']) ? $studentdetails['roll_number'] : '';*/
                            if ($user = $signup->signup()){
								$userid = Yii::$app->db->getLastInsertID();
								$student->user_ref_id = $userid;
                                $student->save();
                            }
						}
						}
						}
                        unlink($csv_file);
                }
                Yii::$app->session->setFlash('signupsuccess', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Student Data Uploaded successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
                return $this->redirect(['import-students']);    
            }
            }else{
                return $this->render("import-students",[
                    'importformmodel'=>$importformmodel,
                ]);
            }
    }

    public function random_string($length) 
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
		for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
        }
        return $key;
    }
	
	public function actionDeleteKin()
    {
		try{
			$kinid = Yii::$app->request->post('kinid');
			$result = StudentKinDetails::deleteRecord($kinid);
			return $result;
		} catch (\Exception $e) {
		\common\controllers\CommonController::exceptionMessage($e->getMessage());
	}
    }
	
	public function actionDeleteHq()
    {
		try{
			$hqid = Yii::$app->request->post('hqid');
			$result = StudentHighestQualificationDetails::deleteRecord($hqid);
			return $result;
		} catch (\Exception $e) {
		\common\controllers\CommonController::exceptionMessage($e->getMessage());
	}
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
	
	public function actionStudentVerify($id)
    {
		try{
        $user = User::find()->where(['id' => Yii::$app->request->get('id')])->one();
		//echo Yii::$app->request->get('is_verified');exit;
        if(Yii::$app->request->get('is_verified') == 1){
            $user->is_verified = 0;
			Yii::$app->session->setFlash('studentverified', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Student Verification Undo Success! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
        }else if(Yii::$app->request->get('is_verified') == 0){
            $user->is_verified = 1;
			Yii::$app->session->setFlash('studentundoverify', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Student Verified successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
        }
		//print_r($user);exit;
        $user->save(false);
		return $this->redirect(['students-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }

    public function actionDelete($id)
    {
		try{
        $user = User::find()->where(['id' => Yii::$app->request->get('id')])->one();
        if(Yii::$app->request->get('status') == 1){
            $user->status = 2;
        }else if(Yii::$app->request->get('status') == 2){
            $user->status = 1;
        }
        $user->save(false);
		return $this->redirect(['admins-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public function actionAdminDelete($id)
    {
		try{
        $user = User::find()->where(['id' => Yii::$app->request->get('id')])->one();
        if(Yii::$app->request->get('status') == 1){
            $user->status = 2;
        }else if(Yii::$app->request->get('status') == 2){
            $user->status = 1;
        }
        $user->save(false);
		return $this->redirect(['admins-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
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

    public function actionReports(){
        try{
            return $this->render("reports");
        } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    
    public function actionGetReportDetails(){
        try{
            $category = (Yii::$app->getRequest()->getQueryParam('category')) ? Yii::$app->getRequest()->getQueryParam('category') : '';
            $report = '';
            $report = User::getReportDetails($category);
            return $report;
        } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
    
}
