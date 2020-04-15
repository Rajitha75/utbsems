
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
   table, td, th {
    border: 1px solid #756c6c;
	font-size: 14px;
	padding:4px;
	/*background:#f1ecec*/
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
	/*background:#e33066 ;*/
}

.sinfotd{
	width:10%;
	font-weight:bold;
}

table.studentinfo{
	border:0;
}

.year_1 table,.year_2 table,.year_3 table,.year_4 table{
	margin-bottom:30px;
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
.studentinfo td {
  border: none;
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
<?php 
$this->title = 'Student Marks';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<?php if(count($studentmarks1)>0 || count($studentmarks2)>0 || count($studentmarks3)>0 || count($studentmarks4)>0) { ?>
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

<?php if(isset($studentname) && $studentname!=''){?>
 <div class='yr' style="padding:6px; font-size:18px"><?php echo $studentname; ?></div></br>
 <?php } ?>
 <?php if(isset($ic_no) && $ic_no != '') { ?>
 <div class="programme-title">IC No. : <?php echo $ic_no;  ?></div>
 <?php } ?>
 <?php if(isset($rollno) && $rollno != '') { ?>
 <div class="faculty-title">Roll No :  <?php echo $rollno; ?></div>
 <?php } ?>
 
 <?php if(isset($programmename) && $programmename != '') { ?>
 <div class="programme-title">Programme Name : <?php echo $programmename;  ?></div>
 <?php } ?>
 <?php if(isset($facultyname) && $facultyname != '') { ?>
 <div class="faculty-title">Faculty Name :  <?php echo $facultyname; ?></div>
 <?php } ?>
 </br>
<div id="pjax-list" data-pjax-container=""><div id="w0" class="grid-view">

<div class="year_1_2">
<?php if(count($studentmarks1)>0) { ?>
<div class="year_1">
<table><thead>
</thead>
<tbody>
<tr><td class="yr" colspan="<?php echo count($studentmarks1)*4 ?>">Year 1</td></tr>
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
<td class="sem" colspan="<?php echo $sem1 ?>">Semester 1</td>
<?php } ?>
<?php if($sem2 > 0) { ?>
<td class="sem" colspan="<?php echo $sem2 ?>">Semester 2</td>
<?php } ?>
</tr>
<tr data-key="0" class="mybg">
<?php for($i=0; $i<count($studentmarks1); $i++) { ?>
<td ><?php echo $studentmarks1[$i]['moduleid'] ?></td>
<?php } ?>
</tr>
<tr class="mybg">
<?php for($i=0; $i<count($studentmarks1); $i++) { ?>
<td>Grade</td>
<?php } ?>
</tr>


<tr class="mybg">
<?php for($i=0; $i<count($studentmarks1); $i++) { ?>
<?php } ?>
</tr>

<tr>
<?php for($i=0; $i<count($studentmarks1); $i++) { ?>
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
<tr><td class="yr" colspan="<?php echo count($studentmarks2)*4 ?>">Year 2</td></tr>
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
<td class="sem" colspan="<?php echo $sem3 ?>">Semester 3</td>
<?php } ?>
<?php if($sem4 > 0) { ?>
<td class="sem" colspan="<?php echo $sem4 ?>">Semester 4</td>
<?php } ?>
</tr>
<tr data-key="0" class="mybg">
<?php for($i=0; $i<count($studentmarks2); $i++) { ?>
<td ><?php echo $studentmarks2[$i]['moduleid'] ?></td>
<?php } ?>
</tr>
<tr class="mybg">
<?php for($i=0; $i<count($studentmarks2); $i++) { ?>
<td>Grade</td>
<?php } ?>
</tr>


<tr>
<?php for($i=0; $i<count($studentmarks2); $i++) { ?>
<?php } ?>
</tr>

<tr>
<?php for($i=0; $i<count($studentmarks2); $i++) { ?>
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
<tr><td class="yr" colspan="<?php echo count($studentmarks3)*4 ?>">Year 3</td></tr>
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
<td class="sem" colspan="<?php echo $sem5 ?>">Semester 5</td>
<?php } ?>
<?php if($sem6 > 0) { ?>
<td class="sem" colspan="<?php echo $sem6 ?>">Semester 6</td>
<?php } ?>
</tr>
<tr data-key="0" class="mybg">
<?php for($i=0; $i<count($studentmarks3); $i++) { ?>
<td><?php echo $studentmarks3[$i]['moduleid'] ?></td>
<?php } ?>
</tr>
<tr class="mybg">
<?php for($i=0; $i<count($studentmarks3); $i++) { ?>
<td>Grade</td>
<?php } ?>
</tr>



<tr>
<?php for($i=0; $i<count($studentmarks3); $i++) { ?>
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
<tr><td class="yr" colspan="<?php echo count($studentmarks4)*4 ?>">Year 4</td></tr>
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
<td class="sem" colspan="<?php echo $sem7 ?>">Semester 7</td>
<?php } ?>
<?php if($sem8 > 0) { ?>
<td class="sem" colspan="<?php echo $sem8 ?>">Semester 8</td>
<?php } ?>
</tr>
<tr data-key="0" class="mybg">
<?php for($i=0; $i<count($studentmarks4); $i++) { ?>
<td><?php echo $studentmarks4[$i]['moduleid'] ?></td>
<?php } ?>
</tr>
<tr class="mybg">
<?php for($i=0; $i<count($studentmarks4); $i++) { ?>
<td>Grade</td>
<?php } ?>
</tr>



<tr>
<?php for($i=0; $i<count($studentmarks4); $i++) { ?>
<td><?php echo $studentmarks4[$i]['grade'] ?></td>
<?php } ?>
</tr>
</tbody></table>
</div>
</div>
<?php } ?>
</div></div>
<?php } else {
	echo '<div class="nodata">No Results</div>';
}?>