
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
$this->title = 'Update Programme';
echo "<h1 class='box-title'>$this->title </h1>"; 
?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'update-programme',
			'id' => 'addprogrammeform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	
	<?php			
	echo $form->field($programmeformmodel, 'programme_id')->hiddenInput(['autocomplete' => 'off','value'=>!empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : ''])->label(false);
			//echo $form->field($programmeformmodel, 'faculty_id')->dropDownList(ArrayHelper::map($faculty,'id','faculty_name'),['prompt'=>'Please select Faculty'])->label('Faculty');
		?>  
		
	<?php echo $form->field($programmeformmodel, 'programme_name')->textInput(['value' => (isset($programmedata['programme_name'])? $programmedata['programme_name'] : ''), 'autocomplete' => 'off'])->label('Programme Name');?>
	
	
		
		</div>
 
 </div>
  <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Update', ['class' => 'btn btn-primary addprogramme', 'id' => 'addprogramme']) ?>
 </div>
        
        </div>
					</div>

		<?php ActiveForm::end(); ?>
		
		
<script>
$(document).ready(function() {
$("#addfacultyform").validate({
            rules: {
				"CreateFacultyForm[programme_name]": {
					required: true
				}
			},
            messages: {
				"CreateFacultyForm[programme_name]": {
                    required: "Please enter Programme Name"
				}
			},
			});
			});
</script>
