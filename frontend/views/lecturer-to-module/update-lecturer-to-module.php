
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\bootstrap\Alert;
use common\models\Storage;
use yii\helpers\Url;
$storagemodel = new Storage();

$lecturermoduleformmodel->module_id = $data['module_id'];
$lecturermoduleformmodel->lecturer_id = $data['lecturer_id'];
?>
<?php 
$this->title = 'Update Lecturer to Module';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'update-lecturer-to-module',
			'id' => 'addfacultyform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	<?php echo $form->field($lecturermoduleformmodel, 'id')->hiddenInput(['autocomplete' => 'off','value'=>!empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : ''])->label(false);?>
	
	<?php echo $form->field($lecturermoduleformmodel, 'module_id')->dropDownList(ArrayHelper::map($modules,'id','module_name'),['prompt'=>'Please select Module'])->label('Module'); ?>
	
	<?php echo $form->field($lecturermoduleformmodel, 'lecturer_id')->dropDownList(ArrayHelper::map($lecturer,'user_ref_id','name'),['prompt'=>'Please select Lecturer'])->label('Lecturer'); ?>
	
	
		</div>
 
 </div>
  <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Update', ['class' => 'btn btn-primary addfaculty', 'id' => 'addfaculty']) ?>
 </div>
        
        </div>
					</div>

		<?php ActiveForm::end(); ?>
		
		
<script>
$(document).ready(function() {
$("#addfacultyform").validate({
            rules: {
				"CreateFacultyForm[faculty_name]": {
					required: true
				}
			},
            messages: {
				"CreateFacultyForm[faculty_name]": {
                    required: "Please enter Faculty Name"
				}
			},
			});
			});
</script>
