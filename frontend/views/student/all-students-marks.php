
<?php
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
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
.nodata{
font-weight: bold;
    font-size: 16px;
    color: #6b3bd5;
	padding-left:20px;
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
table, td, th {
    border: 1px solid black;
	font-size: 14px;
}
td, th {
	padding: 4px;
	width: 34px;
}
/*.year_1 {
	float:left;
	margin-right: 30px;
}
.year_2{
	float:left;
}

.year_3 {
	float:left;
	margin-right: 30px;
}
.year_4{
	float:left;
} */

.year_1 table,.year_2 table,.year_3 table,.year_4 table{
	margin-bottom:30px;
}

.noborder{
	border:0;
}
</style>
<?php
$this->title = 'Student Marks';
echo "<h1 class='box-title'>$this->title </h1>";  ?>
<?php if(count($studentmarks1)>0 || count($studentmarks2)>0 || count($studentmarks3)>0 || count($studentmarks4)>0) { ?>
<div class="downloadall">
<?php $vurl = Url::toRoute(['../../view-all-marks-pdf']); ?>
<?php if(count($studentmarks1)>0){
	$programmename = $studentmarks1[0]['programme_name'];
	$facultyname = $studentmarks1[0]['faculty_name'];
}else if(count($studentmarks2)>0){
	$programmename = $studentmarks2[0]['programme_name'];
	$facultyname = $studentmarks2[0]['faculty_name'];
}else if(count($studentmarks3)>0){
	$programmename = $studentmarks3[0]['programme_name'];
	$facultyname = $studentmarks3[0]['faculty_name'];
}else if(count($studentmarks4)>0){
	$programmename = $studentmarks4[0]['programme_name'];
	$facultyname = $studentmarks4[0]['faculty_name'];
} ?>
 <a href="<?php echo $vurl; ?>" id="downloadall" class="btn btn-primary" target="_blank">Download</a>
 </div>
 <?php if(isset($programmename) && $programmename != '') { ?>
 <div class="programme-title">Programme Name : <?php echo $programmename;  ?></div>
 <?php } ?>
 <?php if(isset($facultyname) && $facultyname != '') { ?>
 <div class="faculty-title">Faculty Name :  <?php echo $facultyname; ?></div>
 <?php } ?>
<?php //print_r($studentmarks1); exit;
$smarks1 = []; $semisterArray1 = [];
 $moduleidArray1 = []; $modulenameArray1 = []; $moduleArrayid1 = [];
 $moduleidArray2 = []; $modulenameArray2 = []; $moduleArrayid2 = [];
 $moduleidArray12 = []; $modulenameArray12 = []; $moduleArrayid12 = [];
 $studentArray1 = []; $studentNameArray1 = []; $newArray1 = [];
 if(isset($studentmarks1) && count($studentmarks1)>0){
 for($i=0;$i<count($studentmarks1);$i++) {
	$semcount = 0;
	if (!in_array($studentmarks1[$i]['semister'], $semisterArray1)){
		$semcount = $semcount+1;
		array_push($semisterArray1, $studentmarks1[$i]['semister']);
	}
	if($studentmarks1[$i]['semister'] == 1){
	if (!in_array($studentmarks1[$i]['module_id'], $moduleidArray1)){
		array_push($moduleidArray1, $studentmarks1[$i]['module_id']);
		array_push($modulenameArray1, $studentmarks1[$i]['module_name']);
		array_push($moduleArrayid1, $studentmarks1[$i]['moduleid']);

		array_push($moduleidArray12, $studentmarks1[$i]['module_id']);
		array_push($modulenameArray12, $studentmarks1[$i]['module_name']);
		array_push($moduleArrayid12, $studentmarks1[$i]['moduleid']);
	}
	}
	if($studentmarks1[$i]['semister'] == 2){
	if (!in_array($studentmarks1[$i]['module_id'], $moduleidArray2)){
		array_push($moduleidArray2, $studentmarks1[$i]['module_id']);
		array_push($modulenameArray2, $studentmarks1[$i]['module_name']);
		array_push($moduleArrayid2, $studentmarks1[$i]['moduleid']);

		array_push($moduleidArray12, $studentmarks1[$i]['module_id']);
		array_push($modulenameArray12, $studentmarks1[$i]['module_name']);
		array_push($moduleArrayid12, $studentmarks1[$i]['moduleid']);
	}
	}
	if (!in_array($studentmarks1[$i]['student_id'], $studentArray1)){
		array_push($studentArray1, $studentmarks1[$i]['student_id']);
		array_push($studentNameArray1, $studentmarks1[$i]['studentname']);
	}

	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['ew_percentage'] = $studentmarks1[$i]['ew_percentage'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['ew_marks'] = $studentmarks1[$i]['ew_marks'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['cw_percentage'] = $studentmarks1[$i]['cw_percentage'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['cw_marks'] = $studentmarks1[$i]['cw_marks'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['ew_total_percentage'] = $studentmarks1[$i]['ew_total_percentage'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['cw_total_percentage'] = $studentmarks1[$i]['cw_total_percentage'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['total_percentage'] = $studentmarks1[$i]['total_percentage'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['grade'] = $studentmarks1[$i]['grade'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['studentname'] = $studentmarks1[$i]['studentname'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['ic_no'] = $studentmarks1[$i]['ic_no'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['rollno'] = $studentmarks1[$i]['rollno'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['student_id'] = $studentmarks1[$i]['student_id'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['semister'] = $studentmarks1[$i]['semister'];
	$smarks1[$studentmarks1[$i]['semister']][$studentmarks1[$i]['module_id']][$studentmarks1[$i]['student_id']]['mid'] = $studentmarks1[$i]['id'];
}
}//echo '<pre>';print_r($smarks1);exit;
//echo $smarks1[1][1][56]['grade']; exit; ?>

<?php $smarks2 = []; $semisterArray2 = [];
 $moduleidArray3 = []; $modulenameArray3 = []; $moduleArrayid3 = [];
 $moduleidArray4 = []; $modulenameArray4 = []; $moduleArrayid4 = [];
 $moduleidArray34 = []; $modulenameArray34 = []; $moduleArrayid34 = [];
 $studentArray2 = []; $studentNameArray2 = []; $newArray2 = [];
 if(isset($studentmarks2) && count($studentmarks2)>0){
	 for($i=0;$i<count($studentmarks2);$i++) {
	$semcount = 0;
	if (!in_array($studentmarks2[$i]['semister'], $semisterArray2)){
		$semcount = $semcount+1;
		array_push($semisterArray2, $studentmarks2[$i]['semister']);
	}
	if($studentmarks2[$i]['semister'] == 3){
	if (!in_array($studentmarks2[$i]['module_id'], $moduleidArray3)){
		array_push($moduleidArray3, $studentmarks2[$i]['module_id']);
		array_push($modulenameArray3, $studentmarks2[$i]['module_name']);
		array_push($moduleArrayid3, $studentmarks2[$i]['moduleid']);

		array_push($moduleidArray34, $studentmarks2[$i]['module_id']);
		array_push($modulenameArray34, $studentmarks2[$i]['module_name']);
		array_push($moduleArrayid34, $studentmarks2[$i]['moduleid']);
	}
	}
	if($studentmarks2[$i]['semister'] == 4){
	if (!in_array($studentmarks2[$i]['module_id'], $moduleidArray4)){
		array_push($moduleidArray4, $studentmarks2[$i]['module_id']);
		array_push($modulenameArray4, $studentmarks2[$i]['module_name']);
		array_push($moduleArrayid4, $studentmarks2[$i]['moduleid']);

		array_push($moduleidArray34, $studentmarks2[$i]['module_id']);
		array_push($modulenameArray34, $studentmarks2[$i]['module_name']);
		array_push($moduleArrayid34, $studentmarks2[$i]['moduleid']);
	}
	}
	if (!in_array($studentmarks2[$i]['student_id'], $studentArray2)){
		array_push($studentArray2, $studentmarks2[$i]['student_id']);
		array_push($studentNameArray2, $studentmarks2[$i]['studentname']);
	}

	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['ew_percentage'] = $studentmarks2[$i]['ew_percentage'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['ew_marks'] = $studentmarks2[$i]['ew_marks'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['cw_percentage'] = $studentmarks2[$i]['cw_percentage'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['cw_marks'] = $studentmarks2[$i]['cw_marks'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['ew_total_percentage'] = $studentmarks2[$i]['ew_total_percentage'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['cw_total_percentage'] = $studentmarks2[$i]['cw_total_percentage'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['total_percentage'] = $studentmarks2[$i]['total_percentage'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['grade'] = $studentmarks2[$i]['grade'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['studentname'] = $studentmarks2[$i]['studentname'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['ic_no'] = $studentmarks2[$i]['ic_no'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['rollno'] = $studentmarks2[$i]['rollno'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['student_id'] = $studentmarks2[$i]['student_id'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['semister'] = $studentmarks2[$i]['semister'];
	$smarks2[$studentmarks2[$i]['semister']][$studentmarks2[$i]['module_id']][$studentmarks2[$i]['student_id']]['mid'] = $studentmarks2[$i]['id'];
}
}//echo '<pre>';print_r($moduleArrayid34);exit;
//echo $smarks2[1][1][56]['grade']; exit; ?>

<?php $smarks3 = []; $semisterArray3 = [];
 $moduleidArray5 = []; $modulenameArray5 = []; $moduleArrayid5 = [];
 $moduleidArray6 = []; $modulenameArray6 = []; $moduleArrayid6 = [];
 $moduleidArray56 = []; $modulenameArray56 = []; $moduleArrayid56 = [];
 $studentArray3 = []; $studentNameArray3 = []; $newArray3 = [];
 if(isset($studentmarks3) && count($studentmarks3)>0){
	 for($i=0;$i<count($studentmarks3);$i++) {
	$semcount = 0;
	if (!in_array($studentmarks3[$i]['semister'], $semisterArray3)){
		$semcount = $semcount+1;
		array_push($semisterArray3, $studentmarks3[$i]['semister']);
	}
	if($studentmarks3[$i]['semister'] == 5){
	if (!in_array($studentmarks3[$i]['module_id'], $moduleidArray5)){
		array_push($moduleidArray5, $studentmarks3[$i]['module_id']);
		array_push($modulenameArray5, $studentmarks3[$i]['module_name']);
		array_push($moduleArrayid5, $studentmarks3[$i]['moduleid']);

		array_push($moduleidArray56, $studentmarks3[$i]['module_id']);
		array_push($modulenameArray56, $studentmarks3[$i]['module_name']);
		array_push($moduleArrayid56, $studentmarks3[$i]['moduleid']);
	}
	}
	if($studentmarks3[$i]['semister'] == 6){
	if (!in_array($studentmarks3[$i]['module_id'], $moduleidArray6)){
		array_push($moduleidArray6, $studentmarks3[$i]['module_id']);
		array_push($modulenameArray6, $studentmarks3[$i]['module_name']);
		array_push($moduleArrayid6, $studentmarks3[$i]['moduleid']);

		array_push($moduleidArray56, $studentmarks3[$i]['module_id']);
		array_push($modulenameArray56, $studentmarks3[$i]['module_name']);
		array_push($moduleArrayid56, $studentmarks3[$i]['moduleid']);
	}
	}
	if (!in_array($studentmarks3[$i]['student_id'], $studentArray3)){
		array_push($studentArray3, $studentmarks3[$i]['student_id']);
		array_push($studentNameArray3, $studentmarks3[$i]['studentname']);
	}

	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['ew_percentage'] = $studentmarks3[$i]['ew_percentage'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['ew_marks'] = $studentmarks3[$i]['ew_marks'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['cw_percentage'] = $studentmarks3[$i]['cw_percentage'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['cw_marks'] = $studentmarks3[$i]['cw_marks'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['ew_total_percentage'] = $studentmarks3[$i]['ew_total_percentage'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['cw_total_percentage'] = $studentmarks3[$i]['cw_total_percentage'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['total_percentage'] = $studentmarks3[$i]['total_percentage'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['grade'] = $studentmarks3[$i]['grade'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['studentname'] = $studentmarks3[$i]['studentname'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['ic_no'] = $studentmarks3[$i]['ic_no'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['rollno'] = $studentmarks3[$i]['rollno'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['student_id'] = $studentmarks3[$i]['student_id'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['semister'] = $studentmarks3[$i]['semister'];
	$smarks3[$studentmarks3[$i]['semister']][$studentmarks3[$i]['module_id']][$studentmarks3[$i]['student_id']]['mid'] = $studentmarks3[$i]['id'];
}
 }//echo '<pre>';print_r($moduleArrayid56);exit;
//echo $smarks3[1][1][56]['grade']; exit; ?>

<?php $smarks4 = []; $semisterArray4 = [];
 $moduleidArray7 = []; $modulenameArray7 = []; $moduleArrayid7 = [];
 $moduleidArray8 = []; $modulenameArray8 = []; $moduleArrayid8 = [];
 $moduleidArray78 = []; $modulenameArray78 = []; $moduleArrayid78 = [];
 $studentArray4 = []; $studentNameArray4 = []; $newArray4 = [];
 if(isset($studentmarks4) && count($studentmarks4)>0){
	 for($i=0;$i<count($studentmarks4);$i++) {
	$semcount = 0;
	if (!in_array($studentmarks4[$i]['semister'], $semisterArray4)){
		$semcount = $semcount+1;
		array_push($semisterArray4, $studentmarks4[$i]['semister']);
	}
	if($studentmarks4[$i]['semister'] == 7){
	if (!in_array($studentmarks4[$i]['module_id'], $moduleidArray7)){
		array_push($moduleidArray7, $studentmarks4[$i]['module_id']);
		array_push($modulenameArray7, $studentmarks4[$i]['module_name']);
		array_push($moduleArrayid7, $studentmarks4[$i]['moduleid']);

		array_push($moduleidArray78, $studentmarks4[$i]['module_id']);
		array_push($modulenameArray78, $studentmarks4[$i]['module_name']);
		array_push($moduleArrayid78, $studentmarks4[$i]['moduleid']);
	}
	}
	if($studentmarks4[$i]['semister'] == 8){
	if (!in_array($studentmarks4[$i]['module_id'], $moduleidArray8)){
		array_push($moduleidArray8, $studentmarks4[$i]['module_id']);
		array_push($modulenameArray8, $studentmarks4[$i]['module_name']);
		array_push($moduleArrayid8, $studentmarks4[$i]['moduleid']);

		array_push($moduleidArray78, $studentmarks4[$i]['module_id']);
		array_push($modulenameArray78, $studentmarks4[$i]['module_name']);
		array_push($moduleArrayid78, $studentmarks4[$i]['moduleid']);
	}
	}
	if (!in_array($studentmarks4[$i]['student_id'], $studentArray4)){
		array_push($studentArray4, $studentmarks4[$i]['student_id']);
		array_push($studentNameArray4, $studentmarks4[$i]['studentname']);
	}

	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['ew_percentage'] = $studentmarks4[$i]['ew_percentage'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['ew_marks'] = $studentmarks4[$i]['ew_marks'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['cw_percentage'] = $studentmarks4[$i]['cw_percentage'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['cw_marks'] = $studentmarks4[$i]['cw_marks'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['ew_total_percentage'] = $studentmarks4[$i]['ew_total_percentage'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['cw_total_percentage'] = $studentmarks4[$i]['cw_total_percentage'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['total_percentage'] = $studentmarks4[$i]['total_percentage'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['grade'] = $studentmarks4[$i]['grade'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['studentname'] = $studentmarks4[$i]['studentname'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['ic_no'] = $studentmarks4[$i]['ic_no'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['rollno'] = $studentmarks4[$i]['rollno'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['student_id'] = $studentmarks4[$i]['student_id'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['semister'] = $studentmarks4[$i]['semister'];
	$smarks4[$studentmarks4[$i]['semister']][$studentmarks4[$i]['module_id']][$studentmarks4[$i]['student_id']]['mid'] = $studentmarks4[$i]['id'];
}
 }//echo '<pre>';print_r($smarks4);exit;
//echo $smarks4[1][1][56]['grade']; exit; ?>


<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="">
        <div class="">

        	<div class="panel-body">


<div id="pjax-list" data-pjax-container=""><div id="w0" class="grid-view">

<div class="year_1_2">
<?php //print_r($smarks1);exit;
if(count($studentArray1)>0) { ?>
<div class="year_1">
<table class="table">
  <tr>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="yr" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleArrayid12)*4)+count($moduleidArray12)+1 : (count($moduleArrayid12)*4)+1; ?>">Year 1</td>
  </tr>
  <tr>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <?php if(count($moduleidArray1)>0) { ?><td class="sem" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleidArray1)*4)+count($moduleidArray1)+1 : (count($moduleidArray1)*4); ?>">Semester 1</td><?php } ?>
  <?php if(count($moduleidArray2)>0) { ?><td class="sem" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleidArray2)*4)+count($moduleidArray2)+1 : (count($moduleidArray2)*4); ?>">Semester 2</td><?php } ?>
  </tr>
   <tr class="mybg">
   <td rowspan="3">Name</td>
   <td rowspan="3">IC No</td>
   <td rowspan="3">Roll No</td>
   <?php for($i=0;$i<count($moduleArrayid12);$i++){ ?>
  <td colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? 5 : 4; ?>" align="center"><?php echo $moduleArrayid12[$i]; ?></td>
   <?php } ?>
   <?php if(Yii::$app->session['userRole'] == 3){ ?>
   <td rowspan="3">Edit</td>
   <?php } ?>
  </tr>
  <tr class="mybg">
   <?php for($i=0;$i<count($moduleidArray12);$i++){ ?>
  <td>CW</td>
<td>EW</td>
<td>Total</td>
<td rowspan="2">Grade</td>
<?php if(Yii::$app->session['userRole'] == 3) { ?><td rowspan="2">Remarks</td><?php } ?>
   <?php } ?>
  </tr>


  <?php $arr1 = []; for($k=0;$k<1;$k++){ ?>
  <tr class="mybg">
	<?php $m=0;
		for($i=0;$i<count($moduleArrayid12);$i++){
		for($j=0;$j<count($semisterArray1);$j++){
		//print_r($smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]);exit;
		if(isset($smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]])) { ?>
		<?php if (!in_array($semisterArray1[$j].$moduleidArray12[$i].$studentArray1[$k], $arr1)){ ?>

		<td><?php echo $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['ew_percentage'].'%'; ?></td>
		<td><?php echo $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['cw_percentage'].'%'; ?></td>
		<td><?php echo '100%'; ?></td>
			<?php $m=$m+1; }
		array_push($arr1, $semisterArray1[$j].$moduleidArray12[$i].$studentArray1[$k]);		?>
		<?php } } } ?>
		</tr>
  <?php } ?>


  <?php  $arr1 = []; for($k=0;$k<count($studentArray1);$k++){ ?>
  <tr>
	<?php $m=0; 
		for($i=0;$i<count($moduleArrayid12);$i++){
		for($j=0;$j<count($semisterArray1);$j++){
		//print_r($smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]);exit;
		if(isset($smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]])) { ?>
		<?php if (!in_array($semisterArray1[$j].$moduleidArray12[$i].$studentArray1[$k], $arr1)){ ?>
		<?php if($m==0) { ?>
		<td><?php echo $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['studentname']; ?></td>
		<td><?php echo $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['ic_no']; ?></td>
		<td><?php echo $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['rollno']; ?></td>
		<?php } ?>
		<td><?php echo $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['ew_total_percentage']; ?></td>
		<td><?php echo $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['cw_total_percentage']; ?></td>
		<td><?php echo $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['total_percentage']; ?></td>
		<td><?php echo $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['grade']; ?></td>
		<?php if(Yii::$app->session['userRole'] == 3) { ?><td><span class="glyphicon glyphicon-edit sremarks" mid = "<?php echo $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['mid']; ?>" title="Remarks"></span></td><?php } ?>
			<?php if($m==(count($moduleidArray1)+count($moduleidArray2))-1  && Yii::$app->session['userRole'] == 3) { ?>
			<td><?php
			$url = Url::toRoute(['../../edit-student-marks', 'year' => 1, 'id' => $smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]['student_id']]);
			?>
			<a href = "<?php echo $url; ?>"><span class="glyphicon glyphicon-pencil" title="Edit"></span></a>
			</td>
			<?php } $m=$m+1; }
		array_push($arr1, $semisterArray1[$j].$moduleidArray12[$i].$studentArray1[$k]);		?>
		<?php } } } ?>

		</tr>
  <?php } ?>

</table>
</div>
<?php } ?>
<?php if(count($studentArray2)>0) { ?>
<div class="year_2">
<table >
  <tr>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="yr" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleArrayid34)*4)+count($moduleidArray34)+1 : (count($moduleArrayid34)*4)+1; ?>">Year 2</td>
  </tr>
  <tr>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <?php if(count($moduleidArray3)>0) { ?><td class="sem" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleidArray3)*4)+count($moduleidArray3)+1 : (count($moduleidArray3)*4)+1; ?>">Semester 3</td><?php } ?>
  <?php if(count($moduleidArray4)>0) { ?><td class="sem" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleidArray4)*4)+count($moduleidArray4)+1 : (count($moduleidArray4)*4)+1; ?>">Semester 4</td><?php } ?>
  </tr>
   <tr class="mybg">
   <td rowspan="3">Name</td>
   <td rowspan="3">IC No</td>
   <td rowspan="3">Roll No</td>
   <?php for($i=0;$i<count($moduleArrayid34);$i++){ ?>
  <td colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? 5 : 4; ?>" align="center"><?php echo $moduleArrayid34[$i]; ?></td>
   <?php } ?>
   <?php if(Yii::$app->session['userRole'] == 3){ ?>
   <td rowspan="3">Edit</td>
   <?php } ?>
  </tr>
  <tr class="mybg">
   <?php for($i=0;$i<count($moduleidArray34);$i++){ ?>
  <td>CW</td>
<td>EW</td>
<td>Total</td>
<td rowspan="2">Grade</td>
<?php if(Yii::$app->session['userRole'] == 3) { ?><td rowspan="2">Remarks</td><?php } ?>
   <?php } ?>
  </tr>


  <?php $arr1 = []; for($k=0;$k<1;$k++){ ?>
  <tr class="mybg">
	<?php $m=0;
		for($i=0;$i<count($moduleArrayid34);$i++){
		for($j=0;$j<count($semisterArray2);$j++){
		//print_r($smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]);exit;
		if(isset($smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]])) { ?>
		<?php if (!in_array($semisterArray2[$j].$moduleidArray34[$i].$studentArray2[$k], $arr1)){ ?>

		<td><?php echo $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['ew_percentage'].'%'; ?></td>
		<td><?php echo $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['cw_percentage'].'%'; ?></td>
		<td><?php echo '100%'; ?></td>
			<?php $m=$m+1; }
		array_push($arr1, $semisterArray2[$j].$moduleidArray34[$i].$studentArray2[$k]);		?>
		<?php } } } ?>
		</tr>
  <?php } ?>


  <?php  $arr1 = []; for($k=0;$k<count($studentArray2);$k++){ ?>
  <tr>
	<?php $m=0;
		for($i=0;$i<count($moduleArrayid34);$i++){
		for($j=0;$j<count($semisterArray2);$j++){
		//print_r($smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]);exit;
		if(isset($smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]])) { ?>
		<?php if (!in_array($semisterArray2[$j].$moduleidArray34[$i].$studentArray2[$k], $arr1)){ ?>
		<?php if($m==0) { ?>
		<td><?php echo $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['studentname']; ?></td>
		<td><?php echo $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['ic_no']; ?></td>
		<td><?php echo $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['rollno']; ?></td>
		<?php } ?>
		<td><?php echo $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['ew_total_percentage']; ?></td>
		<td><?php echo $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['cw_total_percentage']; ?></td>
		<td><?php echo $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['total_percentage']; ?></td>
			<td><?php echo $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['grade']; ?></td>
			<?php if(Yii::$app->session['userRole'] == 3) { ?><td><span class="glyphicon glyphicon-edit sremarks" mid = "<?php echo $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['mid']; ?>"  title="Remarks"></span></td><?php } ?>
			<?php if($m==(count($moduleidArray3)+count($moduleidArray4))-1  && Yii::$app->session['userRole'] == 3) { ?>
			<td><?php
			$url = Url::toRoute(['../../edit-student-marks', 'year' => 2, 'id' => $smarks2[$semisterArray2[$j]][$moduleidArray34[$i]][$studentArray2[$k]]['student_id']]);
			?>
			<a href = "<?php echo $url; ?>"><span class="glyphicon glyphicon-pencil" title="Edit"></span></a>
			</td>
			<?php } $m=$m+1; }
		array_push($arr1, $semisterArray2[$j].$moduleidArray34[$i].$studentArray2[$k]);		?>
		<?php } } } ?>

		</tr>
  <?php } ?>

</table>
</div>
<?php } ?>
</div>

<div class="year_3_4">
<?php if(count($studentArray3)>0) { ?>
<div class="year_3">
<table >
  <tr>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="yr" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleArrayid56)*4)+count($moduleidArray56)+1 : (count($moduleArrayid56)*4)+1; ?>">Year 3</td>
  </tr>
  <tr>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <?php if(count($moduleidArray5)>0) { ?><td class="sem" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleidArray5)*4)+count($moduleidArray5)+1 : (count($moduleidArray5)*4)+1; ?>">Semester 5</td><?php } ?>
  <?php if(count($moduleidArray6)>0) { ?><td class="sem" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleidArray6)*4)+count($moduleidArray6)+1 : (count($moduleidArray6)*4)+1; ?>">Semester 6</td><?php } ?>
  </tr>
   <tr class="mybg">
   <td rowspan="3">Name</td>
   <td rowspan="3">IC No</td>
   <td rowspan="3">Roll No</td>
   <?php for($i=0;$i<count($moduleArrayid56);$i++){ ?>
  <td colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? 5 : 4; ?>" align="center"><?php echo $moduleArrayid56[$i]; ?></td>
   <?php } ?>
   <?php if(Yii::$app->session['userRole'] == 3){ ?>
   <td rowspan="3">Edit</td>
   <?php } ?>
  </tr>
  <tr class="mybg">
   <?php for($i=0;$i<count($moduleidArray56);$i++){ ?>
  <td>CW</td>
<td>EW</td>
<td>Total</td>
<td rowspan="2">Grade</td>
<?php if(Yii::$app->session['userRole'] == 3) { ?><td rowspan="2">Remarks</td><?php } ?>
   <?php } ?>
  </tr>


  <?php $arr1 = []; for($k=0;$k<1;$k++){ ?>
  <tr class="mybg">
	<?php $m=0;
		for($i=0;$i<count($moduleArrayid56);$i++){
		for($j=0;$j<count($semisterArray3);$j++){
		//print_r($smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]);exit;
		if(isset($smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]])) { ?>
		<?php if (!in_array($semisterArray3[$j].$moduleidArray56[$i].$studentArray3[$k], $arr1)){ ?>

		<td><?php echo $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['ew_percentage'].'%'; ?></td>
		<td><?php echo $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['cw_percentage'].'%'; ?></td>
		<td><?php echo '100%'; ?></td>
			<?php $m=$m+1; }
		array_push($arr1, $semisterArray3[$j].$moduleidArray56[$i].$studentArray3[$k]);		?>
		<?php } } } ?>
		</tr>
  <?php } ?>


  <?php  $arr1 = []; for($k=0;$k<count($studentArray3);$k++){ ?>
  <tr>
	<?php $m=0;
		for($i=0;$i<count($moduleArrayid56);$i++){
		for($j=0;$j<count($semisterArray3);$j++){
		//print_r($smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]);exit;
		if(isset($smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]])) { ?>
		<?php if (!in_array($semisterArray3[$j].$moduleidArray56[$i].$studentArray3[$k], $arr1)){ ?>
		<?php if($m==0) { ?>
		<td><?php echo $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['studentname']; ?></td>
		<td><?php echo $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['ic_no']; ?></td>
		<td><?php echo $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['rollno']; ?></td>
		<?php } ?>
		<td><?php echo $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['ew_total_percentage']; ?></td>
		<td><?php echo $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['cw_total_percentage']; ?></td>
		<td><?php echo $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['total_percentage']; ?></td>
			<td><?php echo $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['grade']; ?></td>
			<?php if(Yii::$app->session['userRole'] == 3) { ?><td><span class="glyphicon glyphicon-edit sremarks" mid = "<?php echo $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['mid']; ?>" title="Remarks"></span></td><?php } ?>
			<?php if($m==(count($moduleidArray5)+count($moduleidArray6))-1  && Yii::$app->session['userRole'] == 3) { ?>
			<td><?php
			$url = Url::toRoute(['../../edit-student-marks', 'year' => 3, 'id' => $smarks3[$semisterArray3[$j]][$moduleidArray56[$i]][$studentArray3[$k]]['student_id']]);
			?>
			<a href = "<?php echo $url; ?>"><span class="glyphicon glyphicon-pencil" title="Edit"></span></a>
			</td>
			<?php } $m=$m+1; }
		array_push($arr1, $semisterArray3[$j].$moduleidArray56[$i].$studentArray3[$k]);		?>
		<?php } } } ?>

		</tr>
  <?php } ?>

</table>
</div>
<?php } ?>
<?php if(count($studentArray4)>0) { ?>
<div class="year_4">
<table >
  <tr>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="yr" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleArrayid78)*4)+count($moduleidArray78)+1 : (count($moduleArrayid78)*4)+1; ?>">Year 4</td>
  </tr>
  <tr>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <td class="noborder"></td>
  <?php if(count($moduleidArray7)>0) { ?><td class="sem" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleidArray7)*4)+count($moduleidArray7)+1 : (count($moduleidArray7)*4)+1; ?>">Semester 7</td><?php } ?>
  <?php if(count($moduleidArray8)>0) { ?><td class="sem" colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? (count($moduleidArray8)*4)+count($moduleidArray8)+1 : (count($moduleidArray8)*4)+1; ?>">Semester 8</td><?php } ?>
  </tr>
   <tr class="mybg">
   <td rowspan="3">Name</td>
   <td rowspan="3">IC No</td>
   <td rowspan="3">Roll No</td>
   <?php for($i=0;$i<count($moduleArrayid78);$i++){ ?>
  <td colspan="<?php echo (Yii::$app->session['userRole'] == 3) ? 5 : 4; ?>" align="center"><?php echo $moduleArrayid78[$i]; ?></td>
   <?php } ?>
   <?php if(Yii::$app->session['userRole'] == 3){ ?>
   <td rowspan="3">Edit</td>
   <?php } ?>
  </tr>
  <tr class="mybg">
   <?php for($i=0;$i<count($moduleidArray78);$i++){ ?>
  <td>CW</td>
<td>EW</td>
<td>Total</td>
<td rowspan="2">Grade</td>
<?php if(Yii::$app->session['userRole'] == 3) { ?><td rowspan="2">Remarks</td><?php } ?>
   <?php } ?>
  </tr>


  <?php $arr1 = []; for($k=0;$k<1;$k++){ ?>
  <tr class="mybg">
	<?php $m=0;
		for($i=0;$i<count($moduleArrayid78);$i++){
		for($j=0;$j<count($semisterArray4);$j++){
		//print_r($smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]);exit;
		if(isset($smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]])) { ?>
		<?php if (!in_array($semisterArray4[$j].$moduleidArray78[$i].$studentArray4[$k], $arr1)){ ?>

		<td><?php echo $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['ew_percentage'].'%'; ?></td>
		<td><?php echo $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['cw_percentage'].'%'; ?></td>
		<td><?php echo '100%'; ?></td>
			<?php $m=$m+1; }
		array_push($arr1, $semisterArray4[$j].$moduleidArray78[$i].$studentArray4[$k]);		?>
		<?php } } } ?>
		</tr>
  <?php } ?>


  <?php  $arr1 = []; for($k=0;$k<count($studentArray4);$k++){ ?>
  <tr>
	<?php $m=0;
		for($i=0;$i<count($moduleArrayid78);$i++){
		for($j=0;$j<count($semisterArray4);$j++){
		//print_r($smarks1[$semisterArray1[$j]][$moduleidArray12[$i]][$studentArray1[$k]]);exit;
		if(isset($smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]])) { ?>
		<?php if (!in_array($semisterArray4[$j].$moduleidArray78[$i].$studentArray4[$k], $arr1)){ ?>
		<?php if($m==0) { ?>
		<td><?php echo $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['studentname']; ?></td>
		<td><?php echo $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['ic_no']; ?></td>
		<td><?php echo $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['rollno']; ?></td>
		<?php } ?>
		<td><?php echo $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['ew_total_percentage']; ?></td>
		<td><?php echo $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['cw_total_percentage']; ?></td>
		<td><?php echo $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['total_percentage']; ?></td>
			<td><?php echo $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['grade']; ?></td>
			<?php if(Yii::$app->session['userRole'] == 3) { ?><td><span class="glyphicon glyphicon-edit sremarks" mid = "<?php echo $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['mid']; ?>" title="Remarks"></span></td><?php } ?>
			<?php if($m==(count($moduleidArray7)+count($moduleidArray8))-1  && Yii::$app->session['userRole'] == 3) { ?>
			<td><?php
			$url = Url::toRoute(['../../edit-student-marks', 'year' => 4, 'id' => $smarks4[$semisterArray4[$j]][$moduleidArray78[$i]][$studentArray4[$k]]['student_id']]);
			?>
			<a href = "<?php echo $url; ?>"><span class="glyphicon glyphicon-pencil" title="Edit"></span></a>
			</td>
			<?php } $m=$m+1; }
		array_push($arr1, $semisterArray4[$j].$moduleidArray78[$i].$studentArray4[$k]);		?>
		<?php } } } ?>

		</tr>
  <?php } ?>

</table>
</div>
<?php } ?>
</div>

</div></div>
<?php } else {
	echo '<div class="nodata">No Results</div>';
}?>
<div id="dataConfirmModal" class="confirm-box" style="display:none; width:30%">
    <h3 id="dataConfirmLabel" >Remarks</h3>   
    <div style="text-align:right;margin-top:10px;">
		<div class="form-group field-remarks">
		<textarea id="student-remarks" class="form-control" name="student_remarks" rows="2" autocomplete="off" placeholder="Add Your Remarks Here ..."></textarea>
		<input type="hidden" class="mid" name="remarks_mid" />
		<div class="help-block"></div>
		</div>
        <input class="dataConfirmCancel btn btn-secondary" onclick="$('#dataConfirmModal').css('display','none');" type="button" value="Cancel">
        <input class="dataConfirmOK btn btn-primary" onclick="remarks()" type="button" value="Submit">
    </div>
</div>

<div id="manualfeedback" style="display:none" ><div id="forceflashmodal" class="alert-success front-noti alert fade in" style="z-index: 999999">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text"><?php echo 'Remarks Submitted Successfully'; ?></div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>

</div></div>
<script>
$(document).ready(function(){
	$('.sremarks').click(function(){
		var mid = $(this).attr('mid');
		$('#student-remarks').val('');
		$('#dataConfirmModal .mid').val(mid);
		//alert(studentid);alert(moduleid);alert(semister);
		var pjaxContainer = $(this).attr('pjax-container');
		$('#ajaxContainer').val(pjaxContainer);
		var getremarks = "<?php echo Yii::$app->request->BaseUrl; ?>/student/get-student-remarks";
		$.ajax({
                url: getremarks,
                type: 'get',
                data: {'mid': mid},
                success: function (data) {
					if(data){
						$('#dataConfirmModal #student-remarks').val(data);
					}
                },
                error: function (xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            });
		$('#dataConfirmLabel').text($(this).attr('data-confirm'));
		$('#dataConfirmModal').css('display','block');
	   
		return false;
	});
	
});

	function remarks(){
		var mid = $('#dataConfirmModal .mid').val();
		var remarks = $('#dataConfirmModal #student-remarks').val();
		var submitremarks = "<?php echo Yii::$app->request->BaseUrl; ?>/student/student-remarks";
		if(mid && remarks && remarks!=''){
		$.ajax({
                url: submitremarks,
                type: 'post',
                data: {'mid': mid, 'remarks':remarks},
                success: function (data) {
                    $('#dataConfirmModal').css('display','none');
					$('#dataConfirmModal #student-remarks').val('');
					$('#manualfeedback').show();
                },
                error: function (xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            });
		}
	}
</script>