<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Lecturer Login';
$this->params['breadcrumbs'][] = $this->title;
/*
if(($flash = Yii::$app->session->getFlash('password_changed')) || ($flash = Yii::$app->session->getFlash('forgotpassword'))){
    echo Alert::widget(['options' => ['class' => 'alert-success chag-pwds'], 'body' => $flash]);
}
 */
if(($flash = Yii::$app->session->getFlash('mailnotconfirmed')) || ($flash = Yii::$app->session->getFlash('statusnotenabled')) || ($flash = Yii::$app->session->getFlash('resendemailsuccess'))){
    echo Alert::widget(['options' => ['class' => 'alert-success mr-top'], 'body' => $flash]);
}

?>
<style>
html.intro-over, html.intro-over body {
    overflow-y: auto !important;
    overflow-x: hidden !important;
}
	body { background:#F1F1F1; }
	
	.mr-top{ margin-top:85px !important; margin:0px auto; width:95%; }
	.intro-over div#w0 .modal-body.mdl-bdy.inc-height {min-height: 450px !important;}
    .front-noti{ 
        position: fixed;
        top: 40%;
        left: 50%;
        z-index: 9999;
        margin-left: -245px;
    }
	
	.login_page {
    font-family: 'Titillium Web',sans-serif;
    background: linear-gradient(rgba(0,0,0,0) 10%,rgba(0, 0, 0, 0.2),rgba(0,0,0,0));
    padding: 10% 0 0 0;
    overflow: hidden;
    background-attachment: fixed;
    background-size: cover;
    height: 100%;
}
.login_page .site-login .panel-heading {
    background-color: #8194ac !important;
    padding: 20px 10px;
    color: #fff;
    text-transform: uppercase;
    text-align: center;
	border:none !important;
}
.login_page .site-login .panel-heading h3.panel-title {
    font-weight: 600;
    font-size: 18px;
    color: #fff;
    font-family: 'Titillium Web',sans-serif;
}
.footer {
    background: #261E1E;
    position: relative;
    width: 100%;
    bottom: 0;
}
.login_page .button-container1 .lg-pgbtn{color:#fff;}
.card .input-container select{border:1px solid #ddd;}
	
	@media (max-width: 400px) {
	 p.help-block.help-block-error{/*top: 67px !important;*/bottom: 25px; left:o; right:auto;}
	}
</style>
<div class="login_page">
<div class="site-login">
    

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
        <div class="panel-heading">
        	<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
		</div>
        	<div class="panel-body">
            <p class="login-page-cont">Please fill out the following fields to login</p>
            <?php $form = ActiveForm::begin(['id' => 'login-page-form',
                'method' => 'post',
                'action' => 'lecturer-login',
                ]); ?>
                
                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Email','autocomplete' => 'off']) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
				<?php if($captcha) { ?>
				<?= $form->field($model, 'pageVerifyCode')->widget(Captcha::className(), 
            ['template' => '<div class="captcha_img"><span class="refresh_captcha">'.Html::img(Yii::getAlias('@web').'/themes/metronic/assets/global/plugins/ckeditor/skins/moono/images/refresh.png',[]).'</span>{image}</div><div class="captcha-err" style="float:right;font-size: 10px !important;font-weight: normal !important;color: #e7505a;position: relative;bottom:25px;"></div>'. '{input}'])->label(FALSE); ?>     
				<?php } if(Yii::$app->session->getFlash('incorrectcaptcha') && Yii::$app->session->getFlash('incorrectcaptcha') != '') { ?>
				<div><?php echo Yii::$app->session->getFlash('incorrectcaptcha'); ?></div>
				<?php } ?>
                <?php //echo $form->field($model, 'rememberMeLogin')->checkbox() ?>
				<?php //echo $form->field($model, 'encusername')->hiddenInput()->label(false) ?>
				<?php //echo $form->field($model, 'encpassword')->hiddenInput()->label(false) ?>
				
                <div class="button-container1">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary lg-pgbtn', 'id' => 'loginpagebtn', 'name' => 'login-button']) ?>
                </div>
                

            <?php ActiveForm::end(); ?>
        </div></div></div>
    </div>
</div>
</div>

<script>

$('#loginform-pageverifycode-image').trigger('click');

$('.refresh_captcha').click(function(){
    $('#loginform-pageverifycode-image').trigger('click');
});

</script>