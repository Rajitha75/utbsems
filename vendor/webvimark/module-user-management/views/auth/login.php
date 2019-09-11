<?php
/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\UserManagement\models\forms\LoginForm
 */

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
?>
<style>
body{background:#fff !important;box-shadow:none !important;height:100% !important;}
.login_page.user-adminlog{font-family: 'Titillium Web',sans-serif;background: linear-gradient(rgba(0,0,0,0) 10%,rgba(0, 0, 0, 0.2),rgba(0,0,0,0));background-attachment: fixed;background-size: cover;overflow: hidden;height: 100%;}
.container {width: 100%;padding: 0 3%;}
.page-header-fixed .page-container{position:relative;height:100%;}
#w0-collapse ul#w1, #w0-collapse ul#w2, #w0-collapse ul#w1 li:first-child{margin:0;}
.login_page .site-login1 .panel-heading{background-color: #e33066 !important;padding: 20px 10px;color: #fff;text-transform: uppercase;text-align: center;border: none !important;}
.login_page .site-login1 .button-container1 button{padding: 5px 45px !important;background: #ef5350 !important;border: 1px solid #ef5350;font-size: 20px;font-weight: 600;border-radius: 10px !important;color: #fff !important;}
footer{position:fixed;bottom:0;}
.login_page .site-login1 .button-container1 .lg-pgbtn1:hover{color:#ffa500 !important;}
.refresh_captcha {
    position: relative;
    left: 130px;
}
</style>
<div class="login_page user-adminlog">
<div class="site-login1">
<div class="container" id="login-wrapper">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= UserManagementModule::t('front', 'Administrator Login') ?></h3>
				</div>
				<div class="panel-body log-useradmin">

					<?php $form = ActiveForm::begin([
						'id'      => 'login-form',
						'options'=>['autocomplete'=>'off'],
						'validateOnBlur'=>false,
						'fieldConfig' => [
							'template'=>"{input}\n{error}",
						],
					]) ?>

					<?= $form->field($model, 'username')
						->textInput(['placeholder'=>$model->getAttributeLabel('username'), 'autocomplete'=>'off']) ?>

					<?= $form->field($model, 'password')
						->passwordInput(['placeholder'=>$model->getAttributeLabel('password'), 'autocomplete'=>'off']) ?>
					
					<?php if($captcha) { ?>
							<?= $form->field($model, 'verifyCode')
                    ->widget(Captcha::className(), ['captchaAction' => ['/user-management/auth/captcha'], 'template' => '<div class="captcha_img"><span class="refresh_captcha">'.Html::img(Yii::getAlias('@web').'/themes/metronic/assets/global/plugins/ckeditor/skins/moono/images/refresh.png',[]).'</span>{image}</div><div class="captcha-err" style="float:right;font-size: 10px !important;font-weight: normal !important;color: #e7505a;position: relative;bottom:25px;"></div>'. '{input}']) ?>         
					<?php } ?>
					
					
					<?php //echo $form->field($model, 'rememberMe')->checkbox(['value'=>true]) ?>
                    
					<div class="button-container1">
					<?= Html::submitButton(
						UserManagementModule::t('front', 'Login'),
						['class' => 'btn btn-primary btn-block lg-pgbtn1']
					) ?>
						</div>
					<div class="row registration-block">
						<div class="col-sm-6">
							<?= GhostHtml::a(
								UserManagementModule::t('front', "Registration"),
								['/user-management/auth/registration']
							) ?>
						</div>
						<div class="col-sm-6 text-right">
							<?= GhostHtml::a(
								UserManagementModule::t('front', "Forgot password ?"),
								['/user-management/auth/password-recovery']
							) ?>
						</div>
					</div>
					<?php ActiveForm::end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div></div>

<?php
$css = <<<CSS
html, body {
	background: #eee;
	-webkit-box-shadow: inset 0 0 100px rgba(0,0,0,.5);
	box-shadow: inset 0 0 100px rgba(0,0,0,.5);
	height: 100%;
	min-height: 100%;
	position: relative;
}
#login-wrapper {
	position: relative;
	top: 30%;
}
#login-wrapper .registration-block {
	margin-top: 15px;
}
CSS;

$this->registerCss($css);
?>

<script>

$('#loginform-verifycode-image').trigger('click');
$('.refresh_captcha').click(function(){
$('#loginform-verifycode-image').trigger('click');
});

$('.field-loginform-verifycode').append("<div id='error-msg' style='color: #e7505a;'></div>");

	
	
</script>