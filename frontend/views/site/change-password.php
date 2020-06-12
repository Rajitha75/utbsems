<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Change Password';
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
label.error{
	color: #ff0000;
}
#passworderr{
	color: #ff0000;
	display: block;
    margin-top: -12px;
    margin-bottom: 14px;
}
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
            <?php $form = ActiveForm::begin(['id' => 'change-password-form',
                'method' => 'post',
                'action' => 'change-password',
                ]); ?>
                
                <?= $form->field($model, 'oldpassword')->passwordInput(['autofocus' => true, 'placeholder' => 'Old Password','autocomplete' => 'off'])->label('Old Password') ?>
				<div id="passworderr"></div>
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'placeholder' => 'New Password','autocomplete' => 'off'])->label('New Password') ?>
				
				<?= $form->field($model, 'reenterpassword')->passwordInput(['autofocus' => true, 'placeholder' => 'Re-enter Password','autocomplete' => 'off'])->label('Re-enter Password') ?>
                <div class="button-container1">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary lg-pgbtn', 'id' => 'change-password-btn', 'name' => 'login-button']) ?>
                </div>
                

            <?php ActiveForm::end(); ?>
        </div></div></div>
    </div>
</div>
</div>

<script>
$(document).ready(function() {
var validatepasswordurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/site/validate-password';
	$('#change-password-btn').click(function(e){
		var oldpassword = $('#changepasswordform-oldpassword').val();
		e.preventDefault();
		$('#passworderr').hide();
		if($("#change-password-form").valid()){
			$('#passworderr').hide();
	 $.ajax({
                    url: validatepasswordurl,
                    type: "post",
                    data: {oldpassword:oldpassword},
                    success: function (data) {
						console.log('data',data);
						if(data == 'false'){
							$('#passworderr').text('Incorrect Password');
							$('#passworderr').show();
							return false;
						}else{
							$("#change-password-form").submit();
						}
                        
                    }
                });
		}
	});
	
	
$("#change-password-form").validate({
            rules: {
				"ChangePasswordForm[oldpassword]": {
                    required: true
				},
				"ChangePasswordForm[password]": {
                    required: true
				},
				"ChangePasswordForm[reenterpassword]": {
					required: true,
					equalTo: "#changepasswordform-password"
				}
			},
            messages: {
				"ChangePasswordForm[oldpassword]": {
                    required: "Please enter Old Password",
				},
				"ChangePasswordForm[password]": {
                    required: "Please enter New Password"
				},
				"ChangePasswordForm[reenterpassword]": {
                    required: "Please Re-enter Password",
                    equalTo: "Passwords do not match"
				}
			},
			});
	});

</script>