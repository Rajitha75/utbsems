<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Sign in';
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

	body { background:#F1F1F1; }
	
	.mr-top{ margin-top:85px !important; margin:0px auto; width:95%; }
	
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
    overflow: hidden;
    height: 100%;
}
.login_page .site-login .panel-heading {
    background-color:#8194ac !important
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
	p.help-block.help-block-error{
		    top: 67px !important;    bottom: 25px; left:o; right:auto;		
		}
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
                'action' => 'login',
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username (Email Address)','autocomplete' => 'off']) ?>

                <?= $form->field($model, 'password')->passwordInput(['class' => 'pass','autocomplete' => 'off']) ?>
				<?php if($captcha) { ?>
				<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), 
            ['template' => '<div class="captcha_img">{image}</div><div class="captcha-err" style="float:right;font-size: 10px !important;font-weight: normal !important;color: #e7505a;"></div>'
                . '<a class="refreshcaptcha" href="#">'
                . Html::img('/images/imageName.png',[]).'</a>'
                . 'Verification Code{input}',
            ])->label(FALSE); ?>   
				<?php } ?>
				
                <?//= $form->field($model, 'rememberMe')->checkbox() ?>
				<?php echo $form->field($model, 'encusername')->hiddenInput()->label(false) ?>
				<?php echo $form->field($model, 'encpassword')->hiddenInput()->label(false) ?>
                <div class="login-page-cont">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>
				
                <div class="button-container1">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary lg-pgbtn', 'id' => 'loginbtn', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div></div></div>
    </div>
</div>
</div>

<script src="<?php echo Yii::$app->request->BaseUrl; ?>/js/aes.js"></script>
<script>
/*$('#loginbtn').click(function(event){
    ('.captcha-err').text('');
    var uname=$('#login-page-form #loginform-username').val();
    var password=$('#login-page-form #loginform-password').val();
    
    var verifycode = $('#login-page-form #loginform-verifycode').val();
    if(($("#login-page-form .field-loginform-verifycode").is(":visible") == true)){
        event.preventDefault();
        if(verifycode != ''){
            var encverifycode = function () {
                var tmp = null;
                var eurl = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('../../site/encryptdata'); ?>";
                $.ajax({
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'html',
                    'url': eurl,
                    'data': { 'seckey': seckey, 'string': verifycode },
                    'success': function (data) {
                    console.log(data);
                        tmp = data;
                    }
                });
                return tmp;
            }();
            var vurl = "<?php echo Yii::$app->urlManager->createAbsoluteUrl('../../site/verifycaptchacode'); ?>";
            $.ajax({
                url: vurl,
                type: "post",
                data: {code:encverifycode},
                success: function (data) {
                if(!data){
                $('.captcha-err').text('Verification code is incorrect');
                return false;
                }else{
                $('#login-page-form').submit();
                }
                
                }
            });
        }else{
            $('.captcha-err').text('Please enter Verification code');
            return false;
        }
    }
    $('#loginform-encusername').val(uname);
    $('#loginform-encpassword').val(password);
});*/
</script>