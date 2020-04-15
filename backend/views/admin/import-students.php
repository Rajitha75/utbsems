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
.studentprocess{
font-weight: bold;
    font-size: 16px;
    color: #6b3bd5;
	padding-left:20px;
	margin-bottom:20px;
}
</style>

<?php 
$this->title = 'Import Students';

$this->params['breadcrumbs'][] = $this->title;
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<div class="row">
        <div class="col-xs-12 col-sm-12">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'import-students',
			'id' => 'studentexcelupload',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
			<div class="studentprocess">Uploading Students is in process. Please Wait</div>
	<div class="col-xs-8 col-sm-6">
	<?php echo $form->field($importformmodel, 'importfile')->fileInput(['class' => ''])->label('Upload File'); ?>
		<div class="row text-center">
         <div class="form-group">
 <button type="submit" class="btn btn-primary usersignup">Submit</button> </div>
        
        </div>
	
 </div>
					</div>

		<?php ActiveForm::end(); ?>
 
<script>
$(document).ready(function(){
$('.studentprocess').hide();
$('.usersignup').click(function(){
	$('.studentprocess').show();
	setTimeout(function(){
	$(".usersignup").attr("disabled", true);
	}, 1000);
});
$("#studentexcelupload").validate({
            rules: {
                "ImportFileForm[importfile]": {
                    required: true,
					extension: "xls|csv|xlsx"
				},
		   },
            messages: {
                "ImportFileForm[importfile]": {
                    required: "Upload excel",
					extension: "Upload only xls|csv|xlsx files"
				},
			}
			});
	});
</script>
	