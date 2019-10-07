<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Student Register';
$this->params['breadcrumbs'][] = $this->title;
/*
if(($flash = Yii::$app->session->getFlash('password_changed')) || ($flash = Yii::$app->session->getFlash('forgotpassword'))){
    echo Alert::widget(['options' => ['class' => 'alert-success chag-pwds'], 'body' => $flash]);
}
 */
if(($flash = Yii::$app->session->getFlash('mailnotconfirmed')) || ($flash = Yii::$app->session->getFlash('statusnotenabled')) || ($flash = Yii::$app->session->getFlash('resendemailsuccess'))){
    echo Alert::widget(['options' => ['class' => 'alert-success mr-top'], 'body' => $flash]);
}
$fromyear = date('Y', strtotime('-20 years'));
$range = range($fromyear, $fromyear+40);
$years = array_combine($range, $range);
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
    background-color: #e33066 !important;
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

	.form-group label.control-label{
	float: left !important;
    padding-right: 20px !important;
	width:160px;
}
.form-group input, .form-group select, .form-group textarea {
    width: 70% !important;
    float: left !important;
}

.field-createstudentform-gender, .field-createstudentform-martial_status{
	width:33%
}
</style>

<div class="login_page">
<div class="site-login">
    

    <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
        <div class="panel-heading">
        	<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
		</div>
        	<div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'register-student-form',
                'method' => 'post',
				'action' => 'student-register',
				'options' => ['enctype' => 'multipart/form-data'],
				]); ?>
	<div class="col-xs-8 col-sm-6">
		<fieldset>
    <legend>Personal Information:</legend>
                
				<?php echo $form->field($userformmodel, 'name')->textInput(['autocomplete' => 'off'])->label('Name <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'password')->textInput(['autocomplete' => 'off'])->passwordInput()->label('Password <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'confirmpassword')->textInput(['autocomplete' => 'off'])->passwordInput()->label('Confirm Password <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'rollno')->textInput(['autocomplete' => 'off'])->label('Roll No <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'rumpun')->dropDownList([ 'XLR8' => 'XLR8', 'PRO-XTIV' => 'PRO-XTIV', 'XCEL' => 'XCEL', 'CRTIV' => 'CRTIV'],['prompt' => 'Select Rumpun'])->label('Rumpun'); ?>

	<?php echo $form->field($userformmodel, 'nationality')->dropDownList([ 'Malay' => 'Malay', 'Chinese' => 'Chinese', 'Indian' => 'Indian', 'Other' => 'Other'],['prompt' => 'Select Nationality'])->label('Nationality <span class="mandatory">*</span>'); ?>

	<?php echo $form->field($userformmodel, 'nationalityother')->textInput(['autocomplete' => 'off'])->label('Other'); ?>
	
	<?php echo $form->field($userformmodel, 'ic_no')->textInput(['autocomplete' => 'off'])->label('IC No. <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'Select IC Color'])->label('IC Color <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'passportno')->textInput(['autocomplete' => 'off'])->label('Passport No <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'race')->dropDownList(['Malay' => 'Malay', 'Chinese' => 'Chinese', 'Indian' => 'Indian', 'Other' => 'Other'],['prompt' => 'Select Race'])->label('Race <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'raceother')->textInput(['autocomplete' => 'off'])->label('Other'); ?>

	<?php echo $form->field($userformmodel, 'religion')->dropDownList([ 'Muslim' => 'Muslim', 'Buddhism' => 'Buddhism', 'Hinduism' => 'Hinduism', 'Christianity' => 'Christianity', 'Other' => 'Other'],['prompt' => 'Select Religion'])->label('Religion <span class="mandatory">*</span>'); ?>

	<?php echo $form->field($userformmodel, 'religionother')->textInput(['autocomplete' => 'off'])->label('Other'); ?>
	
	<?php echo $form->field($userformmodel,'gender')->radioList(['Male' => 'Male', 'Female' => 'Female'])->label('Gender <span class="mandatory">*</span>'); ?>

	<?php echo $form->field($userformmodel,'martial_status')->radioList(['Married' => 'Married', 'Single' => 'Single'])->label('Martial Status <span class="mandatory">*</span>');

    echo $form->field($userformmodel, 'dob')->widget(\yii\jui\DatePicker::classname(), [
			'value'  => '1232', 'dateFormat' => 'dd-MM-yyyy', 'options' => ['class' => 'form-control'],
                        'options' => ['class' => 'form-control'],            
                        'clientOptions' => [
                            'changeMonth' => true,
                            'yearRange'=> '-70:-18',
                            'defaultDate' => '-70y',
                            'changeYear' => true,
                            'maxDate' => 0, 
                            'showOn' => 'button',
                            'buttonImage' => 'images/calendar.gif',
                            'buttonImageOnly' => true,
                            'buttonText' => 'Select date',
                             'buttonImage' => Yii::$app->request->BaseUrl.'/images/calendar.gif',
                        ],
		])->textInput(['readonly' => true])->label('Date of Birth <span class="mandatory">*</span>'); ?>
		
		<?php echo $form->field($userformmodel, 'place_of_birth')->textInput(['autocomplete' => 'off'])->label('Place of Birth <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'telephone_mobile')->textInput(['autocomplete' => 'off'])->label('Telephone No. (Mobile): <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'tele_home')->textInput(['autocomplete' => 'off'])->label('Telephone No. (Home):');?>

		<?php echo $form->field($userformmodel, 'email')->textInput(['autocomplete' => 'off'])->label('Email <span class="mandatory">*</span>');?>
	
		<?php echo $form->field($userformmodel, 'emailother')->textInput(['autocomplete' => 'off'])->label('Email (other)');?>
		
		<?php echo $form->field($userformmodel, 'lastschoolname')->textInput(['autocomplete' => 'off'])->label('Name of Last School Attended <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'type_of_entry')->dropDownList(['HECAS' => 'HECAS', 'In-service' => 'In-service', 'Other' => 'Other'],['prompt' => 'Select Type of Entry'])->label('Type of Entry <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'typeofentryother')->textInput(['autocomplete' => 'off'])->label('Other'); ?>

		<?php echo $form->field($userformmodel, 'specialneeds')->textarea(['rows' => 2,'autocomplete' => 'off' ])->label('Special Needs'); ?>

		<?php echo $form->field($userformmodel, 'user_image')->fileInput(['class' => 'with-preview accept-gif|jpg|png|jpeg|bmp profile-img'])->label('Profile Image'); ?>
		</fieldset>
		<fieldset>
    <legend>Postal Address:</legend>
		<?php echo $form->field($userformmodel, 'address')->textarea(['rows' => 2,'autocomplete' => 'off' ])->label('Postal Address <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'address2')->textarea(['rows' => 2,'autocomplete' => 'off' ])->label('Address Line 2 <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'address3')->textarea(['rows' => 2,'autocomplete' => 'off' ])->label('Address Line 3 <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'postal_code')->textInput(['autocomplete' => 'off'])->label('Postal Code <span class="mandatory">*</span>');?>

	</fieldset>

	<fieldset>
	<legend>Bank Details:</legend>
	
	<?php echo $form->field($userformmodel, 'bank_name')->dropDownList([ 'BAIDURI' => 'BAIDURI', 'BIBD' => 'BIBD', 'STANDARD CHARTERED BANK' => 'STANDARD CHARTERED BANK', 'TAIB' => 'TAIB'],['prompt' => 'Select Bank'])->label('Bank Name <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'account_no')->textInput(['autocomplete' => 'off'])->label('Bank Account No <span class="mandatory">*</span>');?>
		</fieldset>
	<fieldset>
		</div>
	<div class="col-xs-8 col-sm-6">

	<fieldset>
    <legend>Parents Information:</legend>
		<?php echo $form->field($userformmodel, 'father_name')->textInput(['autocomplete' => 'off'])->label('Father/Guardian Name <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'gaurdian_relation')->textInput(['autocomplete' => 'off'])->label('Guardian Relation');?>

		<?php echo $form->field($userformmodel, 'fathericno')->textInput(['autocomplete' => 'off'])->label('Father/Guardian IC No <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'father_ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'Select Father/Gaurdian IC Color'])->label('Father/Gaurdian IC Color <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'father_mobile')->textInput(['autocomplete' => 'off'])->label('Father\'s Telephone No <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mobile_home')->textInput(['autocomplete' => 'off'])->label('Telephone No (Home)');?>

		<?php echo $form->field($userformmodel, 'gaurdian_employment')->textInput(['autocomplete' => 'off'])->label('Father/Guardian Employment');?>

		<?php echo $form->field($userformmodel, 'gaurdian_employer')->textInput(['autocomplete' => 'off'])->label('Father/Guardian Employer');?>

		<?php echo $form->field($userformmodel, 'remarks')->textarea(['rows' => 2,'autocomplete' => 'off'])->label('Remarks');?>

		<?php echo $form->field($userformmodel, 'telphone_work')->textInput(['autocomplete' => 'off'])->label('Telephone No. (Work)');?>

		<?php echo $form->field($userformmodel, 'mother_name')->textInput(['autocomplete' => 'off'])->label('Mother Name <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mothericno')->textInput(['autocomplete' => 'off'])->label('Mother IC No <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mother_ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'Select Mother IC Color'])->label('Mother IC Color <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mother_mobile')->textInput(['autocomplete' => 'off'])->label('Mother\'s Telephone No <span class="mandatory">*</span>');?>
	</fieldset>
	
	<legend>Programme Information:</legend>

	<?php echo $form->field($userformmodel, 'sponsor_type')->dropDownList([ 'Government Scholarship' => 'Government Scholarship', 'BSP Scholarship' => 'BSP Scholarship', 'Fee Paying' => 'Fee Paying', 'Other' => 'Other'],['prompt' => 'Select Sponsor Type'])->label('Sponsor Type <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'sponsor_type_other')->textInput(['autocomplete' => 'off' ])->label('Other'); ?>
	
	<?php echo $form->field($userformmodel, 'programme_name')
		->dropDownList(['Bachelor of Business in Applied Economics and Finance' => 'Bachelor of Business in Applied Economics and Finance',
		'Bachelor of Business in Accounting and Information Systems' => 'Bachelor of Business in Accounting and Information Systems',
		'Bachelor of Business in Business Information System' => 'Bachelor of Business in Business Information System',
		'Bachelor of Business in Business Information System(Part Time)' => 'Bachelor of Business in Business Information System(Part Time)',
		'Bachelor of Business in Finance and Risk Management' => 'Bachelor of Business in Finance and Risk Management',
		'Government Scholarship' => 'Government Scholarship',
		'Bachelor of Business in Marketing and Information Systems' => 'Bachelor of Business in Marketing and Information Systems',
		'Bachelor of Business in Technology Management' => 'Bachelor of Business in Technology Management',
		'Master in Management and Technology' => 'Master in Management and Technology',
		'Bachelor of Science in Computing with Data Analytic' => 'Bachelor of Science in Computing with Data Analytic',
		'Bachelor of Science in Creative Multimedia' => 'Bachelor of Science in Creative Multimedia',
		'Bachelor of Science in Computer Network and Security' => 'Bachelor of Science in Computer Network and Security',
		'Bachelor of Science in Computing' => 'Bachelor of Science in Computing',
		'Bachelor of Science in Digital Media' => 'Bachelor of Science in Digital Media',
		'Bachelor of Science in Internet Computing' => 'Bachelor of Science in Internet Computing',
		'Master in Computer Information System' =>  'Master in Computer Information System',
		'Bachelor of Science in Applied Mathematics and Economics' => 'Bachelor of Science in Applied Mathematics and Economics',
		'Bachelor of Science in Food Science and Technology' => 'Bachelor of Science in Food Science and Technology',
		'Bachelor of Science in Architecture' => 'Bachelor of Science in Architecture',
		'Bachelor of Science in Product Design' => 'Bachelor of Science in Product Design',
		'Bachelor of Engineering in Civil Engineering' => 'Bachelor of Engineering in Civil Engineering',
		'Bachelor of Engineering in Chemical Engineering' => 'Bachelor of Engineering in Chemical Engineering',
		'Bachelor of Engineering in Civil and Structural Engineering' => 'Bachelor of Engineering in Civil and Structural Engineering',
		'Bachelor of Engineering in Electrical and Electronics' => 'Bachelor of Engineering in Electrical and Electronics',
		'Bachelor of Engineering in Mechatronic Engineering' => 'Bachelor of Engineering in Mechatronic Engineering',
		'Bachelor of Engineering in Mechanical Engineering' => 'Bachelor of Engineering in Mechanical Engineering',
		'Bachelor of Engineering in Petroleum Engineering' => 'Bachelor of Engineering in Petroleum Engineering',
		'Master of Science in Mechanical Engineering' => 'Master of Science in Mechanical Engineering',
		'Master in Water Resources and Environmental Engineering' => 'Master in Water Resources and Environmental Engineering',
		'Bachelor of Business in Business Information Management' => 'Bachelor of Business in Business Information Management',
		'Bachelor of Business in Business Information Management (Part Time)' => 'Bachelor of Business in Business Information Management (Part Time)',
		'Master in Management and Technology (Part Time)' => 'Master in Management and Technology (Part Time)',
		'Bachelor of Science in Internet Computing (Part Time)' => 'Bachelor of Science in Internet Computing (Part Time)',
		'Master in Information Security' => 'Master in Information Security',
		'Bachelor of Science in Computer and Information Security' => 'Bachelor of Science in Computer and Information Security',
		'Master in Information Security (Part Time)' => 'Master in Information Security (Part Time)',
		'Master of Science in Electrical and Electronic Engineering' => 'Master of Science in Electrical and Electronic Engineering'],['prompt' => 'Select Programme Name'])->label('Programme Name <span class="mandatory">*</span>');?>

		

		<?php echo $form->field($userformmodel, 'entry')->dropDownList(['First Year' => 'First Year', 'Second Year' => 'Second Year'], ['prompt' => 'Select Entry'])->label('Entry <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'status_of_student')->dropDownList(['Current Student' => 'Current Student', 'Withdrawn' => 'Withdrawn'], ['prompt' => 'Select Status of Student'])->label('Status of Student <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'status_remarks')->textarea(['rows' => 2,'autocomplete' => 'off'])->label('Status Remarks');?>

		<?php echo $form->field($userformmodel, 'intake')->dropDownList($years,['prompt' => 'Select Intake No'])->label('Intake No. <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mode')->dropDownList(['Full Time' => 'Full Time', 'Part Time'=> 'Part Time'],['prompt' => 'Select Mode'])->label('Mode <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'utb_email_address')->textInput(['autocomplete' => 'off'])->label('UTB Email Address <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'degree_classification')->textInput(['autocomplete' => 'off'])->label('Degree Classification <span class="mandatory">*</span>');?>

		<?php 
		echo $form->field($userformmodel, 'date_of_registration')->widget(\yii\jui\DatePicker::classname(), [
			'value'  => '1232', 'dateFormat' => 'dd-MM-yyyy', 'options' => ['class' => 'form-control'],
                        'options' => ['class' => 'form-control'],            
                        'clientOptions' => [
                            'changeMonth' => true,
                            'yearRange'=> '-20:0',
                            'defaultDate' => '-70y',
                            'changeYear' => true,
                            'maxDate' => 0, 
                            'showOn' => 'button',
                            'buttonImage' => 'images/calendar.gif',
                            'buttonImageOnly' => true,
                            'buttonText' => 'Select date',
                             'buttonImage' => Yii::$app->request->BaseUrl.'/images/calendar.gif',
                        ],
		])->textInput(['readonly' => true])->label('Date of Registration <span class="mandatory">*</span>'); ?>

<?php 
		echo $form->field($userformmodel, 'date_of_leaving')->widget(\yii\jui\DatePicker::classname(), [
			'value'  => '1232', 'dateFormat' => 'dd-MM-yyyy', 'options' => ['class' => 'form-control'],
                        'options' => ['class' => 'form-control'],            
                        'clientOptions' => [
                            'changeMonth' => true,
                            'yearRange'=> '-20:+0',
                            'defaultDate' => '-70y',
                            'changeYear' => true,
                            'maxDate' => 0, 
                            'showOn' => 'button',
                            'buttonImage' => 'images/calendar.gif',
                            'buttonImageOnly' => true,
                            'buttonText' => 'Select date',
                             'buttonImage' => Yii::$app->request->BaseUrl.'/images/calendar.gif',
                        ],
		])->textInput(['readonly' => true])->label('Date of Leaving'); ?>

<?php echo $form->field($userformmodel, 'previous_roll_no')->textInput(['autocomplete' => 'off'])->label('Previous Roll No');?>

<?php echo $form->field($userformmodel, 'previous_programme_name')->textInput(['autocomplete' => 'off'])->label('Previous Programmme Name');?>

<?php echo $form->field($userformmodel, 'previous_intake_no')->dropDownList($years,['prompt' => 'Select Previous Intake No'])->label('Previous Intake No');?>

<?php echo $form->field($userformmodel, 'previous_utb_email')->textInput(['autocomplete' => 'off'])->label('Previous UTB Email');?>
		</fieldset>				
					</div>
		


				
                

</div>
<div class="login-page-cont">
                    Already Registered? <?= Html::a('Login', Yii::$app->request->BaseUrl . '/../../student-login') ?>.
                </div>
				
                <div class="button-container1">
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'id' => 'studentregister', 'name' => '']) ?>
				</div>
				
				<?php ActiveForm::end(); ?>
	</div></div>
    </div>
</div>
</div>

<script>
$(document).ready(function(){
	$('.field-createstudentform-nationalityother').hide();
	$('.field-createstudentform-raceother').hide();
	$('.field-createstudentform-religionother').hide();
	$('.field-createstudentform-typeofentryother').hide();
	$('.field-createstudentform-sponsor_type_other').hide();
	
	var studentother = $('#createstudentform-nationality').val();
	var raceother = $('#createstudentform-race').val();
	var religionother = $('#createstudentform-religion').val();
	var typeofentryother = $('#createstudentform-type_of_entry').val();
	if(studentother && studentother=='Other'){
		$('.field-createstudentform-nationalityother').show();
	}else{
			$('.field-createstudentform-nationalityother').hide();
	}

	if(raceother && raceother=='Other'){
		$('.field-createstudentform-raceother').show();
	}else{
			$('.field-createstudentform-raceother').hide();
	}

	if(religionother && religionother=='Other'){
		$('.field-createstudentform-religionother').show();
	}else{
			$('.field-createstudentform-religionother').hide();
	}

	if(typeofentryother && typeofentryother=='Other'){
		alert('sds')
		$('.field-createstudentform-typeofentryother').show();
	}else{
			$('.field-createstudentform-typeofentryother').hide();
	}

	$('#createstudentform-nationality').change(function(){
		if($(this).val() == 'Other'){
			$('.field-createstudentform-nationalityother').show();
		}else{
			$('.field-createstudentform-nationalityother').hide();
		}
	})
	$('#createstudentform-race').change(function(){
		if($(this).val() == 'Other'){
			$('.field-createstudentform-raceother').show();
		}else{
			$('.field-createstudentform-raceother').hide();
		}
	})
	$('#createstudentform-religion').change(function(){
		if($(this).val() == 'Other'){
			$('.field-createstudentform-religionother').show();
		}else{
			$('.field-createstudentform-religionother').hide();
		}
	})

	$('#createstudentform-type_of_entry').change(function(){
		if($(this).val() == 'Other'){
			$('.field-createstudentform-typeofentryother').show();
		}else{
			$('.field-createstudentform-typeofentryother').hide();
		}
	})

	$('#createstudentform-sponsor_type').change(function(){
		if($(this).val() == 'Other'){
			$('.field-createstudentform-sponsor_type_other').show();
		}else{
			$('.field-createstudentform-sponsor_type_other').hide();
		}
	})
})

$("#register-student-form").validate({
            rules: {
                "CreateStudentForm[name]": {
                    required: true,
				},
				"CreateStudentForm[password]": {
                    required: true,
				},
				"CreateStudentForm[confirmpassword]": {
					equalTo: "#createstudentform-password"
				},
				"CreateStudentForm[rollno]": {
                    required: true,
				},
				"CreateStudentForm[nationality]": {
                    required: true,
				},
				"CreateStudentForm[passportno]": {
                    required: true,
				},
				"CreateStudentForm[ic_no]": {
                    required: true,
				},
				"CreateStudentForm[ic_color]": {
                    required: true,
				},
				"CreateStudentForm[race]": {
                    required: true,
				},
				"CreateStudentForm[religion]": {
                    required: true,
				},
				"CreateStudentForm[gender]": {
                    required: true,
				},
				"CreateStudentForm[martial_status]": {
                    required: true,
				},
				"CreateStudentForm[dob]": {
                    required: true,
				},
				"CreateStudentForm[place_of_birth]": {
                    required: true,
				},
				"CreateStudentForm[telephone_mobile]": {
                    required: true,
				},
				"CreateStudentForm[email]": {
                    required: true,
				},
				"CreateStudentForm[lastschoolname]": {
                    required: true,
				},"CreateStudentForm[type_of_entry]": {
                    required: true,
				},
				"CreateStudentForm[father_name]": {
                    required: true,
				},
				"CreateStudentForm[fathericno]": {
                    required: true,
				},
				"CreateStudentForm[father_ic_color]": {
                    required: true,
				},
				"CreateStudentForm[mother_ic_color]": {
                    required: true,
				},
				"CreateStudentForm[father_mobile]": {
                    required: true,
				},
				"CreateStudentForm[mother_name]": {
                    required: true,
				},
				"CreateStudentForm[mothericno]": {
                    required: true,
				},
				"CreateStudentForm[mother_mobile]": {
                    required: true,
				},
				"CreateStudentForm[address]": {
                    required: true,
				},
				"CreateStudentForm[address2]": {
                    required: true,
				},
				"CreateStudentForm[address3]": {
                    required: true,
				},
				"CreateStudentForm[postal_code]": {
                    required: true,
				},
				"CreateStudentForm[bank_name]": {
                    required: true,
				},
				"CreateStudentForm[account_no]": {
                    required: true,
				},
				"CreateStudentForm[sponsor_type]": {
                    required: true,
				},
				"CreateStudentForm[programme_name]": {
                    required: true,
				},
				"CreateStudentForm[intake]": {
                    required: true,
				},
				"CreateStudentForm[entry]": {
                    required: true,
                },
				"CreateStudentForm[user_image]": {
					accept:"jpg,png,jpeg,bmp"
                },
				"CreateStudentForm[status_of_student]": {
                    required: true,
                },
				"CreateStudentForm[mode]": {
                    required: true,
                },
				"CreateStudentForm[utb_email_address]": {
                    required: true,
                },
				"CreateStudentForm[date_of_registration]": {
                    required: true,
                },
		   },
            messages: {
                "CreateStudentForm[name]": {
                    required: "Name cannot be blank",
				},
				"CreateStudentForm[password]": {
                    required: "Please enter Password",
				},
				"CreateStudentForm[confirmpassword]": {
					equalTo: "Passwords must match"
				},
				"CreateStudentForm[rollno]": {
                    required: "Roll No is required",
				},
				"CreateStudentForm[nationality]": {
                    required: "Please select Nationality",
				},
				"CreateStudentForm[passportno]": {
                    required: "Please enter Passport No",
				},
				"CreateStudentForm[ic_no]": {
                    required: "Please enter IC No",
				},
				"CreateStudentForm[ic_color]": {
                    required: "Please select IC Color",
				},
				"CreateStudentForm[race]": {
                    required: "Please enter Race",
				},
				"CreateStudentForm[religion]": {
                    required: "Please select Religion",
				},
				"CreateStudentForm[gender]": {
                    required: "Please select Gender",
				},
				"CreateStudentForm[martial_status]": {
                    required: "Please select Martial Status",
				},
				"CreateStudentForm[dob]": {
                    required: "Please enter Date of Birth",
				},
				"CreateStudentForm[place_of_birth]": {
                    required: "Please enter Place of Birth",
				},
				"CreateStudentForm[telephone_mobile]": {
                    required: "Please enter Mobile Number",
				},
				"CreateStudentForm[email]": {
                    required: "Please enter Email",
				},
				"CreateStudentForm[lastschoolname]": {
                    required: "Please enter your Last School",
				},
				"CreateStudentForm[type_of_entry]": {
                    required: "Please select Type of entry",
				},
				"CreateStudentForm[father_name]": {
                    required: "Please enter Father's Name",
				},
				"CreateStudentForm[fathericno]": {
                    required: "Please enter Father's/Gaurdian IC No",
				},
				"CreateStudentForm[father_ic_color]": {
                    required: "Please select Father/Gaurdian IC Color",
				},
				"CreateStudentForm[mother_ic_color]": {
                    required: "Please select Mother IC Color",
				},
				"CreateStudentForm[father_mobile]": {
                    required: "Please enter Father's Mobile No",
				},
				"CreateStudentForm[mother_name]": {
                    required: "Please enter Mother's Name",
				},
				"CreateStudentForm[mothericno]": {
                    required: "Please enter Mother's IC No",
				},
				"CreateStudentForm[mother_mobile]": {
                    required: "Please enter Mother's Mobile",
				},
				"CreateStudentForm[address]": {
                    required: "Please enter Address",
				},
				"CreateStudentForm[address2]": {
                    required: "Please enter Address Line 2",
				},
				"CreateStudentForm[address3]": {
                    required: "Please enter Address Line 3",
				},
				"CreateStudentForm[postal_code]": {
                    required: "Please enter Postal Code",
				},
				"CreateStudentForm[bank_name]": {
                    required: "Please enter Bank Name",
				},
				"CreateStudentForm[account_no]": {
                    required: "Please enter Account No",
				},
				"CreateStudentForm[sponsor_type]": {
                    required: "Please select Sponsor Type",
				},
				"CreateStudentForm[programme_name]": {
                    required: "Please enter Programme Name",
				},
				"CreateStudentForm[intake]": {
                    required: "This field is required",
				},
				"CreateStudentForm[entry]": {
                    required: "This field is required",
                },
				"CreateStudentForm[status_of_student]": {
                    required: "Please select Status of Student",
                },
				"CreateStudentForm[mode]": {
                    required: "Please select Mode",
                },
				"CreateStudentForm[utb_email_address]": {
                    required: "Please enter UTB Email Address",
                },
				"CreateStudentForm[date_of_registration]": {
                    required: "Please select Date of Registration",
                },
				"CreateStudentForm[user_image]": {
					accept:"Upload only files of type jpg,png,jpeg,bmp"
                },
			},
			});
</script>
	