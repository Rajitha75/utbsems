<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\bootstrap\Alert;
use common\models\Storage;
use yii\helpers\Url;

$storagemodel = new Storage();
$this->title = 'Create Admin';

$this->params['breadcrumbs'][] = $this->title;
echo "<h1 class='box-title'>$this->title </h1>"; 
?>
<style>
.form-group input, .form-group select, .form-group textarea {
    width: 60% !important;
    float: left !important;
}

.form-group label.control-label{
	float: left !important;
    padding-right: 20px !important;
	width:160px;
}

.form-group{
	width: 94%;
	padding-bottom: 40px;
}


</style>
<div class="row">
        <div class="col-xs-12 col-sm-12">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'admin-create',
			'id' => 'admincreateform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	<?php //echo $form->field($userformmodel, 'userid')->hiddenInput(['autocomplete' => 'off','value'=>!empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : ''])->label('');?>
	
	<?php echo $form->field($userformmodel, 'name')->textInput(['autocomplete' => 'off'])->label('Name <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'password')->passwordInput(['autocomplete' => 'off'])->label('Password <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'confirmpassword')->passwordInput(['autocomplete' => 'off'])->label('Confirm Password <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'email')->textInput(['autocomplete' => 'off'])->label('Email <span class="mandatory">*</span>');?>
	
	<?php echo $form->field($userformmodel, 'mobile')->textInput(['autocomplete' => 'off'])->label('Mobile <span class="mandatory">*</span>');?>
	
	<?php echo $form->field($userformmodel,'gender')->radioList(['Male' => 'Male', 'Female' => 'Female'])->label('Gender <span class="mandatory">*</span>'); ?>

		
		</div>
 
 </div>
 
 <div class="row text-center admin-create-user">
         <div class="form-group">
 <?= Html::submitButton('Submit', ['class' => 'btn btn-primary usersignup']) ?>
 </div>
        
        </div>
		<?php ActiveForm::end(); ?>

<script>

$("#admincreateform").validate({
            rules: {
                "CreateAdminForm[name]": {
                    required: true,
				},
				"CreateAdminForm[password]": {
                    required: true,
				},
				"CreateAdminForm[confirmpassword]": {
					equalTo: "#createadminform-password"
				},
				"CreateAdminForm[email]": {
                    required: true,
                },
				"CreateAdminForm[gender]": {
                    required: true,
				},
				"CreateAdminForm[mobile]": {
                    required: true,
                },
		   },
            messages: {
                "CreateAdminForm[name]": {
                    required: "Name cannot be blank",
				},
				"CreateAdminForm[password]": {
                    required: "Please enter Password",
				},
				"CreateAdminForm[confirmpassword]": {
					equalTo: "Passwords must match"
				},
				"CreateAdminForm[email]": {
                    required: "Please enter Email",
				},
				"CreateAdminForm[gender]": {
                    required: "Please select Gender",
				},
				"CreateAdminForm[mobile]": {
                    required: "Mobile Number is required",
                },
			}
			});
</script>
	
