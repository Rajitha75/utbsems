
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\bootstrap\Alert;
use common\models\Storage;
use yii\helpers\Url;
$storagemodel = new Storage();
ini_set('memory_limit', '1024M');
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>STUDENT STAGE WISE MARKS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link type="text/css" href="<?php echo Yii::getAlias('@web'); ?>/themes/metronic/assets/global/css/bootstrap.min.css" rel="stylesheet"  media="print" media="screen"/>
<link type="text/css" href="<?php echo Yii::getAlias('@web'); ?>/themes/metronic/assets/global/css/font-awesome.css" rel="stylesheet"   media="print" media="screen"/>
<link type="text/css" href="<?php echo Yii::getAlias('@web'); ?>/themes/metronic/assets/global/css/pdf.css" rel="stylesheet"  media="print" media="screen"/>

<link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,700" rel="stylesheet" media="print" media="screen"> 

<script src="<?php echo Yii::getAlias('@web'); ?>/themes/metronic/assets/global/scripts/bootstrap.js" type="text/javascript" media="print" media="screen"></script>

<style>
table, td, th {
    border: 1px solid #756c6c;
	font-size: 10px;
	padding:2px;
}

.tablecontent{
	margin-bottom:30px;
	margin-right:30px;
	
}

.tdheading{
	font-weight:bold;
}

.studentinfo{
	width:90%;
	margin-bottom:30px;
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
.tit{
	background:#00224c !important;
	padding: 10px !important;
    color: #fff !important;
    font-size: 18px !important;
    text-transform: uppercase !important;
}
.yr {
    background: #4a5789;
    color: #fff !important;
    text-align: center;
}
.sem {
  background: #8194ac;
color: #fff !important;
text-align: center;
}
</style>
</head>
<body>
<?php 
$this->title = 'STUDENT STAGE WISE MARKS';  ?> 
<div class="tit"><?php echo $this->title; ?></div>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">
		<table class="management">
		<tr>
		<td class="sem">Original Marks</td>
		</tr>
		</table>
<table class="studentinfo">
<tr><td class="sinfotd">Name :</td><td><?php echo isset($studentmarks[0]['studentname'])? $studentmarks[0]['studentname'] : '' ?></td></tr>
<tr><td class="sinfotd">IC No :</td><td><?php echo isset($studentmarks[0]['ic_no'])? $studentmarks[0]['ic_no'] : '' ?></td></tr>
<tr><td class="sinfotd">Roll No :</td><td><?php echo isset($studentmarks[0]['rollno'])? $studentmarks[0]['rollno'] : '' ?></td></tr>
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
	<div class="tablecontent" >
	<table >
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
	<td><?php echo isset($studentmarks[$i]['ew_marks'])? $studentmarks[$i]['ew_marks'] : '' ?></td>
	<td><?php echo isset($studentmarks[$i]['cw_marks'])? $studentmarks[$i]['cw_marks'] : '' ?></td>
	</tr>
	</table>
	</div>
	<?php } ?>
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
		<td class="levelhead yr">Level of Management</td>
		<td class="leveltitle sem"><?php echo 'Programme Area'; ?><?php echo ($studentprevdata[0]['is_submit'] == 'submit') ? '' : ' (Saved)'; ?></td>
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
	<table >
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
	<td><?php echo isset($studentmarks[$i]['ew_marks'])? $studentmarks[$i]['ew_marks'] : '' ?></td>
	<td><?php echo isset($studentmarks[$i]['cw_marks'])? $studentmarks[$i]['cw_marks'] : '' ?></td>
	</tr>
	</table>
	</div>
	<?php } ?>
	
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
		<td class="levelhead yr">Level of Management</td>
		<td class="leveltitle sem"><?php echo 'Faculty/School Exam Board'; ?><?php echo ($studentprevdata2[0]['is_submit'] == 'submit') ? '' : ' (Saved)'; ?></td>
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
	<td><?php echo isset($studentmarks[$i]['ew_marks'])? $studentmarks[$i]['ew_marks'] : '' ?></td>
	<td><?php echo isset($studentmarks[$i]['cw_marks'])? $studentmarks[$i]['cw_marks'] : '' ?></td>
	</tr>
	</table>
	</div>
	<?php } ?>
	
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
		<td class="levelhead yr">Level of Management</td>
		<td class="leveltitle sem"><?php echo 'University Exam Board'; ?><?php echo ($studentprevdata3[0]['is_submit'] == 'submit') ? '' : ' (Saved)'; ?></td>
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
	<td><?php echo isset($studentmarks[$i]['ew_marks'])? $studentmarks[$i]['ew_marks'] : '' ?></td>
	<td><?php echo isset($studentmarks[$i]['cw_marks'])? $studentmarks[$i]['cw_marks'] : '' ?></td>
	</tr>
	</table>
	</div>
	<?php } ?>
	
	
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
	</body>
</html>
		