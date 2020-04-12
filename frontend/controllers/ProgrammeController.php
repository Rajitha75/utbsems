<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use common\models\Programme;
use common\models\Faculty;
use common\models\User;

date_default_timezone_set('Asia/Kolkata');
/**
 * Site controller
 */
class ProgrammeController extends \common\controllers\CommonController {

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

    /**
     * Logs in a user.
     *
     * @return mixed
     */
   
	public function actionAddProgramme()
    {
	  //  try{
	    Yii::$app->cache->flush();
		//$faculty = Faculty::getAllFaculty();
	    $programmeformmodel = new \common\models\CreateProgrammeForm();
            $programme = new Programme();
            if($programmeformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateProgrammeForm');
				$programmesexist = Programme::getProgrammeIfExists($postvariable['programme_name']);
				if(count($programmesexist) == 0){
                $programme->programme_name = $postvariable['programme_name'];
				$programme->status = 1;
				$programme->save(false);
					Yii::$app->session->setFlash('programmesaved', "Programme is saved successfully");
				}else{
					Yii::$app->session->setFlash('programmeexists', $postvariable['programme_name']." already exists");
				}
				return $this->redirect(['programmes-list']);
			}
			
			return $this->render('add-programme',[
				'programmeformmodel'=>$programmeformmodel,
				//'faculty'=>$faculty
			]);    
	    /*} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }*/
	   }
	   
	   public function actionUpdateProgramme()
    {
	    //try{
	    Yii::$app->cache->flush();
	    $programmeformmodel = new \common\models\CreateProgrammeForm();
			$programmeid = Yii::$app->request->get('id');
			$programmemodel = Programme::find()->where(['id' => $programmeid])->one();
			//$faculty = Faculty::getAllFaculty();
            if($programmeformmodel->load(Yii::$app->request->post())){
				$postvariable=Yii::$app->request->post('CreateProgrammeForm');
				$programmesexist = Programme::getProgrammeIfExists($postvariable['programme_name']);
				if(count($programmesexist) == 0){
					$programmemodel = Programme::find()->where(['id' => $postvariable['programme_id']])->one();
					$programmemodel->programme_name = $postvariable['programme_name'];
					$programmemodel->save(false);
					Yii::$app->session->setFlash('programmeupdated', "Programme is updated successfully");
				}else{
					Yii::$app->session->setFlash('programmeexists', $postvariable['programme_name']." already exists");
				}
				return $this->redirect(['programmes-list']);
			}
			
			return $this->render('update-programme',[
				'programmeformmodel'=>$programmeformmodel,
				'programmedata'=>$programmemodel,
				//'faculty'=>$faculty
			]);    
	   /* } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }*/
	   }
	   
	   public function actionProgrammeDelete($id)
    {
		try{
        $programme = Programme::find()->where(['id' => $id])->one();
        if(Yii::$app->request->get('status') == 1){
            $programme->status = 0;
			Yii::$app->session->setFlash('programmedeleted', "Programme Deleted Successfully");
        }else if(Yii::$app->request->get('status') == 0){
            $programme->status = 1;
			Yii::$app->session->setFlash('programmedeleted', "Programme Delete Undo Success");
        }
        $programme->save(false);
		return $this->redirect(['programmes-list']);
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	   
	   public function actionProgrammesList()
    {
	    try{
	    Yii::$app->cache->flush();
			$programme = new Programme();
            $uQuery = Programme::getAllProgrammeList();
				$query = $uQuery;		
				$count = $uQuery->count();
				return $this->render('programmes-list',[
					 'model'=>$programme,
					'query'=>$query,
					'count'=>$count
				]);   
	    } catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
	   }
	  
	   
}
