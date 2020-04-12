
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\bootstrap\Alert;
use common\models\Storage;
use yii\helpers\Url;
$storagemodel = new Storage();
?>
<style>
    label.error{
		color: #ff0000;
		font-weight: normal;
	}
	
	.ui-datepicker-trigger{
		float: right;
		margin-top: -30px;
	}
	
	.bankterms{
		margin-top: -16px;
    display: block;
    font-size: 12px;
    margin-left: 50px;
    width: 82%;
    margin-bottom: 10px;
	}
	img.ui-datepicker-trigger {
    position: absolute;
    right: 72px;
    margin-top: -29px;
}
.icnoformat {
  width: 100%;
  height:100px;
  margin-right: 10px;
  float: left;
}
.field-createstudentform-ic_no_format{
width: 18%;
    z-index: 9999;
    }
   
  .field-createstudentform-ic_no {
    width: 52%;
    margin-left: 50px !important;
    margin-top: 22px !important;
    }
.field-createstudentform-ic_no_format, .field-createstudentform-ic_no {
  float: left;
  margin-right: 5px;
}

#emailerr{
	color: #ff0000;
	margin-left: 50px;
    margin-top: -24px;
}
</style>
<?php 
$this->title = 'Create Lecturer';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'create-lecturer',
			'id' => 'lecturer-createform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	<?php echo $form->field($userformmodel, 'name')->textInput(['value' => (isset($lecturerdata['name'])? $lecturerdata['name'] : ''), 'autocomplete' => 'off'])->label('Name');?>
	
	<?php echo $form->field($userformmodel, 'email')->textInput(['autocomplete' => 'off'])->label('Email');?>
	<div id='emailerr' style="display:none">Email id already exists</div>
	
	<?php echo $form->field($userformmodel, 'password')->textInput(['autocomplete' => 'off', 'placeholder' => 'Password'])->passwordInput()->label('Password');?>
	
	<?php echo $form->field($userformmodel, 'retype_password')->textInput(['autocomplete' => 'off', 'placeholder' => 'Retype Password'])->passwordInput()->label('Retype Password');?>
	
		</div>
 
 </div>
  <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Create', ['class' => 'btn btn-primary lecturersignup', 'id' => 'lecturersignup']) ?>
 </div>
        
        </div>
					</div>

		<?php ActiveForm::end(); ?>
		
		
<script>
$(document).ready(function() {
var validateemailurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/site/validate-email';
$('#createlecturerform-email').keyup(function(){
	$('#emailerr').hide();
});
	$('#lecturersignup').click(function(e){
		var emailval = $('#createlecturerform-email').val();
		e.preventDefault();
		$('#emailerr').hide();
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
							$("#lecturer-createform").submit();
						}
                        
                    }
                });
				
	 
	}else{
		$('#emailerr').text('Please enter email address');
		$('#emailerr').show();
	}
	});
$("#lecturer-createform").validate({
            rules: {
				"CreateLecturerForm[name]": {
                    required: true
				},
				"CreateLecturerForm[email]": {
                    required: true,
					email:true
				},
				"CreateLecturerForm[password]": {
					required: true,
				},
				"CreateLecturerForm[retype_password]": {
					required: true,
					equalTo: "#createlecturerform-password"
				},
			},
            messages: {
				"CreateLecturerForm[name]": {
                    required: "Please enter Name",
				},
				"CreateLecturerForm[email]": {
                    required: "Please enter Email",
					email:"Please enter valid email address"
				},
				"CreateLecturerForm[password]": {
                    required: "Please enter Password"
				},
				"CreateLecturerForm[retype_password]": {
					required: "Please Re-enter password",
                    equalTo: "Passwords do not match"
				}
			},
			});
			});
</script>
