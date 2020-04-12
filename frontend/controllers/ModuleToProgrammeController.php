<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use common\models\User;
use common\models\Programme;
use common\models\Module;
use common\models\AssignModuleProgramme;

date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class ModuleToProgrammeController extends \common\controllers\CommonController {

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
    
	   public function actionAddModuleToProgramme()
    {
	   // try{
	    Yii::$app->cache->flush();
	    $moduleprogrammeformmodel = new \common\models\CreateModuleToProgrammeForm();
		$modules = Module::getAllModuleList();
		//print_r($modules);exit;
		$programme = Programme::getAllProgrammes();
		$assignmoduleprogramme = new AssignModuleProgramme();
            if($moduleprogrammeformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateModuleToProgrammeForm');
				$records=AssignModuleProgramme::checkExistingRecords($postvariable['module_id'],$postvariable['programme_id'],$postvariable['semister']);
					if(count($records) == 0){
						$assignmoduleprogramme->module_id = $postvariable['module_id'];
						$assignmoduleprogramme->programme_id = ucwords($postvariable['programme_id']);
						$assignmoduleprogramme->semister = ucwords($postvariable['semister']);
						$assignmoduleprogramme->save(false);
						Yii::$app->session->setFlash('moduletoprogrammesaved', "Added successfully");
					}else{
						Yii::$app->session->setFlash('moduletoprogrammeexists', "Already exists");
					}
					return $this->redirect(['module-to-programme-list']); 
			}
			//print_r($programmes); exit;
			return $this->render('add-module-to-programme',[
				'moduleprogrammeformmodel'=>$moduleprogrammeformmodel,
				'modules'=>$modules,
				'programme'=>$programme
			]);    
	    /*} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }*/
	   }
	   
	   public function actionUpdateModuleToProgramme()
    {
	   // try{
	    Yii::$app->cache->flush();
	    $moduleprogrammeformmodel = new \common\models\CreateModuleToProgrammeForm();
		$modules = Module::getAllModuleList();
		$programme = Programme::getAllProgrammes();
		$assignmoduleprogramme = AssignModuleProgramme::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
            if($moduleprogrammeformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateModuleToProgrammeForm');
				$records=AssignModuleProgramme::checkExistingRecords($postvariable['module_id'],$postvariable['programme_id'],$postvariable['semister']);
					if(count($records) == 0){
						$assignmoduleprogramme = AssignModuleProgramme::find()->where(['id' => $postvariable['id']])->one();
						$assignmoduleprogramme->module_id = $postvariable['module_id'];
						$assignmoduleprogramme->programme_id = $postvariable['programme_id'];
						$assignmoduleprogramme->semister = $postvariable['semister'];
						$assignmoduleprogramme->save(false);
						Yii::$app->session->setFlash('moduletoprogrammeupdate', "Added successfully");
					}else{
						Yii::$app->session->setFlash('moduletoprogrammeexists', "Already exists");
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
	    /*} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }*/
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
		Yii::$app->session->setFlash('moduletoprogrammedeleted', "Deleted successfully");
		return $this->redirect(['module-to-programme-list']); 
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   
}
