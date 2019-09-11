<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\User;
use common\models\Communique;
date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class SiteController extends \common\controllers\CommonController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'ghost-access' => [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	
    public function beforeAction($action) {
        if (\Yii::$app->getUser()->isGuest && yii::$app->controller->action->id != 'captcha'  && Yii::$app->controller->action->id != 'maliciouserror' && Yii::$app->controller->action->id != 'encryptdata' && Yii::$app->controller->action->id != 'newmessagesession' && Yii::$app->controller->action->id != 'getseckey'){
            \Yii::$app->getResponse()->redirect(Yii::$app->request->BaseUrl . '/site/login');
        } else {
            if(Yii::$app->controller->action->id != 'getseckey'){
                return parent::beforeAction($action);
            }else{
                $this->actionGetseckey();
			}
        }
    }
    
    /* backend dashboard deatils */
    public function actionIndex() {
		try{
		$userrole = User::getUserRole(Yii::$app->user->identity->id);
        $uQuery=User::getUserCount();
		$totalUsers = $uQuery->count();			   
       
        return $this->redirect('admin/students-list');
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
       }		
    }
 
    public function actionLogin()
    {
		try{
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new \common\models\LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }

    public function actionLogout()
    {
		try{
        Yii::$app->user->logout();
		unset($_COOKIE['PHPSESSID']);unset($_COOKIE['_csrf']);unset($_COOKIE['_ga']);unset($_COOKIE['_gid']);
		setcookie('PHPSESSID', '', -1, '/');setcookie('_csrf', '', -1, '/');setcookie('_ga', '', -1, '/');setcookie('_gid', '', -1, '/');
        return $this->goHome();
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public function actionMaliciouserror(){
		return $this->render('malicious-error');
	}
	
  
	
	public function actionNotAuthorised() {	
		return $this->render('not-authorised');
    }
    
    public function actionEncryptdata(){
		try{
		$string = Yii::$app->request->post('string');
		$seckey = Yii::$app->request->post('seckey');
		Yii::$app->session['enckey'] = $seckey;
		$data = \common\controllers\CommonController::encrypt($seckey,$string);
		echo $data;exit;
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	}
	
	public function actionNewmessagesession(){
		try{
		Yii::$app->session['newmsg'] =  Yii::$app->request->post('textvalue');
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	}
	
	public function actionGetseckey(){
		try{
		Yii::$app->session['secretkey'] = $key = \Yii::$app->params['secretkey'];
		echo $key;exit;
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	}
}
