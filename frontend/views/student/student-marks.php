
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
}
.year_1 { 
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
} 

.year_1 table,.year_2 table,.year_3 table,.year_4 table{ 
	margin-bottom:30px;
}
</style>
<?php 
$this->title = 'Student Marks';
echo "<h1 class='box-title'>$this->title </h1>"; ?>

<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">
<?php if(count($studentmarks1)>0){
	$studentname = $studentmarks1[0]['studentname'];
	$ic_no = $studentmarks1[0]['ic_no'];
	$rollno = $studentmarks1[0]['rollno'];
	$programmename = $studentmarks1[0]['programme_name'];
	$facultyname = $studentmarks1[0]['faculty_name'];
}else if(count($studentmarks2)>0){
	$studentname = $studentmarks2[0]['studentname'];
	$ic_no = $studentmarks2[0]['ic_no'];
	$rollno = $studentmarks2[0]['rollno'];
	$programmename = $studentmarks2[0]['programme_name'];
	$facultyname = $studentmarks2[0]['faculty_name'];
}else if(count($studentmarks3)>0){
	$studentname = $studentmarks3[0]['studentname'];
	$ic_no = $studentmarks3[0]['ic_no'];
	$rollno = $studentmarks3[0]['rollno'];
	$programmename = $studentmarks3[0]['programme_name'];
	$facultyname = $studentmarks3[0]['faculty_name'];
}else if(count($studentmarks4)>0){
	$studentname = $studentmarks4[0]['studentname'];
	$ic_no = $studentmarks4[0]['ic_no'];
	$rollno = $studentmarks4[0]['rollno'];
	$programmename = $studentmarks4[0]['programme_name'];
	$facultyname = $studentmarks4[0]['faculty_name'];
} ?>


 <h1 class='box-title'><?php echo 'Student Name: '.$studentname; ?></h1></br>
 <?php if(isset($ic_no) && $ic_no != '') { ?>
 <div class="">IC No. : <?php echo $ic_no;  ?></div>
 <?php } ?>
 <?php if(isset($rollno) && $rollno != '') { ?>
 <div class="">Roll No :  <?php echo $rollno; ?></div>
 <?php } ?>
 
 <?php if(isset($programmename) && $programmename != '') { ?>
 <div class="">Programme Name : <?php echo $programmename;  ?></div>
 <?php } ?>
 <?php if(isset($facultyname) && $facultyname != '') { ?>
 <div class="">Faculty Name :  <?php echo $facultyname; ?></div>
 <?php } ?>
<div id="pjax-list" data-pjax-container=""><div id="w0" class="grid-view">

<div class="year_1_2">
<?php if(count($studentmarks1)>0) { ?>
<div class="year_1">
<table><thead>
</thead>
<tbody>
<tr><td colspan="<?php echo count($studentmarks1)*4 ?>">Year 1</td></tr>
<?php $sem1 = 0; $sem2 = 0; for($i=0; $i<count($studentmarks1); $i++) { 
if($studentmarks1[$i]['semister'] == 1){
	$sem1 = $sem1+1;
}
if($studentmarks1[$i]['semister'] == 2){
	$sem2 = $sem2+1;
}
?>
<?php } ?>
<tr>
<?php if($sem1 > 0) { ?>
<td colspan="<?php echo $sem1*4 ?>">Semester 1</td>
<?php } ?>
<?php if($sem2 > 0) { ?>
<td colspan="<?php echo $sem2*4 ?>">Semester 2</td>
<?php } ?>
</tr>
<tr data-key="0">
<?php for($i=0; $i<count($studentmarks1); $i++) { ?>
<td colspan="4"><?php echo $studentmarks1[$i]['moduleid'] ?></td>
<?php } ?>
</tr>
<tr>
<?php for($i=0; $i<count($studentmarks1); $i++) { ?>
<td>CW</td>
<td>EW</td>
<td>Total</td>
<td>Grade</td>
<?php } ?>
</tr>


<tr>
<?php for($i=0; $i<count($studentmarks1); $i++) { ?>
<td><?php echo $studentmarks1[$i]['ew_percentage'].'%'; ?></td>
<td><?php echo $studentmarks1[$i]['cw_percentage'].'%'; ?></td>
<td><?php echo '100%'; ?></td>
<td><?php echo '' ?></td>
<?php } ?>
</tr>

<tr>
<?php for($i=0; $i<count($studentmarks1); $i++) { ?>
<td><?php echo $studentmarks1[$i]['ew_total_percentage']; ?></td>
<td><?php echo $studentmarks1[$i]['cw_total_percentage']; ?></td>
<td><?php echo $studentmarks1[$i]['total_percentage']; ?></td>
<td><?php echo $studentmarks1[$i]['grade'] ?></td>
<?php } ?>
</tr>
</tbody></table>
</div>
<?php } if(count($studentmarks2)>0) { ?>

<div class="year_2">
<table><thead>
</thead>
<tbody>
<tr><td colspan="<?php echo count($studentmarks2)*4 ?>">Year 2</td></tr>
<?php $sem3 = 0; $sem4 = 0; for($i=0; $i<count($studentmarks2); $i++) { 
if($studentmarks2[$i]['semister'] == 3){
	$sem3 = $sem3+1;
}
if($studentmarks2[$i]['semister'] == 4){
	$sem4 = $sem4+1;
}
?>
<?php } ?>
<tr>
<?php if($sem3 > 0) { ?>
<td colspan="<?php echo $sem3*4 ?>">Semester 3</td>
<?php } ?>
<?php if($sem4 > 0) { ?>
<td colspan="<?php echo $sem4*4 ?>">Semester 4</td>
<?php } ?>
</tr>
<tr data-key="0">
<?php for($i=0; $i<count($studentmarks2); $i++) { ?>
<td colspan="4"><?php echo $studentmarks2[$i]['moduleid'] ?></td>
<?php } ?>
</tr>
<tr>
<?php for($i=0; $i<count($studentmarks2); $i++) { ?>
<td>CW</td>
<td>EW</td>
<td>Total</td>
<td>Grade</td>
<?php } ?>
</tr>


<tr>
<?php for($i=0; $i<count($studentmarks2); $i++) { ?>
<td><?php echo $studentmarks2[$i]['ew_percentage'].'%'; ?></td>
<td><?php echo $studentmarks2[$i]['cw_percentage'].'%'; ?></td>
<td><?php echo '100%'; ?></td>
<td><?php echo '' ?></td>
<?php } ?>
</tr>

<tr>
<?php for($i=0; $i<count($studentmarks2); $i++) { ?>
<td><?php echo $studentmarks2[$i]['ew_total_percentage']; ?></td>
<td><?php echo $studentmarks2[$i]['cw_total_percentage']; ?></td>
<td><?php echo $studentmarks2[$i]['total_percentage']; ?></td>
<td><?php echo $studentmarks2[$i]['grade'] ?></td>
<?php } ?>
</tr>
</tbody></table>
</div>
</div>
<div class="year_3_4">
<?php } if(count($studentmarks3)>0) { ?>

<div class="year_3">
<table><thead>
</thead>
<tbody>
<tr><td colspan="<?php echo count($studentmarks3)*4 ?>">Year 3</td></tr>
<?php $sem5 = 0; $sem6 = 0; for($i=0; $i<count($studentmarks3); $i++) { 
if($studentmarks3[$i]['semister'] == 5){
	$sem5 = $sem5+1;
}
if($studentmarks3[$i]['semister'] == 6){
	$sem6 = $sem6+1;
}
?>
<?php } ?>
<tr>
<?php if($sem5 > 0) { ?>
<td colspan="<?php echo $sem5*4 ?>">Semester 5</td>
<?php } ?>
<?php if($sem6 > 0) { ?>
<td colspan="<?php echo $sem6*4 ?>">Semester 6</td>
<?php } ?>
</tr>
<tr data-key="0">
<?php for($i=0; $i<count($studentmarks3); $i++) { ?>
<td colspan="4"><?php echo $studentmarks3[$i]['moduleid'] ?></td>
<?php } ?>
</tr>
<tr>
<?php for($i=0; $i<count($studentmarks3); $i++) { ?>
<td>CW</td>
<td>EW</td>
<td>Total</td>
<td>Grade</td>
<?php } ?>
</tr>


<tr>
<?php for($i=0; $i<count($studentmarks3); $i++) { ?>
<td><?php echo $studentmarks3[$i]['ew_percentage'].'%'; ?></td>
<td><?php echo $studentmarks3[$i]['cw_percentage'].'%'; ?></td>
<td><?php echo '100%'; ?></td>
<td><?php echo '' ?></td>
<?php } ?>
</tr>

<tr>
<?php for($i=0; $i<count($studentmarks3); $i++) { ?>
<td><?php echo $studentmarks3[$i]['ew_total_percentage']; ?></td>
<td><?php echo $studentmarks3[$i]['cw_total_percentage']; ?></td>
<td><?php echo $studentmarks3[$i]['total_percentage']; ?></td>
<td><?php echo $studentmarks3[$i]['grade'] ?></td>
<?php } ?>
</tr>
</tbody></table>
</div>
<?php } if(count($studentmarks4)>0) { ?>

<div class="year_4">
<table><thead>
</thead>
<tbody>
<tr><td colspan="<?php echo count($studentmarks4)*4 ?>">Year 4</td></tr>
<?php $sem7 = 0; $sem8 = 0; for($i=0; $i<count($studentmarks4); $i++) { 
if($studentmarks4[$i]['semister'] == 7){
	$sem7 = $sem7+1;
}
if($studentmarks4[$i]['semister'] == 8){
	$sem8 = $sem8+1;
}
?>
<?php } ?>
<tr>
<?php if($sem7 > 0) { ?>
<td colspan="<?php echo $sem7*4 ?>">Semester 7</td>
<?php } ?>
<?php if($sem8 > 0) { ?>
<td colspan="<?php echo $sem8*4 ?>">Semester 8</td>
<?php } ?>
</tr>
<tr data-key="0">
<?php for($i=0; $i<count($studentmarks4); $i++) { ?>
<td colspan="4"><?php echo $studentmarks4[$i]['moduleid'] ?></td>
<?php } ?>
</tr>
<tr>
<?php for($i=0; $i<count($studentmarks4); $i++) { ?>
<td>CW</td>
<td>EW</td>
<td>Total</td>
<td>Grade</td>
<?php } ?>
</tr>


<tr>
<?php for($i=0; $i<count($studentmarks4); $i++) { ?>
<td><?php echo $studentmarks4[$i]['ew_percentage'].'%'; ?></td>
<td><?php echo $studentmarks4[$i]['cw_percentage'].'%'; ?></td>
<td><?php echo '100%'; ?></td>
<td><?php echo '' ?></td>
<?php } ?>
</tr>

<tr>
<?php for($i=0; $i<count($studentmarks4); $i++) { ?>
<td><?php echo $studentmarks4[$i]['ew_total_percentage']; ?></td>
<td><?php echo $studentmarks4[$i]['cw_total_percentage']; ?></td>
<td><?php echo $studentmarks4[$i]['total_percentage']; ?></td>
<td><?php echo $studentmarks4[$i]['grade'] ?></td>
<?php } ?>
</tr>
</tbody></table>
</div>
</div>
<?php } ?>
</div></div>