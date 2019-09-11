<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Signup';
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

#form-signuppage #sign-up-page-button {
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
    			<p class="login-page-cont">Please fill out the following fields to signup</p>
        
            <?php 
            
            
            $form = ActiveForm::begin(['id' => 'form-signuppage']); ?>

                <?php echo $form->field($model, 'email',[
                    'inputOptions' => [                      
                        'class'=>'form-control signupemail',
						'id'=>'signup-email',
                        'placeholder'=>'Username (Email / Mobile)',
                        'autocomplete' => 'off',
                    ]]) ?>
				
				<?php
                    $countrycodes = yii\helpers\ArrayHelper::map(\common\models\User::countryCodes(), 'countries_isd_code', 'countries_name');
                    
                    //echo $form->field($model, 'countrycode')->dropDownList($countrycodes, ['prompt' => 'Select Country Code'])->label(false);
                    echo $form->field($model, 'countrycode',[
                    'inputOptions' => [                      
                        'id'=>'signup-countrycode']])->dropDownList($countrycodes)->label(false);
					?>  

                <?php echo $form->field($model, 'password',[
                    'inputOptions' => [                      
                        'class'=>'form-control signuppassword',
						'id'=>'signup-password',
                        'type'=>'password',
                        'autocomplete' => 'off',
                    ]])->passwordInput() ?>
            
                <?php echo $form->field($model, 'confirmpassword',[
                    'inputOptions' => ['id'=>'signup-confirmpassword']])->passwordInput() ?>
            
                 
				<div class="form-group">
				<input type="checkbox" name="terms" id="terms-signup" value="" style="width: 5%; float: left; height: 15px;">
				<span class="termsconds_signup"> &nbsp;&nbsp; I accept <a href="terms-of-use" class="tnc" target="_blank">terms and conditions</a></span>
			</div>	
				<div class="login-page-cont">
                    Already Registered? <?= Html::a('Sign in', Yii::$app->request->BaseUrl . '/../../login') ?>
                </div>
                <div class="button-container1">
                    <?php echo Html::submitButton('Signup', ['class' => 'btn btn-primary lg-pgbtn', 'name' => 'signup-button','id' => 'sign-up-page-button']) ?>
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

$('#form-signuppage .field-signup-countrycode').hide();
$('#form-signuppage #signup-email').on('keyup',function(){
	$('#form-signuppage .field-signup-countrycode > label').css('display','none');
	var username = $('#form-signuppage #signup-email').val(); 
	if(username.match(/^[0-9]{10}$/)){
	$('#form-signuppage .field-signup-countrycode').show();
	$('#form-signuppage #signup-countrycode').addClass('validatecountrycode');

	$( ".field-signup-email" ).addClass( "selectcountry-code" );
	$( "#signup-countrycode" ).addClass( "selectcountry-code_select" );
	$( "#signup-email" ).addClass( "selectcountry-code_input" );

}else{
	
	$('#form-signuppage #signup-countrycode').removeClass('validatecountrycode');
	$(' .field-signup-countrycode').hide();
 }
});
$('#form-signuppage .help-block-error').css('display','none');
if($('.field-signup-email').hasClass('has-error') && $('#form-signuppage .field-signup-email .help-block-error').text()=='This email address has already been taken.'){
$('#form-signuppage .field-signup-email .help-block-error').css('display','block');
}
$('#signup-password').val('');
$('#signup-confirmpassword').val('');
$('#signup-usertype').val('');
    $('#terms-signup').change(function(){
        var terms_cond = $('#terms-signup:checkbox:checked').length;
        if(terms_cond<=0){
            $('.termsconds_signup').addClass('error');
            return false;
        }else{
            $('.termsconds_signup').removeClass('error');
        }
    });
    $("#form-signuppage .field-signupform-media_agency_ref_id").hide();
    $("select[class^=signupusertype]").change(function(){
        var usertype = $("select[class^=signupusertype]").val();
        if(usertype == 9){
            $(".field-signupform-media_agency_ref_id").show();
        }else{
            $(".field-signupform-media_agency_ref_id").hide();
        }
});
$("#form-signuppage").validate({
            rules: {
				"SignupForm[email]":{
					required:true,
				},
                "SignupForm[confirmpassword]": {
                    equalTo: "#form-signuppage #signup-password"
                },
            },
            messages: {
                "SignupForm[confirmpassword]": {
                    equalTo:"Passwords do not match"
                },
            }
        });
});
    </script>