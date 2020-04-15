
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
.addnew{
	background: green;
    padding: 5px 10px;
    width: 114px;
    color: #ffffff;
}

.removenew{
	background:red;
	padding: 5px 10px;
    width: 114px;
    color: #ffffff;
}
</style>
<?php 
$this->title = 'Add Module';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'add-module',
			'id' => 'addmoduleform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	
	<?php			
			echo $form->field($moduleformmodel, 'programmer_id')->dropDownList(ArrayHelper::map($programmers,'id','programme_name'),['prompt'=>'Please select Programmer'])->label('Programmer');
		?>  
		
			<?php			
			echo $form->field($moduleformmodel, 'module_id')->dropDownList(ArrayHelper::map($modules,'id','module_name'),['prompt'=>'Please select Module'])->label('Module');
		?> 
		<div class="addnewmodule">Module does not exist? <div class="addnew">Add New Module</div></div>
	<?php echo $form->field($moduleformmodel, 'module_name')->textInput(['value' => (isset($moduledata['module_name'])? $moduledata['module_name'] : ''), 'autocomplete' => 'off'])->label('Module Name');?>
	
	<div class="removenewmodule"><div class="removenew">Remove</div></div>
		
		<?php echo $form->field($moduleformmodel, 'semister')->dropDownList(['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8'], ['prompt' => 'Select Semester'])->label('Semester <span class="mandatory">*</span>');?>
		</div>
 
 </div>
  <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Add', ['class' => 'btn btn-primary addmodule', 'id' => 'addmodule']) ?>
 </div>
        
        </div>
					</div>

		<?php ActiveForm::end(); ?>
		
		
<script>
$(document).ready(function() {
	$('.field-createmoduleform-module_name').hide();
	$('.removenew').hide();
	$('.addnew').click(function(){
		$('.field-createmoduleform-module_name').show();
		$('#createmoduleform-module_id').val('');
		$('.removenew').show();
	});
	$('.removenew').click(function(){
		$('.field-createmoduleform-module_name').hide();
		$('#createmoduleform-module_name').val('');
		$('.removenew').hide();
	});
	
$("#addmoduleform").validate({
            rules: {
				"CreateModuleForm[programmer_id]": {
					required: true
				}
			},
            messages: {
				"CreateModuleForm[programmer_id]": {
                    required: "Please select Programmer"
				}
			},
			});
			});
</script>
