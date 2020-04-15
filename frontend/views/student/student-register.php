<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Create an Account';
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
#emailerr, #icnoerr{
	color: #ff0000;
	margin-left: 40px;
    position: relative;
    top: -20px;
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
label.error{
	font-weight: inherit;
	color: #ff0000;
}
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
            <p class="login-page-cont">Please fill out the following fields to register</p>
			<?php $form = ActiveForm::begin(['id' => 'register-student-form',
                'method' => 'post',
				'action' => 'student-register'
				]); ?>
                
                <?php echo $form->field($userformmodel, 'ic_no')->textInput(['autocomplete' => 'off', 'placeholder' => 'Brunei IC Number'])->label(false);?>

	<?php echo $form->field($userformmodel, 'passportno')->textInput(['autocomplete' => 'off', 'placeholder' => 'Passport No'])->label(false);?>
	<div id='icnoerr' style="display:none">Please enter passport number if you do not have Brunei IC</div>
	
	<?php echo $form->field($userformmodel, 'email')->textInput(['autocomplete' => 'off', 'placeholder' => 'Email'])->label(false);?>
	<div id='emailerr' style="display:none">Email id already exists</div>
	
	<?php echo $form->field($userformmodel, 'password')->textInput(['autocomplete' => 'off', 'placeholder' => 'Password'])->passwordInput(['placeholder' => 'Password'])->label(false);?>
	
	<?php echo $form->field($userformmodel, 'retype_password')->textInput(['autocomplete' => 'off', 'placeholder' => 'Retype Password'])->passwordInput(['placeholder' => 'Retype Password'])->label(false);?>
					
				<div class="login-page-cont">
                    <?= Html::a('I already have an account', Yii::$app->request->BaseUrl . '/../../login') ?>.
                </div>
                <div class="button-container1">
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary lg-pgbtn', 'id' => 'loginpagebtn', 'name' => 'login-button']) ?>
                </div>
                

            <?php ActiveForm::end(); ?>
        </div></div></div>
    </div>
</div>
</div>

<script>
$(document).ready(function() {
var validateemailurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/site/validate-email';
	$('#loginpagebtn').click(function(e){
		var emailval = $('#createstudentform-email').val();
		var rollnoval = $('#createstudentform-rollno').val();
		e.preventDefault();
		$('#emailerr').hide();
		$('#rollnoerr').hide();
		$('#icnoerr').hide();
		var icno = $('#createstudentform-ic_no').val();
		var passportno = $('#createstudentform-passportno').val();
		if((!icno || icno == '') && (!passportno || passportno == '')){
			$('#icnoerr').show();
		}
		if(emailval && emailval != ''){
			$('#emailerr').hide();
	 $.ajax({
                    url: validateemailurl,
                    type: "post",
                    data: {email:emailval},
                    success: function (data) {
						if(data == 'false'){
							$('#emailerr').text('Email id already exists');
							$('#emailerr').show();
							return false;
						}else{
							$("#register-student-form").submit();
						}
                        
                    }
                });
				
	 
	}else{
		$('#emailerr').text('Please enter email address');
		$('#emailerr').show();
	}
	});
$("#register-student-form").validate({
            rules: {
               /* "CreateStudentForm[name]": {
                    required: true,
				},
				"CreateStudentForm[rollno]": {
                    required: true,
				},*/
				"CreateStudentForm[email]": {
                    required: true,
					email:true
				},
				"CreateStudentForm[password]": {
					required: true,
				},
				"CreateStudentForm[confirmpassword]": {
					equalTo: "#createstudentform-password"
				},
			},
            messages: {
               /* "CreateStudentForm[name]": {
                    required: "Name cannot be blank",
				},
				"CreateStudentForm[rollno]": {
                    required: "Roll No is required",
				},*/
				"CreateStudentForm[email]": {
                    required: "Please enter Email",
					email:"Please enter valid email address"
				},
				"CreateStudentForm[password]": {
                    required: "Please enter Password"
				},
				"CreateStudentForm[confirmpassword]": {
                    required: "Passwords do not match"
				}
			},
			});
			});
</script>