
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\bootstrap\Alert;
use common\models\Storage;
use yii\helpers\Url;
$storagemodel = new Storage();

$programmefacultyformmodel->faculty_id = $data['faculty_id'];
$programmefacultyformmodel->programme_id = $data['programme_id'];
?>
<?php 
$this->title = 'Update Faculty to Programme';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'update-programme-to-faculty',
			'id' => 'addfacultyform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	<?php echo $form->field($programmefacultyformmodel, 'id')->hiddenInput(['autocomplete' => 'off','value'=>!empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : ''])->label(false);?>
	
	<?php echo $form->field($programmefacultyformmodel, 'faculty_id')->dropDownList(ArrayHelper::map($faculty,'id','faculty_name'),['prompt'=>'Please select Faculty'])->label('Faculty'); ?>
	
	<?php echo $form->field($programmefacultyformmodel, 'programme_id')->dropDownList(ArrayHelper::map($programme,'id','programme_name'),['prompt'=>'Please select Programme'])->label('Programme'); ?>
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
