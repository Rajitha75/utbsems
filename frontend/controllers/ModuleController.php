<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use common\models\Module;
use common\models\User;

date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class ModuleController extends \common\controllers\CommonController {

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
                 Yii::$app->controller->action->id != 'exam-officers-login') {
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
						Yii::$app->session->setFlash('modulesaved', "Module is saved successfully");
				}else{
					Yii::$app->session->setFlash('moduleexists', $postvariable['module_name']." already exists");
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
				$moduleids=Module::getModuleIdIfExists($postvariable['module_id']);
				$modulemodel = Module::find()->where(['id' => $postvariable['moduleid']])->one();
					if((($modulemodel['module_name'] != $postvariable['module_name']) && count($modules) == 0) && (($modulemodel['module_id'] != $postvariable['module_id']) && count($moduleids) == 0)){
						$modulemodel->module_id = $postvariable['module_id'];
						$modulemodel->module_name = ucwords($postvariable['module_name']);
						$modulemodel->save(false);
						Yii::$app->session->setFlash('moduleupdated', "Module is Updated successfully");
				}else if((($modulemodel['module_name'] != $postvariable['module_name']) && count($modules) > 0) && (($modulemodel['module_id'] != $postvariable['module_id']) && count($moduleids) > 0)){
					Yii::$app->session->setFlash('moduleexists', 'Module Name "'.$postvariable['module_name'].'" and Module ID "'.$postvariable['module_id'].'" already exists');
				}else if(count($modules) > 0){
					Yii::$app->session->setFlash('moduleexists', 'Module Name '.$postvariable['module_name']." already exists");
				}else if(count($moduleids) > 0){
					Yii::$app->session->setFlash('moduleexists', 'Module ID '.$postvariable['module_id']." already exists");
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
		$module_id = Yii::$app->getRequest()->getQueryParam('module_id') ? Yii::$app->getRequest()->getQueryParam('module_id') : "";
		$module_name = Yii::$app->getRequest()->getQueryParam('module_name') ? Yii::$app->getRequest()->getQueryParam('module_name') : "";
            $uQuery = Module::getAllModuleListRecords($module_id,$module_name);
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
			Yii::$app->session->setFlash('moduledeleted', "Module Deleted Successfully");
        }else if(Yii::$app->request->get('status') == 0){
            $module->status = 1;
			Yii::$app->session->setFlash('moduledeleted', "Module Delete Undo Success");
        }
        $module->save(false);
		return $this->redirect(['modules-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }

}
