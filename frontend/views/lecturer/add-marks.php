
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
	<?php echo $form->field($marksformmodel, 'semister')->dropDownList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8'], ['prompt' => 'Select Semister'])->label('Semister');?>
	<div class="semistererr" style="display:none">Please select a Semester</div>
	
	<div id="moduleslist"></div>
	
	<div id="studentslist"></div>
	
	<div id="modulemarks"></div>
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
	$('.studenterr').hide();
	$('.ewpercentageerr').hide();
	$('.ewpercentageerrnum').hide();
	$('.ewpercentageerrmax').hide();
	$('.ewmarkserr').hide();
	$('.ewmarkserrnum').hide();
	$('.ewmarkserrmax').hide();
	$('.cwpercentageerr').hide();
	$('.cwpercentageerrnum').hide();
	$('.cwpercentageerrmax').hide();
	$('.cwmarkserr').hide();
	$('.cwmarkserrnum').hide();
	$('.cwmarkserrmax').hide();
	
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
	
	var student = $('#addstudentmarksform-student_id').val();
	if(!student || student == ''){
		$('.studenterr').show();
		return false;
	}else{
		$('.studenterr').hide();
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
			
	var ewmarks = $('#addstudentmarksform-ew_marks').val();
	if(ewmarks == ''){
			$('.ewmarkserr').show();
			return false;
		}else{
			$('.ewmarkserr').hide();
			if($.isNumeric(ewmarks)){
				$('.ewmarkserrnum').hide();
				if(ewmarks > 100){
					$('.ewmarkserrmax').show();
					return false;
				}else{
					$('.ewmarkserrmax').hide();
				}
			}else{
				$('.ewmarkserrnum').show();
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
			
	var cwmarks = $('#addstudentmarksform-cw_marks').val();
	if(cwmarks == ''){
			$('.cwmarkserr').show();
			return false;
		}else{
			$('.cwmarkserr').hide();
			if($.isNumeric(cwmarks)){
				$('.cwmarkserrnum').hide();
				if(cwmarks > 100){
					$('.cwmarkserrmax').show();
					return false;
				}else{
					$('.cwmarkserrmax').hide();
				}
			}else{
				$('.cwmarkserrnum').show();
				return false;
			}
		}
})

$('#addstudentmarksform-semister').change(function(){
	var semister = $(this).val();
			$('#moduleslist').empty();
			$('#studentslist').empty();
			$('#modulemarks').empty();
			$('.moduleerr').hide();
			$('.studenterr').hide();
			$('.ewpercentageerr').hide();
			$('.ewpercentageerrnum').hide();
			$('.ewpercentageerrmax').hide();
			$('.ewmarkserr').hide();
			$('.ewmarkserrnum').hide();
			$('.ewmarkserrmax').hide();
			$('.cwpercentageerr').hide();
			$('.cwpercentageerrnum').hide();
			$('.cwpercentageerrmax').hide();
			$('.cwmarkserr').hide();
			$('.cwmarkserrnum').hide();
			$('.cwmarkserrmax').hide();
			$('#addstudentmarksform-module_id').val('');
			$('#addstudentmarksform-student_id').val('');
			$('#addstudentmarksform-ew_percentage').val('');
			$('#addstudentmarksform-ew_marks').val('');
			$('#addstudentmarksform-cw_percentage').val('');
			$('#addstudentmarksform-cw_marks').val('');
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
			$('.studenterr').hide();
			$('.ewpercentageerr').hide();
			$('.ewpercentageerrnum').hide();
			$('.ewpercentageerrmax').hide();
			$('.ewmarkserr').hide();
			$('.ewmarkserrnum').hide();
			$('.ewmarkserrmax').hide();
			$('.cwpercentageerr').hide();
			$('.cwpercentageerrnum').hide();
			$('.cwpercentageerrmax').hide();
			$('.cwmarkserr').hide();
			$('.cwmarkserrnum').hide();
			$('.cwmarkserrmax').hide();
			$('#addstudentmarksform-student_id').val('');
			$('#addstudentmarksform-ew_percentage').val('');
			$('#addstudentmarksform-ew_marks').val('');
			$('#addstudentmarksform-cw_percentage').val('');
			$('#addstudentmarksform-cw_marks').val('');
	if(moduleid == ''){
			$('.moduleerr').show();
		}else{
			$('.moduleerr').hide();
	var getstuddentsurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/lecturer/get-students-by-lecturer';
	var userid = '<?php echo Yii::$app->user->id; ?>';
	console.log(moduleid);
	console.log(userid);
	console.log(getstuddentsurl);
	var uhtml = '';
	$.ajax({
                    url: getstuddentsurl,
                    type: "get",
                    data: {moduleid:moduleid, userid:userid},
                    success: function (data) {
						var udata = JSON.parse(data);
						var uhtml = '';
								uhtml += '<div class="form-group field-addstudentmarksform-student_id">';
								uhtml += '<label class="control-label" for="addstudentmarksform-student_id">Students</label>';
								uhtml += '<select id="addstudentmarksform-student_id" class="form-control valid" name="AddStudentMarksForm[student_id]">';
								uhtml += '<option value="">Please select Student</option>';
						for(i=0;i<udata.length;i++){
							
								uhtml += '<option value="'+udata[i]['studentid']+'">'+udata[i]['studentname']+'</option>';
						console.log(udata[i])
						}
						
								uhtml += '</select>';
								uhtml += '<div class="studenterr" style="display:none">Please select a student</div>';
								uhtml += '</div>';
								
								$('#studentslist').append(uhtml);
                        
                    }
                });
		}
});

$('#addmarksform').on('change','#addstudentmarksform-student_id', function(){
			$('#modulemarks').empty();
			$('.ewpercentageerr').hide();
			$('.ewpercentageerrnum').hide();
			$('.ewpercentageerrmax').hide();
			$('.ewmarkserr').hide();
			$('.ewmarkserrnum').hide();
			$('.ewmarkserrmax').hide();
			$('.cwpercentageerr').hide();
			$('.cwpercentageerrnum').hide();
			$('.cwpercentageerrmax').hide();
			$('.cwmarkserr').hide();
			$('.cwmarkserrnum').hide();
			$('.cwmarkserrmax').hide();
			$('#addstudentmarksform-ew_percentage').val('');
			$('#addstudentmarksform-ew_marks').val('');
			$('#addstudentmarksform-cw_percentage').val('');
			$('#addstudentmarksform-cw_marks').val('');
	if($('#addstudentmarksform-student_id').val() == ''){
			$('.studenterr').show();
		}else{
			$('.studenterr').hide();
			var getstuddentmarksurl = '<?php echo SITE_URL.yii::getAlias("@web"); ?>/lecturer/get-students-marks';
			var userid = '<?php echo Yii::$app->user->id; ?>';
			var semister = $('#addstudentmarksform-semister').val();
			var moduleid = $('#addstudentmarksform-module_id').val();
			var studentid = $('#addstudentmarksform-student_id').val();
			var uhtml = '';
			$.ajax({
                    url: getstuddentmarksurl,
                    type: "get",
                    data: {semister:semister, moduleid:moduleid, studentid:studentid, userid:userid},
                    success: function (data) {
						var sdata = JSON.parse(data);
						var nstudents = sdata.length;
						if(nstudents > 0){
							var ew_percentage = sdata[0]['ew_percentage'];
							var ew_marks = sdata[0]['ew_marks'];
							var cw_percentage = sdata[0]['cw_percentage'];
							var cw_marks = sdata[0]['cw_marks'];
							var previd = sdata[0]['id'];
						}else{
							var ew_percentage = '';
							var ew_marks = '';
							var cw_percentage = '';
							var cw_marks = '';
							var previd = '';
						}
						
						
						var mhtml = '';
						 mhtml += '<div class="form-group field-addstudentmarksform-marks">';
						 mhtml += '<label class="control-label" for="addstudentmarksform-marks">Exam Weight</label>';
						 mhtml += '<div class="ewmarks">';
						 mhtml += '<div class="form-group field-addstudentmarksform-ew_percentage">';
						 mhtml += '<label class="control-label" for="addstudentmarksform-ew_percentage">Percentage</label>';
						 mhtml += '<input type="text" id="addstudentmarksform-ew_percentage" class="form-control" name="AddStudentMarksForm[ew_percentage]" value="'+ew_percentage+'" autocomplete="off">';
						 mhtml += '</div>';
						 mhtml += '<div class="ewpercentageerr" style="display:none">Please enter the marks</div>';
						 mhtml += '<div class="ewpercentageerrnum" style="display:none">Please enter only digits</div>';
						 mhtml += '<div class="ewpercentageerrmax" style="display:none">Marks should not exceed 100</div>';
						 mhtml += '<div class="form-group field-addstudentmarksform-ew_marks">';
						 mhtml += '<label class="control-label" for="addstudentmarksform-ew_marks">Marks</label>';
						 mhtml += '<input type="text" id="addstudentmarksform-ew_marks" class="form-control" name="AddStudentMarksForm[ew_marks]" value="'+ew_marks+'" autocomplete="off">';
						 mhtml += '</div>';
						 mhtml += '<div class="ewmarkserr" style="display:none">Please enter the marks</div>';
						 mhtml += '<div class="ewmarkserrnum" style="display:none">Please enter only digits</div>';
						 mhtml += '<div class="ewmarkserrmax" style="display:none">Marks should not exceed 100</div>';
						 mhtml += '</div>';
						 mhtml += '<input type="hidden" id="addstudentmarksform-previd" class="form-control" name="AddStudentMarksForm[previd]" value="'+previd+'" autocomplete="off">';
						 mhtml += '</div>';
						 
						 mhtml += '<div class="form-group field-addstudentmarksform-marks">';
						 mhtml += '<label class="control-label" for="addstudentmarksform-marks">Course Work Weight</label>';
						 mhtml += '<div class="cwmarks">';
						 mhtml += '<div class="form-group field-addstudentmarksform-cw_percentage">';
						 mhtml += '<label class="control-label" for="addstudentmarksform-cw_percentage">Percentage</label>';
						 mhtml += '<input type="text" id="addstudentmarksform-cw_percentage" class="form-control" name="AddStudentMarksForm[cw_percentage]" value="'+cw_percentage+'" autocomplete="off">';
						 mhtml += '</div>';
						 mhtml += '<div class="cwpercentageerr" style="display:none">Please enter the marks</div>';
						 mhtml += '<div class="cwpercentageerrnum" style="display:none">Please enter only digits</div>';
						 mhtml += '<div class="cwpercentageerrmax" style="display:none">Marks should not exceed 100</div>';
						 mhtml += '<div class="form-group field-addstudentmarksform-cw_marks">';
						 mhtml += '<label class="control-label" for="addstudentmarksform-cw_marks">Marks</label>';
						 mhtml += '<input type="text" id="addstudentmarksform-cw_marks" class="form-control" name="AddStudentMarksForm[cw_marks]" value="'+cw_marks+'" autocomplete="off">';
						 mhtml += '</div>';
						 mhtml += '<div class="cwmarkserr" style="display:none">Please enter the marks</div>';
						 mhtml += '<div class="cwmarkserrnum" style="display:none">Please enter only digits</div>';
						 mhtml += '<div class="cwmarkserrmax" style="display:none">Marks should not exceed 100</div>';
						 mhtml += '</div>';
						 mhtml += '<input type="hidden" id="addstudentmarksform-previd" class="form-control" name="AddStudentMarksForm[previd]" value="'+previd+'" autocomplete="off">';
						 mhtml += '</div>';
						$('#modulemarks').append(mhtml);
					}
			});
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
			
$('#addmarksform').on('change','#addstudentmarksform-ew_marks', function(){
	var marks = $('#addstudentmarksform-ew_marks').val();
	$('.ewmarkserr').hide();
	$('.ewmarkserrnum').hide();
	$('.ewmarkserrmax').hide();
	if(marks == ''){
			$('.ewmarkserr').show();
		}else{
			$('.ewmarkserr').hide();
			if($.isNumeric(marks)){
				$('.ewmarkserrnum').hide();
				if(marks > 100){
					$('.ewmarkserrmax').show();
				}else{
					$('.ewmarkserrmax').hide();
				}
			}else{
				$('.ewmarkserrnum').show();
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
			
$('#addmarksform').on('change','#addstudentmarksform-cw_marks', function(){
	var marks = $('#addstudentmarksform-cw_marks').val();
	$('.cwmarkserr').hide();
	$('.cwmarkserrnum').hide();
	$('.cwmarkserrmax').hide();
	if(marks == ''){
			$('.cwmarkserr').show();
		}else{
			$('.cwmarkserr').hide();
			if($.isNumeric(marks)){
				$('.cwmarkserrnum').hide();
				if(marks > 100){
					$('.cwmarkserrmax').show();
				}else{
					$('.cwmarkserrmax').hide();
				}
			}else{
				$('.cwmarkserrnum').show();
			}
		}
			});
			});
			
</script>
