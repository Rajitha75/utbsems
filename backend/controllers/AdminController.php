<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\Student;
use common\models\Admin;
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
    
    public function actionStudentCreate()
    {
            $userformmodel = new \common\models\CreateStudentForm();
            $signup = new \frontend\models\SignupForm();
            $student = new Student;
            if($userformmodel->load(Yii::$app->request->post())){
                $postvariable=Yii::$app->request->post('CreateStudentForm');
               //print_r($postvariable['nationalityother']);exit;
                Yii::$app->cache->flush();
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
                $student->gender = isset($postvariable['gender']) ? $postvariable['gender'] : '';
                $student->martial_status = isset($postvariable['martial_status']) ? $postvariable['martial_status'] : '';
                $student->dob = isset($postvariable['dob']) ? $postvariable['dob'] : '';
                $student->specialneeds = isset($postvariable['specialneeds']) ? $postvariable['specialneeds'] : '';
                $student->type_of_entry = isset($postvariable['type_of_entry']) ? $postvariable['type_of_entry'] : '';
                $student->typeofentryother = isset($postvariable['typeofentryother']) ? $postvariable['typeofentryother'] : '';
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
                    ]);
    }

    public function actionStudentUpdate(){
        //print_r($studentdata[0]['name']); exit;
            $userformmodel = new \common\models\CreateStudentForm();
        if($userformmodel->load(Yii::$app->request->post())){
            $postvariable=Yii::$app->request->post('CreateStudentForm');
                $student = Student::find()->where(['id'=>$postvariable['studentid']])->one();
                Yii::$app->cache->flush();
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

                $storagemodel = new \common\models\Storage();
				
                $storagemodel->user_image = \yii\web\UploadedFile::getInstance($userformmodel, 'user_image');
                
                if(count($storagemodel->user_image)>0){
                    unlink('../../frontend/web/uploads/profile_images/' . $student->user_ref_id.'/'.$student->user_image);
                    $studentimage = $student->user_image = $storagemodel->user_image->name;
                    if ($storagemodel->upload($student->user_ref_id)) {
                    }
                    }
                if($student->save(false))
                {
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
                ]);
        }
    }

    public function actionStudentsList(){
		try{
        $student = new Student();
        $cond = $where = '';
        $studentname = Yii::$app->getRequest()->getQueryParam('name') ? Yii::$app->getRequest()->getQueryParam('name') : "";
        $programme_name = Yii::$app->getRequest()->getQueryParam('programme_name') ? Yii::$app->getRequest()->getQueryParam('programme_name') : "";
            
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
        $email = Yii::$app->getRequest()->getQueryParam('email') ? Yii::$app->getRequest()->getQueryParam('email') : "";
        $typeofentry = Yii::$app->getRequest()->getQueryParam('typeofentry') ? Yii::$app->getRequest()->getQueryParam('typeofentry') : "";
        $address = Yii::$app->getRequest()->getQueryParam('address') ? Yii::$app->getRequest()->getQueryParam('address') : "";
        $bankname = Yii::$app->getRequest()->getQueryParam('bankname') ? Yii::$app->getRequest()->getQueryParam('bankname') : "";
        $accountno = Yii::$app->getRequest()->getQueryParam('accountno') ? Yii::$app->getRequest()->getQueryParam('accountno') : "";
        $fathername = Yii::$app->getRequest()->getQueryParam('fathername') ? Yii::$app->getRequest()->getQueryParam('fathername') : "";
        $fathericno = Yii::$app->getRequest()->getQueryParam('fathericno') ? Yii::$app->getRequest()->getQueryParam('fathericno') : "";
        $mothername = Yii::$app->getRequest()->getQueryParam('mothername') ? Yii::$app->getRequest()->getQueryParam('mothername') : "";
        $mothericno = Yii::$app->getRequest()->getQueryParam('mothericno') ? Yii::$app->getRequest()->getQueryParam('mothericno') : "";
        $sponsortype = Yii::$app->getRequest()->getQueryParam('sponsortype') ? Yii::$app->getRequest()->getQueryParam('sponsortype') : "";
        $progname = Yii::$app->getRequest()->getQueryParam('progname') ? Yii::$app->getRequest()->getQueryParam('progname') : "";
        $entry = Yii::$app->getRequest()->getQueryParam('entry') ? Yii::$app->getRequest()->getQueryParam('entry') : "";
        $status = Yii::$app->getRequest()->getQueryParam('status') ? Yii::$app->getRequest()->getQueryParam('status') : "";
        $intake = Yii::$app->getRequest()->getQueryParam('intake') ? Yii::$app->getRequest()->getQueryParam('intake') : "";
        $mode = Yii::$app->getRequest()->getQueryParam('mode') ? Yii::$app->getRequest()->getQueryParam('mode') : "";
        $utbemail = Yii::$app->getRequest()->getQueryParam('utbemail') ? Yii::$app->getRequest()->getQueryParam('utbemail') : "";
        $degree = Yii::$app->getRequest()->getQueryParam('degree') ? Yii::$app->getRequest()->getQueryParam('degree') : "";
        $dateofregistration = Yii::$app->getRequest()->getQueryParam('dateofregistration') ? Yii::$app->getRequest()->getQueryParam('dateofregistration') : "";
        $dateofleaving = Yii::$app->getRequest()->getQueryParam('dateofleaving') ? Yii::$app->getRequest()->getQueryParam('dateofleaving') : "";
        $prevrollno = Yii::$app->getRequest()->getQueryParam('prevrollno') ? Yii::$app->getRequest()->getQueryParam('prevrollno') : "";
        $prevprogname = Yii::$app->getRequest()->getQueryParam('prevprogname') ? Yii::$app->getRequest()->getQueryParam('prevprogname') : "";
        $previntakeno = Yii::$app->getRequest()->getQueryParam('previntakeno') ? Yii::$app->getRequest()->getQueryParam('previntakeno') : "";
        $prevutbemail = Yii::$app->getRequest()->getQueryParam('prevutbemail') ? Yii::$app->getRequest()->getQueryParam('prevutbemail') : "";


        $uQuery=Student::getStudentsList($studentname, $rollno, $rumpun, $nationality, $studenticno, $studenticcolor, $passportno, $race, $religion, $gender, $martialstatus, $mobile, $telehome, $email, $typeofentry, $address, $bankname, $accountno, $fathername, $fathericno, $mothername, $mothericno, $sponsortype, $progname, $entry, $status, $intake, $mode, $utbemail, $degree, $dateofregistration, $dateofleaving, $prevrollno, $prevprogname, $previntakeno, $prevutbemail);
		$query = $uQuery;		
		$count = $uQuery->count();
        return $this->render('students-list',[
            'model'=>$student,
            'query'=>$query,
            'count'=>$count
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
                        $student->typeofentryother = isset($studentdetails['Type of Entry (other)']) ? $studentdetails['Type of Entry (other)'] : '';
                        $student->place_of_birth = isset($studentdetails['Place of Birth']) ? $studentdetails['Place of Birth'] : '';
                        $student->telephone_mobile = isset($studentdetails['Telephone No(Mobile)']) ? $studentdetails['Telephone No(Mobile)'] : '';
                        $student->tele_home = isset($studentdetails['Telephone No (Home)']) ? $studentdetails['Telephone No (Home)'] : '';
                        $student->email = isset($studentdetails['Email']) ? $studentdetails['Email'] : '';
                        $student->emailother = isset($studentdetails['Email (other)']) ? $studentdetails['Email (other)'] : '';
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
                $student->sponsor_type_other = isset($studentdetails['Sponsor Type (other)']) ? $studentdetails['Sponsor Type (other)'] : '';
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
                        
                $student->status_of_student = isset($postvariable['Status of Student']) ? $postvariable['Status of Student'] : '';
                $student->status_remarks = isset($postvariable['Status Remarks']) ? $postvariable['Status Remarks'] : '';
                $student->mode = isset($postvariable['Mode']) ? $postvariable['Mode'] : '';
                $student->utb_email_address = isset($postvariable['UTB Email Address']) ? $postvariable['UTB Email Address'] : '';
                $student->degree_classification = isset($postvariable['Degree Classification']) ? $postvariable['Degree Classification'] : '';
                $student->date_of_registration = isset($postvariable['Date of Registration']) ? str_replace('/', '-', $postvariable['Date of Registration']) : '';
                $student->date_of_leaving = isset($postvariable['Date of Leaving']) ? str_replace('/', '-',$postvariable['date_of_leaving']) : '';
                $student->previous_roll_no = isset($postvariable['Previous Roll No']) ? $postvariable['Previous Roll No'] : '';
                $student->previous_programme_name = isset($postvariable['Previous Programme Name']) ? $postvariable['Previous Programme Name'] : '';
                $student->previous_intake_no = isset($postvariable['Previous Intake No']) ? $postvariable['Previous Intake No'] : '';
                $student->previous_utb_email = isset($postvariable['Previous UTB Email']) ? $postvariable['Previous UTB Email'] : '';
        
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
		return $this->redirect(['students-list']);
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
        $imageurl = 'http://'.$_SERVER['HTTP_HOST'].$strarr[0].'frontend/web/uploads/profile_images/'.$studentdata['user_ref_id'].'/'.$studentdata['user_image'];
         $pdf_content=$this->renderPartial('viewpdf', [
            'studentdata' => $studentdata,
            'imageurl' => $imageurl
        ]);
        $mpdf = new \mPDF();
        $mpdf->WriteHTML($pdf_content);
        $fileName = str_replace(" ", "_", $studentdata['name']) . '.pdf';
        $mpdf->Output($fileName, 'I');
        exit;
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
    
}
