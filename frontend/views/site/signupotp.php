<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'OTP';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.termsconds_signup.error {
    color: #F44336 !important;
}
.tnc-error{
color: #F44336 !important;
}
label.error{
	position: absolute;
	top:0;
    right: 0;
    top: 2px;
    font-size: 10px !important;
	color: #ff0000;
    text-align: left;
	padding-left: 30% !important;
    padding-top: 0;
    margin: 0;
    font-weight: normal !important;
}

.incorrectotp{
	font-size: 12px !important;
    font-weight: normal !important;
    color: #ff0000;
	margin-left: 48px;
    margin-top: -19px;
	}
	
	.otperror{
	display:block !important;
	}

#form-signupotppage .signupotp-pgbtn {
    color: #fff;
}
</style>
<div class="site-signup-page">
		<div class="site-login">
                <div class="row">
       			 <div class="col-md-4 col-md-offset-4">
       				 <div class="panel panel-default">
                     <div class="panel-heading"><h3 class="panel-title"><?php echo Html::encode($this->title) ?></h3></div>
		<div class="panel-body">
		<?php if (Yii::$app->getRequest()->getQueryParam('status') && Yii::$app->getRequest()->getQueryParam('status') == 'resendotp'){ ?>
				<p class='login-page-contresendtotp'>OTP has been resent to you mobile number.</p>
				<?php } else{ ?>
    			<p class="login-page-cont">Please enter OTP sent to your mobile.</p>
        <?php } ?>
            <?php 
            
            $form = ActiveForm::begin(['id' => 'form-signupotppage']); ?>

                <?php echo $form->field($model, 'otp_code',[
                    'inputOptions' => [                      
                        'class'=>'form-control signupotp',
						'id'=>'signupotppage-otp_code',
                        'placeholder'=>'Please enter OTP',
                        'autocomplete' => 'off',
                    ]])->label('OTP'); ?>
				<input type="hidden" name="mobile" id="mobile" value="<?php echo $mobile; ?>">
				<?php if (Yii::$app->getRequest()->getQueryParam('status') && Yii::$app->getRequest()->getQueryParam('status') == 'incorrectotp'){ ?>
				<div class='incorrectotp'>Incorrect OTP</div>
				<?php } ?>
				<div class="login-page-cont">
                    <?= Html::a('Sign up', Yii::$app->request->BaseUrl . '/../../signup') ?>
                </div>
				<div class="login-page-cont">
                    <?= Html::a('Resend OTP', Yii::$app->request->BaseUrl . '/../../resendotp?mobile='.$mobile.'&resendotp=resendotp') ?>
                </div>
                <div class="button-container1">
                    <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary signupotp-pgbtn', 'name' => 'signupotp-button','id' => 'signupotp-page-button']) ?>
                </div>
				
            <?php ActiveForm::end(); ?>
        </div>
        </div>
    </div>
    </div>
    
</div>
</div>
<script>
    $(document).ready( function (e)
{
$('#signupotppage-otp_code').keyup(function(){
	$('.incorrectotp').css('display','none');
	$('label.otperror').css('display','none');
});

        $("#form-signupotppage").validate({
			focusCleanup: true,
            rules: {
                'SignupForm[otp_code]': {
                    required: true,
                },
            },
            messages: {
                'SignupForm[otp_code]': {
                    required: "OTP cannot be blank",
                },
            },
            
        });
		
		$('#signupotp-page-button').click(function(){
		if ($('#form-signupotppage').valid() === false) {
		$('.field-signupotppage-otp_code label.error').addClass('otperror');
		return false;
		}else{
		$('.field-signupotppage-otp_code label.error').removeClass('otperror');
		}
		});
});


    </script>