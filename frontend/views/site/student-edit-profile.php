
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
		margin-top: -30px;
    display: block;
    font-size: 12px;
    margin-left: 50px;
    width: 82%;
    margin-bottom: 10px;
	}ma
</style>
<?php 
$fromyear = date('Y', strtotime('-20 years'));
$range = range($fromyear, $fromyear+40);
$years = array_combine($range, $range);
if(isset($studentdata['dob'])){
	$date = explode("-",$studentdata['dob']);
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
$userformmodel->title = isset($studentdata['title']) ? ($studentdata['title']) : ''; 
$userformmodel->nationality = isset($studentdata['nationality']) ? ($studentdata['nationality']) : ''; 
$userformmodel->race = isset($studentdata['race']) ? ($studentdata['race']) : ''; 
$userformmodel->religion = isset($studentdata['religion']) ? ($studentdata['religion']) : ''; 
$userformmodel->rumpun = isset($studentdata['rumpun']) ? ($studentdata['rumpun']) : ''; 
$userformmodel->type_of_entry = isset($studentdata['type_of_entry']) ? ($studentdata['type_of_entry']) : ''; 
$userformmodel->type_of_residential = isset($studentdata['type_of_residential']) ? ($studentdata['type_of_residential']) : '';
$userformmodel->bank_name = isset($studentdata['bank_name']) ? ($studentdata['bank_name']) : ''; 
$userformmodel->highest_qualification = isset($studentdata['highest_qualification']) ? ($studentdata['highest_qualification']) : '';
$userformmodel->state = isset($studentdata['state']) ? ($studentdata['state']) : '';
$userformmodel->mailing_state = isset($studentdata['mailing_state']) ? ($studentdata['mailing_state']) : '';
$userformmodel->sponsor_type = isset($studentdata['sponsor_type']) ? ($studentdata['sponsor_type']) : ''; 
$userformmodel->type_of_programme = isset($studentdata['type_of_programme']) ? ($studentdata['type_of_programme']) : ''; 
$userformmodel->school = isset($studentdata['school']) ? ($studentdata['school']) : ''; 
$userformmodel->programme_name = isset($studentdata['programme_name']) ? ($studentdata['programme_name']) : ''; 
$userformmodel->entry = isset($studentdata['entry']) ? ($studentdata['entry']) : ''; 
$userformmodel->ic_color = isset($studentdata['ic_color']) ? ($studentdata['ic_color']) : ''; 
$userformmodel->father_ic_color = isset($studentdata['father_ic_color']) ? ($studentdata['father_ic_color']) : ''; 
$userformmodel->mother_ic_color = isset($studentdata['mother_ic_color']) ? ($studentdata['mother_ic_color']) : ''; 
//$userformmodel->status_of_student = isset($studentdata['status_of_student']) ? ($studentdata['status_of_student']) : ''; 
$userformmodel->intake = isset($studentdata['intake']) ? ($studentdata['intake']) : ''; 
$userformmodel->previous_intake_no = isset($studentdata['previous_intake_no']) ? ($studentdata['previous_intake_no']) : ''; 
$userformmodel->mode = isset($studentdata['mode']) ? ($studentdata['mode']) : ''; 
if(isset($studentdata['martial_status'])){
	$userformmodel->martial_status = $studentdata['martial_status']; 
	}
if(isset($studentdata['dob']))$userformmodel->dob = $studentdata['dob']; 
if(isset($studentdata['date_of_registration']))$userformmodel->date_of_registration = $studentdata['date_of_registration']; 
if(isset($studentdata['date_of_leaving']))$userformmodel->date_of_leaving = $studentdata['date_of_leaving']; 
$userformmodel->countrycode = isset($studentdata['countrycode']) ? ($studentdata['countrycode']) : ''; 
$userformmodel->state = isset($studentdata['state']) ? ($studentdata['state']) : ''; 
$userformmodel->mailing_countrycode = isset($studentdata['mailing_countrycode']) ? ($studentdata['mailing_countrycode']) : ''; 
$userformmodel->mailing_state = isset($studentdata['mailing_state']) ? ($studentdata['mailing_state']) : ''; 
$this->title = 'Update Student';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
        <div class="panel-heading">
        	<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
		</div>
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'student-edit-profile',
			'id' => 'usercreateform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	<fieldset>
    <legend>Personal Information:</legend>
	<div class="titlename">
	<?php echo $form->field($userformmodel, 'title')->dropDownList(['Dato' => 'Dato', 'Datin' => 'Datin', 'Dayangku' => 'Dayangku', 'Awangku' => 'Awangku', 'Dayang' => 'Dayang', 'Awang' => 'Awang', 'Mister' => 'Mister', 'Mrs' => 'Mrs', 'Miss' => 'Miss', 'Ms' => 'Ms', 'Ampuan' => 'Ampuan', 'Malai' => 'Malai', 'Pehin' => 'Pehin', 'Pengiren Anak Isteri' => 'Pengiren Anak Isteri', 'Pengiren Anak Isteri Pengiren' => 'Pengiren Anak Isteri Pengiren', 'Pengiren Anak Puteri' => 'Pengiren Anak Puteri', 'Yang Teramat Mulia' => 'Yang Teramat Mulia', 'Yang Amat Mulia' => 'Yang Amat Mulia', 'Pengiren Anak' => 'Pengiren Anak', 'Haji Awang' => 'Haji Awang', 'Hajah Dayang' => 'Hajah Dayang', 'Professor' => 'Professor', 'Associate Professor' => 'Associate Professor'], ['prompt' => 'Select Title'])->label('Title');?>
	
	<?php echo $form->field($userformmodel, 'name')->textInput(['value' => (isset($studentdata['name'])? $studentdata['name'] : ''), 'autocomplete' => 'off' ])->label('Name <span class="mandatory">*</span>');?>
	</div>

	<?php echo $form->field($userformmodel, 'rollno')->textInput(['value' => (isset($studentdata['rollno'])? $studentdata['rollno'] : ''), 'autocomplete' => 'off' ])->label('Roll No <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'rumpun')->dropDownList([  'XLR8' => 'XLR8', 'PRO-XTIV' => 'PRO-XTIV', 'XCEL' => 'XCEL', 'CRTIV' => 'CRTIV'],['prompt' => 'Select Rumpun'])->label('Rumpun'); ?>

	<?php echo $form->field($userformmodel, 'nationality')->dropDownList([ 'Malay' => 'Malay', 'Chinese' => 'Chinese', 'Indian' => 'Indian', 'Other' => 'Other'],['prompt' => 'Select Nationality'])->label('Nationality <span class="mandatory">*</span>'); ?>
	
	<?php echo $form->field($userformmodel, 'nationalityother')->textInput(['value' => (isset($studentdata['nationalityother'])? $studentdata['nationalityother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

	<?php echo $form->field($userformmodel, 'ic_no_format')->textInput(['value' => (isset($studentdata['ic_no_format'])? $studentdata['ic_no_format'] : ''), 'autocomplete' => 'off'])->label(false);?>
	
	<?php echo $form->field($userformmodel, 'ic_no')->textInput(['value' => (isset($studentdata['ic_no'])? $studentdata['ic_no'] : ''), 'autocomplete' => 'off'])->label('IC No. <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'Select IC Color'])->label('IC Color <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'passportno')->textInput(['value' => (isset($studentdata['passportno'])? $studentdata['passportno'] : ''), 'autocomplete' => 'off' ])->label('Passport No <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'race')->dropDownList(['Malay' => 'Malay', 'Kedayan' => 'Kedayan', 'Dusun' => 'Dusun', 'Murut' => 'Murut', 'Bisaya' => 'Bisaya', 'Belait' => 'Belait', 'Tutong' => 'Tutong', 'Brunei' => 'Brunei', 'Iban' => 'Iban', 'Batak' => 'Batak', 'Kenyah' => 'Kenyah', 'Dayak' => 'Dayak', 'Kedazan' => 'Kedazan', 'Chinese' => 'Chinese', 'Indian' => 'Indian', 'Other' => 'Other'], ['prompt' => 'Select Race'])->label('Race <span class="mandatory">*</span>');?>

	<?php echo $form->field($userformmodel, 'raceother')->textInput(['value' => (isset($studentdata['raceother'])? $studentdata['raceother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

	<?php echo $form->field($userformmodel, 'religion')->dropDownList([ 'Muslim' => 'Muslim', 'Buddist' => 'Buddist', 'Christian' => 'Christian', 'Hindu' => 'Hindu', 'Sikh' => 'Sikh', 'No Religion' => 'No Religion', 'Other' => 'Other'],['prompt' => 'Select Religion'])->label('Religion <span class="mandatory">*</span>'); ?>
	
	<?php echo $form->field($userformmodel, 'religionother')->textInput(['value' => (isset($studentdata['religionother'])? $studentdata['religionother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

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
                            'buttonImage' => '../images/calendar.gif',
                            'buttonImageOnly' => true,
                            'buttonText' => 'Select date',
                             'buttonImage' => Yii::$app->request->BaseUrl.'/../images/calendar.gif',
                        ],
		])->textInput(['readonly' => true])->label('Date of Birth <span class="mandatory">*</span>'); ?>
		
		<?php echo $form->field($userformmodel, 'age')->textInput(['value' => (isset($studentdata['age'])? $studentdata['age'] : ''), 'autocomplete' => 'off','readonly' => true ])->label('Age');?>
		
		<?php echo $form->field($userformmodel, 'place_of_birth')->textInput(['value' => (isset($studentdata['place_of_birth'])? $studentdata['place_of_birth'] : ''), 'autocomplete' => 'off' ])->label('Place of Birth <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'telephone_mobile')->textInput(['value' => (isset($studentdata['telephone_mobile'])? $studentdata['telephone_mobile'] : ''), 'autocomplete' => 'off' ])->label('Telephone No. (Mobile): <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'tele_home')->textInput(['value' => (isset($studentdata['tele_home'])? $studentdata['tele_home'] : ''), 'autocomplete' => 'off' ])->label('Telephone No. (Home):');?>

		<?php echo $form->field($userformmodel, 'email')->textInput(['value' => (isset($studentdata['email'])? $studentdata['email'] : ''), 'autocomplete' => 'off' ])->label('Email <span class="mandatory">*</span>');?>
	
		<?php echo $form->field($userformmodel, 'emailother')->textInput(['value' => (isset($studentdata['emailother'])? $studentdata['emailother'] : ''), 'autocomplete' => 'off' ])->label('Email (other)');?>
		
		<?php echo $form->field($userformmodel, 'highest_qualification')->dropDownList(['A Level' => 'A Level', 'Advanced National Diploma' => 'Advanced National Diploma', 'Higher National Diploma' => 'Higher National Diploma', 'International Baccalaureate' => 'International Baccalaureate', 'Undergraduate Degree' => 'Undergraduate Degree', 'Masters by Coursework' => 'Masters by Coursework', 'Masters by Research' => 'Masters by Research', 'Doctor of Philosophy PhD' => 'Doctor of Philosophy PhD', 'Other' => 'Other'], ['prompt' => 'Select Highest Qualification Obtained'])->label('Highest Qualification Obtained');?>
		
		<?php echo $form->field($userformmodel, 'highestqualificationother')->textInput(['value' => (isset($studentdata['highestqualificationother'])? $studentdata['highestqualificationother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>
		
		<?php echo $form->field($userformmodel, 'lastschoolname')->textInput(['value' => (isset($studentdata['lastschoolname'])? $studentdata['lastschoolname'] : ''), 'autocomplete' => 'off' ])->label('Name of Last School Attended <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'type_of_entry')->dropDownList(['HECAS' => 'HECAS', 'In-service' => 'In-service', 'BDGS (MOFA)' => 'BDGS (MOFA)', 'Other' => 'Other'],['prompt' => 'Select Type of Entry'])->label('Type of Entry');?>

		<?php echo $form->field($userformmodel, 'typeofentryother')->textInput(['value' => (isset($studentdata['typeofentryother'])? $studentdata['typeofentryother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

		<?php echo $form->field($userformmodel, 'specialneeds')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['specialneeds'])? $studentdata['specialneeds'] : '') ])->label('Special Needs'); ?>

		<?php echo $form->field($userformmodel, 'user_image')->fileInput(['class' => 'with-preview accept-gif|jpg|png|jpeg|bmp profile-img'])->label('Profile Image'); ?>
		</fieldset>
		
	<fieldset>
    <legend>Postal Address:</legend>
		<?php echo $form->field($userformmodel, 'type_of_residential')->dropDownList(['Own House' => 'Own House', 'Hostel' => 'Hostel', 'Core' => 'Core', 'Rental' => 'Rental', 'Other' => 'Other'], ['prompt' => 'Select Type of Residential'])->label('Type of Residential <span class="mandatory">*</span>');?>
		
		<?php echo $form->field($userformmodel, 'typeofresidentialother')->textInput(['value' => (isset($studentdata['typeofresidentialother'])? $studentdata['typeofresidentialother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>
	</fieldset>

		<fieldset>
		<?php echo $form->field($userformmodel, 'address')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['address'])? $studentdata['address'] : '') ])->label('Address Line 1 <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'address2')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['address2'])? $studentdata['address2'] : '') ])->label('Address Line 2 <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'address3')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['address3'])? $studentdata['address3'] : '') ])->label('Address Line 3 <span class="mandatory">*</span>'); ?>
		
		<?php			
			//echo $form->field($model, 'countrycode')->dropDownList($countrycodes, ['prompt' => 'Select Country Code'])->label(false);
			echo $form->field($userformmodel, 'countrycode',[
			'inputOptions' => [                      	
				'id'=>'createstudentform-countrycode', 'class'=>'form-control']])->dropDownList($countries, ['prompt' => 'Select Country'])->label('Country');
		?>  
		
		<?php echo $form->field($userformmodel, 'state')->dropDownList(['Brunei-Muara' => 'Brunei-Muara', 'Tutong' => 'Tutong', 'Kuala Belait' => 'Kuala Belait', 'Temburong' => 'Temburong'], ['prompt' => 'Select District/State'])->label('District/State <span class="mandatory">*</span>');?>
		
		<?php echo $form->field($userformmodel, 'district')->textInput(['value' => (isset($studentdata['district'])? $studentdata['district'] : ''), 'autocomplete' => 'off' ])->label('District/State');?>

		<?php echo $form->field($userformmodel, 'postal_code')->textInput(['value' => (isset($studentdata['postal_code'])? $studentdata['postal_code'] : ''), 'autocomplete' => 'off' ])->label('Postal Code <span class="mandatory">*</span>');?>

	</fieldset>
	
		</div>
	<div class="col-xs-8 col-sm-6">
	
	<fieldset>
	<legend>Bank Details:</legend>
	
		<?php echo $form->field($userformmodel, 'bank_name')->dropDownList([ 'BAIDURI' => 'BAIDURI', 'BIBD' => 'BIBD', 'STANDARD CHARTERED BANK' => 'STANDARD CHARTERED BANK', 'TAIB' => 'TAIB', 'Other' => 'Other'],['prompt' => 'Select Bank'])->label('Bank Name <span class="mandatory">*</span>'); ?>
		
		<?php echo $form->field($userformmodel, 'bank_name_other')->textInput(['value' => (isset($studentdata['bank_name_other'])? $studentdata['bank_name_other'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>
		
		<?php echo $form->field($userformmodel, 'bank_account_name')->textInput(['value' => (isset($studentdata['bank_account_name'])? $studentdata['bank_account_name'] : ''), 'autocomplete' => 'off' ])->label('Bank Account Name'); ?>

		<?php echo $form->field($userformmodel, 'account_no')->textInput(['value' => (isset($studentdata['account_no'])? $studentdata['account_no'] : ''), 'autocomplete' => 'off' ])->label('Bank Account No <span class="mandatory">*</span>');?>
		
		<?php echo $form->field($userformmodel, 'bank_terms')->checkbox(['label'=>'I agree to the terms'])->label(false) ?>
		<span class="bankterms">I declare that all the particulars and information provided in this application are true to my best knowledge and belief.</span>
		</fieldset>
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

<?php echo $form->field($userformmodel, 'remarks')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['remarks'])? $studentdata['remarks'] : '')])->label('Remarks');?>

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
		
		<?php echo $form->field($userformmodel, 'type_of_programme')->dropDownList(['Undergraduate Degree' => 'Undergraduate Degree', 'Masters by Coursework' => 'Masters by Coursework', 'Masters by Research' => 'Masters by Research', 'Doctor of Philosophy PhD' => 'Doctor of Philosophy PhD'], ['prompt' => 'Select Type of Programme'])->label('Type of Programme <span class="mandatory">*</span>');?>
		
		<?php echo $form->field($userformmodel, 'school')->dropDownList(['School of Business' => 'School of Business', 'School of Computing and Informatics' => 'School of Computing and Informatics', 'School of Applied Sciences and Mathematics' => 'School of Applied Sciences and Mathematics', 'School of Design' => 'School of Design', 'Faculty of Engineering' => 'Faculty of Engineering'], ['prompt' => 'Select School/Faculty'])->label('School/Faculty <span class="mandatory">*</span>');?>
	
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

		<?php //echo $form->field($userformmodel, 'status_of_student')->dropDownList(['Current Student' => 'Current Student', 'Withdrawn' => 'Withdrawn'], ['prompt' => 'Select Status of Student'])->label('Status of Student <span class="mandatory">*</span>');?>

		<?php //echo $form->field($userformmodel, 'status_remarks')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['status_remarks'])? $studentdata['status_remarks'] : '')])->label('Status Remarks');?>

		<?php echo $form->field($userformmodel, 'intake')->dropDownList($years,['prompt' => 'Select Intake No'])->label('Intake No. <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'mode')->dropDownList(['Full Time' => 'Full Time', 'Part Time'=> 'Part Time'],['prompt' => 'Select Mode'])->label('Mode <span class="mandatory">*</span>');?>

		<?php echo $form->field($userformmodel, 'utb_email_address')->textInput(['value' => (isset($studentdata['utb_email_address'])? $studentdata['utb_email_address'] : ''), 'autocomplete' => 'off'])->label('UTB Email Address <span class="mandatory">*</span>');?>

		<?php //echo $form->field($userformmodel, 'degree_classification')->textInput(['value' => (isset($studentdata['degree_classification'])? $studentdata['degree_classification'] : ''), 'autocomplete' => 'off'])->label('Degree Classification <span class="mandatory">*</span>');?>

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
                            'buttonImage' => '../images/calendar.gif',
                            'buttonImageOnly' => true,
                            'buttonText' => 'Select date',
                             'buttonImage' => Yii::$app->request->BaseUrl.'/../images/calendar.gif',
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
                            'buttonImage' => '../images/calendar.gif',
                            'buttonImageOnly' => true,
                            'buttonText' => 'Select date',
                             'buttonImage' => Yii::$app->request->BaseUrl.'/../images/calendar.gif',
                        ],
		])->textInput(['readonly' => true])->label('Date of Leaving'); ?>

<?php //echo $form->field($userformmodel, 'previous_roll_no')->textInput(['value' => (isset($studentdata['previous_roll_no'])? $studentdata['previous_roll_no'] : ''), 'autocomplete' => 'off'])->label('Previous Roll No');?>

<?php //echo $form->field($userformmodel, 'previous_programme_name')->textInput(['value' => (isset($studentdata['previous_programme_name'])? $studentdata['previous_programme_name'] : ''), 'autocomplete' => 'off'])->label('Previous Programmme Name');?>

<?php //echo $form->field($userformmodel, 'previous_intake_no')->dropDownList($years,['prompt' => 'Select Previous Intake No'])->label('Previous Intake No');?>

<?php //echo $form->field($userformmodel, 'previous_utb_email')->textInput(['value' => (isset($studentdata['previous_utb_email'])? $studentdata['previous_utb_email'] : ''), 'autocomplete' => 'off'])->label('Previous UTB Email');?>


	<?php echo $form->field($userformmodel, 'studentid')->hiddenInput(['autocomplete' => 'off','value'=>isset(Yii::$app->user->id) ? Yii::$app->user->id : ''])->label(false);?>
	</fieldset>
	<fieldset>
    <legend>Mailing Address:</legend>
	
		 <?php echo $form->field($userformmodel, 'mailing_permanent')->checkbox(['label'=>'Set mailing address same as permanent address'])->label(false) ?>
		 
		<?php echo $form->field($userformmodel, 'mailing_address')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['mailing_address'])? $studentdata['mailing_address'] : '') ])->label('Address Line 1 <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'mailing_address2')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['mailing_address2'])? $studentdata['mailing_address2'] : '') ])->label('Address Line 2 <span class="mandatory">*</span>'); ?>

		<?php echo $form->field($userformmodel, 'mailing_address3')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['mailing_address3'])? $studentdata['mailing_address3'] : '') ])->label('Address Line 3 <span class="mandatory">*</span>'); ?>
		
		<?php			
			//echo $form->field($model, 'countrycode')->dropDownList($countrycodes, ['prompt' => 'Select Country Code'])->label(false);
			echo $form->field($userformmodel, 'mailing_countrycode',[
			'inputOptions' => [                      	
				'id'=>'createstudentform-mailing_countrycode', 'class'=>'form-control']])->dropDownList($countries, ['prompt' => 'Select Country'])->label('Country');
		?>  
		
		<?php echo $form->field($userformmodel, 'mailing_state')->dropDownList(['Brunei-Muara' => 'Brunei-Muara', 'Tutong' => 'Tutong', 'Kuala Belait' => 'Kuala Belait', 'Temburong' => 'Temburong'], ['prompt' => 'Select District/State'])->label('District/State <span class="mandatory">*</span>');?>
		
		<?php echo $form->field($userformmodel, 'mailing_district')->textInput(['value' => (isset($studentdata['mailing_district'])? $studentdata['mailing_district'] : ''), 'autocomplete' => 'off' ])->label('District/State');?>

		<?php echo $form->field($userformmodel, 'mailing_postal_code')->textInput(['value' => (isset($studentdata['mailing_postal_code'])? $studentdata['mailing_postal_code'] : ''), 'autocomplete' => 'off' ])->label('Postal Code <span class="mandatory">*</span>');?>

	</fieldset>
 </div>
 
 </div>
  <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Submit', ['class' => 'btn btn-primary usersignup']) ?>
 </div>
        
        </div>
					</div>

		<?php ActiveForm::end(); ?>
 
<script>
$(document).ready(function(){
	var mailing_permanent = <?php echo (isset($studentdata['mailing_permanent']) && $studentdata['mailing_permanent'] == 1) ? true : false ?>;
	$('#createstudentform-mailing_permanent').prop('checked', mailing_permanent);
	
	var bank_terms = <?php echo (isset($studentdata['bank_terms']) && $studentdata['bank_terms'] == 1) ? true : false ?>;
	$('#createstudentform-bank_terms').prop('checked', bank_terms);
	
	if(mailing_permanent == 1){
		$('#createstudentform-mailing_address').prop('readonly',true);
		$('#createstudentform-mailing_address2').prop('readonly',true);
		$('#createstudentform-mailing_address3').prop('readonly',true);
		$('#createstudentform-mailing_countrycode').prop('disabled',true);
		$('#createstudentform-mailing_postal_code').prop('readonly',true);
		$('#createstudentform-mailing_state').attr('disabled','true');
		$('#createstudentform-mailing_district').prop('readonly',true);
	}
	$('#createstudentform-state').change(function(){
	$('#createstudentform-mailing_state').val($('#createstudentform-state').val());
	});
	$('#createstudentform-address,#createstudentform-address2,#createstudentform-address3,#createstudentform-countrycode,#createstudentform-postal_code,#createstudentform-district').keyup(function(){
		if($('#createstudentform-mailing_permanent').is(":checked") === true){
			$('#createstudentform-mailing_address').val($('#createstudentform-address').val());
			$('#createstudentform-mailing_address2').val($('#createstudentform-address2').val());
			$('#createstudentform-mailing_address3').val($('#createstudentform-address3').val());
			$('#createstudentform-mailing_countrycode').val($('#createstudentform-countrycode').val());
			$('#createstudentform-mailing_postal_code').val($('#createstudentform-postal_code').val());
			if($('#createstudentform-countrycode').val() == 'Brunei'){
				$('.field-createstudentform-mailing_state').show();
				$('#createstudentform-mailing_district').val('');
				$('#createstudentform-mailing_state').val($('#createstudentform-state').val());
			}else{
				$('#createstudentform-mailing_state').val('');
				$('.field-createstudentform-mailing_district').show();
				$('#createstudentform-mailing_district').val($('#createstudentform-district').val());
			}
				
		}else{
			$('#createstudentform-mailing_address').val('');
			$('#createstudentform-mailing_address2').val('');
			$('#createstudentform-mailing_address3').val('');
			$('#createstudentform-mailing_countrycode').val('');
			$('#createstudentform-mailing_postal_code').val('');
			$('#createstudentform-mailing_district').val('');
			$('#createstudentform-mailing_state').val('');
		}
	});
	$('#createstudentform-mailing_permanent').change(function(){
		$('.field-createstudentform-mailing_state').hide();
		$('.field-createstudentform-mailing_district').hide();
		if($('#createstudentform-mailing_permanent').is(":checked") === true){
		$('#createstudentform-mailing_address').prop('readonly',true);
		$('#createstudentform-mailing_address2').prop('readonly',true);
		$('#createstudentform-mailing_address3').prop('readonly',true);
		$('#createstudentform-mailing_countrycode').prop('disabled',true);
		$('#createstudentform-mailing_postal_code').prop('readonly',true);
		$('#createstudentform-mailing_state').attr('disabled','true');
		$('#createstudentform-mailing_district').prop('readonly',true);
			$('#createstudentform-mailing_address').val($('#createstudentform-address').val());
			$('#createstudentform-mailing_address2').val($('#createstudentform-address2').val());
			$('#createstudentform-mailing_address3').val($('#createstudentform-address3').val());
			$('#createstudentform-mailing_countrycode').val($('#createstudentform-countrycode').val());
			$('#createstudentform-mailing_postal_code').val($('#createstudentform-postal_code').val());
			if($('#createstudentform-countrycode').val() == 'Brunei'){
				$('.field-createstudentform-mailing_state').show();
				$('#createstudentform-mailing_district').val('');
				$('#createstudentform-mailing_state').val($('#createstudentform-state').val());
			}else{
				$('#createstudentform-mailing_state').val('');
				$('.field-createstudentform-mailing_district').show();
				$('#createstudentform-mailing_district').val($('#createstudentform-district').val());
			}
				
		}else{
			$('#createstudentform-mailing_address').val('');
			$('#createstudentform-mailing_address2').val('');
			$('#createstudentform-mailing_address3').val('');
			$('#createstudentform-mailing_countrycode').val('');
			$('#createstudentform-mailing_postal_code').val('');
			$('#createstudentform-mailing_district').val('');
			$('#createstudentform-mailing_state').val('');
		$('#createstudentform-mailing_address').prop('readonly',false);
		$('#createstudentform-mailing_address2').prop('readonly',false);
		$('#createstudentform-mailing_address3').prop('readonly',false);
		$('#createstudentform-mailing_countrycode').prop('disabled',false);
		$('#createstudentform-mailing_postal_code').prop('readonly',false);
		$('#createstudentform-mailing_state').attr('disabled','false');
		$('#createstudentform-mailing_district').prop('readonly',false);
		}
	});
	$('.field-createstudentform-district').hide();
	$('.field-createstudentform-state').hide();
	$('#createstudentform-countrycode').change(function(){
		$('.field-createstudentform-district').hide();
		$('.field-createstudentform-state').hide();
		$('.field-createstudentform-mailing_district').hide();
		$('.field-createstudentform-mailing_state').hide();
		$('#createstudentform-district').val('');
		$('#createstudentform-state').val('');
		$('#createstudentform-mailing_district').val('');
		$('#createstudentform-mailing_state').val('');
		if($(this).val() == 'Brunei'){
			$('.field-createstudentform-state').show();
			$('.field-createstudentform-mailing_state').show();
		}else{
			$('.field-createstudentform-district').show();
			$('.field-createstudentform-mailing_district').show();
		}
	});
	var countrycode = $('#createstudentform-countrycode').val();
	if(countrycode && countrycode=='Brunei'){
		$('.field-createstudentform-state').show();
	}else{
		$('.field-createstudentform-district').hide();
	}
	
	$('.field-createstudentform-mailing_district').hide();
	$('.field-createstudentform-mailing_state').hide();
	$('#createstudentform-mailing_countrycode').change(function(){
		$('.field-createstudentform-mailing_district').hide();
		$('.field-createstudentform-mailing_state').hide();
		$('#createstudentform-mailing_district').val('');
		$('#createstudentform-mailing_state').val('');
		if($(this).val() == 'Brunei'){
			$('.field-createstudentform-mailing_state').show();
		}else{
			$('.field-createstudentform-mailing_district').show();
		}
	});
	var countrycode = $('#createstudentform-mailing_countrycode').val();
	if(countrycode && countrycode=='Brunei'){
		$('.field-createstudentform-mailing_state').show();
	}else{
		$('.field-createstudentform-mailing_district').hide();
	}
	
	$('#createstudentform-dob').change(function(){
		var dob = $(this).val();
		var dobArr = dob.split('-');
		dob = dobArr[1]+'-'+dobArr[0]+'-'+dobArr[2];
		dob = new Date(dob);
	var today = new Date();
	console.log(today);
	console.log(dob);
	var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
	$('#createstudentform-age').val(age);
	});
	$('.field-createstudentform-nationalityother').hide();
	$('.field-createstudentform-sponsor_type_other').hide();
	$('.field-createstudentform-raceother').hide();
	$('.field-createstudentform-religionother').hide();
	$('.field-createstudentform-highestqualificationother').hide();
	$('.field-createstudentform-typeofentryother').hide();
	$('.field-createstudentform-bank_name_other').hide();
	$('.field-createstudentform-typeofresidentialother').hide();
	var studentother = $('#createstudentform-nationality').val();
	var raceother = $('#createstudentform-race').val();
	var religionother = $('#createstudentform-religion').val();
	var highestqualificationother = $('#createstudentform-highest_qualification').val();
	var typeofentryother = $('#createstudentform-type_of_entry').val();
	var banknameother = $('#createstudentform-bank_name').val();
	var typeofresidentialother = $('#createstudentform-type_of_residential').val();
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
	if(highestqualificationother && highestqualificationother=='Other'){
		$('.field-createstudentform-highestqualificationother').show();
	}else{
			$('.field-createstudentform-highestqualificationother').hide();
	}
	if(typeofentryother && typeofentryother=='Other'){
		$('.field-createstudentform-typeofentryother').show();
	}else{
			$('.field-createstudentform-typeofentryother').hide();
	}
	if(banknameother && banknameother=='Other'){
		$('.field-createstudentform-bank_name_other').show();
	}else{
			$('.field-createstudentform-bank_name_other').hide();
	}
	if(typeofresidentialother && typeofresidentialother=='Other'){
		$('.field-createstudentform-typeofresidentialother').show();
	}else{
			$('.field-createstudentform-typeofresidentialother').hide();
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
	$('#createstudentform-bank_name').change(function(){
		if($(this).val() == 'Other'){
			$('.field-createstudentform-bank_name_other').show();
		}else{
			$('.field-createstudentform-bank_name_other').hide();
		}
	})
	$('#createstudentform-type_of_residential').change(function(){
		if($(this).val() == 'Other'){
			$('.field-createstudentform-typeofresidentialother').show();
		}else{
			$('.field-createstudentform-typeofresidentialother').hide();
		}
	})
	$('#createstudentform-highest_qualification').change(function(){
		if($(this).val() == 'Other'){
			$('.field-createstudentform-highestqualificationother').show();
		}else{
			$('.field-createstudentform-highestqualificationother').hide();
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
				"CreateStudentForm[ic_no_format]": {
                    required: true,
					digits: true,
					minlength: 2,
					maxlength: 2
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
					email:true
				},
				"CreateStudentForm[emailother]": {
					email:true
				},
				"CreateStudentForm[lastschoolname]": {
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
				"CreateStudentForm[bank_account_name]": {
                    required: true,
				},
				"CreateStudentForm[account_no]": {
                    required: true,
				},
				"CreateStudentForm[sponsor_type]": {
                    required: true,
				},
				"CreateStudentForm[type_of_programme]": {
                    required: true,
				},
				"CreateStudentForm[school]": {
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
				/*"CreateStudentForm[status_of_student]": {
                    required: true,
                },*/
				"CreateStudentForm[mode]": {
                    required: true,
                },
				"CreateStudentForm[utb_email_address]": {
                    required: true,
					email:true
                },
				"CreateStudentForm[date_of_registration]": {
                    required: true,
                },
				"CreateStudentForm[user_image]": {
					accept:"jpg,png,jpeg,bmp"
                },
				"CreateStudentForm[type_of_residential]": {
                    required: true,
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
				"CreateStudentForm[ic_no_format]": {
                    required: "Please enter IC No Format",
					digits: "Please enter a valid IC No Format",
					minlength: "IC No Format must be 2 digits length",
					maxlength: "IC No Format must be 2 digits length"
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
					email:"Please enter valid email address"
				},
				"CreateStudentForm[emailother]": {
					email:"Please enter valid email address"
				},
				"CreateStudentForm[lastschoolname]": {
                    required: "Please enter your Last School",
				},
				"CreateStudentForm[father_name]": {
                    required: "Please enter Father's Name",
				},
				"CreateStudentForm[fathericno]": {
                    required: "Please enter Father's/Gaurdian IC No",
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
				"CreateStudentForm[bank_account_name]": {
                    required: "Please enter Bank Account Name",
				},
				"CreateStudentForm[account_no]": {
                    required: "Please enter Account No",
				},
				"CreateStudentForm[sponsor_type]": {
                    required: "Please select Sponsor Type",
				},
				"CreateStudentForm[type_of_programme]": {
                    required: "Please select Type of Programme",
				},
				"CreateStudentForm[school]": {
                    required: "Please select School/Faculty",
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
				/*"CreateStudentForm[status_of_student]": {
                    required: "Please select Status of Student",
                },*/
				"CreateStudentForm[mode]": {
                    required: "Please select Mode",
                },
				"CreateStudentForm[utb_email_address]": {
                    required: "Please enter UTB Email Address",
					email:"Please enter valid email address"
                },
				"CreateStudentForm[date_of_registration]": {
                    required: "Please select Date of Registration",
                },
				"CreateStudentForm[user_image]": {
					accept:"Upload only files of type jpg,png,jpeg,bmp"
                },
				"CreateStudentForm[type_of_residential]": {
                    required: "Please select Type of Residential",
                },
			}
			});
</script>