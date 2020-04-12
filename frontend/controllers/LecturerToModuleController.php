<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use common\models\Lecturer;
use common\models\User;
use common\models\Module;
use common\models\AssignLecturerModule;

date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class LecturerToModuleController extends \common\controllers\CommonController {

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
    
	   
	    public function actionAddLecturerToModule()
    {
	   // try{
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
						Yii::$app->session->setFlash('lecturertomodulesaved', "Added successfully");
					}else{
						Yii::$app->session->setFlash('lecturertomoduleexists', "Already exists");
					}
					return $this->redirect(['lecturer-to-module-list']); 
			}
			//print_r($programmes); exit;
			return $this->render('add-lecturer-to-module',[
				'lecturermoduleformmodel'=>$lecturermoduleformmodel,
				'modules'=>$modules,
				'lecturer'=>$lecturer
			]);    
	    /*} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }*/
	   }
	   
	   public function actionUpdateLecturerToModule()
    {
	   // try{
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
						Yii::$app->session->setFlash('lecturertomoduleupdate', "Updated successfully");
					}else{
						Yii::$app->session->setFlash('lecturertomoduleexists', "Already exists");
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
	    /*} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }*/
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
		Yii::$app->session->setFlash('lecturertomoduledeleted', "Deleted successfully");
		return $this->redirect(['lecturer-to-module-list']); 
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	   
	   
	   
}
