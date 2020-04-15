
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
    border: 1px solid #8ea3bf;
	font-size: 14px;
}
td, th {
    padding: 12px;
}
</style>
<?php 
$this->title = 'Add / Edit Marks';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'add-marks',
			'id' => 'addmarksform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	<?php echo $form->field($marksformmodel, 'semister')->dropDownList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8'], ['prompt' => 'Select Semister'])->label('Semester');?>
	<div class="semistererr" style="display:none">Please select a Semester</div>
	
	<div id="moduleslist"></div>
	
	<div id="modulemarks"></div>
	
	<div id="studentslist"></div>
		</div>
 
 </div>
  <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Save', ['class' => 'btn btn-primary addfaculty', 'id' => 'addmarks']) ?>
 </div>
        
        </div>
					</div>

		<?php ActiveForm::end(); ?>
		
		
<script>
$(document).ready(function() {
$("#addmarks").click(function(){
	$('.semistererr').hide();
	$('.moduleerr').hide();
	$('.ewpercentageerr').hide();
	$('.ewpercentageerrnum').hide();
	$('.ewpercentageerrmax').hide();
	$('.cwpercentageerr').hide();
	$('.cwpercentageerrnum').hide();
	$('.cwpercentageerrmax').hide();
	
	var semister = $('#addstudentmarksform-semister').val();
	if(!semister || semister == ''){
		$('.semistererr').show();
		return false;
	}else{
		$('.semistererr').hide();
	}
	
	var module = $('#addstudentmarksform-module_id').val();
	if(!module || module == ''){
		$('.moduleerr').show();
		return false;
	}else{
		$('.moduleerr').hide();
	}
	
	var ewpercentage = $('#addstudentmarksform-ew_percentage').val();
	if(ewpercentage == ''){
			$('.ewpercentageerr').show();
			return false;
		}else{
			$('.ewpercentageerr').hide();
			if($.isNumeric(ewpercentage)){
				$('.ewpercentageerrnum').hide();
				if(ewpercentage > 100){
					$('.ewpercentageerrmax').show();
					return false;
				}else{
					$('.ewpercentageerrmax').hide();
				}
			}else{
				$('.ewpercentageerrnum').show();
				return false;
			}
		}
			
	var cwpercentage = $('#addstudentmarksform-cw_percentage').val();
	if(cwpercentage == ''){
			$('.cwpercentageerr').show();
			return false;
		}else{
			$('.cwpercentageerr').hide();
			if($.isNumeric(cwpercentage)){
				$('.cwpercentageerrnum').hide();
				if(cwpercentage > 100){
					$('.cwpercentageerrmax').show();
					return false;
				}else{
					$('.cwpercentageerrmax').hide();
				}
			}else{
				$('.cwpercentageerrnum').show();
				return false;
			}
		}
		
		/*var value = $(this).val();
		var index = $(this).attr("index");
		if($.isNumeric(value)){
			$('.ew_num_error_'+index).hide();
			if(value > 100){
				$('.ew_max_error_'+index).show();
			}else{
				$('.ew_max_error_'+index).hide();
			}
		}else{
			$('.ew_num_error_'+index).show();
		}*/
		
		$("#addmarksform .sewmarks").each(function() {
			var value = $(this).val();
			var index = $(this).attr("index");
			if(value!=''){
			if($.isNumeric(value)){
				$('.ew_num_error_'+index).hide();
				if(value > 100){
					$('.ew_max_error_'+index).show();
					event.preventDefault();
				}else{
					$('.ew_max_error_'+index).hide();
				}
			}else{
				$('.ew_num_error_'+index).show();
					event.preventDefault();
			}
			}
		});
		
		$("#addmarksform .scwmarks").each(function() {
			var value = $(this).val();
			var index = $(this).attr("index");
			if(value!=''){
			if($.isNumeric(value)){
				$('.cw_num_error_'+index).hide();
				if(value > 100){
					$('.cw_max_error_'+index).show();
					event.preventDefault();
				}else{
					$('.cw_max_error_'+index).hide();
				}
			}else{
				$('.cw_num_error_'+index).show();
				event.preventDefault();
			}
			}
		});
})

$('#addstudentmarksform-semister').change(function(){
	var semister = $(this).val();
			$('#moduleslist').empty();
			$('#studentslist').empty();
			$('#modulemarks').empty();
			$('.moduleerr').hide();
			$('.ewpercentageerr').hide();
			$('.ewpercentageerrnum').hide();
			$('.ewpercentageerrmax').hide();
			$('.cwpercentageerr').hide();
			$('.cwpercentageerrnum').hide();
			$('.cwpercentageerrmax').hide();
			$('#addstudentmarksform-module_id').val('');
			$('#addstudentmarksform-student_id').val('');
			$('#addstudentmarksform-ew_percentage').val('');
			$('#addstudentmarksform-cw_percentage').val('');
	if(semister == ''){
			$('.semistererr').show();
		}else{
			$('.semistererr').hide();
	var getmodulesurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/lecturer/get-modules-by-lecturer-semister';
	var userid = '<?php echo Yii::$app->user->id; ?>';
	var uhtml = '';
	$.ajax({
                    url: getmodulesurl,
                    type: "get",
                    data: {semister:semister, userid:userid},
                    success: function (data) {
						var udata = JSON.parse(data);
						var uhtml = '';
								uhtml += '<div class="form-group field-addstudentmarksform-module_id">';
								uhtml += '<label class="control-label" for="addstudentmarksform-module_id">Modules</label>';
								uhtml += '<select id="addstudentmarksform-module_id" class="form-control valid" name="AddStudentMarksForm[module_id]">';
								uhtml += '<option value="">Please select Module</option>';
						for(i=0;i<udata.length;i++){
							
								uhtml += '<option value="'+udata[i]['moduleid']+'">'+udata[i]['modulename']+'</option>';
						console.log(udata[i])
						}
						
								uhtml += '</select>';
								uhtml += '<div class="moduleerr" style="display:none">Please select a module</div>';
								uhtml += '</div>';
								
								$('#moduleslist').append(uhtml);
                        
                    }
                });
		}
});
			
$('#addmarksform').on('change','#addstudentmarksform-module_id', function(){
	var moduleid = $(this).val();
			$('#studentslist').empty();
			$('#modulemarks').empty();
			$('.ewpercentageerr').hide();
			$('.ewpercentageerrnum').hide();
			$('.ewpercentageerrmax').hide();
			$('.cwpercentageerr').hide();
			$('.cwpercentageerrnum').hide();
			$('.cwpercentageerrmax').hide();
			$('#addstudentmarksform-student_id').val('');
			$('#addstudentmarksform-ew_percentage').val('');
			$('#addstudentmarksform-cw_percentage').val('');
	if(moduleid == ''){
			$('.moduleerr').show();
		}else{
			$('.moduleerr').hide();
	var getstuddentsurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/lecturer/get-students-by-lecturer';
	var getpercentageurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/lecturer/get-marks-percentage';
	var getstudentmarksurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/lecturer/get-student-marks';
	var userid = '<?php echo Yii::$app->user->id; ?>';
	var semister = $('#addstudentmarksform-semister').val();
	var uhtml = '';
	$.ajax({
                    url: getstuddentsurl,
                    type: "get",
                    data: {semister:semister, moduleid:moduleid, userid:userid},
                    success: function (studentsdata) {
			    var studentsdata = JSON.parse(studentsdata);
			    console.log(studentsdata);
			    $.ajax({
			    url: getpercentageurl,
			    type: "get",
			    data: {semister:semister, moduleid:moduleid, userid:userid},
			    success: function (percentagedata) {
				    var percentagedata = JSON.parse(percentagedata);
				    var percentagecount = percentagedata.length;
				    if(percentagecount == 0){
					    ew_percentage = '';
					    cw_percentage = '';
				    }else{
					    ew_percentage = percentagedata[0]['ew_percentage'];
					    cw_percentage = percentagedata[0]['cw_percentage'];
				    }
				     $.ajax({
				    url: getstudentmarksurl,
				    type: "get",
				    data: {semister:semister, moduleid:moduleid, userid:userid},
				    success: function (marksdata) {
						var marksdata = JSON.parse(marksdata);
						var marksdatacount = marksdata.length;
						console.log(marksdata);
						var mhtml = '';
						 mhtml += '<div class="form-group field-addstudentmarksform-marks">';
						 mhtml += '<label class="control-label" for="addstudentmarksform-marks">Exam Weight Percentage</label>';
						 mhtml += '<input type="text" id="addstudentmarksform-ew_percentage" class="form-control" name="AddStudentMarksForm[ew_percentage]" value="'+ ew_percentage +'" autocomplete="off">';
						 mhtml += '<div class="ewpercentageerr" style="display:none">Please enter the marks</div>';
						 mhtml += '<div class="ewpercentageerrnum" style="display:none">Please enter only digits</div>';
						 mhtml += '<div class="ewpercentageerrmax" style="display:none">Marks should not exceed 100</div>';
						 mhtml += '</div>';
						 
						 mhtml += '<div class="form-group field-addstudentmarksform-marks">';
						 mhtml += '<label class="control-label" for="addstudentmarksform-marks">Course Work Weight Percentage</label>';
						 mhtml += '<input type="text" id="addstudentmarksform-cw_percentage" class="form-control" name="AddStudentMarksForm[cw_percentage]" value="'+cw_percentage +'" autocomplete="off">';
						 mhtml += '<div class="cwpercentageerr" style="display:none">Please enter the marks</div>';
						 mhtml += '<div class="cwpercentageerrnum" style="display:none">Please enter only digits</div>';
						 mhtml += '<div class="cwpercentageerrmax" style="display:none">Marks should not exceed 100</div>';
						 mhtml += '</div>';
						$('#modulemarks').append(mhtml);
						
						var uhtml = '';
						uhtml += '<div class="students-list">';
						uhtml += '<table>';
						uhtml += '<tr><td>S.No</td><td>Name</td><td>Roll No</td><td>IC No</td><td>EW Marks</td><td>CW Marks</td></tr>';
						for(i=0;i<studentsdata.length;i++){
							if(marksdatacount == 0){
								uhtml += '<tr>';
								uhtml += '<td>'+(i+1)+'</td>';
								uhtml += '<td>'+studentsdata[i]['studentname']+'</td>';
								uhtml += '<td>'+studentsdata[i]['rollno']+'</td>';
								uhtml += '<td>'+studentsdata[i]['ic_no']+'</td>';
								uhtml += '<td><input type="text" name="AddStudentMarksForm[ew_marks][]" autocomplete="off"  index='+i+' value="" class="sewmarks ewmrks_'+i+'"/>';
								uhtml += '<div style="display:none;" class="ew_error ew_num_error_'+i+'">Please enter only digits</div>';
								uhtml += '<div style="display:none;" class="ew_error ew_max_error_'+i+'">Marks should not exceed 100</div>';
								uhtml += '<input type="hidden" name="AddStudentMarksForm[studentid][]" value="'+studentsdata[i]['studentid']+'"/></td>';
								uhtml += '<td><input type="text" name="AddStudentMarksForm[cw_marks][]" autocomplete="off"  index='+i+' value=""  class="scwmarks cwmrks_'+i+'"/>';
								uhtml += '<input type="hidden" id="addstudentmarksform-previd" class="form-control" name="AddStudentMarksForm[previd][]" value="" autocomplete="off">';
								uhtml += '<div style="display:none;" class="cw_error cw_num_error_'+i+'">Please enter only digits</div>';
								uhtml += '<div style="display:none;" class="cw_error cw_max_error_'+i+'">Marks should not exceed 100</div></td>';
								uhtml += '</tr>';
								
							}else{
								for(j=0;j<marksdata.length;j++){
								if(marksdata[j]['student_id'] == studentsdata[i]['studentid']){
								uhtml += '<tr>';
								uhtml += '<td>'+(i+1)+'</td>';
								uhtml += '<td>'+studentsdata[i]['studentname']+'</td>';
								uhtml += '<td>'+studentsdata[i]['rollno']+'</td>';
								uhtml += '<td>'+studentsdata[i]['ic_no']+'</td>';
								uhtml += '<td><input type="text" name="AddStudentMarksForm[ew_marks][]" index='+i+' autocomplete="off" value="'+marksdata[j]['ew_marks']+'" class="sewmarks ewmrks_'+i+'"/>';
								uhtml += '<div style="display:none;" class="ew_error ew_num_error_'+i+'">Please enter only digits</div>';
								uhtml += '<div style="display:none;" class="ew_error ew_max_error_'+i+'">Marks should not exceed 100</div>';
								uhtml += '<input type="hidden" name="AddStudentMarksForm[studentid][]" value="'+studentsdata[i]['studentid']+'"/></td>';
								uhtml += '<td><input type="text" name="AddStudentMarksForm[cw_marks][]" index='+i+' autocomplete="off" value="'+marksdata[j]['cw_marks']+'"  class="scwmarks cwmrks_'+i+'"/>';
								uhtml += '<input type="hidden" id="addstudentmarksform-previd" class="form-control" name="AddStudentMarksForm[previd][]" value="'+marksdata[j]['id']+'" autocomplete="off">';
								uhtml += '<div style="display:none;" class="cw_error cw_num_error_'+i+'">Please enter only digits</div>';
								uhtml += '<div style="display:none;" class="cw_error cw_max_error_'+i+'">Marks should not exceed 100</div></td>';
								uhtml += '</tr>';
								}
								}
							}
						
						}
						uhtml += '</table>';
						uhtml += '</div>';
						
								$('#studentslist').append(uhtml);
                        
                    }
                });
		}
                });
		}
                });
		}
});

$('#addmarksform').on('keyup','.sewmarks', function(){
	var value = $(this).val();
	var index = $(this).attr("index");
	if(value!=''){
	if($.isNumeric(value)){
		$('.ew_num_error_'+index).hide();
		if(value > 100){
			$('.ew_max_error_'+index).show();
		}else{
			$('.ew_max_error_'+index).hide();
		}
	}else{
		$('.ew_num_error_'+index).show();
	}
	}
});

$('#addmarksform').on('keyup','.scwmarks', function(){
	var value = $(this).val();
	var index = $(this).attr("index");
	if(value!=''){
	if($.isNumeric(value)){
		$('.cw_num_error_'+index).hide();
		if(value > 100){
			$('.cw_max_error_'+index).show();
		}else{
			$('.cw_max_error_'+index).hide();
		}
	}else{
		$('.cw_num_error_'+index).show();
	}
	}
});

$('#addmarksform').on('change','#addstudentmarksform-ew_percentage', function(){
	var marks = $('#addstudentmarksform-ew_percentage').val();
	$('.ewpercentageerr').hide();
	$('.ewpercentageerrnum').hide();
	$('.ewpercentageerrmax').hide();
	if(marks == ''){
			$('.ewpercentageerr').show();
		}else{
			$('.ewpercentageerr').hide();
			if($.isNumeric(marks)){
				$('.ewpercentageerrnum').hide();
				if(marks > 100){
					$('.ewpercentageerrmax').show();
				}else{
					$('.ewpercentageerrmax').hide();
				}
			}else{
				$('.ewpercentageerrnum').show();
			}
		}
			});
			
$('#addmarksform').on('change','#addstudentmarksform-cw_percentage', function(){
	var marks = $('#addstudentmarksform-cw_percentage').val();
	$('.cwpercentageerr').hide();
	$('.cwpercentageerrnum').hide();
	$('.cwpercentageerrmax').hide();
	if(marks == ''){
			$('.cwpercentageerr').show();
		}else{
			$('.cwpercentageerr').hide();
			if($.isNumeric(marks)){
				$('.cwpercentageerrnum').hide();
				if(marks > 100){
					$('.cwpercentageerrmax').show();
				}else{
					$('.cwpercentageerrmax').hide();
				}
			}else{
				$('.cwpercentageerrnum').show();
			}
		}
			});

			});
			
</script>
