
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
$this->title = 'Update Module';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'update-module',
			'id' => 'addmoduleform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
		
		<?php echo $form->field($moduleformmodel, 'moduleid')->hiddenInput(['autocomplete' => 'off','value'=>!empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : ''])->label(false);?>
			<?php			
			echo $form->field($moduleformmodel, 'module_id')->textInput(['value' => (isset($moduledata['module_id'])? $moduledata['module_id'] : ''), 'autocomplete' => 'off'])->label('Module ID');?>

		<?php echo $form->field($moduleformmodel, 'module_name')->textInput(['value' => (isset($moduledata['module_name'])? $moduledata['module_name'] : ''), 'autocomplete' => 'off'])->label('Module Name');?>
	</div>
 
 </div>
  <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Update', ['class' => 'btn btn-primary addmodule', 'id' => 'addmodule']) ?>
 </div>
        
        </div>
					</div>

		<?php ActiveForm::end(); ?>
		
		
<script>
$(document).ready(function() {
	
$("#addmoduleform").validate({
            rules: {
				"CreateModuleForm[programme_id]": {
					required: true
				}
			},
            messages: {
				"CreateModuleForm[programme_id]": {
                    required: "Please select Programme"
				}
			},
			});
			});
</script>
