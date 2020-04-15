<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use common\models\User;
use common\models\Faculty;
use common\models\Programme;
use common\models\AssignProgrammeFaculty;

date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class ProgrammeToFacultyController extends \common\controllers\CommonController {

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
                 Yii::$app->controller->action->id != 'coming-soon') {
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
						Yii::$app->session->setFlash('programmerofacultysaved', "Added successfully");
					}else{
						Yii::$app->session->setFlash('programmerofacultyexists', "Already exists");
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
						Yii::$app->session->setFlash('programmerofacultyupdated', "Updated successfully");
					}else{
						Yii::$app->session->setFlash('programmerofacultyexists', "Already exists");
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
		$programme_name = Yii::$app->getRequest()->getQueryParam('programme_name') ? Yii::$app->getRequest()->getQueryParam('programme_name') : "";
		$faculty_name = Yii::$app->getRequest()->getQueryParam('faculty_name') ? Yii::$app->getRequest()->getQueryParam('faculty_name') : "";
            $uQuery = AssignProgrammeFaculty::getAllRecords($faculty_name,$programme_name);
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
		Yii::$app->session->setFlash('programmerofacultydeleted', "Deleted successfully");
		return $this->redirect(['programme-to-faculty-list']); 
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
}
