
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

		.field-createstudentform-kin_phone_country_code, .field-createstudentform-kin_mobile_country_code{
			width: 30%;
			float: left;
		}
		
		.kin-country-code, .kin-mobile-code{
			float: left;
			margin-top: 6%;
			width: auto;
			margin-left: 5%;
		}
		
		.field-createstudentform-kin_phone, .field-createstudentform-kin_mobile{
			width: 50%;
			float: left;
			margin-top: 5%;
			margin-left: 5%;
		}
		
		.icnoformat {
			width: 100%;
			height: 100px;
			margin-right: 10px;
			float: left;
		}

		.idcard-hiphen{
				float: left;
				margin-top: 6%;
				margin-left: 5%;
		}

		.field-createstudentform-kin_id_card_no_code {
			width: 30%;
			float: left;
		}
		
		.field-createstudentform-kin_id_card_no{
				width: 48%;
				float: left;
				margin-left: 5%;
				margin-top: 4.8%;
		}

		.usercreateformrow .col-sm-6 {
			width:48%;
		}
		
		.leftform{
			margin-right: 4%;
		}
		
		#usercreateform .usercreateformrow fieldset {
			width:95%
		}
		
		#usercreateform .usercreateformrow legend{
		color: #FFFFFF;
		background: #6a7988;
		padding: 2px 10px;
		margin-left: 28px;
		}

	.field-createstudentform-emergency_phone_country_code, .field-createstudentform-emergency_mobile_country_code, .field-createstudentform-emergency_officeno_country_code{
		float: left;
		width: 40%;
	}
	
	.emergency-country-code, .emergency-mobile-code, .emergency-officeno-code{
		margin-top: 28px;
		float: left;
		width: 18%;
		height: 50px;
		padding-left: 18px;
		padding-right: 9px;
	}
	
	.field-createstudentform-emergency_phone, .field-createstudentform-emergency_mobile, .field-createstudentform-emergency_officeno{
		width: 41%;
		float: left;
		margin-top: 24px;
	}
	
	.hqfields{
		width: 20%;
		margin: 0px 10px;
	}
	
	.hqfields1, .hqfields2, .hqfields3{
		float:left;
	}
	
	.hqdata {
		margin-top: 84px;
	}
	/*.hq_a_level_amore {
		    margin-top: -50px;
	}
	
	.hqdata{
		margin-top: 18%;
	}
	.hqfields{
		float: left;
		width: 20%;
		margin: 0px 10px;
	}
	
	.addmoredetails{
		margin-bottom:90px !important;
	}*/
	
.addmorekin, #hq_a_level_addmore{
		background: #36c6d3;
		width: 14%;
		border-radius: 1px 0 3px 4px;
		padding: 4px 10px;
		text-align: center;
		color: #ffffff;
		margin-bottom:20px;
		border-radius: 3px!important;
		border-color: #2CB3BF!important;
		cursor: pointer;
	}
	
	.kindata{
		border: #e0d9d9 solid 1px;
		padding: 20px;
		border-radius: 2px !important;
		margin-bottom:20px;
	}
	.removekin, .hq_a_level_remove{
		background: #ca4b4b;
		width: 22%;
		border-radius: 1px 0 3px 4px;
		padding: 4px 10px;
		text-align: center;
		color: #ffffff;
		border-radius: 3px!important;
		border-color: #2CB3BF!important;
		cursor: pointer;
		margin-bottom:20px;
	}
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
		right: 18px;
		margin-top: -29px;
	}

.field-createstudentform-ic_no_format{
width: 18%;
    z-index: 9999;
    }
   
  .field-createstudentform-ic_no {
    width: 52%;
    margin-left: 48px !important;
    margin-top: 23px !important;
    }
.field-createstudentform-ic_no_format, .field-createstudentform-ic_no {
  float: left;
  margin-right: 5px;
}
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
$userformmodel->status_of_student = isset($studentdata['status_of_student']) ? ($studentdata['status_of_student']) : ''; 
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

$userformmodel->emergency_relationship = isset($studentdata['emergency_relationship']) ? ($studentdata['emergency_relationship']) : ''; 
$userformmodel->emergency_phone_country_code = isset($studentdata['emergency_phone_country_code']) ? ($studentdata['emergency_phone_country_code']) : ''; 
$userformmodel->emergency_mobile_country_code = isset($studentdata['emergency_mobile_country_code']) ? ($studentdata['emergency_mobile_country_code']) : ''; 
$userformmodel->emergency_officeno_country_code = isset($studentdata['emergency_officeno_country_code']) ? ($studentdata['emergency_officeno_country_code']) : ''; 
$this->title = 'Update Student';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'student-update',
			'id' => 'usercreateform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
			<div class="row usercreateformrow">
			<fieldset>
			<legend>Personal Information:</legend>
				<div class="col-xs-12 col-sm-12">
					<div class="col-xs-8 col-sm-6 leftform">
					
					<div class="titlename">
					<?php echo $form->field($userformmodel, 'title')->dropDownList(['Dato' => 'Dato', 'Datin' => 'Datin', 'Dayangku' => 'Dayangku', 'Awangku' => 'Awangku', 'Dayang' => 'Dayang', 'Awang' => 'Awang', 'Mister' => 'Mister', 'Mrs' => 'Mrs', 'Miss' => 'Miss', 'Ms' => 'Ms', 'Ampuan' => 'Ampuan', 'Malai' => 'Malai', 'Pehin' => 'Pehin', 'Pengiran Anak Isteri' => 'Pengiran Anak Isteri', 'Pengiran Anak Isteri Pengiran' => 'Pengiran Anak Isteri Pengiran', 'Pengiran Anak Puteri' => 'Pengiran Anak Puteri', 'Yang Teramat Mulia' => 'Yang Teramat Mulia', 'Yang Amat Mulia' => 'Yang Amat Mulia', 'Pengiran Anak' => 'Pengiran Anak', 'Haji Awang' => 'Haji Awang', 'Hajah Dayang' => 'Hajah Dayang', 'Professor' => 'Professor', 'Associate Professor' => 'Associate Professor'], ['prompt' => 'Select Title'])->label('Title');?>
					
					<?php echo $form->field($userformmodel, 'name')->textInput(['value' => (isset($studentdata['name'])? $studentdata['name'] : ''), 'autocomplete' => 'off' ])->label('Name <span class="mandatory">*</span>');?>
					</div>

					<?php echo $form->field($userformmodel, 'rollno')->textInput(['value' => (isset($studentdata['rollno'])? $studentdata['rollno'] : ''), 'autocomplete' => 'off' ])->label('Roll No <span class="mandatory">*</span>');?>

					<?php echo $form->field($userformmodel, 'rumpun')->dropDownList([  'XLR8' => 'XLR8', 'PRO-XTIV' => 'PRO-XTIV', 'XCEL' => 'XCEL', 'CRTIV' => 'CRTIV'],['prompt' => 'Select Rumpun'])->label('Rumpun'); ?>

					<?php echo $form->field($userformmodel, 'nationality')->dropDownList([ 'Malay' => 'Malay', 'Chinese' => 'Chinese', 'Indian' => 'Indian', 'Other' => 'Other'],['prompt' => 'Select Nationality'])->label('Nationality <span class="mandatory">*</span>'); ?>
					
					<?php echo $form->field($userformmodel, 'nationalityother')->textInput(['value' => (isset($studentdata['nationalityother'])? $studentdata['nationalityother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

					<div class="icnoformat" style="height: 90px;">
					<?php echo $form->field($userformmodel, 'ic_no_format')->textInput(['value' => (isset($studentdata['ic_no_format'])? $studentdata['ic_no_format'] : ''), 'autocomplete' => 'off'])->label('IC No. <span class="mandatory">*</span>');?>
					
					<?php echo $form->field($userformmodel, 'ic_no')->textInput(['value' => (isset($studentdata['ic_no'])? $studentdata['ic_no'] : ''), 'autocomplete' => 'off'])->label(false);?>
					</div>
					<?php echo $form->field($userformmodel, 'ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'Select IC Color'])->label('IC Color <span class="mandatory">*</span>');?>

					<?php echo $form->field($userformmodel, 'passportno')->textInput(['value' => (isset($studentdata['passportno'])? $studentdata['passportno'] : ''), 'autocomplete' => 'off' ])->label('Passport No <span class="mandatory">*</span>');?>

					<?php echo $form->field($userformmodel, 'race')->dropDownList(['Malay' => 'Malay', 'Kedayan' => 'Kedayan', 'Dusun' => 'Dusun', 'Murut' => 'Murut', 'Bisaya' => 'Bisaya', 'Belait' => 'Belait', 'Tutong' => 'Tutong', 'Brunei' => 'Brunei', 'Iban' => 'Iban', 'Batak' => 'Batak', 'Kenyah' => 'Kenyah', 'Dayak' => 'Dayak', 'Kedazan' => 'Kedazan', 'Chinese' => 'Chinese', 'Indian' => 'Indian', 'Other' => 'Other'], ['prompt' => 'Select Race'])->label('Race <span class="mandatory">*</span>');?>

					<?php echo $form->field($userformmodel, 'raceother')->textInput(['value' => (isset($studentdata['raceother'])? $studentdata['raceother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

					<?php echo $form->field($userformmodel, 'religion')->dropDownList([ 'Muslim' => 'Muslim', 'Buddist' => 'Buddist', 'Christian' => 'Christian', 'Hindu' => 'Hindu', 'Sikh' => 'Sikh', 'No Religion' => 'No Religion', 'Other' => 'Other'],['prompt' => 'Select Religion'])->label('Religion <span class="mandatory">*</span>'); ?>
					
					<?php echo $form->field($userformmodel, 'religionother')->textInput(['value' => (isset($studentdata['religionother'])? $studentdata['religionother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

					<?php echo $form->field($userformmodel,'gender')->radioList(['Male' => 'Male', 'Female' => 'Female'])->label('Gender <span class="mandatory">*</span>'); ?>

					<?php echo $form->field($userformmodel,'martial_status')->radioList(['Married' => 'Married', 'Single' => 'Single'])->label('Martial Status <span class="mandatory">*</span>'); ?>
					
					</div>
					<div class="col-xs-8 col-sm-6">
					
					<?php echo $form->field($userformmodel, 'dob')->widget(\yii\jui\DatePicker::classname(), [
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
					
					<?php echo $form->field($userformmodel, 'age')->textInput(['value' => (isset($studentdata['age'])? $studentdata['age'] : ''), 'autocomplete' => 'off','readonly' => true ])->label('Age');?>
		
					<?php echo $form->field($userformmodel, 'place_of_birth')->textInput(['value' => (isset($studentdata['place_of_birth'])? $studentdata['place_of_birth'] : ''), 'autocomplete' => 'off' ])->label('Place of Birth <span class="mandatory">*</span>');?>

					<?php echo $form->field($userformmodel, 'telephone_mobile')->textInput(['value' => (isset($studentdata['telephone_mobile'])? $studentdata['telephone_mobile'] : ''), 'autocomplete' => 'off' ])->label('Telephone No. (Mobile): <span class="mandatory">*</span>');?>

					<?php echo $form->field($userformmodel, 'tele_home')->textInput(['value' => (isset($studentdata['tele_home'])? $studentdata['tele_home'] : ''), 'autocomplete' => 'off' ])->label('Telephone No. (Home):');?>

					<?php echo $form->field($userformmodel, 'email')->textInput(['value' => (isset($studentdata['email'])? $studentdata['email'] : ''), 'autocomplete' => 'off' ])->label('Email <span class="mandatory">*</span>');?>
				
					<?php echo $form->field($userformmodel, 'emailother')->textInput(['value' => (isset($studentdata['emailother'])? $studentdata['emailother'] : ''), 'autocomplete' => 'off' ])->label('Email (other)');?>
					
					<?php echo $form->field($userformmodel, 'highest_qualification')->dropDownList(['A Level' => 'A Level', 'Advanced National Diploma' => 'Advanced National Diploma', 'Higher National Diploma' => 'Higher National Diploma', 'International Baccalaureate' => 'International Baccalaureate', 'Undergraduate Degree' => 'Undergraduate Degree', 'Masters by Coursework' => 'Masters by Coursework', 'Masters by Research' => 'Masters by Research', 'Doctor of Philosophy (PhD)' => 'Doctor of Philosophy (PhD)', 'Diploma Level 5' => 'Diploma Level 5', 'Other' => 'Other'], ['prompt' => 'Select Highest Qualification Obtained'])->label('Highest Qualification Obtained');?>
					
					<?php echo $form->field($userformmodel, 'highestqualificationother')->textInput(['value' => (isset($studentdata['highestqualificationother'])? $studentdata['highestqualificationother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>
					
					<div id="highest_qualification_details">
					<?php echo $form->field($userformmodel, 'highestqualification_coursetaken')->textInput(['value' => (isset($studentdata['highestqualification_coursetaken'])? $studentdata['highestqualification_coursetaken'] : ''), 'autocomplete' => 'off' ])->label('Course Taken'); ?>
					
					<?php echo $form->field($userformmodel, 'highestqualification_result')->textInput(['value' => (isset($studentdata['highestqualification_result'])? $studentdata['highestqualification_result'] : ''), 'autocomplete' => 'off' ])->label('Result'); ?>
					</div>
					
					<div id="hq_a_level_details">
					<div id="hq_a_level_addmore">+ Add</div>
					<?php for($i=0;$i<count($studenthqdetails);$i++){ ?> 
					<div class="hqdata<?php echo $studenthqdetails[$i]['id'] ; ?> hqdata">
					<div class="hq_a_level_remove removehq" hqid="<?php echo $studenthqdetails[$i]['id'] ; ?>">- Remove</div>
						<?php echo $form->field($userformmodel, 'hq_id[]')->hiddenInput(['value' => (isset($studenthqdetails[$i]['id'])? $studenthqdetails[$i]['id'] : ''), 'autocomplete' => 'off' ])->label(false);?>
						
						<div class="hqfields hqfields1">
						<?php echo $form->field($userformmodel, 'hq_a_level_year[]')->textInput(['value' => (isset($studenthqdetails[$i]['hq_a_level_year'])? $studenthqdetails[$i]['hq_a_level_year'] : ''), 'autocomplete' => 'off', 'placeholder' => 'Year' ])->label('Year'); ?>
						</div>
						
						<div class="hqfields hqfields2">
						<?php echo $form->field($userformmodel, 'hq_a_level_subject[]')->textInput(['value' => (isset($studenthqdetails[$i]['hq_a_level_subject'])? $studenthqdetails[$i]['hq_a_level_subject'] : ''), 'autocomplete' => 'off', 'placeholder' => 'Subject' ])->label('Subject');?>
						</div>
						
						<div class="hqfields hqfields3">
						<?php echo $form->field($userformmodel, 'hq_a_level_grade[]')->textInput(['value' => (isset($studenthqdetails[$i]['hq_a_level_grade'])? $studenthqdetails[$i]['hq_a_level_grade'] : ''), 'autocomplete' => 'off', 'placeholder' => 'Grade' ])->label('Grade');?>
						</div>
					</div>
					<?php } ?>
					<div class="hq_a_level_addmore_fields <?php echo count($studenthqdetails)>0 ? 'addmoredetails' : ''; ?>"></div>
					</div>
					
					
					<?php echo $form->field($userformmodel, 'lastschoolname')->textInput(['value' => (isset($studentdata['lastschoolname'])? $studentdata['lastschoolname'] : ''), 'autocomplete' => 'off' ])->label('Name of Last School Attended <span class="mandatory">*</span>');?>

					<?php echo $form->field($userformmodel, 'type_of_entry')->dropDownList(['Hecas' => 'Hecas', 'Non-Hecas' => 'Non-Hecas'],['prompt' => 'Select Type of Entry'])->label('Type of Entry');?>

					<?php echo $form->field($userformmodel, 'typeofentryother')->textInput(['value' => (isset($studentdata['typeofentryother'])? $studentdata['typeofentryother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

					<?php echo $form->field($userformmodel, 'specialneeds')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['specialneeds'])? $studentdata['specialneeds'] : '') ])->label('Special Needs'); ?>

					<?php echo $form->field($userformmodel, 'user_image')->fileInput(['class' => 'with-preview accept-gif|jpg|png|jpeg|bmp profile-img'])->label('Profile Image'); ?>
					
					</div>
				</div>
				</fieldset>
			</div>
			
			
			<div class="row usercreateformrow">
			<fieldset>
			<legend>Postal Address:</legend>
				<div class="col-xs-12 col-sm-12">
					<div class="col-xs-8 col-sm-6 leftform">
					
					<?php echo $form->field($userformmodel, 'type_of_residential')->dropDownList(['Own House' => 'Own House', 'Hostel' => 'Hostel', 'Core' => 'Core', 'Rental' => 'Rental', 'Other' => 'Other'], ['prompt' => 'Select Type of Residential'])->label('Type of Residential <span class="mandatory">*</span>');?>
		
					<?php echo $form->field($userformmodel, 'typeofresidentialother')->textInput(['value' => (isset($studentdata['typeofresidentialother'])? $studentdata['typeofresidentialother'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>					
					
					<?php echo $form->field($userformmodel, 'address')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['address'])? $studentdata['address'] : '') ])->label('Address Line <span class="mandatory">*</span>'); ?>

					</div>
					<div class="col-xs-8 col-sm-6">
					
					<?php //echo $form->field($userformmodel, 'address2')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['address2'])? $studentdata['address2'] : '') ])->label('Address Line 2 <span class="mandatory">*</span>'); ?>

					<?php //echo $form->field($userformmodel, 'address3')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['address3'])? $studentdata['address3'] : '') ])->label('Address Line 3 <span class="mandatory">*</span>'); ?>
					
					<?php			
						//echo $form->field($model, 'countrycode')->dropDownList($countrycodes, ['prompt' => 'Select Country Code'])->label(false);
						echo $form->field($userformmodel, 'countrycode',[
						'inputOptions' => [                      	
							'id'=>'createstudentform-countrycode', 'class'=>'form-control']])->dropDownList($countries, ['prompt' => 'Select Country'])->label('Country');
					?>  
					
					<?php echo $form->field($userformmodel, 'state')->dropDownList(['Brunei-Muara' => 'Brunei-Muara', 'Tutong' => 'Tutong', 'Kuala Belait' => 'Kuala Belait', 'Temburong' => 'Temburong'], ['prompt' => 'Select District/State'])->label('District/State <span class="mandatory">*</span>');?>
					
					<?php echo $form->field($userformmodel, 'district')->textInput(['value' => (isset($studentdata['district'])? $studentdata['district'] : ''), 'autocomplete' => 'off' ])->label('District/State');?>

					<?php echo $form->field($userformmodel, 'postal_code')->textInput(['value' => (isset($studentdata['postal_code'])? $studentdata['postal_code'] : ''), 'autocomplete' => 'off' ])->label('Postal Code <span class="mandatory">*</span>');?>


					</div>
				</div>
			</fieldset>
			</div>
			
			
			<div class="row usercreateformrow">
			<fieldset>
			<legend>Mailing Address:</legend>
				<div class="col-xs-12 col-sm-12">
					<div class="col-xs-8 col-sm-6 leftform">
					
					<?php echo $form->field($userformmodel, 'mailing_permanent')->checkbox(['label'=>'Set mailing address same as permanent address'])->label(false) ?>
		 
					<?php echo $form->field($userformmodel, 'mailing_address')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['mailing_address'])? $studentdata['mailing_address'] : '') ])->label('Address Line <span class="mandatory">*</span>'); ?>

					<?php //echo $form->field($userformmodel, 'mailing_address2')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['mailing_address2'])? $studentdata['mailing_address2'] : '') ])->label('Address Line 2 <span class="mandatory">*</span>'); ?>

					<?php //echo $form->field($userformmodel, 'mailing_address3')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['mailing_address3'])? $studentdata['mailing_address3'] : '') ])->label('Address Line 3 <span class="mandatory">*</span>'); ?>
					
					<?php			
						//echo $form->field($model, 'countrycode')->dropDownList($countrycodes, ['prompt' => 'Select Country Code'])->label(false);
						echo $form->field($userformmodel, 'mailing_countrycode',[
						'inputOptions' => [                      	
							'id'=>'createstudentform-mailing_countrycode', 'class'=>'form-control']])->dropDownList($countries, ['prompt' => 'Select Country'])->label('Country');
					?>  
					
					
					</div>
					<div class="col-xs-8 col-sm-6">
					
					<?php echo $form->field($userformmodel, 'mailing_state')->dropDownList(['Brunei-Muara' => 'Brunei-Muara', 'Tutong' => 'Tutong', 'Kuala Belait' => 'Kuala Belait', 'Temburong' => 'Temburong'], ['prompt' => 'Select District/State'])->label('District/State <span class="mandatory">*</span>');?>
		
					<?php echo $form->field($userformmodel, 'mailing_district')->textInput(['value' => (isset($studentdata['mailing_district'])? $studentdata['mailing_district'] : ''), 'autocomplete' => 'off' ])->label('District/State');?>

					<?php echo $form->field($userformmodel, 'mailing_postal_code')->textInput(['value' => (isset($studentdata['mailing_postal_code'])? $studentdata['mailing_postal_code'] : ''), 'autocomplete' => 'off' ])->label('Postal Code <span class="mandatory">*</span>');?>
					
					</div>
				</div>
			</fieldset>
			</div>
			
			<div class="row usercreateformrow">
			<fieldset>
			<legend>Emergency Contact Details:</legend>
				<div class="col-xs-12 col-sm-12">
					<div class="col-xs-8 col-sm-6 leftform">
					
					<?php echo $form->field($userformmodel, 'emergency_relationship')->dropDownList(['Father' => 'Father', 'Mother' => 'Mother', 'Guardian' => 'Guardian', 'Husband' => 'Husband', 'Wife' => 'Wife', 'Sibling' => 'Sibling', 'Son' => 'Son', 'Daughter' => 'Daughter', 'Relative' => 'Relative', 'Others' => 'Others'], ['prompt' => 'Select Relationship'])->label('Relationship');?>

					<?php echo $form->field($userformmodel, 'emergency_relationship_others')->textInput(['value' => (isset($studentdata['emergency_relationship_others'])? $studentdata['emergency_relationship_others'] : ''),'autocomplete' => 'off' ])->label('Others');?>

					<?php echo $form->field($userformmodel, 'emergency_name')->textInput(['value' => (isset($studentdata['emergency_name'])? $studentdata['emergency_name'] : ''),'autocomplete' => 'off' ])->label('Name');?>

					<?php echo $form->field($userformmodel, 'emergency_address')->textarea(['value' => (isset($studentdata['emergency_address'])? $studentdata['emergency_address'] : ''),'rows' => 2,'autocomplete' => 'off', 'placeholder' => 'Address Line One' ])->label('Address'); ?>

					<?php echo $form->field($userformmodel, 'emergency_address2')->textarea(['value' => (isset($studentdata['emergency_address2'])? $studentdata['emergency_address2'] : ''),'rows' => 2,'autocomplete' => 'off', 'placeholder' => 'Address Line Two' ])->label(false); ?>

					<?php echo $form->field($userformmodel, 'emergency_address3')->textarea(['value' => (isset($studentdata['emergency_address3'])? $studentdata['emergency_address3'] : ''),'rows' => 2,'autocomplete' => 'off', 'placeholder' => 'Address Line Three' ])->label(false); ?>

					</div>
					<div class="col-xs-8 col-sm-6">
					
					<div class="icnoformat emergencyphone">

					<?php			
								//echo $form->field($model, 'countrycode')->dropDownList($countrycodes, ['prompt' => 'Select Country Code'])->label(false);
								echo $form->field($userformmodel, 'emergency_phone_country_code',[
								'inputOptions' => [                      	
									'id'=>'createstudentform-emergency_phone_country_code', 'class'=>'form-control emergencyphonecode']])->dropDownList($countriesIsoCodes, ['prompt' => 'Select Country'])->label('Phone No.');
							?>  
					<div class="emergency-country-code"></div>
					<?php echo $form->field($userformmodel, 'emergency_phone')->textInput(['placeholder' =>  'Phone Number', 'value' => (isset($studentdata['emergency_phone'])? $studentdata['emergency_phone'] : ''),'autocomplete' => 'off'])->label(false);?>
					</div>

					<div class="icnoformat emergencymobile">

					<?php			
								echo $form->field($userformmodel, 'emergency_mobile_country_code',[
								'inputOptions' => [                      	
									'id'=>'createstudentform-emergency_mobile_country_code', 'class'=>'form-control emergencymobilecode']])->dropDownList($countriesIsoCodes, ['prompt' => 'Select Country'])->label('Mobile No.');
							?>  
					<div class="emergency-mobile-code"></div>

					<?php echo $form->field($userformmodel, 'emergency_mobile')->textInput(['placeholder' =>  'Mobile No', 'value' => (isset($studentdata['emergency_mobile'])? $studentdata['emergency_mobile'] : ''),'autocomplete' => 'off'])->label(false);?>
					</div>

					<div class="icnoformat emergencyofficeno">

					<?php			
								echo $form->field($userformmodel, 'emergency_officeno_country_code',[
								'inputOptions' => [                      	
									'id'=>'createstudentform-emergency_officeno_country_code', 'class'=>'form-control emergencyofficenocode']])->dropDownList($countriesIsoCodes, ['prompt' => 'Select Country'])->label('Office No.');
							?>  
					<div class="emergency-officeno-code"></div>

					<?php echo $form->field($userformmodel, 'emergency_officeno')->textInput(['placeholder' =>  'Office No', 'value' => (isset($studentdata['emergency_officeno'])? $studentdata['emergency_officeno'] : ''),'autocomplete' => 'off'])->label(false);?>
					</div>

					<?php echo $form->field($userformmodel, 'emergency_email')->textInput(['value' => (isset($studentdata['emergency_email'])? $studentdata['emergency_email'] : ''),'autocomplete' => 'off'])->label('Email');?>
							
					</div>
				</div>
			</fieldset>
			</div>
			
			
			<div class="row usercreateformrow">
			<fieldset>
			<legend>Next of Kin:</legend>
				<div class="col-xs-12 col-sm-12">
					
					<div class="addmorekin">+ Add</div>
<?php for($i=0;$i<count($studentkindetails);$i++){ ?>
<div class="kindata">
<div class="row">
<div class="col-xs-8 col-sm-6 <?php echo ($i % 2 == 0) ? 'leftform' : '' ?>">
<div class="removekin" kinid="<?php echo $studentkindetails[$i]['kin_id'] ; ?>">- Remove</div>

<div class="kinrelation<?php echo $studentkindetails[$i]['kin_id'] ; ?>">

<?php echo $form->field($userformmodel, 'kin_id[]')->hiddenInput(['value' => (isset($studentkindetails[$i]['kin_id'])? $studentkindetails[$i]['kin_id'] : ''), 'autocomplete' => 'off' ])->label(false);?>

<?php echo $form->field($userformmodel, 'kin_relationship[]')->dropDownList(['Father' => 'Father', 'Mother' => 'Mother', 'Guardian' => 'Guardian', 'Husband' => 'Husband', 'Wife' => 'Wife', 'Sibling' => 'Sibling', 'Son' => 'Son', 'Daughter' => 'Daughter', 'Relative' => 'Relative', 'Others' => 'Others'], ['prompt' => 'Select Relationship'])->label('Relationship');?>

</div>

<?php if(isset($studentkindetails[$i]['kin_relationship']) && $studentkindetails[$i]['kin_relationship'] == 'Others'){ ?>
<div class="kinothers">
<?php echo $form->field($userformmodel, 'kin_relationship_others[]')->textInput(['value' => (isset($studentkindetails[$i]['kin_relationship_others'])? $studentkindetails[$i]['kin_relationship_others'] : ''), 'autocomplete' => 'off' ])->label('Others');?>
</div>
<?php } ?>

<?php echo $form->field($userformmodel, 'kin_name[]')->textInput(['value' => (isset($studentkindetails[$i]['kin_name'])? $studentkindetails[$i]['kin_name'] : ''), 'autocomplete' => 'off' ])->label('Name');?>

<?php echo $form->field($userformmodel, 'kin_address[]')->textarea(['value' => (isset($studentkindetails[$i]['kin_address'])? $studentkindetails[$i]['kin_address'] : ''), 'rows' => 2,'autocomplete' => 'off', 'placeholder' => 'Address Line One' ])->label('Address'); ?>

<?php echo $form->field($userformmodel, 'kin_address2[]')->textarea(['value' => (isset($studentkindetails[$i]['kin_address2'])? $studentkindetails[$i]['kin_address2'] : ''), 'rows' => 2,'autocomplete' => 'off', 'placeholder' => 'Address Line Two' ])->label(false); ?>

<?php echo $form->field($userformmodel, 'kin_address3[]')->textarea(['value' => (isset($studentkindetails[$i]['kin_address3'])? $studentkindetails[$i]['kin_address3'] : ''), 'rows' => 2,'autocomplete' => 'off', 'placeholder' => 'Address Line Three' ])->label(false); ?>

</div>
<div class="col-xs-8 col-sm-6">

<div class="icnoformat">
<?php echo $form->field($userformmodel, 'kin_id_card_no_code[]')->textInput(['value' => (isset($studentkindetails[$i]['kin_id_card_no_code'])? $studentkindetails[$i]['kin_id_card_no_code'] : ''), 'autocomplete' => 'off'])->label('Identity Card No. <span class="mandatory">*</span>');?>
<div class="idcard-hiphen">&ndash;</div>
<?php echo $form->field($userformmodel, 'kin_id_card_no[]')->textInput(['value' => (isset($studentkindetails[$i]['kin_id_card_no'])? $studentkindetails[$i]['kin_id_card_no'] : ''), 'autocomplete' => 'off'])->label(false);?>
</div>

<div class="icnoformat">
<?php echo $form->field($userformmodel, 'kin_phone_country_code[]')->textInput(['value' => (isset($studentkindetails[$i]['kin_phone_country_code'])? $studentkindetails[$i]['kin_phone_country_code'] : ''), 'autocomplete' => 'off'])->label('Phone	No.');?>

<?php echo $form->field($userformmodel, 'kin_phone[]')->textInput(['value' => (isset($studentkindetails[$i]['kin_phone'])? $studentkindetails[$i]['kin_phone'] : ''), 'autocomplete' => 'off'])->label(false);?>
</div>

<div class="icnoformat">
<?php echo $form->field($userformmodel, 'kin_mobile_country_code[]')->textInput(['value' => (isset($studentkindetails[$i]['kin_mobile_country_code'])? $studentkindetails[$i]['kin_mobile_country_code'] : ''), 'autocomplete' => 'off'])->label('Mobile No.');?>

<?php echo $form->field($userformmodel, 'kin_mobile[]')->textInput(['value' => (isset($studentkindetails[$i]['kin_mobile'])? $studentkindetails[$i]['kin_mobile'] : ''), 'autocomplete' => 'off'])->label(false);?>
</div>

<?php echo $form->field($userformmodel, 'kin_email[]')->textInput(['value' => (isset($studentkindetails[$i]['kin_email'])? $studentkindetails[$i]['kin_email'] : ''), 'autocomplete' => 'off'])->label('Email');?>

<?php echo $form->field($userformmodel, 'kin_occupation[]')->textInput(['value' => (isset($studentkindetails[$i]['kin_occupation'])? $studentkindetails[$i]['kin_occupation'] : ''), 'autocomplete' => 'off'])->label('Occupation');?>
</div>
</div>
</div>
<?php } ?>
<div class="add-kin"></div>
				</div>
			</fieldset>
			</div>
			
			
			<div class="row usercreateformrow">
			<fieldset>
			<legend>Programme Information:</legend>
				<div class="col-xs-12 col-sm-12">
					<div class="col-xs-8 col-sm-6 leftform">
					
					<?php echo $form->field($userformmodel, 'sponsor_type')->dropDownList([ 'Government Scholarship' => 'Government Scholarship', 'BSP Scholarship' => 'BSP Scholarship', 'Fee Paying' => 'Fee Paying', 'In-Service' => 'In-Service', 'MFA Scholarship (BDGS)' => 'MFA Scholarship (BDGS)', 'UTB Scholarship' => 'UTB Scholarship', 'Other' => 'Other'],['prompt' => 'Select Sponsor Type'])->label('Sponsor Type <span class="mandatory">*</span>');?>	
		
					<?php echo $form->field($userformmodel, 'sponsor_type_other')->textInput(['value' => (isset($studentdata['sponsor_type_other'])? $studentdata['sponsor_type_other'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>
					
					<?php echo $form->field($userformmodel, 'type_of_programme')->dropDownList(['Undergraduate Degree' => 'Undergraduate Degree', 'Masters by Coursework' => 'Masters by Coursework', 'Masters by Research' => 'Masters by Research', 'Doctor of Philosophy (PhD)' => 'Doctor of Philosophy (PhD)'], ['prompt' => 'Select Type of Programme'])->label('Type of Programme <span class="mandatory">*</span>');?>
					
					<?php echo $form->field($userformmodel, 'school')->dropDownList(ArrayHelper::map($faculty,'id','faculty_name'),['prompt'=>'Please select School/Faculty'])->label('School/Faculty <span class="mandatory">*</span>'); ?>
				
					<?php echo $form->field($userformmodel, 'programme_name')->dropDownList(ArrayHelper::map($programme,'id','programme_name'),['prompt'=>'Please select Programme'])->label('Programme'); ?>
					
					<?php echo $form->field($userformmodel, 'entry')->dropDownList(['First Year' => 'First Year', 'Second Year' => 'Second Year', 'Other' => 'Other'], ['prompt' => 'Select Entry'])->label('Entry <span class="mandatory">*</span>');?>
					
					<?php echo $form->field($userformmodel, 'entry_other')->textInput(['value' => (isset($studentdata['entry_other'])? $studentdata['entry_other'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

					<?php echo $form->field($userformmodel, 'status_of_student')->dropDownList(['Current Student' => 'Current Student', 'Withdrawn' => 'Withdrawn', 'Repeat' => 'Repeat', 'Interruption of study' => 'Interruption of study', 'Other' => 'Other'], ['prompt' => 'Select Status of Student'])->label('Status of Student <span class="mandatory">*</span>');?>
					
					<?php echo $form->field($userformmodel, 'status_of_student_other')->textInput(['value' => (isset($studentdata['status_of_student_other'])? $studentdata['status_of_student_other'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>

					<?php //echo $form->field($userformmodel, 'status_remarks')->textarea(['rows' => 2,'autocomplete' => 'off', 'value'=> (isset($studentdata['status_remarks'])? $studentdata['status_remarks'] : '')])->label('Status Remarks');?>

					

					</div>
					<div class="col-xs-8 col-sm-6">
					
					<?php echo $form->field($userformmodel, 'intake')->dropDownList($years,['prompt' => 'Select Intake No'])->label('Intake No. <span class="mandatory">*</span>');?>

					<?php echo $form->field($userformmodel, 'mode')->dropDownList(['Full Time' => 'Full Time', 'Part Time'=> 'Part Time'],['prompt' => 'Select Mode'])->label('Mode <span class="mandatory">*</span>');?>

					<?php echo $form->field($userformmodel, 'utb_email_address')->textInput(['value' => (isset($studentdata['utb_email_address'])? $studentdata['utb_email_address'] : ''), 'autocomplete' => 'off'])->label('UTB Email Address <span class="mandatory">*</span>');?>

					
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

					<?php //echo $form->field($userformmodel, 'previous_roll_no')->textInput(['value' => (isset($studentdata['previous_roll_no'])? $studentdata['previous_roll_no'] : ''), 'autocomplete' => 'off'])->label('Previous Roll No');?>

					<?php //echo $form->field($userformmodel, 'previous_programme_name')->textInput(['value' => (isset($studentdata['previous_programme_name'])? $studentdata['previous_programme_name'] : ''), 'autocomplete' => 'off'])->label('Previous Programmme Name');?>

					<?php //echo $form->field($userformmodel, 'previous_intake_no')->dropDownList($years,['prompt' => 'Select Previous Intake No'])->label('Previous Intake No');?>

					<?php //echo $form->field($userformmodel, 'previous_utb_email')->textInput(['value' => (isset($studentdata['previous_utb_email'])? $studentdata['previous_utb_email'] : ''), 'autocomplete' => 'off'])->label('Previous UTB Email');?>


						<?php echo $form->field($userformmodel, 'studentid')->hiddenInput(['autocomplete' => 'off','value'=>!empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : ''])->label(false);?>
					
					</div>
				</div>
				</fieldset>
			</div>
			
			
			<div class="row usercreateformrow">
			<fieldset id="bankdetails">
				<legend>Bank Details:</legend>
				<div class="col-xs-12 col-sm-12">
					<div class="col-xs-8 col-sm-6 leftform">
					
						<?php echo $form->field($userformmodel, 'bank_name')->dropDownList([ 'BAIDURI' => 'BAIDURI', 'BIBD' => 'BIBD', 'STANDARD CHARTERED BANK' => 'STANDARD CHARTERED BANK', 'TAIB' => 'TAIB', 'Other' => 'Other'],['prompt' => 'Select Bank'])->label('Bank Name <span class="mandatory">*</span>'); ?>
		
						<?php echo $form->field($userformmodel, 'bank_name_other')->textInput(['value' => (isset($studentdata['bank_name_other'])? $studentdata['bank_name_other'] : ''), 'autocomplete' => 'off' ])->label('Other'); ?>
		
					</div>
					<div class="col-xs-8 col-sm-6">
					
					<?php echo $form->field($userformmodel, 'bank_account_name')->textInput(['value' => (isset($studentdata['bank_account_name'])? $studentdata['bank_account_name'] : ''), 'autocomplete' => 'off' ])->label('Bank Account Name'); ?>

					<?php echo $form->field($userformmodel, 'account_no')->textInput(['value' => (isset($studentdata['account_no'])? $studentdata['account_no'] : ''), 'autocomplete' => 'off' ])->label('Bank Account No <span class="mandatory">*</span>');?>
					
					</div>
				</div>
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
	$('#hq_a_level_addmore').click(function(){
		var addmorefields = '';
		addmorefields += '<div class="hq_a_level_more hqdata">';
		addmorefields += '<div class="hq_a_level_remove removehq">- Remove</div>';
		addmorefields += '<div class="form-group field-createstudentform-hq_a_level_year hqfields hqfields1">';
		addmorefields += '<input type="text" class="createstudentform-hq_a_level_year form-control" name="CreateStudentForm[hq_a_level_year][]" autocomplete="off" placeholder="Year">';
		addmorefields += '</div>';			
		addmorefields += '<div class="form-group field-createstudentform-hq_a_level_subject hqfields hqfields2">';
		addmorefields += '<input type="text" class="createstudentform-hq_a_level_subject form-control" name="CreateStudentForm[hq_a_level_subject][]" autocomplete="off" placeholder="Subject">';
		addmorefields += '</div>';			
		addmorefields += '<div class="form-group field-createstudentform-hq_a_level_grade hqfields hqfields3">';
		addmorefields += '<input type="text" class="createstudentform-hq_a_level_grade form-control" name="CreateStudentForm[hq_a_level_grade][]" autocomplete="off" placeholder="Grade">';
		addmorefields += '</div>';		
		addmorefields += '</div>';
		$('.hq_a_level_addmore_fields').append(addmorefields);
		$('.hq_a_level_addmore_fields').addClass('hq_a_level_amore');
	});
	
	$('body').on('click', '.hq_a_level_remove', function() {
		$(this).closest('.hq_a_level_more').remove();
	});
	
	var deletehqurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/admin/delete-hq';
	$('body').on('click', '.removehq', function() {
		var hqid = $(this).attr('hqid');
		$('.hqdata'+hqid).remove();
		$.ajax({
                    url: deletehqurl,
                    type: "post",
                    data: {hqid:hqid},
                    success: function (data) {
						if(data == 1){							
						}
                        
                    }
                });
	});
	
	var highestqual = $('#createstudentform-highest_qualification').val();
	if(highestqual == 'Advanced National Diploma' || highestqual == 'Higher National Diploma' || highestqual == 'International Baccalaureate' || highestqual == 'Undergraduate Degree' || highestqual == 'Masters by Coursework' || highestqual == 'Masters by Research' || highestqual == 'Doctor of Philosophy (PhD)'){
		$('#highest_qualification_details').show();
	}else{
		$('#highest_qualification_details').hide();
	}
	if(highestqual == 'A Level'){
		$('#hq_a_level_details').show();
	}else{
		$('#hq_a_level_details').hide();
	}
	$('#createstudentform-highest_qualification').change(function(){
		var highestqual = $(this).val();
		if(highestqual == 'Advanced National Diploma' || highestqual == 'Higher National Diploma' || highestqual == 'International Baccalaureate' || highestqual == 'Undergraduate Degree' || highestqual == 'Masters by Coursework' || highestqual == 'Masters by Research' || highestqual == 'Doctor of Philosophy (PhD)'){
			$('#highest_qualification_details').show();
		}else{
			$('#highest_qualification_details').hide();
		}
		
		if(highestqual == 'A Level'){
			$('#hq_a_level_details').show();
		}else{
			$('#hq_a_level_details').hide();
		}
	});
	
	var bankdetails = $('#createstudentform-sponsor_type').val();
	if(bankdetails == 'Government Scholarship' || bankdetails == 'UTB Scholarship'){
		$('#bankdetails').show();
	}else{
		$('#bankdetails').hide();
	}
	$('#createstudentform-sponsor_type').change(function(){
		if($(this).val() == 'Government Scholarship' || $(this).val() == 'UTB Scholarship'){
			$('#bankdetails').show();
		}else{
			$('#bankdetails').hide();
		}
	});
	
	var deletekinurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/admin/delete-kin';
	$('body').on('click', '.removekin', function() {
		var kinid = $(this).attr('kinid');
		$(this).closest('.kindata').remove();
		$.ajax({
                    url: deletekinurl,
                    type: "post",
                    data: {kinid:kinid},
                    success: function (data) {
						if(data == 1){							
						}
                        
                    }
                });
	});
	
	$('body').on('change', '.field-createstudentform-kin_relationship select', function() {
	if($(this).val() == 'Others'){
		$(this).closest('.kindata').find('.kinothers').show();
	}else{
		$(this).closest('.kindata').find('.kinothers').hide();
	}
});

$('body').on('change', '.field-createstudentform-emergency_relationship select', function() {
	if($(this).val() == 'Others'){
		$('.field-createstudentform-emergency_relationship_others').show();
	}else{
		$('.field-createstudentform-emergency_relationship_others').hide();
	}
});


$('body').on('change', '.kinphonecode', function() {
	var phonecode = $(this).val();
	$(this).closest('.kinphone').find('.kin-country-code').empty();
	$(this).closest('.kinphone').find('.kin-country-code').append('('+phonecode+')');
});

$('body').on('change', '.kinmobilecode', function() {
	var phonecode = $(this).val();
	$(this).closest('.kinmobile').find('.kin-mobile-code').empty();
	$(this).closest('.kinmobile').find('.kin-mobile-code').append('('+phonecode+')');
});

$('body').on('change', '.emergencyphonecode', function() {
	var phonecode = $(this).val();
	$('.emergency-country-code').empty();
	$('.emergency-country-code').append('('+phonecode+')');
});

$('body').on('change', '.emergencymobilecode', function() {
	var phonecode = $(this).val();
	$('.emergency-mobile-code').empty();
	$('.emergency-mobile-code').append('('+phonecode+')');
});

$('body').on('change', '.emergencyofficenocode', function() {
	var phonecode = $(this).val();
	$('.emergency-officeno-code').empty();
	$('.emergency-officeno-code').append('('+phonecode+')');
});

var emergencyphonecode = $('.emergencyphonecode').val();
var emergencymobilecode = $('.emergencymobilecode').val();
var emergencyofficenocode = $('.emergencyofficenocode').val();
if(emergencyphonecode != ''){
	$('.emergency-country-code').append('('+emergencyphonecode+')');
}

if(emergencymobilecode != ''){
	$('.emergency-mobile-code').append('('+emergencymobilecode+')');
}

if(emergencyofficenocode != ''){
	$('.emergency-officeno-code').append('('+emergencyofficenocode+')');
}

	
	$('.addmorekin').click(function(){
	var kinfield = '';
	kinfield += '<div class="col-xs-12 col-sm-12">';
	kinfield += '<div class="kindata">';
	kinfield += '<div class="row">';
	kinfield += '<div class="col-xs-8 col-sm-6 leftform">';
	kinfield += '<div class="removekin">- Remove</div>';
	kinfield += '<div class="form-group field-createstudentform-kin_relationship">';
	kinfield += '<label class="control-label" for="createstudentform-kin_relationship">Relationship</label>';
	kinfield += '<select id="createstudentform-kin_relationship" class="form-control" name="CreateStudentForm[kin_relationship][]">';
	kinfield += '<option value="">Select Relationship</option>';
	kinfield += '<option value="Father">Father</option>';
	kinfield += '<option value="Mother">Mother</option>';
	kinfield += '<option value="Guardian">Guardian</option>';
	kinfield += '<option value="Husband">Husband</option>';
	kinfield += '<option value="Wife">Wife</option>';
	kinfield += '<option value="Sibling">Sibling</option>';
	kinfield += '<option value="Son">Son</option>';
	kinfield += '<option value="Daughter">Daughter</option>';
	kinfield += '<option value="Relative">Relative</option>';
	kinfield += '<option value="Others">Others</option>';
	kinfield += '</select>';
	kinfield += '</div>';

	kinfield += '<div class="kinothers"  style="display:none">';
	kinfield += '<div class="form-group field-createstudentform-kin_relationship_others">';
	kinfield += '<label class="control-label" for="createstudentform-kin_relationship_others">Others</label>';
	kinfield += '<input type="text" id="createstudentform-kin_relationship_others" class="form-control" name="CreateStudentForm[kin_relationship_others][]" autocomplete="off">';
	kinfield += '</div>';
	kinfield += '</div>';
	
	kinfield += '<div class="form-group field-createstudentform-kin_name">';
	kinfield += '<label class="control-label" for="createstudentform-kin_name">Name</label>';
	kinfield += '<input type="text" id="createstudentform-kin_name" class="form-control" name="CreateStudentForm[kin_name][]" autocomplete="off">';
	kinfield += '</div>';

	kinfield += '<div class="form-group field-createstudentform-kin_address">';
	kinfield += '<label class="control-label" for="createstudentform-kin_address">Address</label>';
	kinfield += '<textarea id="createstudentform-kin_address" class="form-control" name="CreateStudentForm[kin_address][]" rows="2" autocomplete="off" placeholder="Address Line One"></textarea>';
	kinfield += '</div>';

	kinfield += '<div class="form-group field-createstudentform-kin_address2">';
	kinfield += '<textarea id="createstudentform-kin_address2" class="form-control" name="CreateStudentForm[kin_address2][]" rows="2" autocomplete="off" placeholder="Address Line Two"></textarea>';
	kinfield += '</div>';

	kinfield += '<div class="form-group field-createstudentform-kin_address3">';
	kinfield += '<textarea id="createstudentform-kin_address3" class="form-control" name="CreateStudentForm[kin_address3][]" rows="2" autocomplete="off" placeholder="Address Line Three"></textarea>';
	kinfield += '</div>';
	kinfield += '</div>';

	kinfield += '<div class="col-xs-8 col-sm-6">';
	kinfield += '<div class="icnoformat">';
	kinfield += '<div class="form-group field-createstudentform-kin_id_card_no_code">';
	kinfield += '<label class="control-label" for="createstudentform-kin_id_card_no_code">Identity Card No.</label>';
	kinfield += '<input type="text" id="createstudentform-kin_id_card_no_code" class="form-control" name="CreateStudentForm[kin_id_card_no_code][]" autocomplete="off">';
	kinfield += '</div>';
	
	kinfield += '<div class="idcard-hiphen">–</div>';

	kinfield += '<div class="form-group field-createstudentform-kin_id_card_no">';
	kinfield += '<input type="text" id="createstudentform-kin_id_card_no" class="form-control" name="CreateStudentForm[kin_id_card_no][]" autocomplete="off">';
	kinfield += '</div>';
	kinfield += '</div>';

	kinfield += '<div class="icnoformat kinphone">';
	kinfield += '<div class="form-group field-createstudentform-kin_phone_country_code">';
	kinfield += '<label class="control-label" for="createstudentform-kin_phone_country_code">Phone No.</label>';
	kinfield += '<select id="createstudentform-kin_phone_country_code" class="form-control kinphonecode" name="CreateStudentForm[kin_phone_country_code][]">';
	kinfield += '<option value="">Select Country</option>';
	kinfield += '<option value="93">Afganistan</option>';
	kinfield += '<option value="355">Albania</option>';
	kinfield += '<option value="213">Algeria</option>';
	kinfield += '<option value="1-684">Samoa American</option>';
	kinfield += '<option value="376">Andorra</option>';
	kinfield += '<option value="244">Angola</option>';
	kinfield += '<option value="1-264">Anguilla</option>';
	kinfield += '<option value="1-268">Antigua &amp;amp; Barbuda</option>';
	kinfield += '<option value="54">Argentina</option>';
	kinfield += '<option value="374">Armenia</option>';
	kinfield += '<option value="297">Aruba</option>';
	kinfield += '<option value="61">Cocos Island</option>';
	kinfield += '<option value="43">Austria</option>';
	kinfield += '<option value="994">Azerbaijan</option>';
	kinfield += '<option value="1-242">Bahamas</option>';
	kinfield += '<option value="973">Bahrain</option>';
	kinfield += '<option value="880">Bangladesh</option>';
	kinfield += '<option value="1-246">Barbados</option>';
	kinfield += '<option value="375">Belarus</option>';
	kinfield += '<option value="32">Belgium</option>';
	kinfield += '<option value="501">Belize</option>';
	kinfield += '<option value="229">Benin</option>';
	kinfield += '<option value="1-441">Bermuda</option>';
	kinfield += '<option value="975">Bhutan</option>';
	kinfield += '<option value="591">Bolivia</option>';
	kinfield += '<option value="599-7">Bonaire</option>';
	kinfield += '<option value="387">Bosnia &amp;amp; Herzegovina</option>';
	kinfield += '<option value="267">Botswana</option>';
	kinfield += '<option value="55">Brazil</option>';
	kinfield += '<option value="246">British Indian Ocean Territory</option>';
	kinfield += '<option value="673">Brunei</option>';
	kinfield += '<option value="359">Bulgaria</option>';
	kinfield += '<option value="226">Burkina Faso</option>';
	kinfield += '<option value="257">Burundi</option>';
	kinfield += '<option value="855">Cambodia</option>';
	kinfield += '<option value="237">Cameroon</option>';
	kinfield += '<option value="1">United States of America</option>';
	kinfield += '<option value="238">Cape Verde</option>';
	kinfield += '<option value="1-345">Cayman Islands</option>';
	kinfield += '<option value="236">Central African Republic</option>';
	kinfield += '<option value="235">Chad</option>';
	kinfield += '<option value="56">Chile</option>';
	kinfield += '<option value="86">China</option>';
	kinfield += '<option value="57">Colombia</option>';
	kinfield += '<option value="269">Comoros</option>';
	kinfield += '<option value="242">Congo</option>';
	kinfield += '<option value="682">Cook Islands</option>';
	kinfield += '<option value="506">Costa Rica</option>';
	kinfield += '<option value="385">Croatia</option>';
	kinfield += '<option value="53">Cuba</option>';
	kinfield += '<option value="599">Curaco</option>';
	kinfield += '<option value="357">Cyprus</option>';
	kinfield += '<option value="420">Czech Republic</option>';
	kinfield += '<option value="45">Denmark</option>';
	kinfield += '<option value="253">Djibouti</option>';
	kinfield += '<option value="1-767">Dominica</option>';
	kinfield += '<option value="1-809, 1-829, 1-849">Dominican Republic</option>';
	kinfield += '<option value="670">East Timor</option>';
	kinfield += '<option value="593">Ecuador</option>';
	kinfield += '<option value="20">Egypt</option>';
	kinfield += '<option value="503">El Salvador</option>';
	kinfield += '<option value="240">Equatorial Guinea</option>';
	kinfield += '<option value="291">Eritrea</option>';
	kinfield += '<option value="372">Estonia</option>';
	kinfield += '<option value="251">Ethiopia</option>';
	kinfield += '<option value="500">Falkland Islands</option>';
	kinfield += '<option value="298">Faroe Islands</option>';
	kinfield += '<option value="679">Fiji</option>';
	kinfield += '<option value="358">Finland</option>';
	kinfield += '<option value="33">France</option>';
	kinfield += '<option value="594">French Guiana</option>';
	kinfield += '<option value="689">Tahiti</option>';
	kinfield += '<option value="241">Gabon</option>';
	kinfield += '<option value="220">Gambia</option>';
	kinfield += '<option value="995">Georgia</option>';
	kinfield += '<option value="49">Germany</option>';
	kinfield += '<option value="233">Ghana</option>';
	kinfield += '<option value="350">Gibraltar</option>';
	kinfield += '<option value="30">Greece</option>';
	kinfield += '<option value="299">Greenland</option>';
	kinfield += '<option value="1-473">Grenada</option>';
	kinfield += '<option value="590">St Maarten</option>';
	kinfield += '<option value="1-671">Guam</option>';
	kinfield += '<option value="502">Guatemala</option>';
	kinfield += '<option value="224">Guinea</option>';
	kinfield += '<option value="592">Guyana</option>';
	kinfield += '<option value="509">Haiti</option>';
	kinfield += '<option value="808">Hawaii</option>';
	kinfield += '<option value="504">Honduras</option>';
	kinfield += '<option value="852">Hong Kong</option>';
	kinfield += '<option value="36">Hungary</option>';
	kinfield += '<option value="354">Iceland</option>';
	kinfield += '<option value="91">India</option>';
	kinfield += '<option value="62">Indonesia</option>';
	kinfield += '<option value="98">Iran</option>';
	kinfield += '<option value="964">Iraq</option>';
	kinfield += '<option value="353">Ireland</option>';
	kinfield += '<option value="44-1624">Isle of Man</option>';
	kinfield += '<option value="972">Israel</option>';
	kinfield += '<option value="39">Italy</option>';
	kinfield += '<option value="1-876">Jamaica</option>';
	kinfield += '<option value="81">Japan</option>';
	kinfield += '<option value="962">Jordan</option>';
	kinfield += '<option value="7">Russia</option>';
	kinfield += '<option value="254">Kenya</option>';
	kinfield += '<option value="686">Kiribati</option>';
	kinfield += '<option value="850">Korea North</option>';
	kinfield += '<option value="82">Korea South</option>';
	kinfield += '<option value="965">Kuwait</option>';
	kinfield += '<option value="996">Kyrgyzstan</option>';
	kinfield += '<option value="856">Laos</option>';
	kinfield += '<option value="371">Latvia</option>';
	kinfield += '<option value="961">Lebanon</option>';
	kinfield += '<option value="266">Lesotho</option>';
	kinfield += '<option value="231">Liberia</option>';
	kinfield += '<option value="218">Libya</option>';
	kinfield += '<option value="423">Liechtenstein</option>';
	kinfield += '<option value="370">Lithuania</option>';
	kinfield += '<option value="352">Luxembourg</option>';
	kinfield += '<option value="853">Macau</option>';
	kinfield += '<option value="389">Macedonia</option>';
	kinfield += '<option value="261">Madagascar</option>';
	kinfield += '<option value="60">Malaysia</option>';
	kinfield += '<option value="265">Malawi</option>';
	kinfield += '<option value="960">Maldives</option>';
	kinfield += '<option value="223">Mali</option>';
	kinfield += '<option value="356">Malta</option>';
	kinfield += '<option value="692">Marshall Islands</option>';
	kinfield += '<option value="596">Martinique</option>';
	kinfield += '<option value="222">Mauritania</option>';
	kinfield += '<option value="230">Mauritius</option>';
	kinfield += '<option value="262">Reunion</option>';
	kinfield += '<option value="52">Mexico</option>';
	kinfield += '<option value="373">Moldova</option>';
	kinfield += '<option value="377">Monaco</option>';
	kinfield += '<option value="976">Mongolia</option>';
	kinfield += '<option value="1-664">Montserrat</option>';
	kinfield += '<option value="212">Morocco</option>';
	kinfield += '<option value="258">Mozambique</option>';
	kinfield += '<option value="95">Myanmar</option>';
	kinfield += '<option value="264">Nambia</option>';
	kinfield += '<option value="674">Nauru</option>';
	kinfield += '<option value="977">Nepal</option>';
	kinfield += '<option value="31">Netherlands</option>';
	kinfield += '<option value="1-869">St Kitts-Nevis</option>';
	kinfield += '<option value="687">New Caledonia</option>';
	kinfield += '<option value="64">Pitcairn Island</option>';
	kinfield += '<option value="505">Nicaragua</option>';
	kinfield += '<option value="227">Niger</option>';
	kinfield += '<option value="234">Nigeria</option>';
	kinfield += '<option value="683">Niue</option>';
	kinfield += '<option value="672-3">Norfolk Island</option>';
	kinfield += '<option value="47">Norway</option>';
	kinfield += '<option value="968">Oman</option>';
	kinfield += '<option value="92">Pakistan</option>';
	kinfield += '<option value="680">Palau Island</option>';
	kinfield += '<option value="970">Palestine</option>';
	kinfield += '<option value="507">Panama</option>';
	kinfield += '<option value="675">Papua New Guinea</option>';
	kinfield += '<option value="595">Paraguay</option>';
	kinfield += '<option value="51">Peru</option>';
	kinfield += '<option value="63">Phillipines</option>';
	kinfield += '<option value="48">Poland</option>';
	kinfield += '<option value="351">Portugal</option>';
	kinfield += '<option value="1-787, 1-939">Puerto Rico</option>';
	kinfield += '<option value="974">Qatar</option>';
	kinfield += '<option value="382">Republic of Montenegro</option>';
	kinfield += '<option value="381">Serbia</option>';
	kinfield += '<option value="40">Romania</option>';
	kinfield += '<option value="250">Rwanda</option>';
	kinfield += '<option value="599-3">St Eustatius</option>';
	kinfield += '<option value="290">St Helena</option>';
	kinfield += '<option value="1-758">St Lucia</option>';
	kinfield += '<option value="508">St Pierre &amp;amp; Miquelon</option>';
	kinfield += '<option value="1-784">St Vincent &amp;amp; Grenadines</option>';
	kinfield += '<option value="1-670">Saipan</option>';
	kinfield += '<option value="685">Samoa</option>';
	kinfield += '<option value="378">San Marino</option>';
	kinfield += '<option value="239">Sao Tome &amp;amp; Principe</option>';
	kinfield += '<option value="966">Saudi Arabia</option>';
	kinfield += '<option value="221">Senegal</option>';
	kinfield += '<option value="248">Seychelles</option>';
	kinfield += '<option value="232">Sierra Leone</option>';
	kinfield += '<option value="65">Singapore</option>';
	kinfield += '<option value="421">Slovakia</option>';
	kinfield += '<option value="386">Slovenia</option>';
	kinfield += '<option value="677">Solomon Islands</option>';
	kinfield += '<option value="252">Somalia</option>';
	kinfield += '<option value="27">South Africa</option>';
	kinfield += '<option value="34">Spain</option>';
	kinfield += '<option value="94">Sri Lanka</option>';
	kinfield += '<option value="249">Sudan</option>';
	kinfield += '<option value="597">Suriname</option>';
	kinfield += '<option value="268">Swaziland</option>';
	kinfield += '<option value="46">Sweden</option>';
	kinfield += '<option value="41">Switzerland</option>';
	kinfield += '<option value="963">Syria</option>';
	kinfield += '<option value="886">Taiwan</option>';
	kinfield += '<option value="992">Tajikistan</option>';
	kinfield += '<option value="255">Tanzania</option>';
	kinfield += '<option value="66">Thailand</option>';
	kinfield += '<option value="228">Togo</option>';
	kinfield += '<option value="690">Tokelau</option>';
	kinfield += '<option value="676">Tonga</option>';
	kinfield += '<option value="1-868">Trinidad &amp;amp; Tobago</option>';
	kinfield += '<option value="216">Tunisia</option>';
	kinfield += '<option value="90">Turkey</option>';
	kinfield += '<option value="993">Turkmenistan</option>';
	kinfield += '<option value="1-649">Turks &amp;amp; Caicos Island</option>';
	kinfield += '<option value="688">Tuvalu</option>';
	kinfield += '<option value="256">Uganda</option>';
	kinfield += '<option value="380">Ukraine</option>';
	kinfield += '<option value="971">United Arab Erimates</option>';
	kinfield += '<option value="44">United Kingdom</option>';
	kinfield += '<option value="598">Uraguay</option>';
	kinfield += '<option value="998">Uzbekistan</option>';
	kinfield += '<option value="678">Vanuatu</option>';
	kinfield += '<option value="379">Vatican City State</option>';
	kinfield += '<option value="58">Venezuela</option>';
	kinfield += '<option value="84">Vietnam</option>';
	kinfield += '<option value="1-284">Virgin Islands (Brit)</option>';
	kinfield += '<option value="1-340">Virgin Islands (USA)</option>';
	kinfield += '<option value="681">Wallis &amp;amp; Futana Island</option>';
	kinfield += '<option value="967">Yemen</option>';
	kinfield += '<option value="243">Zaire</option>';
	kinfield += '<option value="260">Zambia</option>';
	kinfield += '<option value="263">Zimbabwe</option>';
	kinfield += '</select>';

	kinfield += '<div class="help-block"></div>';
	kinfield += '</div>';
	
	kinfield += '<div class="kin-country-code"></div>';

	kinfield += '<div class="form-group field-createstudentform-kin_phone">';
	kinfield += '<input type="text" id="createstudentform-kin_phone" class="form-control" name="CreateStudentForm[kin_phone][]" autocomplete="off">';
	kinfield += '</div>';
	kinfield += '</div>';

	kinfield += '<div class="icnoformat kinmobile">';
	kinfield += '<div class="form-group field-createstudentform-kin_mobile_country_code">';
	kinfield += '<label class="control-label" for="createstudentform-kin_mobile_country_code">Mobile No.</label>';
	kinfield += '<select id="createstudentform-kin_mobile_country_code" class="form-control kinmobilecode" name="CreateStudentForm[kin_mobile_country_code][]">';
	kinfield += '<option value="">Select Country</option>';
	kinfield += '<option value="93">Afganistan</option>';
	kinfield += '<option value="355">Albania</option>';
	kinfield += '<option value="213">Algeria</option>';
	kinfield += '<option value="1-684">Samoa American</option>';
	kinfield += '<option value="376">Andorra</option>';
	kinfield += '<option value="244">Angola</option>';
	kinfield += '<option value="1-264">Anguilla</option>';
	kinfield += '<option value="1-268">Antigua &amp;amp; Barbuda</option>';
	kinfield += '<option value="54">Argentina</option>';
	kinfield += '<option value="374">Armenia</option>';
	kinfield += '<option value="297">Aruba</option>';
	kinfield += '<option value="61">Cocos Island</option>';
	kinfield += '<option value="43">Austria</option>';
	kinfield += '<option value="994">Azerbaijan</option>';
	kinfield += '<option value="1-242">Bahamas</option>';
	kinfield += '<option value="973">Bahrain</option>';
	kinfield += '<option value="880">Bangladesh</option>';
	kinfield += '<option value="1-246">Barbados</option>';
	kinfield += '<option value="375">Belarus</option>';
	kinfield += '<option value="32">Belgium</option>';
	kinfield += '<option value="501">Belize</option>';
	kinfield += '<option value="229">Benin</option>';
	kinfield += '<option value="1-441">Bermuda</option>';
	kinfield += '<option value="975">Bhutan</option>';
	kinfield += '<option value="591">Bolivia</option>';
	kinfield += '<option value="599-7">Bonaire</option>';
	kinfield += '<option value="387">Bosnia &amp;amp; Herzegovina</option>';
	kinfield += '<option value="267">Botswana</option>';
	kinfield += '<option value="55">Brazil</option>';
	kinfield += '<option value="246">British Indian Ocean Territory</option>';
	kinfield += '<option value="673">Brunei</option>';
	kinfield += '<option value="359">Bulgaria</option>';
	kinfield += '<option value="226">Burkina Faso</option>';
	kinfield += '<option value="257">Burundi</option>';
	kinfield += '<option value="855">Cambodia</option>';
	kinfield += '<option value="237">Cameroon</option>';
	kinfield += '<option value="1">United States of America</option>';
	kinfield += '<option value="238">Cape Verde</option>';
	kinfield += '<option value="1-345">Cayman Islands</option>';
	kinfield += '<option value="236">Central African Republic</option>';
	kinfield += '<option value="235">Chad</option>';
	kinfield += '<option value="56">Chile</option>';
	kinfield += '<option value="86">China</option>';
	kinfield += '<option value="57">Colombia</option>';
	kinfield += '<option value="269">Comoros</option>';
	kinfield += '<option value="242">Congo</option>';
	kinfield += '<option value="682">Cook Islands</option>';
	kinfield += '<option value="506">Costa Rica</option>';
	kinfield += '<option value="385">Croatia</option>';
	kinfield += '<option value="53">Cuba</option>';
	kinfield += '<option value="599">Curaco</option>';
	kinfield += '<option value="357">Cyprus</option>';
	kinfield += '<option value="420">Czech Republic</option>';
	kinfield += '<option value="45">Denmark</option>';
	kinfield += '<option value="253">Djibouti</option>';
	kinfield += '<option value="1-767">Dominica</option>';
	kinfield += '<option value="1-809, 1-829, 1-849">Dominican Republic</option>';
	kinfield += '<option value="670">East Timor</option>';
	kinfield += '<option value="593">Ecuador</option>';
	kinfield += '<option value="20">Egypt</option>';
	kinfield += '<option value="503">El Salvador</option>';
	kinfield += '<option value="240">Equatorial Guinea</option>';
	kinfield += '<option value="291">Eritrea</option>';
	kinfield += '<option value="372">Estonia</option>';
	kinfield += '<option value="251">Ethiopia</option>';
	kinfield += '<option value="500">Falkland Islands</option>';
	kinfield += '<option value="298">Faroe Islands</option>';
	kinfield += '<option value="679">Fiji</option>';
	kinfield += '<option value="358">Finland</option>';
	kinfield += '<option value="33">France</option>';
	kinfield += '<option value="594">French Guiana</option>';
	kinfield += '<option value="689">Tahiti</option>';
	kinfield += '<option value="241">Gabon</option>';
	kinfield += '<option value="220">Gambia</option>';
	kinfield += '<option value="995">Georgia</option>';
	kinfield += '<option value="49">Germany</option>';
	kinfield += '<option value="233">Ghana</option>';
	kinfield += '<option value="350">Gibraltar</option>';
	kinfield += '<option value="30">Greece</option>';
	kinfield += '<option value="299">Greenland</option>';
	kinfield += '<option value="1-473">Grenada</option>';
	kinfield += '<option value="590">St Maarten</option>';
	kinfield += '<option value="1-671">Guam</option>';
	kinfield += '<option value="502">Guatemala</option>';
	kinfield += '<option value="224">Guinea</option>';
	kinfield += '<option value="592">Guyana</option>';
	kinfield += '<option value="509">Haiti</option>';
	kinfield += '<option value="808">Hawaii</option>';
	kinfield += '<option value="504">Honduras</option>';
	kinfield += '<option value="852">Hong Kong</option>';
	kinfield += '<option value="36">Hungary</option>';
	kinfield += '<option value="354">Iceland</option>';
	kinfield += '<option value="91">India</option>';
	kinfield += '<option value="62">Indonesia</option>';
	kinfield += '<option value="98">Iran</option>';
	kinfield += '<option value="964">Iraq</option>';
	kinfield += '<option value="353">Ireland</option>';
	kinfield += '<option value="44-1624">Isle of Man</option>';
	kinfield += '<option value="972">Israel</option>';
	kinfield += '<option value="39">Italy</option>';
	kinfield += '<option value="1-876">Jamaica</option>';
	kinfield += '<option value="81">Japan</option>';
	kinfield += '<option value="962">Jordan</option>';
	kinfield += '<option value="7">Russia</option>';
	kinfield += '<option value="254">Kenya</option>';
	kinfield += '<option value="686">Kiribati</option>';
	kinfield += '<option value="850">Korea North</option>';
	kinfield += '<option value="82">Korea South</option>';
	kinfield += '<option value="965">Kuwait</option>';
	kinfield += '<option value="996">Kyrgyzstan</option>';
	kinfield += '<option value="856">Laos</option>';
	kinfield += '<option value="371">Latvia</option>';
	kinfield += '<option value="961">Lebanon</option>';
	kinfield += '<option value="266">Lesotho</option>';
	kinfield += '<option value="231">Liberia</option>';
	kinfield += '<option value="218">Libya</option>';
	kinfield += '<option value="423">Liechtenstein</option>';
	kinfield += '<option value="370">Lithuania</option>';
	kinfield += '<option value="352">Luxembourg</option>';
	kinfield += '<option value="853">Macau</option>';
	kinfield += '<option value="389">Macedonia</option>';
	kinfield += '<option value="261">Madagascar</option>';
	kinfield += '<option value="60">Malaysia</option>';
	kinfield += '<option value="265">Malawi</option>';
	kinfield += '<option value="960">Maldives</option>';
	kinfield += '<option value="223">Mali</option>';
	kinfield += '<option value="356">Malta</option>';
	kinfield += '<option value="692">Marshall Islands</option>';
	kinfield += '<option value="596">Martinique</option>';
	kinfield += '<option value="222">Mauritania</option>';
	kinfield += '<option value="230">Mauritius</option>';
	kinfield += '<option value="262">Reunion</option>';
	kinfield += '<option value="52">Mexico</option>';
	kinfield += '<option value="373">Moldova</option>';
	kinfield += '<option value="377">Monaco</option>';
	kinfield += '<option value="976">Mongolia</option>';
	kinfield += '<option value="1-664">Montserrat</option>';
	kinfield += '<option value="212">Morocco</option>';
	kinfield += '<option value="258">Mozambique</option>';
	kinfield += '<option value="95">Myanmar</option>';
	kinfield += '<option value="264">Nambia</option>';
	kinfield += '<option value="674">Nauru</option>';
	kinfield += '<option value="977">Nepal</option>';
	kinfield += '<option value="31">Netherlands</option>';
	kinfield += '<option value="1-869">St Kitts-Nevis</option>';
	kinfield += '<option value="687">New Caledonia</option>';
	kinfield += '<option value="64">Pitcairn Island</option>';
	kinfield += '<option value="505">Nicaragua</option>';
	kinfield += '<option value="227">Niger</option>';
	kinfield += '<option value="234">Nigeria</option>';
	kinfield += '<option value="683">Niue</option>';
	kinfield += '<option value="672-3">Norfolk Island</option>';
	kinfield += '<option value="47">Norway</option>';
	kinfield += '<option value="968">Oman</option>';
	kinfield += '<option value="92">Pakistan</option>';
	kinfield += '<option value="680">Palau Island</option>';
	kinfield += '<option value="970">Palestine</option>';
	kinfield += '<option value="507">Panama</option>';
	kinfield += '<option value="675">Papua New Guinea</option>';
	kinfield += '<option value="595">Paraguay</option>';
	kinfield += '<option value="51">Peru</option>';
	kinfield += '<option value="63">Phillipines</option>';
	kinfield += '<option value="48">Poland</option>';
	kinfield += '<option value="351">Portugal</option>';
	kinfield += '<option value="1-787, 1-939">Puerto Rico</option>';
	kinfield += '<option value="974">Qatar</option>';
	kinfield += '<option value="382">Republic of Montenegro</option>';
	kinfield += '<option value="381">Serbia</option>';
	kinfield += '<option value="40">Romania</option>';
	kinfield += '<option value="250">Rwanda</option>';
	kinfield += '<option value="599-3">St Eustatius</option>';
	kinfield += '<option value="290">St Helena</option>';
	kinfield += '<option value="1-758">St Lucia</option>';
	kinfield += '<option value="508">St Pierre &amp;amp; Miquelon</option>';
	kinfield += '<option value="1-784">St Vincent &amp;amp; Grenadines</option>';
	kinfield += '<option value="1-670">Saipan</option>';
	kinfield += '<option value="685">Samoa</option>';
	kinfield += '<option value="378">San Marino</option>';
	kinfield += '<option value="239">Sao Tome &amp;amp; Principe</option>';
	kinfield += '<option value="966">Saudi Arabia</option>';
	kinfield += '<option value="221">Senegal</option>';
	kinfield += '<option value="248">Seychelles</option>';
	kinfield += '<option value="232">Sierra Leone</option>';
	kinfield += '<option value="65">Singapore</option>';
	kinfield += '<option value="421">Slovakia</option>';
	kinfield += '<option value="386">Slovenia</option>';
	kinfield += '<option value="677">Solomon Islands</option>';
	kinfield += '<option value="252">Somalia</option>';
	kinfield += '<option value="27">South Africa</option>';
	kinfield += '<option value="34">Spain</option>';
	kinfield += '<option value="94">Sri Lanka</option>';
	kinfield += '<option value="249">Sudan</option>';
	kinfield += '<option value="597">Suriname</option>';
	kinfield += '<option value="268">Swaziland</option>';
	kinfield += '<option value="46">Sweden</option>';
	kinfield += '<option value="41">Switzerland</option>';
	kinfield += '<option value="963">Syria</option>';
	kinfield += '<option value="886">Taiwan</option>';
	kinfield += '<option value="992">Tajikistan</option>';
	kinfield += '<option value="255">Tanzania</option>';
	kinfield += '<option value="66">Thailand</option>';
	kinfield += '<option value="228">Togo</option>';
	kinfield += '<option value="690">Tokelau</option>';
	kinfield += '<option value="676">Tonga</option>';
	kinfield += '<option value="1-868">Trinidad &amp;amp; Tobago</option>';
	kinfield += '<option value="216">Tunisia</option>';
	kinfield += '<option value="90">Turkey</option>';
	kinfield += '<option value="993">Turkmenistan</option>';
	kinfield += '<option value="1-649">Turks &amp;amp; Caicos Island</option>';
	kinfield += '<option value="688">Tuvalu</option>';
	kinfield += '<option value="256">Uganda</option>';
	kinfield += '<option value="380">Ukraine</option>';
	kinfield += '<option value="971">United Arab Erimates</option>';
	kinfield += '<option value="44">United Kingdom</option>';
	kinfield += '<option value="598">Uraguay</option>';
	kinfield += '<option value="998">Uzbekistan</option>';
	kinfield += '<option value="678">Vanuatu</option>';
	kinfield += '<option value="379">Vatican City State</option>';
	kinfield += '<option value="58">Venezuela</option>';
	kinfield += '<option value="84">Vietnam</option>';
	kinfield += '<option value="1-284">Virgin Islands (Brit)</option>';
	kinfield += '<option value="1-340">Virgin Islands (USA)</option>';
	kinfield += '<option value="681">Wallis &amp;amp; Futana Island</option>';
	kinfield += '<option value="967">Yemen</option>';
	kinfield += '<option value="243">Zaire</option>';
	kinfield += '<option value="260">Zambia</option>';
	kinfield += '<option value="263">Zimbabwe</option>';
	kinfield += '</select>';

	kinfield += '<div class="help-block"></div>';
	kinfield += '</div>';
	
	kinfield += '<div class="kin-mobile-code"></div>';

	kinfield += '<div class="form-group field-createstudentform-kin_mobile">';
	kinfield += '<input type="text" id="createstudentform-kin_mobile" class="form-control" name="CreateStudentForm[kin_mobile][]" autocomplete="off">';
	kinfield += '</div>';
	kinfield += '</div>';

	kinfield += '<div class="form-group field-createstudentform-kin_email">';
	kinfield += '<label class="control-label" for="createstudentform-kin_email">Email</label>';
	kinfield += '<input type="text" id="createstudentform-kin_email" class="form-control" name="CreateStudentForm[kin_email][]" autocomplete="off">';
	kinfield += '</div>';

	kinfield += '<div class="form-group field-createstudentform-kin_occupation">';
	kinfield += '<label class="control-label" for="createstudentform-kin_occupation">Occupation</label>';
	kinfield += '<input type="text" id="createstudentform-kin_occupation" class="form-control" name="CreateStudentForm[kin_occupation][]" autocomplete="off">';
	kinfield += '</div>';
	kinfield += '</div>';
	kinfield += '</div>';
	kinfield += '</div>';
	kinfield += '</div>';
	$('.add-kin').append(kinfield);
});

	<?php for($i=0;$i<count($studentkindetails);$i++){  ?>
	var kinclass = <?php echo $studentkindetails[$i]["kin_id"]; ?>;
	var kinvalue = '<?php echo $studentkindetails[$i]["kin_relationship"]; ?>';
	$('.kinrelation'+kinclass+' select').val(kinvalue)
	
	<?php } ?>
	var mailing_permanent = <?php echo (isset($studentdata['mailing_permanent']) && $studentdata['mailing_permanent'] == 1) ? 1 : 0 ?>;
	$('#createstudentform-mailing_permanent').prop('checked', mailing_permanent);
	
	var bank_terms = <?php echo (isset($studentdata['bank_terms']) && $studentdata['bank_terms'] == 1) ? 1 : 0 ?>;
	$('#createstudentform-bank_terms').prop('checked', bank_terms);
	
	if(mailing_permanent == 1){
		$('#createstudentform-mailing_address').prop('readonly',true);
		//$('#createstudentform-mailing_address2').prop('readonly',true);
		//$('#createstudentform-mailing_address3').prop('readonly',true);
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
			//$('#createstudentform-mailing_address2').val($('#createstudentform-address2').val());
			//$('#createstudentform-mailing_address3').val($('#createstudentform-address3').val());
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
			//$('#createstudentform-mailing_address2').val('');
			//$('#createstudentform-mailing_address3').val('');
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
		//$('#createstudentform-mailing_address2').prop('readonly',true);
		//$('#createstudentform-mailing_address3').prop('readonly',true);
		$('#createstudentform-mailing_countrycode').prop('disabled',true);
		$('#createstudentform-mailing_postal_code').prop('readonly',true);
		$('#createstudentform-mailing_state').attr('disabled','true');
		$('#createstudentform-mailing_district').prop('readonly',true);
			$('#createstudentform-mailing_address').val($('#createstudentform-address').val());
			//$('#createstudentform-mailing_address2').val($('#createstudentform-address2').val());
			//$('#createstudentform-mailing_address3').val($('#createstudentform-address3').val());
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
			//$('#createstudentform-mailing_address2').val('');
			//$('#createstudentform-mailing_address3').val('');
			$('#createstudentform-mailing_countrycode').val('');
			$('#createstudentform-mailing_postal_code').val('');
			$('#createstudentform-mailing_district').val('');
			$('#createstudentform-mailing_state').val('');
		$('#createstudentform-mailing_address').prop('readonly',false);
		//$('#createstudentform-mailing_address2').prop('readonly',false);
		//$('#createstudentform-mailing_address3').prop('readonly',false);
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
	$('.field-createstudentform-status_of_student_other').hide();
	$('.field-createstudentform-raceother').hide();
	$('.field-createstudentform-religionother').hide();
	$('.field-createstudentform-highestqualificationother').hide();
	$('.field-createstudentform-typeofentryother').hide();
	$('.field-createstudentform-bank_name_other').hide();
	$('.field-createstudentform-entry_other').hide();
	$('.field-createstudentform-emergency_relationship_others').hide();
	$('.field-createstudentform-typeofresidentialother').hide();
	var studentother = $('#createstudentform-nationality').val();
	var raceother = $('#createstudentform-race').val();
	var religionother = $('#createstudentform-religion').val();
	var highestqualificationother = $('#createstudentform-highest_qualification').val();
	var typeofentryother = $('#createstudentform-type_of_entry').val();
	var banknameother = $('#createstudentform-bank_name').val();
	var typeofresidentialother = $('#createstudentform-type_of_residential').val();
	var sponsortypeother = $('#createstudentform-sponsor_type').val();
	var statusofstudentother = $('#createstudentform-status_of_student').val();
	var emergencyrelationshipother = $('#createstudentform-emergency_relationship').val();
	var entryother = $('#createstudentform-entry').val();
	if(entryother && entryother=='Other'){
		$('.field-createstudentform-entry_other').show();
	}else{
			$('.field-createstudentform-entry_other').hide();
	}
	if(statusofstudentother && statusofstudentother=='Other'){
		$('.field-createstudentform-status_of_student_other').show();
	}else{
		$('.field-createstudentform-status_of_student_other').hide();
	}
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
	if(emergencyrelationshipother && emergencyrelationshipother=='Others'){
		$('.field-createstudentform-emergency_relationship_others').show();
	}else{
			$('.field-createstudentform-emergency_relationship_others').hide();
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
	$('#createstudentform-entry').change(function(){
		if($(this).val() == 'Other'){
			$('.field-createstudentform-entry_other').show();
		}else{
			$('.field-createstudentform-entry_other').hide();
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
	$('#createstudentform-status_of_student').change(function(){
		if($(this).val() == 'Other'){
			$('.field-createstudentform-status_of_student_other').show();
		}else{
			$('.field-createstudentform-status_of_student_other').hide();
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
					digits: true,
					minlength: 6,
					maxlength: 6
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
					email: true
				},
				"CreateStudentForm[emailother]": {
					email: true
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
				/*"CreateStudentForm[address2]": {
                    required: true,
				},
				"CreateStudentForm[address3]": {
                    required: true,
				},*/
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
				"CreateStudentForm[status_of_student]": {
                    required: true,
                },
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
					digits: "Please enter a valid IC No",
					minlength: "IC No must be 6 digits length",
					maxlength: "IC No must be 6 digits length"
				},
				"CreateStudentForm[ic_no_format]": {
                    required: "Please enter IC No Format",
					digits: "IC No Format is invalid",
					minlength: "Must be 2 digits length",
					maxlength: "Must be 2 digits length"
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
                    required: "Please enter Father's/Guardian IC No",
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
				/*"CreateStudentForm[address2]": {
                    required: "Please enter Address Line 2",
				},
				"CreateStudentForm[address3]": {
                    required: "Please enter Address Line 3",
				},*/
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
				"CreateStudentForm[status_of_student]": {
                    required: "Please select Status of Student",
                },
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