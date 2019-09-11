<?php

namespace common\controllers;
use yii\web\Controller;
use Yii;
use yii\helpers\Html;
use yii\db\Query;
use common\models\ProjectLikes;
use common\models\Projects;
use common\models\Communique;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use common\models\EmailTemplates;
use common\models\SmsTemplates;

class CommonController extends \common\controllers\Security
{	
	/* get user types */
	
    
    public static function exceptionMessage($message){
	if($message=='Malicious data entered'){
		throw new BadRequestHttpException($message);
	}else{
		throw new BadRequestHttpException($message);
	}
	}
	
	/* get individual project lik count  */
	
}