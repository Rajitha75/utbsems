
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
table, td, th {
    border: 1px solid #756c6c;
	font-size: 14px;
	padding:4px;
	background:#f1ecec
}

.tablecontent{
	margin-bottom:30px;
	margin-right:30px;
	float:left;
	
}

.tdheading{
	font-weight:bold;
}

.studentinfo{
	width:90%;
	margin-bottom:30px;
	background:#e33066 ;
}

.sinfotd{
	width:10%;
	font-weight:bold;
}

table.studentinfo{
	border:0;
}

.merr,.prev_merr,.prev2_merr,.prev3_merr {
	display:none;
}

.management{
	width:90%;
	margin-bottom:30px;
}
.levelhead{
	width:20%;
}
.leveltitle{
	width:80%;
}
.submithide{
	display:none;
}
.submitshow{
	display:block;
}
</style>
<?php 
$this->title = 'Edit Student Marks';
echo "<h1 class='box-title'>$this->title </h1>";
/*if($stage == 1){
	$management = 'Programme Area';
}else if($stage == 2){
	$management = 'Faculty / School Exam Board';
}else if($stage == 3){
	$management = 'University Exam Board';
}*/
 ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">
		<table class="management">
		<tr>
		<td >Original Marks</td>
		</tr>
		</table>
<table class="studentinfo">
<tr><td class="sinfotd">Name :</td><td><?php echo isset($studentmarks[0]['studentname'])? $studentmarks[0]['studentname'] : '' ?></td></tr>
<tr><td class="sinfotd">IC No :</td><td><?php echo isset($studentmarks[0]['ic_no'])? $studentmarks[0]['ic_no'] : '' ?></td></tr>
</table>
 <?php if(count($studentmarks)>0){//print_r($prevdata);exit; 
 $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'edit-student-marks',
			'id' => 'editstudentmarksform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="">
	<?php //print_r($studentmarks); 
	for($i=0;$i<count($studentmarks);$i++){ ?>
	<div class="tablecontent">
	
	<input type="hidden" id="editstudentmarksform-marks_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-marks_id" name="EditStudentMarksForm[marks_id][]" value="<?php echo isset($studentmarks[$i]['id'])? $studentmarks[$i]['id'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-semister_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-semister" name="EditStudentMarksForm[semister][]" value="<?php echo isset($studentmarks[$i]['semister'])? $studentmarks[$i]['semister'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-module_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-module_id" name="EditStudentMarksForm[module_id][]" value="<?php echo isset($studentmarks[$i]['module_id'])? $studentmarks[$i]['module_id'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-student_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-student" name="EditStudentMarksForm[student_id][]" value="<?php echo isset($studentmarks[$i]['student_id'])? $studentmarks[$i]['student_id'] : '' ?>" autocomplete="off">
	
	<table>
	<tr>
	<td class="tdheading">Semester</td><td><?php echo isset($studentmarks[$i]['semister'])? 'Semester '.$studentmarks[$i]['semister'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Module Name</td><td><?php echo isset($studentmarks[$i]['module_name'])? $studentmarks[$i]['module_name'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Module ID</td><td><?php echo isset($studentmarks[$i]['moduleid'])? $studentmarks[$i]['moduleid'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Total Percentage</td><td class="m_total_percentage_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['total_percentage'])? $studentmarks[$i]['total_percentage'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Grade</td><td class="m_grade_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['grade'])? $studentmarks[$i]['grade'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Grade Definition</td><td class="m_grade_definition_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['grade_definition'])? $studentmarks[$i]['grade_definition'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Exam Weight</td><td class="tdheading">Coursework Weight</td>
	</tr>
	<tr>
	<td><?php echo isset($studentmarks[$i]['ew_percentage'])? $studentmarks[$i]['ew_percentage'].'%' : '%' ?></td>
	<td><?php echo isset($studentmarks[$i]['cw_percentage'])? $studentmarks[$i]['cw_percentage'].'%' : '%' ?></td>
	</tr>
	<tr>
	<td><input type="text" markstype="ew" <?php echo (count($studentprevdata)>0) ? 'readonly' : ''; ?>  id="editstudentmarksform-ew_marks_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-ew_marks ew_marks_index_<?php echo $i; ?>" name="EditStudentMarksForm[ew_marks][]" value="<?php echo isset($studentmarks[$i]['ew_marks'])? $studentmarks[$i]['ew_marks'] : '' ?>" autocomplete="off"></td>
	<td><input type="text" markstype="cw" <?php echo (count($studentprevdata)>0) ? 'readonly' : ''; ?> id="editstudentmarksform-cw_marks_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-cw_marks cw_marks_index_<?php echo $i; ?>" name="EditStudentMarksForm[cw_marks][]" value="<?php echo isset($studentmarks[$i]['cw_marks'])? $studentmarks[$i]['cw_marks'] : '' ?>" autocomplete="off"></td>
	</tr>
	<tr class="errerr">
	<td class="merr errerr marksewerr ewerr_index_<?php echo $i; ?>"></td>
	<td class="merr errerr markscwerr cwerr_index_<?php echo $i; ?>"></td>
	</tr>
	<tr class="errnum">
	<td class="merr errnum markserrewnum ewnum_index_<?php echo $i; ?>"></td>
	<td class="merr errnum markserrcwnum cwnum_index_<?php echo $i; ?>"></td>
	</tr>
	<tr class="errmax">
	<td class="merr errmax markserrewmax ewmax_index_<?php echo $i; ?>"></td>
	<td class="merr errmax markserrcwmax cwmax_index_<?php echo $i; ?>"></td>
	</tr>
	</table>
	<input type="hidden" id="editstudentmarksform-ew_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-ew_percentage ew_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[ew_percentage][]" value="<?php echo isset($studentmarks[$i]['ew_percentage'])? $studentmarks[$i]['ew_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-ew_total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-ew_total_percentage ew_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[ew_total_percentage][]" value="<?php echo isset($studentmarks[$i]['ew_total_percentage'])? $studentmarks[$i]['ew_total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-cw_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-cw_percentage cw_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[cw_percentage][]" value="<?php echo isset($studentmarks[$i]['cw_percentage'])? $studentmarks[$i]['cw_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-cw_total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-cw_total_percentage cw_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[cw_total_percentage][]" value="<?php echo isset($studentmarks[$i]['cw_total_percentage'])? $studentmarks[$i]['cw_total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-total_percentage total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[total_percentage][]" value="<?php echo isset($studentmarks[$i]['total_percentage'])? $studentmarks[$i]['total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-is_pass_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-is_pass is_pass_index_<?php echo $i; ?>" name="EditStudentMarksForm[is_pass][]" value="<?php echo isset($studentmarks[$i]['is_pass'])? $studentmarks[$i]['is_pass'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-grade_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-grade grade_index_<?php echo $i; ?>" name="EditStudentMarksForm[grade][]" value="<?php echo isset($studentmarks[$i]['grade'])? $studentmarks[$i]['grade'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-grade_definition_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-grade_definition grade_definition_index_<?php echo $i; ?>" name="EditStudentMarksForm[grade_definition][]" value="<?php echo isset($studentmarks[$i]['grade_definition'])? $studentmarks[$i]['grade_definition'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="editstudentmarksform-entered_by_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control editstudentmarksform-entered_by" name="EditStudentMarksForm[entered_by][]" value="<?php echo isset($studentmarks[$i]['entered_by'])? $studentmarks[$i]['entered_by'] : '' ?>" autocomplete="off">
	

	</div>
	<?php } ?>
	<input type="hidden" id="editstudentmarksform-is_submit" class="form-control editstudentmarksform-is_submit" name="EditStudentMarksForm[is_submit]"  autocomplete="off">
	<input type="hidden" id="editstudentmarksform-stage" class="form-control editstudentmarksform-stage" name="EditStudentMarksForm[stage]" value="pa" autocomplete="off">
	<input type="hidden" id="editstudentmarksform-year" class="form-control editstudentmarksform-year" name="EditStudentMarksForm[year]" value="<?php echo $year ?>" autocomplete="off">
		</div>
 
 </div>
  <div class="row text-center">
         <div class="form-group <?php echo (count($studentprevdata)>0) ? 'submithide' : 'submitshow' ?>" >
 <?= Html::submitButton('Save', ['class' => 'btn btn-primary savemarks', 'id' => 'savemarks']) ?>
 <?= Html::submitButton('Submit', ['class' => 'btn btn-primary submitmarks', 'id' => 'submitmarks']) ?>
 </div>
        
        </div>
	<?php ActiveForm::end(); ?>
	<?php } ?>
					</div>
		
		
		
		
		 <?php 
		 
	if(count($studentprevdata)>0){ ?> 
	<table class="management">
		<tr>
		<td class="levelhead">Level of Management</td>
		<td class="leveltitle"><?php echo 'Programme Area'; ?><?php echo ($studentprevdata[0]['is_submit'] == 'submit') ? '' : ' (Saved)'; ?></td>
		</tr>
		</table>
 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'edit-student-marks',
			'id' => 'editstudentmarksform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="">
	<?php //print_r($studentmarks); 
	$studentmarks = $studentprevdata;
	for($i=0;$i<count($studentmarks);$i++){ ?>
	<div class="tablecontent">
	
	<input type="hidden" id="prev_editstudentmarksform-marks_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-marks_id" name="EditStudentMarksForm[prev_marks_id][]" value="<?php echo isset($studentmarks[$i]['marks_id'])? $studentmarks[$i]['marks_id'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-semister_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-semister" name="EditStudentMarksForm[prev_semister][]" value="<?php echo isset($studentmarks[$i]['semister'])? $studentmarks[$i]['semister'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-module_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-module_id" name="EditStudentMarksForm[prev_module_id][]" value="<?php echo isset($studentmarks[$i]['module_id'])? $studentmarks[$i]['module_id'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-student_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-student" name="EditStudentMarksForm[prev_student_id][]" value="<?php echo isset($studentmarks[$i]['student_id'])? $studentmarks[$i]['student_id'] : '' ?>" autocomplete="off">
	
	<table>
	<tr>
	<td class="tdheading">Semester</td><td><?php echo isset($studentmarks[$i]['semister'])? 'Semester '.$studentmarks[$i]['semister'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Module Name</td><td><?php echo isset($studentmarks[$i]['module_name'])? $studentmarks[$i]['module_name'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Module ID</td><td><?php echo isset($studentmarks[$i]['moduleid'])? $studentmarks[$i]['moduleid'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Total Percentage</td><td class="prev_m_total_percentage_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['total_percentage'])? $studentmarks[$i]['total_percentage'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Grade</td><td class="prev_m_grade_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['grade'])? $studentmarks[$i]['grade'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Grade Definition</td><td class="prev_m_grade_definition_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['grade_definition'])? $studentmarks[$i]['grade_definition'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Exam Weight</td><td class="tdheading">Coursework Weight</td>
	</tr>
	<tr>
	<td><?php echo isset($studentmarks[$i]['ew_percentage'])? $studentmarks[$i]['ew_percentage'].'%' : '%' ?></td>
	<td><?php echo isset($studentmarks[$i]['cw_percentage'])? $studentmarks[$i]['cw_percentage'].'%' : '%' ?></td>
	</tr>
	<tr>
	<td><input type="text" markstype="ew" <?php echo ($studentprevdata[$i]['is_submit'] == 'submit') ? 'readonly' : ''; ?> id="prev_editstudentmarksform-ew_marks_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-ew_marks prev_ew_marks_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev_ew_marks][]" value="<?php echo isset($studentmarks[$i]['ew_marks'])? $studentmarks[$i]['ew_marks'] : '' ?>" autocomplete="off"></td>
	<td><input type="text" markstype="cw" <?php echo ($studentprevdata[$i]['is_submit'] == 'submit') ? 'readonly' : ''; ?> id="prev_editstudentmarksform-cw_marks_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-cw_marks prev_cw_marks_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev_cw_marks][]" value="<?php echo isset($studentmarks[$i]['cw_marks'])? $studentmarks[$i]['cw_marks'] : '' ?>" autocomplete="off"></td>
	</tr>
	<tr class="prev_errerr">
	<td class="prev_merr prev_errerr prev_marksewerr prev_ewerr_index_<?php echo $i; ?>"></td>
	<td class="prev_merr prev_errerr prev_markscwerr prev_cwerr_index_<?php echo $i; ?>"></td>
	</tr>
	<tr class="prev_errnum">
	<td class="prev_merr prev_errnum prev_markserrewnum prev_ewnum_index_<?php echo $i; ?>"></td>
	<td class="prev_merr prev_errnum prev_markserrcwnum prev_cwnum_index_<?php echo $i; ?>"></td>
	</tr>
	<tr class="prev_errmax">
	<td class="prev_merr prev_errmax prev_markserrewmax prev_ewmax_index_<?php echo $i; ?>"></td>
	<td class="prev_merr prev_errmax prev_markserrcwmax prev_cwmax_index_<?php echo $i; ?>"></td>
	</tr>
	</table>
	<input type="hidden" id="prev_editstudentmarksform-ew_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-ew_percentage prev_ew_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev_ew_percentage][]" value="<?php echo isset($studentmarks[$i]['ew_percentage'])? $studentmarks[$i]['ew_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-ew_total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-ew_total_percentage prev_ew_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev_ew_total_percentage][]" value="<?php echo isset($studentmarks[$i]['ew_total_percentage'])? $studentmarks[$i]['ew_total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-cw_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-cw_percentage prev_cw_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev_cw_percentage][]" value="<?php echo isset($studentmarks[$i]['cw_percentage'])? $studentmarks[$i]['cw_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-cw_total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-cw_total_percentage prev_cw_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev_cw_total_percentage][]" value="<?php echo isset($studentmarks[$i]['cw_total_percentage'])? $studentmarks[$i]['cw_total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-total_percentage prev_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev_total_percentage][]" value="<?php echo isset($studentmarks[$i]['total_percentage'])? $studentmarks[$i]['total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-is_pass_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-is_pass prev_is_pass_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev_is_pass][]" value="<?php echo isset($studentmarks[$i]['is_pass'])? $studentmarks[$i]['is_pass'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-grade_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-grade prev_grade_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev_grade][]" value="<?php echo isset($studentmarks[$i]['grade'])? $studentmarks[$i]['grade'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-grade_definition_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-grade_definition prev_grade_definition_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev_grade_definition][]" value="<?php echo isset($studentmarks[$i]['grade_definition'])? $studentmarks[$i]['grade_definition'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-entered_by_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev_editstudentmarksform-entered_by" name="EditStudentMarksForm[prev_entered_by][]" value="<?php echo isset($studentmarks[$i]['entered_by'])? $studentmarks[$i]['entered_by'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev_editstudentmarksform-prev_id" class="form-control prev_editstudentmarksform-prev_id" name="EditStudentMarksForm[prev_id][]" value="<?php echo isset($studentmarks[$i]['id'])? $studentmarks[$i]['id'] : '' ?>" autocomplete="off">
	</div>
	<?php } ?>
	<input type="hidden" id="prev_editstudentmarksform-is_submit" class="form-control prev_editstudentmarksform-is_submit" name="EditStudentMarksForm[prev_is_submit]"  autocomplete="off">
	<input type="hidden" id="prev_editstudentmarksform-stage" class="form-control prev_editstudentmarksform-stage" name="EditStudentMarksForm[prev_stage]" value="pa" autocomplete="off">
	<input type="hidden" id="prev_editstudentmarksform-year" class="form-control prev_editstudentmarksform-year" name="EditStudentMarksForm[prev_year]" value="<?php echo $year ?>" autocomplete="off">
	<input type="hidden" id="prev_editstudentmarksform-is_prev_submit" class="form-control prev_editstudentmarksform-is_prev_submit" name="EditStudentMarksForm[is_prev_submit]" value="<?php echo isset($studentmarks[$i]['is_submit'])? $studentmarks[$i]['is_submit'] : '' ?>" autocomplete="off">
	
	
		</div>
 
 </div>
  <div class="row text-center">
  <?php if($studentprevdata[0]['is_submit'] != 'submit') { ?>
         <div class="form-group">
 <?= Html::submitButton('Save', ['class' => 'btn btn-primary prev_savemarks', 'id' => 'prev_savemarks']) ?>
 <?= Html::submitButton('Submit', ['class' => 'btn btn-primary prev_submitmarks', 'id' => 'prev_submitmarks']) ?>
 </div>
  <?php } ?> 
        </div>
	<?php ActiveForm::end(); ?>
	<?php } ?>
					</div>

 <?php 
		 
	if($studentprevdata2 && count($studentprevdata2)>0){ ?> 
	<table class="management">
		<tr>
		<td class="levelhead">Level of Management</td>
		<td class="leveltitle"><?php echo 'Faculty/School Exam Board'; ?><?php echo ($studentprevdata2[0]['is_submit'] == 'submit') ? '' : ' (Saved)'; ?></td>
		</tr>
		</table>
 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'edit-student-marks',
			'id' => 'editstudentmarksform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="">
	<?php //print_r($studentmarks); 
	$studentmarks = $studentprevdata2;
	//echo count($studentmarks);exit;
	for($i=0;$i<count($studentmarks);$i++){ ?>
	<div class="tablecontent">
	
	<input type="hidden" id="prev2_editstudentmarksform-marks_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-marks_id" name="EditStudentMarksForm[prev2_marks_id][]" value="<?php echo isset($studentmarks[$i]['marks_id'])? $studentmarks[$i]['marks_id'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-semister_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-semister" name="EditStudentMarksForm[prev2_semister][]" value="<?php echo isset($studentmarks[$i]['semister'])? $studentmarks[$i]['semister'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-module_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-module_id" name="EditStudentMarksForm[prev2_module_id][]" value="<?php echo isset($studentmarks[$i]['module_id'])? $studentmarks[$i]['module_id'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-student_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-student" name="EditStudentMarksForm[prev2_student_id][]" value="<?php echo isset($studentmarks[$i]['student_id'])? $studentmarks[$i]['student_id'] : '' ?>" autocomplete="off">
	
	<table>
	<tr>
	<td class="tdheading">Semester</td><td><?php echo isset($studentmarks[$i]['semister'])? 'Semester '.$studentmarks[$i]['semister'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Module Name</td><td><?php echo isset($studentmarks[$i]['module_name'])? $studentmarks[$i]['module_name'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Module ID</td><td><?php echo isset($studentmarks[$i]['moduleid'])? $studentmarks[$i]['moduleid'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Total Percentage</td><td class="prev2_m_total_percentage_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['total_percentage'])? $studentmarks[$i]['total_percentage'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Grade</td><td class="prev2_m_grade_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['grade'])? $studentmarks[$i]['grade'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Grade Definition</td><td class="prev2_m_grade_definition_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['grade_definition'])? $studentmarks[$i]['grade_definition'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Exam Weight</td><td class="tdheading">Coursework Weight</td>
	</tr>
	<tr>
	<td><?php echo isset($studentmarks[$i]['ew_percentage'])? $studentmarks[$i]['ew_percentage'].'%' : '%' ?></td>
	<td><?php echo isset($studentmarks[$i]['cw_percentage'])? $studentmarks[$i]['cw_percentage'].'%' : '%' ?></td>
	</tr>
	<tr>
	<td><input type="text" markstype="ew" <?php echo (count($studentprevdata2)>0 && $studentmarks[$i]['stage'] == 'fssubmit') ? 'readonly' : ''; ?>  id="prev2_editstudentmarksform-ew_marks_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-ew_marks prev2_ew_marks_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev2_ew_marks][]" value="<?php echo isset($studentmarks[$i]['ew_marks'])? $studentmarks[$i]['ew_marks'] : '' ?>" autocomplete="off"></td>
	<td><input type="text" markstype="cw" <?php echo (count($studentprevdata2)>0 && $studentmarks[$i]['stage'] == 'fssubmit') ? 'readonly' : ''; ?>  id="prev2_editstudentmarksform-cw_marks_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-cw_marks prev2_cw_marks_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev2_cw_marks][]" value="<?php echo isset($studentmarks[$i]['cw_marks'])? $studentmarks[$i]['cw_marks'] : '' ?>" autocomplete="off"></td>
	</tr>
	<tr class="prev2_errerr">
	<td class="prev2_merr prev2_errerr prev2_marksewerr prev2_ewerr_index_<?php echo $i; ?>"></td>
	<td class="prev2_merr prev2_errerr prev2_markscwerr prev2_cwerr_index_<?php echo $i; ?>"></td>
	</tr>
	<tr class="prev2_errnum">
	<td class="prev2_merr prev2_errnum prev2_markserrewnum prev2_ewnum_index_<?php echo $i; ?>"></td>
	<td class="prev2_merr prev2_errnum prev2_markserrcwnum prev2_cwnum_index_<?php echo $i; ?>"></td>
	</tr>
	<tr class="prev2_errmax">
	<td class="prev2_merr prev2_errmax prev2_markserrewmax prev2_ewmax_index_<?php echo $i; ?>"></td>
	<td class="prev2_merr prev2_errmax prev2_markserrcwmax prev2_cwmax_index_<?php echo $i; ?>"></td>
	</tr>
	</table>
	<input type="hidden" id="prev2_editstudentmarksform-ew_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-ew_percentage prev2_ew_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev2_ew_percentage][]" value="<?php echo isset($studentmarks[$i]['ew_percentage'])? $studentmarks[$i]['ew_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-ew_total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-ew_total_percentage prev2_ew_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev2_ew_total_percentage][]" value="<?php echo isset($studentmarks[$i]['ew_total_percentage'])? $studentmarks[$i]['ew_total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-cw_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-cw_percentage prev2_cw_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev2_cw_percentage][]" value="<?php echo isset($studentmarks[$i]['cw_percentage'])? $studentmarks[$i]['cw_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-cw_total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-cw_total_percentage prev2_cw_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev2_cw_total_percentage][]" value="<?php echo isset($studentmarks[$i]['cw_total_percentage'])? $studentmarks[$i]['cw_total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-total_percentage prev2_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev2_total_percentage][]" value="<?php echo isset($studentmarks[$i]['total_percentage'])? $studentmarks[$i]['total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-is_pass_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-is_pass prev2_is_pass_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev2_is_pass][]" value="<?php echo isset($studentmarks[$i]['is_pass'])? $studentmarks[$i]['is_pass'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-grade_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-grade prev2_grade_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev2_grade][]" value="<?php echo isset($studentmarks[$i]['grade'])? $studentmarks[$i]['grade'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-grade_definition_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-grade_definition prev2_grade_definition_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev2_grade_definition][]" value="<?php echo isset($studentmarks[$i]['grade_definition'])? $studentmarks[$i]['grade_definition'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-entered_by_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev2_editstudentmarksform-entered_by" name="EditStudentMarksForm[prev2_entered_by][]" value="<?php echo isset($studentmarks[$i]['entered_by'])? $studentmarks[$i]['entered_by'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev2_editstudentmarksform-prev2_id" class="form-control prev2_editstudentmarksform-prev2_id" name="EditStudentMarksForm[prev2_id][]" value="<?php echo isset($studentmarks[$i]['id'])? $studentmarks[$i]['id'] : '' ?>" autocomplete="off">
	</div>
	<?php } ?>
	<input type="hidden" id="prev2_editstudentmarksform-is_submit" class="form-control prev2_editstudentmarksform-is_submit" name="EditStudentMarksForm[prev2_is_submit]"  autocomplete="off">
	<input type="hidden" id="prev2_editstudentmarksform-stage" class="form-control prev2_editstudentmarksform-stage" name="EditStudentMarksForm[prev2_stage]" value="pa" autocomplete="off">
	<input type="hidden" id="prev2_editstudentmarksform-year" class="form-control prev2_editstudentmarksform-year" name="EditStudentMarksForm[prev2_year]" value="<?php echo $year ?>" autocomplete="off">
	<input type="hidden" id="prev2_editstudentmarksform-is_prev2_submit" class="form-control prev2_editstudentmarksform-is_prev2_submit" name="EditStudentMarksForm[is_prev2_submit]" value="<?php echo isset($studentmarks[$i]['is_submit'])? $studentmarks[$i]['is_submit'] : '' ?>" autocomplete="off">
	
	
		</div>
 
 </div>
  <div class="row text-center">
  <?php if($studentprevdata2[0]['stage'] != 'fssubmit') { ?>
         <div class="form-group">
 <?= Html::submitButton('Save', ['class' => 'btn btn-primary prev2_savemarks', 'id' => 'prev2_savemarks']) ?>
 <?= Html::submitButton('Submit', ['class' => 'btn btn-primary prev2_submitmarks', 'id' => 'prev2_submitmarks']) ?>
 </div>
  <?php } ?> 
        </div>
	<?php ActiveForm::end(); ?>
	<?php } ?>
	
	<?php 
		 
	if($studentprevdata3 && count($studentprevdata3)>0){ ?> 
	<table class="management">
		<tr>
		<td class="levelhead">Level of Management</td>
		<td class="leveltitle"><?php echo 'University Exam Board'; ?><?php echo ($studentprevdata3[0]['is_submit'] == 'submit') ? '' : ' (Saved)'; ?></td>
		</tr>
		</table>
 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'edit-student-marks',
			'id' => 'editstudentmarksform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="">
	<?php //print_r($studentmarks); 
	$studentmarks = $studentprevdata3;
	//echo count($studentmarks);exit;
	for($i=0;$i<count($studentmarks);$i++){ ?>
	<div class="tablecontent">
	
	<input type="hidden" id="prev3_editstudentmarksform-marks_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-marks_id" name="EditStudentMarksForm[prev3_marks_id][]" value="<?php echo isset($studentmarks[$i]['marks_id'])? $studentmarks[$i]['marks_id'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-semister_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-semister" name="EditStudentMarksForm[prev3_semister][]" value="<?php echo isset($studentmarks[$i]['semister'])? $studentmarks[$i]['semister'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-module_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-module_id" name="EditStudentMarksForm[prev3_module_id][]" value="<?php echo isset($studentmarks[$i]['module_id'])? $studentmarks[$i]['module_id'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-student_id_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-student" name="EditStudentMarksForm[prev3_student_id][]" value="<?php echo isset($studentmarks[$i]['student_id'])? $studentmarks[$i]['student_id'] : '' ?>" autocomplete="off">
	
	<table>
	<tr>
	<td class="tdheading">Semester</td><td><?php echo isset($studentmarks[$i]['semister'])? 'Semester '.$studentmarks[$i]['semister'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Module Name</td><td><?php echo isset($studentmarks[$i]['module_name'])? $studentmarks[$i]['module_name'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Module ID</td><td><?php echo isset($studentmarks[$i]['moduleid'])? $studentmarks[$i]['moduleid'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Total Percentage</td><td class="prev3_m_total_percentage_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['total_percentage'])? $studentmarks[$i]['total_percentage'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Grade</td><td class="prev3_m_grade_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['grade'])? $studentmarks[$i]['grade'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Grade Definition</td><td class="prev3_m_grade_definition_index_<?php echo $i; ?>"><?php echo isset($studentmarks[$i]['grade_definition'])? $studentmarks[$i]['grade_definition'] : '' ?></td>
	</tr>
	<tr>
	<td class="tdheading">Exam Weight</td><td class="tdheading">Coursework Weight</td>
	</tr>
	<tr>
	<td><?php echo isset($studentmarks[$i]['ew_percentage'])? $studentmarks[$i]['ew_percentage'].'%' : '%' ?></td>
	<td><?php echo isset($studentmarks[$i]['cw_percentage'])? $studentmarks[$i]['cw_percentage'].'%' : '%' ?></td>
	</tr>
	<tr>
	<td><input type="text" markstype="ew" <?php echo (count($studentprevdata3)>0 && $studentmarks[$i]['stage'] == 'uebsubmit') ? 'readonly' : ''; ?> id="prev3_editstudentmarksform-ew_marks_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-ew_marks prev3_ew_marks_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev3_ew_marks][]" value="<?php echo isset($studentmarks[$i]['ew_marks'])? $studentmarks[$i]['ew_marks'] : '' ?>" autocomplete="off"></td>
	<td><input type="text" markstype="cw" <?php echo (count($studentprevdata3)>0 && $studentmarks[$i]['stage'] == 'uebsubmit') ? 'readonly' : ''; ?> id="prev3_editstudentmarksform-cw_marks_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-cw_marks prev3_cw_marks_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev3_cw_marks][]" value="<?php echo isset($studentmarks[$i]['cw_marks'])? $studentmarks[$i]['cw_marks'] : '' ?>" autocomplete="off"></td>
	</tr>
	<tr class="prev3_errerr">
	<td class="prev3_merr prev3_errerr prev3_marksewerr prev3_ewerr_index_<?php echo $i; ?>"></td>
	<td class="prev3_merr prev3_errerr prev3_markscwerr prev3_cwerr_index_<?php echo $i; ?>"></td>
	</tr>
	<tr class="prev3_errnum">
	<td class="prev3_merr prev3_errnum prev3_markserrewnum prev3_ewnum_index_<?php echo $i; ?>"></td>
	<td class="prev3_merr prev3_errnum prev3_markserrcwnum prev3_cwnum_index_<?php echo $i; ?>"></td>
	</tr>
	<tr class="prev3_errmax">
	<td class="prev3_merr prev3_errmax prev3_markserrewmax prev3_ewmax_index_<?php echo $i; ?>"></td>
	<td class="prev3_merr prev3_errmax prev3_markserrcwmax prev3_cwmax_index_<?php echo $i; ?>"></td>
	</tr>
	</table>
	<input type="hidden" id="prev3_editstudentmarksform-ew_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-ew_percentage prev3_ew_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev3_ew_percentage][]" value="<?php echo isset($studentmarks[$i]['ew_percentage'])? $studentmarks[$i]['ew_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-ew_total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-ew_total_percentage prev3_ew_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev3_ew_total_percentage][]" value="<?php echo isset($studentmarks[$i]['ew_total_percentage'])? $studentmarks[$i]['ew_total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-cw_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-cw_percentage prev3_cw_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev3_cw_percentage][]" value="<?php echo isset($studentmarks[$i]['cw_percentage'])? $studentmarks[$i]['cw_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-cw_total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-cw_total_percentage prev3_cw_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev3_cw_total_percentage][]" value="<?php echo isset($studentmarks[$i]['cw_total_percentage'])? $studentmarks[$i]['cw_total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-total_percentage_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-total_percentage prev3_total_percentage_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev3_total_percentage][]" value="<?php echo isset($studentmarks[$i]['total_percentage'])? $studentmarks[$i]['total_percentage'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-is_pass_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-is_pass prev3_is_pass_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev3_is_pass][]" value="<?php echo isset($studentmarks[$i]['is_pass'])? $studentmarks[$i]['is_pass'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-grade_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-grade prev3_grade_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev3_grade][]" value="<?php echo isset($studentmarks[$i]['grade'])? $studentmarks[$i]['grade'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-grade_definition_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-grade_definition prev3_grade_definition_index_<?php echo $i; ?>" name="EditStudentMarksForm[prev3_grade_definition][]" value="<?php echo isset($studentmarks[$i]['grade_definition'])? $studentmarks[$i]['grade_definition'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-entered_by_index_<?php echo $i; ?>" index="<?php echo $i; ?>" class="form-control prev3_editstudentmarksform-entered_by" name="EditStudentMarksForm[prev3_entered_by][]" value="<?php echo isset($studentmarks[$i]['entered_by'])? $studentmarks[$i]['entered_by'] : '' ?>" autocomplete="off">
	
	<input type="hidden" id="prev3_editstudentmarksform-prev3_id" class="form-control prev3_editstudentmarksform-prev3_id" name="EditStudentMarksForm[prev3_id][]" value="<?php echo isset($studentmarks[$i]['id'])? $studentmarks[$i]['id'] : '' ?>" autocomplete="off">
	</div>
	<?php } ?>
	<input type="hidden" id="prev3_editstudentmarksform-is_submit" class="form-control prev3_editstudentmarksform-is_submit" name="EditStudentMarksForm[prev3_is_submit]"  autocomplete="off">
	<input type="hidden" id="prev3_editstudentmarksform-stage" class="form-control prev3_editstudentmarksform-stage" name="EditStudentMarksForm[prev3_stage]" value="pa" autocomplete="off">
	<input type="hidden" id="prev3_editstudentmarksform-year" class="form-control prev3_editstudentmarksform-year" name="EditStudentMarksForm[prev3_year]" value="<?php echo $year ?>" autocomplete="off">
	<input type="hidden" id="prev3_editstudentmarksform-is_prev3_submit" class="form-control prev3_editstudentmarksform-is_prev3_submit" name="EditStudentMarksForm[is_prev3_submit]" value="<?php echo isset($studentmarks[$i]['is_submit'])? $studentmarks[$i]['is_submit'] : '' ?>" autocomplete="off">
	
	
		</div>
 
 </div>
  <div class="row text-center">
  <?php if($studentprevdata3[0]['stage'] != 'uebsubmit') { ?>
         <div class="form-group">
 <?= Html::submitButton('Save', ['class' => 'btn btn-primary prev3_savemarks', 'id' => 'prev3_savemarks']) ?>
 <?= Html::submitButton('Submit', ['class' => 'btn btn-primary prev3_submitmarks', 'id' => 'prev3_submitmarks']) ?>
 </div>
  <?php } ?> 
        </div>
	<?php ActiveForm::end(); ?>
	<?php } ?>
					</div>
	
		
		
<script>
$(document).ready(function() {
$('#savemarks').click(function(){
	$('#editstudentmarksform-is_submit').val('save');
});
$('#submitmarks').click(function(){
	$('#editstudentmarksform-is_submit').val('submit');
});

$('#savemarks, #submitmarks').click(function(){
var ewmarks = $('.editstudentmarksform-ew_marks').val();
	var index = $('.editstudentmarksform-ew_marks').attr('index');
	$('.merr').hide();
	$('.merr').text('');
	if(ewmarks == ''){
			$('.ewerr_index_'+index).text('Please enter the marks');
			$('.errerr').show();
			return false;
		}else{
			$('.ewerr_index_'+index).hide();
			if($.isNumeric(ewmarks)){
				$('.ewnum_index_'+index).hide();
				if(ewmarks > 100){
					$('.ewmax_index_'+index).text('Marks should not exceed 100');
					$('.errmax').show();
					return false;
				}else{
					$('.ewmax_index_'+index).hide();
				}
			}else{
				$('.ewnum_index_'+index).text('Please enter only digits');
				$('.errnum').show();
				return false;
			}
		}
		
	var cwmarks = $('.editstudentmarksform-cw_marks').val();
	var index = $('.editstudentmarksform-cw_marks').attr('index');
	if(cwmarks == ''){
			$('.cwerr_index_'+index).text('Please enter the marks');
			$('.errerr').show();
			return false;
		}else{
			$('.cwerr_index_'+index).hide();
			if($.isNumeric(cwmarks)){
				$('.cwnum_index_'+index).hide();
				if(cwmarks > 100){
					$('.cwmax_index_'+index).text('Marks should not exceed 100');
					$('.errmax').show();
					return false;
				}else{
					$('.cwmax_index_'+index).hide();
				}
			}else{
				$('.cwnum_index_'+index).text('Please enter only digits');
				$('.errnum').show();
				return false;
			}
		}
		});

$('.editstudentmarksform-ew_marks').change(function(){
	var ewmarks = $(this).val();
	var index = $(this).attr('index');
	$('.merr').hide();
	$('.merr').text('');
	if(ewmarks == ''){
			$('.ewerr_index_'+index).text('Please enter the marks');
			$('.errerr').show();
		}else{
			$('.ewerr_index_'+index).hide();
			if($.isNumeric(ewmarks)){
				$('.ewnum_index_'+index).hide();
				if(ewmarks > 100){
					$('.ewmax_index_'+index).text('Marks should not exceed 100');
					$('.errmax').show();
				}else{
					$('.ewmax_index_'+index).hide();
				}
			}else{
				$('.ewnum_index_'+index).text('Please enter only digits');
				$('.errnum').show();
			}
		}
});

$('.editstudentmarksform-cw_marks').change(function(){
	var cwmarks = $(this).val();
	var index = $(this).attr('index');
	$('.merr').hide();
	$('.merr').text('');
	if(cwmarks == ''){
			$('.cwerr_index_'+index).text('Please enter the marks');
			$('.errerr').show();
		}else{
			$('.cwerr_index_'+index).hide();
			if($.isNumeric(cwmarks)){
				$('.cwnum_index_'+index).hide();
				if(cwmarks > 100){
					$('.cwmax_index_'+index).text('Marks should not exceed 100');
					$('.errmax').show();
				}else{
					$('.cwmax_index_'+index).hide();
				}
			}else{
				$('.cwnum_index_'+index).text('Please enter only digits');
				$('.errnum').show();
			}
		}
});

$('.editstudentmarksform-ew_marks, .editstudentmarksform-cw_marks').keyup(function(){
	var index = $(this).attr('index');
	var markstype = $(this).attr('markstype');
	var ew_marks = $('.ew_marks_index_'+index).val();
	var ew_percentage = $('.ew_percentage_index_'+index).val();
	var cw_marks = $('.cw_marks_index_'+index).val();
	var cw_percentage = $('.cw_percentage_index_'+index).val();
	var ew_total_percentage = (ew_marks/100)*ew_percentage;
	var cw_total_percentage = (cw_marks/100)*cw_percentage;
	var total_percentage = ew_total_percentage+cw_total_percentage;
	if(total_percentage<40){
		var is_pass = 0;
	}else{
		var is_pass = 1;
	}
	var grade='';
	var grade_definition = '';
	
	if(total_percentage >= 0 && total_percentage <= 39){
		grade = 'F';
		grade_definition = 'Fail';
	}else if(total_percentage >= 40 && total_percentage <= 44){
		grade = 'E';
		grade_definition = 'Marginal';
	}else if(total_percentage >= 45 && total_percentage <= 49){
		grade = 'D';
		grade_definition = 'Satisfactory';
	}else if(total_percentage >= 50 && total_percentage <= 54){
		grade = 'D+';
		grade_definition = 'Satisfactory';
	}else if(total_percentage >= 55 && total_percentage <= 59){
		grade = 'C';
		grade_definition = 'Good';
	}else if(total_percentage >= 60 && total_percentage <= 64){
		grade = 'C+';
		grade_definition = 'Good';
	}else if(total_percentage >= 65 && total_percentage <= 69){
		grade = 'B';
		grade_definition = 'Very Good';
	}else if(total_percentage >= 70 && total_percentage <= 74){
		grade = 'B+';
		grade_definition = 'Very Good';
	}else if(total_percentage >= 75 && total_percentage <= 84){
		grade = 'A';
		grade_definition = 'Excellent';
	}else if(total_percentage >= 85 && total_percentage <= 100){
		grade = 'A+';
		grade_definition = 'Excellent';
	}
	
	$('.total_percentage_index_'+index).val(total_percentage);
	$('.grade_index_'+index).val(grade);
	$('.grade_definition_index_'+index).val(grade_definition);
	$('.is_pass_index_'+index).val(is_pass);
	$('.ew_total_percentage_index_'+index).val(ew_total_percentage);
	$('.cw_total_percentage_index_'+index).val(cw_total_percentage);
	
	$('.m_total_percentage_index_'+index).text(total_percentage);
	$('.m_grade_index_'+index).text(grade);
	$('.m_grade_definition_index_'+index).text(grade_definition);

});
			});

			
			
$(document).ready(function() {
$('#prev_savemarks').click(function(){
	$('#prev_editstudentmarksform-is_submit').val('save');
});
$('#prev_submitmarks').click(function(){
	$('#prev_editstudentmarksform-is_submit').val('submit');
});

$('#prev_savemarks, #prev_submitmarks').click(function(){
var ewmarks = $('.prev_editstudentmarksform-ew_marks').val();
	var index = $('.prev_editstudentmarksform-ew_marks').attr('index');
	$('.prev_merr').hide();
	$('.prev_merr').text('');
	if(ewmarks == ''){
			$('.prev_ewerr_index_'+index).text('Please enter the marks');
			$('.prev_errerr').show();
			return false;
		}else{
			$('.prev_ewerr_index_'+index).hide();
			if($.isNumeric(ewmarks)){
				$('.prev_ewnum_index_'+index).hide();
				if(ewmarks > 100){
					$('.prev_ewmax_index_'+index).text('Marks should not exceed 100');
					$('.prev_errmax').show();
					return false;
				}else{
					$('.prev_ewmax_index_'+index).hide();
				}
			}else{
				$('.prev_ewnum_index_'+index).text('Please enter only digits');
				$('.prev_errnum').show();
				return false;
			}
		}
		
	var cwmarks = $('.prev_editstudentmarksform-cw_marks').val();
	var index = $('.prev_editstudentmarksform-cw_marks').attr('index');
	if(cwmarks == ''){
			$('.prev_cwerr_index_'+index).text('Please enter the marks');
			$('.prev_errerr').show();
			return false;
		}else{
			$('.prev_cwerr_index_'+index).hide();
			if($.isNumeric(cwmarks)){
				$('.prev_cwnum_index_'+index).hide();
				if(cwmarks > 100){
					$('.prev_cwmax_index_'+index).text('Marks should not exceed 100');
					$('.prev_errmax').show();
					return false;
				}else{
					$('.prev_cwmax_index_'+index).hide();
				}
			}else{
				$('.prev_cwnum_index_'+index).text('Please enter only digits');
				$('.prev_errnum').show();
				return false;
			}
		}
		});

$('.prev_editstudentmarksform-ew_marks').change(function(){
	var ewmarks = $(this).val();
	var index = $(this).attr('index');
	$('.prev_merr').hide();
	$('.prev_merr').text('');
	if(ewmarks == ''){
			$('.prev_ewerr_index_'+index).text('Please enter the marks');
			$('.prev_errerr').show();
		}else{
			$('.prev_ewerr_index_'+index).hide();
			if($.isNumeric(ewmarks)){
				$('.prev_ewnum_index_'+index).hide();
				if(ewmarks > 100){
					$('.prev_ewmax_index_'+index).text('Marks should not exceed 100');
					$('.prev_errmax').show();
				}else{
					$('.prev_ewmax_index_'+index).hide();
				}
			}else{
				$('.prev_ewnum_index_'+index).text('Please enter only digits');
				$('.prev_errnum').show();
			}
		}
});

$('.prev_editstudentmarksform-cw_marks').change(function(){
	var cwmarks = $(this).val();
	var index = $(this).attr('index');
	$('.prev_merr').hide();
	$('.prev_merr').text('');
	if(cwmarks == ''){
			$('.prev_cwerr_index_'+index).text('Please enter the marks');
			$('.prev_errerr').show();
		}else{
			$('.prev_cwerr_index_'+index).hide();
			if($.isNumeric(cwmarks)){
				$('.prev_cwnum_index_'+index).hide();
				if(cwmarks > 100){
					$('.prev_cwmax_index_'+index).text('Marks should not exceed 100');
					$('.prev_errmax').show();
				}else{
					$('.prev_cwmax_index_'+index).hide();
				}
			}else{
				$('.prev_cwnum_index_'+index).text('Please enter only digits');
				$('.prev_errnum').show();
			}
		}
});

$('.prev_editstudentmarksform-ew_marks, .prev_editstudentmarksform-cw_marks').keyup(function(){
	var index = $(this).attr('index');
	var markstype = $(this).attr('markstype');
	var ew_marks = $('.prev_ew_marks_index_'+index).val();
	var ew_percentage = $('.prev_ew_percentage_index_'+index).val();
	var cw_marks = $('.prev_cw_marks_index_'+index).val();
	var cw_percentage = $('.prev_cw_percentage_index_'+index).val();
	var ew_total_percentage = (ew_marks/100)*ew_percentage;
	var cw_total_percentage = (cw_marks/100)*cw_percentage;
	var total_percentage = ew_total_percentage+cw_total_percentage;
	if(total_percentage<40){
		var is_pass = 0;
	}else{
		var is_pass = 1;
	}
	var grade='';
	var grade_definition = '';
	
	if(total_percentage >= 0 && total_percentage <= 39){
		grade = 'F';
		grade_definition = 'Fail';
	}else if(total_percentage >= 40 && total_percentage <= 44){
		grade = 'E';
		grade_definition = 'Marginal';
	}else if(total_percentage >= 45 && total_percentage <= 49){
		grade = 'D';
		grade_definition = 'Satisfactory';
	}else if(total_percentage >= 50 && total_percentage <= 54){
		grade = 'D+';
		grade_definition = 'Satisfactory';
	}else if(total_percentage >= 55 && total_percentage <= 59){
		grade = 'C';
		grade_definition = 'Good';
	}else if(total_percentage >= 60 && total_percentage <= 64){
		grade = 'C+';
		grade_definition = 'Good';
	}else if(total_percentage >= 65 && total_percentage <= 69){
		grade = 'B';
		grade_definition = 'Very Good';
	}else if(total_percentage >= 70 && total_percentage <= 74){
		grade = 'B+';
		grade_definition = 'Very Good';
	}else if(total_percentage >= 75 && total_percentage <= 84){
		grade = 'A';
		grade_definition = 'Excellent';
	}else if(total_percentage >= 85 && total_percentage <= 100){
		grade = 'A+';
		grade_definition = 'Excellent';
	}
	
	$('.prev_total_percentage_index_'+index).val(total_percentage);
	$('.prev_grade_index_'+index).val(grade);
	$('.prev_grade_definition_index_'+index).val(grade_definition);
	$('.prev_is_pass_index_'+index).val(is_pass);
	$('.prev_ew_total_percentage_index_'+index).val(ew_total_percentage);
	$('.prev_cw_total_percentage_index_'+index).val(cw_total_percentage);
	
	$('.prev_m_total_percentage_index_'+index).text(total_percentage);
	$('.prev_m_grade_index_'+index).text(grade);
	$('.prev_m_grade_definition_index_'+index).text(grade_definition);

});
			});
			
$(document).ready(function() {
$('#prev2_savemarks').click(function(){
	$('#prev2_editstudentmarksform-is_submit').val('save');
});
$('#prev2_submitmarks').click(function(){
	$('#prev2_editstudentmarksform-is_submit').val('submit');
});

$('#prev2_savemarks, #prev2_submitmarks').click(function(){
var ewmarks = $('.prev2_editstudentmarksform-ew_marks').val();
	var index = $('.prev2_editstudentmarksform-ew_marks').attr('index');
	$('.prev2_merr').hide();
	$('.prev2_merr').text('');
	if(ewmarks == ''){
			$('.prev2_ewerr_index_'+index).text('Please enter the marks');
			$('.prev2_errerr').show();
			return false;
		}else{
			$('.prev2_ewerr_index_'+index).hide();
			if($.isNumeric(ewmarks)){
				$('.prev2_ewnum_index_'+index).hide();
				if(ewmarks > 100){
					$('.prev2_ewmax_index_'+index).text('Marks should not exceed 100');
					$('.prev2_errmax').show();
					return false;
				}else{
					$('.prev2_ewmax_index_'+index).hide();
				}
			}else{
				$('.prev2_ewnum_index_'+index).text('Please enter only digits');
				$('.prev2_errnum').show();
				return false;
			}
		}
		
	var cwmarks = $('.prev2_editstudentmarksform-cw_marks').val();
	var index = $('.prev2_editstudentmarksform-cw_marks').attr('index');
	if(cwmarks == ''){
			$('.prev2_cwerr_index_'+index).text('Please enter the marks');
			$('.prev2_errerr').show();
			return false;
		}else{
			$('.prev2_cwerr_index_'+index).hide();
			if($.isNumeric(cwmarks)){
				$('.prev2_cwnum_index_'+index).hide();
				if(cwmarks > 100){
					$('.prev2_cwmax_index_'+index).text('Marks should not exceed 100');
					$('.prev2_errmax').show();
					return false;
				}else{
					$('.prev2_cwmax_index_'+index).hide();
				}
			}else{
				$('.prev2_cwnum_index_'+index).text('Please enter only digits');
				$('.prev2_errnum').show();
				return false;
			}
		}
		});

$('.prev2_editstudentmarksform-ew_marks').change(function(){
	var ewmarks = $(this).val();
	var index = $(this).attr('index');
	$('.prev2_merr').hide();
	$('.prev2_merr').text('');
	if(ewmarks == ''){
			$('.prev2_ewerr_index_'+index).text('Please enter the marks');
			$('.prev2_errerr').show();
		}else{
			$('.prev2_ewerr_index_'+index).hide();
			if($.isNumeric(ewmarks)){
				$('.prev2_ewnum_index_'+index).hide();
				if(ewmarks > 100){
					$('.prev2_ewmax_index_'+index).text('Marks should not exceed 100');
					$('.prev2_errmax').show();
				}else{
					$('.prev2_ewmax_index_'+index).hide();
				}
			}else{
				$('.prev2_ewnum_index_'+index).text('Please enter only digits');
				$('.prev2_errnum').show();
			}
		}
});

$('.prev2_editstudentmarksform-cw_marks').change(function(){
	var cwmarks = $(this).val();
	var index = $(this).attr('index');
	$('.prev2_merr').hide();
	$('.prev2_merr').text('');
	if(cwmarks == ''){
			$('.prev2_cwerr_index_'+index).text('Please enter the marks');
			$('.prev2_errerr').show();
		}else{
			$('.prev2_cwerr_index_'+index).hide();
			if($.isNumeric(cwmarks)){
				$('.prev2_cwnum_index_'+index).hide();
				if(cwmarks > 100){
					$('.prev2_cwmax_index_'+index).text('Marks should not exceed 100');
					$('.prev2_errmax').show();
				}else{
					$('.prev2_cwmax_index_'+index).hide();
				}
			}else{
				$('.prev2_cwnum_index_'+index).text('Please enter only digits');
				$('.prev2_errnum').show();
			}
		}
});

$('.prev2_editstudentmarksform-ew_marks, .prev2_editstudentmarksform-cw_marks').keyup(function(){
	var index = $(this).attr('index');
	var markstype = $(this).attr('markstype');
	var ew_marks = $('.prev2_ew_marks_index_'+index).val();
	var ew_percentage = $('.prev2_ew_percentage_index_'+index).val();
	var cw_marks = $('.prev2_cw_marks_index_'+index).val();
	var cw_percentage = $('.prev2_cw_percentage_index_'+index).val();
	var ew_total_percentage = (ew_marks/100)*ew_percentage;
	var cw_total_percentage = (cw_marks/100)*cw_percentage;
	var total_percentage = ew_total_percentage+cw_total_percentage;
	if(total_percentage<40){
		var is_pass = 0;
	}else{
		var is_pass = 1;
	}
	var grade='';
	var grade_definition = '';
	
	if(total_percentage >= 0 && total_percentage <= 39){
		grade = 'F';
		grade_definition = 'Fail';
	}else if(total_percentage >= 40 && total_percentage <= 44){
		grade = 'E';
		grade_definition = 'Marginal';
	}else if(total_percentage >= 45 && total_percentage <= 49){
		grade = 'D';
		grade_definition = 'Satisfactory';
	}else if(total_percentage >= 50 && total_percentage <= 54){
		grade = 'D+';
		grade_definition = 'Satisfactory';
	}else if(total_percentage >= 55 && total_percentage <= 59){
		grade = 'C';
		grade_definition = 'Good';
	}else if(total_percentage >= 60 && total_percentage <= 64){
		grade = 'C+';
		grade_definition = 'Good';
	}else if(total_percentage >= 65 && total_percentage <= 69){
		grade = 'B';
		grade_definition = 'Very Good';
	}else if(total_percentage >= 70 && total_percentage <= 74){
		grade = 'B+';
		grade_definition = 'Very Good';
	}else if(total_percentage >= 75 && total_percentage <= 84){
		grade = 'A';
		grade_definition = 'Excellent';
	}else if(total_percentage >= 85 && total_percentage <= 100){
		grade = 'A+';
		grade_definition = 'Excellent';
	}
	
	$('.prev2_total_percentage_index_'+index).val(total_percentage);
	$('.prev2_grade_index_'+index).val(grade);
	$('.prev2_grade_definition_index_'+index).val(grade_definition);
	$('.prev2_is_pass_index_'+index).val(is_pass);
	$('.prev2_ew_total_percentage_index_'+index).val(ew_total_percentage);
	$('.prev2_cw_total_percentage_index_'+index).val(cw_total_percentage);
	
	$('.prev2_m_total_percentage_index_'+index).text(total_percentage);
	$('.prev2_m_grade_index_'+index).text(grade);
	$('.prev2_m_grade_definition_index_'+index).text(grade_definition);

});
			});
			
			
$(document).ready(function() {
$('#prev3_savemarks').click(function(){
	$('#prev3_editstudentmarksform-is_submit').val('save');
});
$('#prev3_submitmarks').click(function(){
	$('#prev3_editstudentmarksform-is_submit').val('submit');
});

$('#prev3_savemarks, #prev3_submitmarks').click(function(){
var ewmarks = $('.prev3_editstudentmarksform-ew_marks').val();
	var index = $('.prev3_editstudentmarksform-ew_marks').attr('index');
	$('.prev3_merr').hide();
	$('.prev3_merr').text('');
	if(ewmarks == ''){
			$('.prev3_ewerr_index_'+index).text('Please enter the marks');
			$('.prev3_errerr').show();
			return false;
		}else{
			$('.prev3_ewerr_index_'+index).hide();
			if($.isNumeric(ewmarks)){
				$('.prev3_ewnum_index_'+index).hide();
				if(ewmarks > 100){
					$('.prev3_ewmax_index_'+index).text('Marks should not exceed 100');
					$('.prev3_errmax').show();
					return false;
				}else{
					$('.prev3_ewmax_index_'+index).hide();
				}
			}else{
				$('.prev3_ewnum_index_'+index).text('Please enter only digits');
				$('.prev3_errnum').show();
				return false;
			}
		}
		
	var cwmarks = $('.prev3_editstudentmarksform-cw_marks').val();
	var index = $('.prev3_editstudentmarksform-cw_marks').attr('index');
	if(cwmarks == ''){
			$('.prev3_cwerr_index_'+index).text('Please enter the marks');
			$('.prev3_errerr').show();
			return false;
		}else{
			$('.prev3_cwerr_index_'+index).hide();
			if($.isNumeric(cwmarks)){
				$('.prev3_cwnum_index_'+index).hide();
				if(cwmarks > 100){
					$('.prev3_cwmax_index_'+index).text('Marks should not exceed 100');
					$('.prev3_errmax').show();
					return false;
				}else{
					$('.prev3_cwmax_index_'+index).hide();
				}
			}else{
				$('.prev3_cwnum_index_'+index).text('Please enter only digits');
				$('.prev3_errnum').show();
				return false;
			}
		}
		});

$('.prev3_editstudentmarksform-ew_marks').change(function(){
	var ewmarks = $(this).val();
	var index = $(this).attr('index');
	$('.prev3_merr').hide();
	$('.prev3_merr').text('');
	if(ewmarks == ''){
			$('.prev3_ewerr_index_'+index).text('Please enter the marks');
			$('.prev3_errerr').show();
		}else{
			$('.prev3_ewerr_index_'+index).hide();
			if($.isNumeric(ewmarks)){
				$('.prev3_ewnum_index_'+index).hide();
				if(ewmarks > 100){
					$('.prev3_ewmax_index_'+index).text('Marks should not exceed 100');
					$('.prev3_errmax').show();
				}else{
					$('.prev3_ewmax_index_'+index).hide();
				}
			}else{
				$('.prev3_ewnum_index_'+index).text('Please enter only digits');
				$('.prev3_errnum').show();
			}
		}
});

$('.prev3_editstudentmarksform-cw_marks').change(function(){
	var cwmarks = $(this).val();
	var index = $(this).attr('index');
	$('.prev3_merr').hide();
	$('.prev3_merr').text('');
	if(cwmarks == ''){
			$('.prev3_cwerr_index_'+index).text('Please enter the marks');
			$('.prev3_errerr').show();
		}else{
			$('.prev3_cwerr_index_'+index).hide();
			if($.isNumeric(cwmarks)){
				$('.prev3_cwnum_index_'+index).hide();
				if(cwmarks > 100){
					$('.prev3_cwmax_index_'+index).text('Marks should not exceed 100');
					$('.prev3_errmax').show();
				}else{
					$('.prev3_cwmax_index_'+index).hide();
				}
			}else{
				$('.prev3_cwnum_index_'+index).text('Please enter only digits');
				$('.prev3_errnum').show();
			}
		}
});

$('.prev3_editstudentmarksform-ew_marks, .prev3_editstudentmarksform-cw_marks').keyup(function(){
	var index = $(this).attr('index');
	var markstype = $(this).attr('markstype');
	var ew_marks = $('.prev3_ew_marks_index_'+index).val();
	var ew_percentage = $('.prev3_ew_percentage_index_'+index).val();
	var cw_marks = $('.prev3_cw_marks_index_'+index).val();
	var cw_percentage = $('.prev3_cw_percentage_index_'+index).val();
	var ew_total_percentage = (ew_marks/100)*ew_percentage;
	var cw_total_percentage = (cw_marks/100)*cw_percentage;
	var total_percentage = ew_total_percentage+cw_total_percentage;
	if(total_percentage<40){
		var is_pass = 0;
	}else{
		var is_pass = 1;
	}
	var grade='';
	var grade_definition = '';
	
	if(total_percentage >= 0 && total_percentage <= 39){
		grade = 'F';
		grade_definition = 'Fail';
	}else if(total_percentage >= 40 && total_percentage <= 44){
		grade = 'E';
		grade_definition = 'Marginal';
	}else if(total_percentage >= 45 && total_percentage <= 49){
		grade = 'D';
		grade_definition = 'Satisfactory';
	}else if(total_percentage >= 50 && total_percentage <= 54){
		grade = 'D+';
		grade_definition = 'Satisfactory';
	}else if(total_percentage >= 55 && total_percentage <= 59){
		grade = 'C';
		grade_definition = 'Good';
	}else if(total_percentage >= 60 && total_percentage <= 64){
		grade = 'C+';
		grade_definition = 'Good';
	}else if(total_percentage >= 65 && total_percentage <= 69){
		grade = 'B';
		grade_definition = 'Very Good';
	}else if(total_percentage >= 70 && total_percentage <= 74){
		grade = 'B+';
		grade_definition = 'Very Good';
	}else if(total_percentage >= 75 && total_percentage <= 84){
		grade = 'A';
		grade_definition = 'Excellent';
	}else if(total_percentage >= 85 && total_percentage <= 100){
		grade = 'A+';
		grade_definition = 'Excellent';
	}
	
	$('.prev3_total_percentage_index_'+index).val(total_percentage);
	$('.prev3_grade_index_'+index).val(grade);
	$('.prev3_grade_definition_index_'+index).val(grade_definition);
	$('.prev3_is_pass_index_'+index).val(is_pass);
	$('.prev3_ew_total_percentage_index_'+index).val(ew_total_percentage);
	$('.prev3_cw_total_percentage_index_'+index).val(cw_total_percentage);
	
	$('.prev3_m_total_percentage_index_'+index).text(total_percentage);
	$('.prev3_m_grade_index_'+index).text(grade);
	$('.prev3_m_grade_definition_index_'+index).text(grade_definition);

});
			});
</script>
