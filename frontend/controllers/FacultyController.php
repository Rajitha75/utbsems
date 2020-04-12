<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use common\models\Faculty;
use common\models\User;

date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class FacultyController extends \common\controllers\CommonController {

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
                \Yii::$app->getRequest()->url !== \yii\helpers\Url::to(\Yii::$app->getUser()->loginUrl)) {
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

	   public function actionAddFaculty()
    {
	    try{
	    Yii::$app->cache->flush();
	    $facultyformmodel = new \common\models\CreateFacultyForm();
            $faculty = new Faculty();
            if($facultyformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateFacultyForm');
				$facultyexist = Faculty::getFacultyIfExists($postvariable['faculty_name']);
				if(count($facultyexist) == 0){
                $faculty->faculty_name = $postvariable['faculty_name'];
				$faculty->status = 1;
				$faculty->save(false);
				Yii::$app->session->setFlash('facultysaved', "Faculty is saved successfully");
				}else{
					Yii::$app->session->setFlash('facultyexists', $postvariable['faculty_name']." already exists");
				}
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
				$facultyexist = Faculty::getFacultyIfExists($postvariable['faculty_name']);
				if(count($facultyexist) == 0){
				$facultyid = $postvariable['id'];
				$facultymodel = Faculty::find()->where(['id' => $facultyid])->one();
                $facultymodel->faculty_name = $postvariable['faculty_name'];
				$facultymodel->save(false);
				Yii::$app->session->setFlash('facultyupdated', "Faculty is Updated successfully");
				}else{
					Yii::$app->session->setFlash('facultyexists', $postvariable['faculty_name']." already exists");
				}
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
			Yii::$app->session->setFlash('facultydeleted', "Faculty Deleted Successfully");
        }else if(Yii::$app->request->get('status') == 0){
            $faculty->status = 1;
			Yii::$app->session->setFlash('facultydeleted', "Faculty Delete Undo Success");
        }
        $faculty->save(false);
		return $this->redirect(['faculty-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	 
	   
}
