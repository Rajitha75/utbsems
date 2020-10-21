<style>
    .notifyDiv, .notifyVerifyDiv{
        background-color: #B5EBE0;  
    }
    .clsTextbox {
        float: none;
        margin-right: 20px;
        width: 20%;
    }
    .searchBox .form-group {
        margin: 0px;
    }
    .empty{
        text-align: center;
    }
    .dropdwn{
        width: 160px;
    }
	button.btn.btn-link.logout-btn {
    padding-top: 20px !important;
}
    @media (max-width: 770px){
        ul.pagination{ display:flex;}
    }

    #advancedSearch{
        top:10%;
        left:22%
    }
	.page-content .searchBtn .btn {
    padding: 6px !important;
}

.page-content .searchBtn {
    float: left;
    margin: 0px 5px 0 0;
}

.tablehead{
	color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;
}

#studentreporttable{
	width: 70%;
    margin-left: 16%;
    margin-top: 6%;
}
</style>
<?php

$fromyear = date('Y', strtotime('-20 years'));
 $range = range($fromyear, $fromyear+40);
 $years = array_combine($range, $range);
 
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

    $this->title = 'Reports';

$this->params['breadcrumbs'][] = $this->title;

echo "<h1 class='box-title'>$this->title </h1>";
echo "<div class='participation-border fl-left all-userlst'>";
?> 
<div class='participation-border fl-left notifyDiv' style="display:none;">You have successfully changed the user status.</div>    
<div class='participation-border fl-left notifyVerifyDiv' style="display:none;">You have successfully changed the verification status.</div>
<div style="width: 100%; float: left;" class="searchBox all-adminlist">
    <div class="col-sm-12 p-left0">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-sm-2 col-xs-12 p-left0 ad-lst">
           <?php echo $form->field($model, 'rumpun')->dropDownList([ 'XLR8' => 'XLR8', 'PRO-XTIV' => 'PRO-XTIV', 'XCEL' => 'XCEL', 'CRTIV' => 'CRTIV'],['prompt' => 'Rumpun'])->label(false); ?>
        </div>
        <div class="col-sm-2 col-xs-12 p-left0 ad-lst">
        <?php echo $form->field($model, 'nationality')->dropDownList([ 'Malay' => 'Malay', 'Chinese' => 'Chinese', 'Indian' => 'Indian', 'Other' => 'Other'],['prompt' => 'Select Nationality'])->label(false); ?>
        </div>
		
		<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
		<?php echo $form->field($model, 'ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'IC Color'])->label(false);?>
		</div>
		
		<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
		<?php echo $form->field($model, 'race')->dropDownList(['Malay' => 'Malay', 'Kedayan' => 'Kedayan', 'Dusun' => 'Dusun', 'Murut' => 'Murut', 'Bisaya' => 'Bisaya', 'Belait' => 'Belait', 'Tutong' => 'Tutong', 'Brunei' => 'Brunei', 'Iban' => 'Iban', 'Batak' => 'Batak', 'Kenyah' => 'Kenyah', 'Dayak' => 'Dayak', 'Kedazan' => 'Kedazan', 'Chinese' => 'Chinese', 'Indian' => 'Indian', 'Other' => 'Other'], ['prompt' => 'Select Race'])->label(false); ?>
		</div>

	<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
	<?php echo $form->field($model, 'religion')->dropDownList([ 'Muslim' => 'Muslim', 'Buddist' => 'Buddist', 'Christian' => 'Christian', 'Hindu' => 'Hindu', 'Sikh' => 'Sikh', 'No Religion' => 'No Religion', 'Other' => 'Other'],['prompt' => 'Select Religion'])->label(false); ?>
	</div>
	
	<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
	<?php echo $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'],['prompt' => 'Gender'])->label(false); ?>
	</div>
	
	<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
    <?php echo $form->field($model, 'martial_status')->dropDownList([ 'Married' => 'Married', 'Single' => 'Single'],['prompt' => 'Martial Status'])->label(false); ?>
	</div>
	
	<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
	<?php echo $form->field($model, 'type_of_entry')->dropDownList(['Hecas' => 'Hecas', 'Non-Hecas' => 'Non-Hecas'],['prompt' => 'Select Type of Entry'])->label(false); ?>
	</div>
	
	<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
	<?php echo $form->field($model, 'type_of_residential')->dropDownList(['Own House' => 'Own House', 'Hostel' => 'Hostel', 'Core' => 'Core', 'Rental' => 'Rental', 'Other' => 'Other'], ['prompt' => 'Select Type of Residential'])->label(false); ?>
	</div>
	
	<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
	<?php echo $form->field($model, 'bank_name')->dropDownList([ 'BAIDURI' => 'BAIDURI', 'BIBD' => 'BIBD', 'STANDARD CHARTERED BANK' => 'STANDARD CHARTERED BANK', 'TAIB' => 'TAIB'],['prompt' => 'Bank Name'])->label(false); ?>
	</div>
	
	<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
	<?php echo $form->field($model, 'sponsor_type')->dropDownList([ 'Government Scholarship' => 'Government Scholarship', 'BSP Scholarship' => 'BSP Scholarship', 'Fee Paying' => 'Fee Paying', 'In-Service' => 'In-Service', 'MFA Scholarship (BDGS)' => 'MFA Scholarship (BDGS)', 'UTB Scholarship' => 'UTB Scholarship', 'Other' => 'Other'],['prompt' => 'Select Sponsor Type'])->label(false); ?>
	</div>
		
		<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
		<?php echo $form->field($model, 'type_of_programme')->dropDownList(['Undergraduate Degree' => 'Undergraduate Degree', 'Masters by Coursework' => 'Masters by Coursework', 'Masters by Research' => 'Masters by Research', 'Doctor of Philosophy (PhD)' => 'Doctor of Philosophy (PhD)'], ['prompt' => 'Type of Programme'])->label(false);?>
		</div>
	
		<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
		<?php echo $form->field($model, 'programme_name')->dropDownList(ArrayHelper::map($programme,'id','programme_name'),['prompt'=>'Please select Programme'])->label(false); ?>
		</div>
		
		<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
		<?php echo $form->field($model, 'entry')->dropDownList(['First Year' => 'First Year', 'Second Year' => 'Second Year', 'Other' => 'Other'], ['prompt' => 'Entry'])->label(false);?>
		</div>
		
		<?php //echo $form->field($model, 'status_of_student')->dropDownList(['Current Student' => 'Current Student', 'Withdrawn' => 'Withdrawn'], ['prompt' => 'Status of Student'])->label(false);?>

	<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
	<?php echo $form->field($model, 'intake')->dropDownList($years,['prompt' => 'Intake No'])->label(false);?>
	</div>
	
	<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
	<?php echo $form->field($model, 'mode')->dropDownList(['Full Time' => 'Full Time', 'Part Time'=> 'Part Time'],['prompt' => 'Mode'])->label(false);?>
    </div>
	
	<div>
        <div class="searchBtn">
                <?php echo Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-success', 'id' => 'btnSearch']) ?>
                <input type="hidden" value="<?php echo Yii::$app->request->BaseUrl; ?>/admin/students-list" id="searchUrl">
            </div>
            <div class="searchBtn" style="padding:0;">
                <?php echo Html::submitButton('<i class="fa fa-repeat"> </i>', ['class' => 'btn btn-success res-bnt', 'id' => 'btnReset']) ?>
            </div>
		</div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>    
<div id="studentreporttable"></div>

			<script>
			$(document).ready(function(){
				
			$('#btnReset').on('click', function (e) {
				$('#student-rumpun').val('');
				$('#student-nationality').val('');
				$('#student-ic_color').val('');
				$('#student-race').val('');
				$('#student-religion').val('');
				$('#student-gender').val('');
				$('#student-martial_status').val('');
				$('#student-type_of_entry').val('');
				$('#student-bank_name').val('');
				$('#student-sponsor_type').val('');
				$('#student-programme_name').val('');
				$('#student-entry').val('');
				$('#student-intake').val('');
				$('#student-mode').val('');
				$('#student-type_of_residential').val('');
				$('#student-type_of_programme').val('');
				return false;
			});
			
			$('#btnSearch').on('click', function (e) {
            var pjaxContainer = 'pjax-list';
            var rumpun = $('#student-rumpun').val();
            var nationality = $('#student-nationality').val();
            var studenticcolor = $('#student-ic_color').val();
            var race = $('#student-race').val();
            var religion = $('#student-religion').val();
            var gender = $('#student-gender').val();
            var martialstatus = $('#student-martial_status').val();
            var typeofentry = $('#student-type_of_entry').val();
            var bankname = $('#student-bank_name').val();

            var sponsortype = $('#student-sponsor_type').val();
            var programme_name = $('#student-programme_name').val();
            var entry = $('#student-entry').val();
            //var status = $('#student-status_of_student').val();
            var intake = $('#student-intake').val();

            var mode = $('#student-mode').val();
            var type_of_residential = $('#student-type_of_residential').val();
            var type_of_programme = $('#student-type_of_programme').val();
			var searchUrl = "<?php echo Yii::$app->request->BaseUrl; ?>"+'/admin/search-students';
                var pjaxReloadURL = searchUrl + '?rumpun=' + rumpun+ '&nationality=' + nationality+ '&studenticcolor=' + studenticcolor+ '&race=' + race+ '&religion=' + religion+ '&gender=' + gender+ '&martialstatus=' + martialstatus+ '&typeofentry=' + typeofentry+ '&bankname=' + bankname+ '&sponsortype=' + sponsortype+ '&programme_name=' + programme_name+ '&entry=' + entry+ '&intake=' + intake+ '&mode=' + mode+ '&type_of_residential=' + type_of_residential + '&type_of_programme=' + type_of_programme;
            
			$.ajax({
                url: pjaxReloadURL,
                type: 'get',
                success: function (data) {
					var udata = JSON.parse(data);
					console.log(udata);
					var studentcount = udata.length;
					var stable = '';
					stable += '<table class="table table-striped table-bordered reporttable">';
					stable += '<thead>';
					stable += '<tr>';
					stable += '</tr>';
					stable += '</thead>';
					stable += '<tbody>';
					stable += '<tr data-key="0">';
					
					var nrows = 0;
					if(rumpun != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Rumpun</td>';
						nrows = nrows+1;
					}
					if(nationality != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Nationality</td>';
						nrows = nrows+1;
					}
					if(studenticcolor != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">IC Color</td>';
						nrows = nrows+1;
					}
					if(race != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Race</td>';
						nrows = nrows+1;
					}
					if(religion != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Religion</td>';
						nrows = nrows+1;
					}
					if(gender != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Gender</td>';
						nrows = nrows+1;
					}
					if(martialstatus != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Martial Status</td>';
						nrows = nrows+1;
					}
					if(typeofentry != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Type of Entry</td>';
						nrows = nrows+1;
					}
					if(bankname != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Bank Name</td>';
						nrows = nrows+1;
					}
					if(sponsortype != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Sponsor Type</td>';
						nrows = nrows+1;
					}
					if(programme_name != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Programme Name</td>';
						nrows = nrows+1;
					}
					if(entry != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Entry</td>';
						nrows = nrows+1;
					}
					if(intake != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Intake</td>';
						nrows = nrows+1;
					}
					if(mode != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Mode</td>';
						nrows = nrows+1;
					}
					if(type_of_residential != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Type of Residential/td>';
						nrows = nrows+1;
					}
					if(type_of_programme != ''){
						stable += '<td style="color: #FFFFFF !important; background: #6a7988; font-weight: bold; padding: 16px 0px !important; text-align:center;">Type of Programme</td>';
						nrows = nrows+1;
					}
					
					
					stable += '</tr>';
					stable += '<tr>';
					
					
					if(rumpun != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+rumpun+'</td>';
					}
					if(nationality != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+nationality+'</td>';
					}
					if(studenticcolor != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+studenticcolor+'</td>';
					}
					if(race != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+race+'</td>';
					}
					if(religion != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+religion+'</td>';
					}
					if(gender != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+gender+'</td>';
					}
					if(martialstatus != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+martialstatus+'</td>';
					}
					if(typeofentry != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+typeofentry+'</td>';
					}
					if(bankname != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+bankname+'</td>';
					}
					if(sponsortype != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+sponsortype+'</td>';
					}
					if(programme_name != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+programme_name+'</td>';
					}
					if(entry != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+entry+'</td>';
					}
					if(intake != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+intake+'</td>';
					}
					if(mode != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+mode+'</td>';
					}
					if(type_of_residential != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+type_of_residential+'</td>';
					}
					if(type_of_programme != ''){
						stable += '<td style="color: #FFFFFF !important; background: #9eb0c1; font-weight: bold; padding: 12px 0px !important; text-align:center;">'+type_of_programme+'</td>';
					}
					
					stable += '</tr>';
					stable += '<tr data-key="1">';
					stable += '<td colspan="'+nrows+'" style="text-align: center; padding: 16px 0px !important;">'+studentcount+'</td>';
					stable += '</tr>';
					stable += '</tbody>';
					stable += '</table>';
					$('#studentreporttable').empty();
					$('#studentreporttable').append(stable);
					/*var student_rumpun = [];
					var student_nationality = [];
					var student_iccolor = [];
					var student_race = [];
					var student_religion = [];
					var student_gender = [];
					var student_martialstatus = [];
					var student_typeofentry = [];
					var student_bankname = [];
					var student_sponsortype = [];
					var student_progname = [];
					var student_entry = [];
					var student_intake = [];
					var student_mode = [];
					var student_typeofresidential = [];
					var student_typeofprog = [];
					
					for (var i = 0; i < udata.length; i++) {
						if(rumpun != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_rumpun.push(udata[i]['rumpun']);
							}
						}
						if(nationality != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_nationality.push(udata[i]['rumpun']);
							}
						}
						if(studenticcolor != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_iccolor.push(udata[i]['rumpun']);
							}
						}
						if(race != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_race.push(udata[i]['rumpun']);
							}
						}
						if(religion != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_religion.push(udata[i]['rumpun']);
							}
						}
						if(gender != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_gender.push(udata[i]['rumpun']);
							}
						}
						if(martialstatus != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_martialstatus.push(udata[i]['rumpun']);
							}
						}
						if(typeofentry != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_typeofentry.push(udata[i]['rumpun']);
							}
						}
						if(bankname != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_bankname.push(udata[i]['rumpun']);
							}
						}
						if(sponsortype != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_sponsortype.push(udata[i]['rumpun']);
							}
						}
						if(programme_name != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_progname.push(udata[i]['rumpun']);
							}
						}
						if(entry != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_entry.push(udata[i]['rumpun']);
							}
						}
						if(intake != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_intake.push(udata[i]['rumpun']);
							}
						}
						if(mode != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_mode.push(udata[i]['rumpun']);
							}
						}
						if(type_of_residential != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_typeofresidential.push(udata[i]['rumpun']);
							}
						}
						if(type_of_programme != ''){
							if(!student_rumpun.includes(udata[i]['rumpun'])){
								student_typeofprog.push(udata[i]['rumpun']);
							}
						}
					}*/
					
                },
                error: function (xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            });
			
            return false;
        });
		})
</script>