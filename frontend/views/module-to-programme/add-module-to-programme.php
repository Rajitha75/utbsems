
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
$this->title = 'Assign Module to Programme';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'add-module-to-programme',
			'id' => 'addfacultyform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	<?php echo $form->field($moduleprogrammeformmodel, 'programme_id')->dropDownList(ArrayHelper::map($programme,'id','programme_name'),['prompt'=>'Please select Programme'])->label('Programme'); ?>
	<?php echo $form->field($moduleprogrammeformmodel, 'module_id')->dropDownList(ArrayHelper::map($modules,'id','module_name'),['prompt'=>'Please select Module'])->label('Module'); ?>
	<?php echo $form->field($moduleprogrammeformmodel, 'semister')->dropDownList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8'], ['prompt' => 'Select Semester'])->label('Semester');?>
	
		</div>
 
 </div>
  <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Add', ['class' => 'btn btn-primary addfaculty', 'id' => 'addfaculty']) ?>
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
