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
}

img.ui-datepicker-trigger {
	right: 34px;
    margin-top: 2px;
}

.field-createstudentform-dob , .field-createstudentform-date_of_registration, ..field-createstudentform-date_of_leaving{
	width: 82% !important;
}

</style>

<?php 
$fromyear = date('Y', strtotime('-20 years'));
$range = range($fromyear, $fromyear+40);
$years = array_combine($range, $range);
if(isset($studentdata['dob'])){
	$date = explode("-",$studentdata['dob']);
	if($date[0] && $date[1] && $date[2])
	$dateofbirth = $date[1].'-'.$date[2].'-'.$date[0];
	}
	if(isset($studentdata['date_of_registration'])){
		$dateofreg = explode("-",$studentdata['date_of_registration']);
		if($dateofreg[0] && $dateofreg[1] && $dateofreg[2])
		$dateofregistration = $dateofreg[1].'-'.$dateofreg[2].'-'.$dateofreg[0];
	}
	if(isset($studentdata['date_of_leaving'])){
		$dateoflev = explode("-",$studentdata['date_of_leaving']);
		if($dateoflev[0] && $dateoflev[1] && $dateoflev[2])
		$dateofleaving = $dateoflev[1].'-'.$dateoflev[2].'-'.$dateoflev[0];
	}
if(isset($studentdata['gender'])){
$userformmodel->gender = $studentdata['gender']; 
}
$userformmodel->nationality = isset($studentdata['nationality']) ? ($studentdata['nationality']) : ''; 
$userformmodel->race = isset($studentdata['race']) ? ($studentdata['race']) : ''; 
$userformmodel->religion = isset($studentdata['religion']) ? ($studentdata['religion']) : ''; 
$userformmodel->rumpun = isset($studentdata['rumpun']) ? ($studentdata['rumpun']) : ''; 
$userformmodel->type_of_entry = isset($studentdata['type_of_entry']) ? ($studentdata['type_of_entry']) : ''; 
$userformmodel->bank_name = isset($studentdata['bank_name']) ? ($studentdata['bank_name']) : ''; 
$userformmodel->sponsor_type = isset($studentdata['sponsor_type']) ? ($studentdata['sponsor_type']) : ''; 
$userformmodel->programme_name = isset($studentdata['programme_name']) ? ($studentdata['programme_name']) : ''; 
$userformmodel->entry = isset($studentdata['entry']) ? ($studentdata['entry']) : ''; 
$userformmodel->ic_color = isset($studentdata['ic_color']) ? ($studentdata['ic_color']) : ''; 
$userformmodel->father_ic_color = isset($studentdata['father_ic_color']) ? ($studentdata['father_ic_color']) : ''; 
$userformmodel->mother_ic_color = isset($studentdata['mother_ic_color']) ? ($studentdata['mother_ic_color']) : ''; 
$userformmodel->status_of_student = isset($studentdata['status_of_student']) ? ($studentdata['status_of_student']) : ''; 
$userformmodel->intake = isset($studentdata['intake']) ? ($studentdata['intake']) : ''; 
$userformmodel->previous_intake_no = isset($studentdata['previous_intake_no']) ? ($studentdata['previous_intake_no']) : ''; 
$userformmodel->mode = isset($studentdata['mode']) ? ($studentdata['mode']) : ''; 

if(isset($studentdata['martial_status'])){
	$userformmodel->martial_status = $studentdata['martial_status']; 
	}
if(isset($dateofbirth))$userformmodel->dob = $dateofbirth; 
if(isset($dateofregistration))$userformmodel->date_of_registration = $dateofregistration; 
if(isset($dateofleaving))$userformmodel->date_of_leaving = $dateofleaving; 

$this->title = 'Update Student';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="row">
        <div class="col-xs-12 col-sm-12">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'student-update',
			'id' => 'usercreateform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	<fieldset>
    <legend>Personal Information:</legend>
	<?php echo $form->field($userformmodel, 'studentid')->hiddenInput(['autocomplete' => 'off','value'=>!empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : ''])->label(false);?>
	
	<?php echo $form->field($userformmodel, 'name')->textInput(['value' => (isset($studentdata['name'])? $studentdata['name'] : ''), 'autocomplete' => 'off' ])->label('Name <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'rollno')->textInput(['value' => (isset($studentdata['rollno'])? $studentdata['rollno'] : ''), 'autocomplete' => 'off' ])->label('Roll No <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'rumpun')->dropDownList([  'XLR8' => 'XLR8', 'PRO-XTIV' => 'PRO-XTIV', 'XCEL' => 'XCEL', 'CRTIV' => 'CRTIV'],['prompt' => 'Select Rumpun'])->label('Rumpun'); ?>

	<?php echo $form->field($userformmodel, 'nationality')->dropDownList(['Malay' => 'Malay', 'Chinese' => 'Chinese', 'Indian' => 'Indian', 'Other' => 'Other'],['prompt' => 'Select Nationality'])->label('Nationality <span class="mandatory">*</span>'); ?>

	<?php echo $form->field($userformmodel, 'nationalityother')->textInput(['value' => (isset($studentdata['nationalityother'])? $studentdata['nationalityother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>
	
	<?php echo $form->field($userformmodel, 'passportno')->textInput(['value' => (isset($studentdata['passportno'])? $studentdata['passportno'] : ''), 'autocomplete' => 'off' ])->label('Passport No <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'ic_no')->textInput(['value' => (isset($studentdata['ic_no'])? $studentdata['ic_no'] : ''), 'autocomplete' => 'off'])->label('IC No. <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'Select IC Color'])->label('IC Color <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'race')->dropDownList(['Malay' => 'Malay', 'Chinese' => 'Chinese', 'Indian' => 'Indian', 'Other' => 'Other'],['prompt' => 'Select Race'])->label('Race <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'raceother')->textInput(['value' => (isset($studentdata['raceother'])? $studentdata['raceother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

	<?php echo $form->field($userformmodel, 'religion')->dropDownList(['Muslim' => 'Muslim', 'Buddhism' => 'Buddhism', 'Hinduism' => 'Hinduism', 'Christianity' => 'Christianity', 'Other' => 'Other'],['prompt' => 'Select Religion'])->label('Religion <span class="mandatory">*</span>'); ?>

	<?php echo $form->field($userformmodel, 'religionother')->textInput(['value' => (isset($studentdata['religionother'])? $studentdata['religionother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>
	
	<?php echo $form->field($userformmodel,'gender')->radioList(['Male' => 'Male', 'Female' => 'Female'])->label('Gender <span class="mandatory">*</span>'); ?>

	<?php echo $form->field($userformmodel,'martial_status')->radioList(['Married' => 'Married', 'Single' => 'Single'])->label('Martial Status <span class="mandatory">*</span>'); ?>

<?php echo '<div class="studentdob">';
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
		])->textInput(['readonly' => true])->label('Date of Birth <span class="mandatory">*</span>'); 
		echo '</div>'; ?>
		
		<?php echo $form->field($userformmodel, 'place_of_birth')->textInput(['value' => (isset($studentdata['place_of_birth'])? $studentdata['place_of_birth'] : ''), 'autocomplete' => 'off' ])->label('Place of Birth <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'telephone_mobile')->textInput(['value' => (isset($studentdata['telephone_mobile'])? $studentdata['telephone_mobile'] : ''), 'autocomplete' => 'off' ])->label('Telephone No. (Mobile): <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'tele_home')->textInput(['value' => (isset($studentdata['tele_home'])? $studentdata['tele_home'] : ''), 'autocomplete' => 'off' ])->label('Telephone No. (Home):');?>

		<?php echo $form->field($userformmodel, 'email')->textInput(['value' => (isset($studentdata['email'])? $studentdata['email'] : ''), 'autocomplete' => 'off' ])->label('Email <span class="mandatory">*</span>');?>
	
		<?php echo $form->field($userformmodel, 'emailother')->textInput(['value' => (isset($studentdata['emailother'])? $studentdata['emailother'] : ''), 'autocomplete' => 'off' ])->label('Email (other)');?>
		
		<?php echo $form->field($userformmodel, 'lastschoolname')->textInput(['value' => (isset($studentdata['lastschoolname'])? $studentdata['lastschoolname'] : ''), 'autocomplete' => 'off' ])->label('Name of Last School Attended <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'type_of_entry')->dropDownList(['HECAS' => 'HECAS', 'In-service' => 'In-service', 'Other' => 'Other'],['prompt' => 'Select Type of Entry'])->label('Type of Entry');?>

		<?php echo $form->field($userformmodel, 'typeofentryother')->textInput(['value' => (isset($studentdata['typeofentryother'])? $studentdata['typeofentryother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

		<?php echo $form->field($userformmodel, 'specialneeds')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['specialneeds'])? $studentdata['specialneeds'] : '') ])->label('Special Needs'); ?>

		<?php echo $form->field($userformmodel, 'user_image')->fileInput(['class' => 'with-preview accept-gif|jpg|png|jpeg|bmp profile-img'])->label('Profile Image'); ?>
		</fieldset>
		<fieldset>
    <legend>Postal Address:</legend>
		<?php echo $form->field($userformmodel, 'address')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['address'])? $studentdata['address'] : '') ])->label('Postal Address <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'address2')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['address2'])? $studentdata['address2'] : '') ])->label('Address Line 2 <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'address3')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['address3'])? $studentdata['address3'] : '') ])->label('Address Line 3 <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'postal_code')->textInput(['value' => (isset($studentdata['postal_code'])? $studentdata['postal_code'] : ''), 'autocomplete' => 'off' ])->label('Postal Code <span class="mandatory">*</span>');?>

	</fieldset>

	<fieldset>
	<legend>Bank Details:</legend>
	
	<?php echo $form->field($userformmodel, 'bank_name')->dropDownList([ 'BAIDURI' => 'BAIDURI', 'BIBD' => 'BIBD', 'STANDARD CHARTERED BANK' => 'STANDARD CHARTERED BANK', 'TAIB' => 'TAIB'],['prompt' => 'Select Bank'])->label('Bank Name <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'account_no')->textInput(['value' => (isset($studentdata['account_no'])? $studentdata['account_no'] : ''), 'autocomplete' => 'off' ])->label('Bank Account No <span class="mandatory">*</span>');?>
		</fieldset>
		</div>
	<div class="col-xs-8 col-sm-6">

	<fieldset>
    <legend>Parents Information:</legend>
		<?php echo $form->field($userformmodel, 'father_name')->textInput(['value' => (isset($studentdata['father_name'])? $studentdata['father_name'] : ''), 'autocomplete' => 'off' ])->label('Father/Guardian Name <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'gaurdian_relation')->textInput(['value' => (isset($studentdata['gaurdian_relation'])? $studentdata['gaurdian_relation'] : ''), 'autocomplete' => 'off' ])->label('Gaurdian relation');?>

		<?php echo $form->field($userformmodel, 'fathericno')->textInput(['value' => (isset($studentdata['fathericno'])? $studentdata['fathericno'] : ''), 'autocomplete' => 'off' ])->label('Father/Guardian IC No <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'father_ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'Select Father/Gaurdian IC Color'])->label('Father/Gaurdian IC Color <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'father_mobile')->textInput(['value' => (isset($studentdata['father_mobile'])? $studentdata['father_mobile'] : ''), 'autocomplete' => 'off' ])->label('Father\'s Telephone No <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mobile_home')->textInput(['value' => (isset($studentdata['mobile_home'])? $studentdata['mobile_home'] : ''), 'autocomplete' => 'off' ])->label('Telephone No (Home)');?>

		<?php echo $form->field($userformmodel, 'gaurdian_employment')->textInput(['value' => (isset($studentdata['gaurdian_employment'])? $studentdata['gaurdian_employment'] : ''), 'autocomplete' => 'off' ])->label('Father/Guardian Employment');?>

		<?php echo $form->field($userformmodel, 'gaurdian_employer')->textInput(['value' => (isset($studentdata['gaurdian_employer'])? $studentdata['gaurdian_employer'] : ''), 'autocomplete' => 'off' ])->label('Father/Guardian Employer');?>

		<?php echo $form->field($userformmodel, 'remarks')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['remarks'])? $studentdata['remarks'] : '') ])->label('Remarks');?>

		<?php echo $form->field($userformmodel, 'telphone_work')->textInput(['value' => (isset($studentdata['telphone_work'])? $studentdata['telphone_work'] : ''), 'autocomplete' => 'off' ])->label('Telephone No. (Work)');?>

		<?php echo $form->field($userformmodel, 'mother_name')->textInput(['value' => (isset($studentdata['mother_name'])? $studentdata['mother_name'] : ''), 'autocomplete' => 'off' ])->label('Mother Name <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mothericno')->textInput(['value' => (isset($studentdata['mothericno'])? $studentdata['mothericno'] : ''), 'autocomplete' => 'off' ])->label('Mother IC No <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mother_ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'Select Mother IC Color'])->label('Mother IC Color <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mother_mobile')->textInput(['value' => (isset($studentdata['mother_mobile'])? $studentdata['mother_mobile'] : ''), 'autocomplete' => 'off' ])->label('Mother\'s Telephone No <span class="mandatory">*</span>');?>
	</fieldset>
	
	<fieldset>
	<legend>Programme Information:</legend>
		
		<?php echo $form->field($userformmodel, 'sponsor_type')->dropDownList([ 'Government Scholarship' => 'Government Scholarship', 'BSP Scholarship' => 'BSP Scholarship', 'Fee Paying' => 'Fee Paying', 'Other' => 'Other'],['prompt' => 'Select Sponsor Type'])->label('Sponsor Type <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'sponsor_type_other')->textInput(['value' => (isset($studentdata['sponsor_type_other'])? $studentdata['sponsor_type_other'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>
	
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

		<?php echo $form->field($userformmodel, 'status_remarks')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['status_remarks'])? $studentdata['status_remarks'] : '')])->label('Status Remarks');?>

		<?php echo $form->field($userformmodel, 'intake')->dropDownList($years,['prompt' => 'Select Intake No'])->label('Intake No. <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mode')->dropDownList(['Full Time' => 'Full Time', 'Part Time'=> 'Part Time'],['prompt' => 'Select Mode'])->label('Mode <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'utb_email_address')->textInput(['value' => (isset($studentdata['utb_email_address'])? $studentdata['utb_email_address'] : ''), 'autocomplete' => 'off'])->label('UTB Email Address <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'degree_classification')->textInput(['value' => (isset($studentdata['degree_classification'])? $studentdata['degree_classification'] : ''), 'autocomplete' => 'off'])->label('Degree Classification <span class="mandatory">*</span>');?>

		<?php 
		echo $form->field($userformmodel, 'date_of_registration')->widget(\yii\jui\DatePicker::classname(), [
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

<?php echo $form->field($userformmodel, 'previous_roll_no')->textInput(['value' => (isset($studentdata['previous_roll_no'])? $studentdata['previous_roll_no'] : ''), 'autocomplete' => 'off'])->label('Previous Roll No');?>

<?php echo $form->field($userformmodel, 'previous_programme_name')->textInput(['value' => (isset($studentdata['previous_programme_name'])? $studentdata['previous_programme_name'] : ''), 'autocomplete' => 'off'])->label('Previous Programmme Name');?>

<?php echo $form->field($userformmodel, 'previous_intake_no')->dropDownList($years,['prompt' => 'Select Previous Intake No'])->label('Previous Intake No');?>

<?php echo $form->field($userformmodel, 'previous_utb_email')->textInput(['value' => (isset($studentdata['previous_utb_email'])? $studentdata['previous_utb_email'] : ''), 'autocomplete' => 'off'])->label('Previous UTB Email');?>

	</fieldset>
	
 </div>
 
 </div>
					</div>
 <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Submit', ['class' => 'btn btn-primary usersignup']) ?>
 </div>
        
        </div>
		<?php ActiveForm::end(); ?>
 
<script>
$(document).ready(function(){
	$('.field-createstudentform-nationalityother').hide();
	$('.field-createstudentform-raceother').hide();
	$('.field-createstudentform-religionother').hide();
	var studentother = $('#createstudentform-nationality').val();
	var raceother = $('#createstudentform-race').val();
	var religionother = $('#createstudentform-religion').val();
	var typeofentryother = $('#createstudentform-type_of_entry').val();
	var sponsortypeother = $('#createstudentform-sponsor_type').val();
	
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
		$('.field-createstudentform-typeofentryother').show();
	}else{
			$('.field-createstudentform-typeofentryother').hide();
	}

	if(sponsortypeother && sponsortypeother=='Other'){
		$('.field-createstudentform-sponsor_type_other').show();
	}else{
			$('.field-createstudentform-sponsor_type_other').hide();
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
$("#usercreateform").validate({
            rules: {
                "CreateStudentForm[name]": {
                    required: true,
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
				},
				"CreateStudentForm[type_of_entry]": {
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
				"CreateStudentForm[user_image]": {
					accept:"jpg,png,jpeg,bmp"
                },
		   },
            messages: {
                "CreateStudentForm[name]": {
                    required: "Name cannot be blank",
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
			}
			});
</script>
	