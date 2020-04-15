<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\Student;
use common\models\Programme;
use common\models\Admin;
use common\models\ExamOfficer;
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
	  $uQuery=ExamOfficer::getExamOfficersList();
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
                        Yii::$app->session->setFlash('signupsuccess', '<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Student Created successfully! </div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>'); 
                        return $this->redirect(['students-list']);
                    }
            }
            return $this->render('student-create',[
                'userformmodel'=>$userformmodel,
                'countries'=>$countries,
				'programme'=>$programme
                    ]);
    }

    public function actionStudentUpdate(){
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
        return $this->render('student-update',[
            'userformmodel'=>$userformmodel,
            'studentdata'=>$studentdata[0],
            'countries'=>$countries,
			'programme'=>$programme
                ]);
        }
    }

    public function actionStudentsList(){
		try{
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


        $uQuery=Student::getStudentsList(false,$studentname, $rollno, $rumpun, $nationality, $studenticno, $studenticcolor, $passportno, $race, $religion, $gender, $martialstatus, $mobile, $telehome, $typeofentry, $address, $bankname, $accountno, $fathername, $fathericno, $mothername, $mothericno, $sponsortype, $progname, $entry, $intake, $mode, $utbemail, $dateofregistration, $dateofleaving, $age, $highest_qualification, $lastschoolname, $state_address, $type_of_residential, $type_of_programme, $bank_account_name);
		$query = $uQuery;		
		$count = $uQuery->count();
        return $this->render('students-list',[
            'model'=>$student,
            'query'=>$query,
            'count'=>$count,
			'programme'=>$programme
        ]);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
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

                        
            $signup = new \frontend\models\SignupForm();
            $student = new Student;
                        $data = \moonland\phpexcel\Excel::widget([
                            'mode' => 'import', 
                            'fileName' => $csv_file, 
                            'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
                            'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
                            'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
                        ]);
                        $studentdetails = $data[0];
                        $signup->password = $this->random_string(10);
                        $signup->email = $studentdetails['Email'];
                        $signup->username = $studentdetails['Email'];
                        $signup->user_role_ref_id = 2;
                         
                        $student->name = isset($studentdetails['Name']) ? $studentdetails['Name'] : '';
                        $student->rollno = isset($studentdetails['Roll No']) ? $studentdetails['Roll No'] : '';
                        $student->rumpun = isset($studentdetails['Rumpun']) ? $studentdetails['Rumpun'] : '';
                        $student->nationality = isset($studentdetails['Nationality']) ? $studentdetails['Nationality'] : '';
                        $student->nationalityother = isset($postvariable['Nationality (other)']) ? $postvariable['Nationality (other)'] : '';
                        $student->passportno = isset($studentdetails['Passport No']) ? $studentdetails['Passport No'] : '';
                        $student->race = isset($studentdetails['Race']) ? $studentdetails['Race'] : '';
                        $student->raceother = isset($postvariable['Race (other)']) ? $postvariable['Race (other)'] : '';
                        $student->religion = isset($studentdetails['Religion']) ? $studentdetails['Religion'] : '';
                        $student->religionother = isset($postvariable['Religion (other)']) ? $postvariable['Religion (other)'] : '';
                        $student->gender = isset($studentdetails['Gender']) ? $studentdetails['Gender'] : '';
                        $student->martial_status = isset($studentdetails['Martial Status']) ? $studentdetails['Martial Status'] : '';
                        $student->dob = isset($studentdetails['Date of Birth']) ? str_replace('/', '-',$studentdetails['Date of Birth']) : '';
                        $student->specialneeds = isset($studentdetails['Special Needs']) ? $studentdetails['Special Needs'] : '';
                        $student->type_of_entry = isset($studentdetails['Type of Entry']) ? $studentdetails['Type of Entry'] : '';
                        //$student->typeofentryother = isset($studentdetails['Type of Entry (other)']) ? $studentdetails['Type of Entry (other)'] : '';
                        $student->place_of_birth = isset($studentdetails['Place of Birth']) ? $studentdetails['Place of Birth'] : '';
                        $student->telephone_mobile = isset($studentdetails['Telephone No(Mobile)']) ? $studentdetails['Telephone No(Mobile)'] : '';
                        $student->tele_home = isset($studentdetails['Telephone No (Home)']) ? $studentdetails['Telephone No (Home)'] : '';
                        $student->email = isset($studentdetails['Email']) ? $studentdetails['Email'] : '';
                        $student->lastschoolname = isset($studentdetails['Name of Last School Attended']) ? $studentdetails['Name of Last School Attended'] : '';
                        $student->father_name = isset($studentdetails['Father / Gaurdian Name']) ? $studentdetails['Father / Gaurdian Name'] : '';
                        $student->fathericno = isset($studentdetails['Father / Gaurdian IC No']) ? $studentdetails['Father / Gaurdian IC No'] : '';
                        $student->father_mobile = isset($studentdetails['Father Telephone No']) ? $studentdetails['Father Telephone No'] : '';
                        $student->mother_name = isset($studentdetails['Mother Name']) ? $studentdetails['Mother Name'] : '';
                        $student->mothericno = isset($studentdetails['Mother IC No']) ? $studentdetails['Mother IC No'] : '';
                        $student->mother_mobile = isset($studentdetails['Mother\'s Telephone No']) ? $studentdetails['Mother\'s Telephone No'] : '';
                        $student->address = isset($studentdetails['Postal Address']) ? $studentdetails['Postal Address'] : '';
                        $student->address2 = isset($studentdetails['Address Line 2']) ? $studentdetails['Address Line 2'] : '';
                        $student->address3 = isset($studentdetails['Address Line 3']) ? $studentdetails['Address Line 3'] : '';
                        $student->postal_code = isset($studentdetails['Postal Code']) ? $studentdetails['Postal Code'] : '';
                        $student->bank_name = isset($studentdetails['Bank Name']) ? $studentdetails['Bank Name'] : '';
                        $student->account_no = isset($studentdetails['Bank Account No']) ? $studentdetails['Bank Account No'] : '';                        
                $student->sponsor_type = isset($studentdetails['Sponsor Type']) ? $studentdetails['Sponsor Type'] : '';
                //$student->sponsor_type_other = isset($studentdetails['Sponsor Type (other)']) ? $studentdetails['Sponsor Type (other)'] : '';


                $student->employer_name = isset($postvariable['Employer Name']) ? $postvariable['Employer Name'] : '';
                $student->employer_address = isset($postvariable['Employer Address Line 1']) ? $postvariable['Employer Address Line 1'] : '';
                $student->employer_address2 = isset($postvariable['Employer Address Line 2']) ? $postvariable['Employer Address Line 2'] : '';
                $student->employer_address3 = isset($postvariable['Employer Address Line 3']) ? $postvariable['Employer Address Line 3'] : '';
                $student->employer_postal_code = isset($postvariable['Employer Postal Code']) ? $postvariable['Employer Postal Code'] : '';
                $student->position_held = isset($postvariable['Position Held']) ? $postvariable['Position Held'] : '';
                $student->employment_mode = isset($postvariable['Employment Mode']) ? $postvariable['Employment Mode'] : '';
                $student->emp_from_month = isset($postvariable['Duration From (Month)']) ? $postvariable['Duration From (Month)'] : '';
                $student->emp_from_year = isset($postvariable['Duration From (Year)']) ? $postvariable['Duration From (Year)'] : '';
                $student->emp_to_month = isset($postvariable['Duration To (Month)']) ? $postvariable['Duration To (Month)'] : '';
                $student->emp_to_year = isset($postvariable['Duration To (Year)']) ? $postvariable['Duration To (Year)'] : '';
               
                        $student->programme_name = isset($studentdetails['Programme No']) ? $studentdetails['Programme No'] : '';
                        $student->intake = isset($studentdetails['Intake']) ? $studentdetails['Intake'] : '';
                        $student->entry = isset($studentdetails['Entry']) ? $studentdetails['Entry'] : '';
                        $student->ic_no = isset($studentdetails['IC No']) ? $studentdetails['IC No'] : '';
                        $student->ic_color = isset($studentdetails['IC Color']) ? $studentdetails['IC Color'] : '';
                        $student->gaurdian_relation = isset($postvariable['Gaurdian Relation']) ? $postvariable['Gaurdian Relation'] : '';
                        $student->mobile_home = isset($postvariable['Telephone No.(Home)']) ? $postvariable['Telephone No.(Home)'] : '';
                        $student->father_ic_color = isset($postvariable['Father/Guardian IC Colour']) ? $postvariable['Father/Guardian IC Colour '] : '';
                        $student->gaurdian_employment = isset($postvariable['Father/Guardian Employment']) ? $postvariable['Father/Guardian Employment'] : '';
                        $student->gaurdian_employer = isset($postvariable['Father/Guardian Employer']) ? $postvariable['Father/Guardian Employer'] : '';
                        $student->remarks = isset($postvariable['Remarks']) ? $postvariable['Remarks'] : '';
                        $student->telphone_work = isset($postvariable['Telephone No. (Work)']) ? $postvariable['Telephone No. (Work)'] : '';
                        $student->mother_ic_color = isset($postvariable['Mother IC Color']) ? $postvariable['Mother IC Color'] : '';
                        
                //$student->status_of_student = isset($postvariable['Status of Student']) ? $postvariable['Status of Student'] : '';
                //$student->status_remarks = isset($postvariable['Status Remarks']) ? $postvariable['Status Remarks'] : '';
                $student->mode = isset($postvariable['Mode']) ? $postvariable['Mode'] : '';
                $student->utb_email_address = isset($postvariable['UTB Email Address']) ? $postvariable['UTB Email Address'] : '';
                //$student->degree_classification = isset($postvariable['Degree Classification']) ? $postvariable['Degree Classification'] : '';
                $student->date_of_registration = isset($postvariable['Date of Registration']) ? str_replace('/', '-', $postvariable['Date of Registration']) : '';
                $student->date_of_leaving = isset($postvariable['Date of Leaving']) ? str_replace('/', '-',$postvariable['date_of_leaving']) : '';
                //$student->previous_roll_no = isset($postvariable['Previous Roll No']) ? $postvariable['Previous Roll No'] : '';
                //$student->previous_programme_name = isset($postvariable['Previous Programme Name']) ? $postvariable['Previous Programme Name'] : '';
                //$student->previous_intake_no = isset($postvariable['Previous Intake No']) ? $postvariable['Previous Intake No'] : '';
                //$student->previous_utb_email = isset($postvariable['Previous UTB Email']) ? $postvariable['Previous UTB Email'] : '';
        
                            if ($user = $signup->signup()){
                                
                    $userid = Yii::$app->db->getLastInsertID();
                    $student->user_ref_id = $userid;
                                $student->save();
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
