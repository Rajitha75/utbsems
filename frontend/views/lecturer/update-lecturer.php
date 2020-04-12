
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
    label.error{
		color: #ff0000;
		font-weight: normal;
	}
	
	.ui-datepicker-trigger{
		float: right;
		margin-top: -30px;
	}
	
	.bankterms{
		margin-top: -16px;
    display: block;
    font-size: 12px;
    margin-left: 50px;
    width: 82%;
    margin-bottom: 10px;
	}
	img.ui-datepicker-trigger {
    position: absolute;
    right: 72px;
    margin-top: -29px;
}
.icnoformat {
  width: 100%;
  height:100px;
  margin-right: 10px;
  float: left;
}
.field-createstudentform-ic_no_format{
width: 18%;
    z-index: 9999;
    }
   
  .field-createstudentform-ic_no {
    width: 52%;
    margin-left: 50px !important;
    margin-top: 22px !important;
    }
.field-createstudentform-ic_no_format, .field-createstudentform-ic_no {
  float: left;
  margin-right: 5px;
}
</style>
<?php 
$this->title = 'Update Lecturer';
echo "<h1 class='box-title'>$this->title </h1>"; 
if(isset($lecturerdata['dob']) && $lecturerdata['dob'] != ''){
	$date = explode("-",$lecturerdata['dob']);
	$dateofbirth = $date[1].'-'.$date[2].'-'.$date[0];
	}
	?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 <?php $form = ActiveForm::begin([
			'method' => 'post',
			'action' => 'update-lecturer',
			'id' => 'usercreateform',
			'options' => ['enctype' => 'multipart/form-data'],
			]); ?>
	<div class="col-xs-8 col-sm-6">
	<?php echo $form->field($userformmodel, 'lecturerid')->hiddenInput(['autocomplete' => 'off','value'=>!empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : ''])->label(false);?>
	<?php echo $form->field($userformmodel, 'name')->textInput(['value' => (isset($lecturerdata['name'])? $lecturerdata['name'] : ''), 'autocomplete' => 'off'])->label('Name');?>
		
	<?php echo $form->field($userformmodel, 'email')->textInput(['value' => (isset($lecturerdata['email'])? $lecturerdata['email'] : ''),'autocomplete' => 'off', 'readonly' => true])->label('Email');?>
	<div id='emailerr' style="display:none">Email id already exists</div>
	
		</div>
 
 </div>
  <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Update', ['class' => 'btn btn-primary usersignup']) ?>
 </div>
        
        </div>
					</div>

		<?php ActiveForm::end(); ?>