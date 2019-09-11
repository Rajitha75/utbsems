<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$id =  Yii::$app->getRequest()->getQueryParam('id');
if(isset($id)){
$admin_location_res = backend\models\AdminLocation::find()->where(['user_ref_id' => $id])->one();
@$admin_location_id = $admin_location_res->location_ref_id; 
$model->location = @$admin_location_id;
}
    $selectedOptionArray = Array();   
?>

<div class="site-signup participation-border fl-left">
     <div class="row">
        <div class="col-xs-12 col-sm-6">

    <?php $form = ActiveForm::begin(['options' => [
                'id' => 'useradminform']]); ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'value'=>stripslashes($model->username),'autocomplete' => 'off'])->label('User Name <span class="mandatory">*</span>') ?> 
    <div id="username" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>

    <?= $form->field($model, 'email')->input('email',['readonly' => !$model->isNewRecord,'autocomplete' => 'off'])->label('Email <span class="mandatory">*</span>') ?>    
    <div id="email" class="help-block customvalids " style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>

    <?php // echo $form->field($model, 'location')->dropDownList($items, array('prompt'=>'Select Location')) ?>    
   
	<?= $form->field($model, 'user_role_ref_id')->radioList($roles,['multiple'=>'true','size'=>4,'options'=>$selectedOptionArray])->label('User Role <span class="mandatory">*</span>') ?>
		<div id="errorUserRole" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Please select User Role</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn submitbtn btn-success' : 'btn submitbtn btn-primary', 'onClick' => 'return checkErrors()']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
     </div>
</div>
<script>

 $(function(){
 $('.submitbtn').click(function(){
	$(".submitbtn").prop('disabled', true);
 });
 $('#useradminform .form-control').keyup(function(){
	$(".submitbtn").prop('disabled', false);
});

$('#useradminform .form-control, input[name="User[user_role_ref_id]').change(function(){
	$(".submitbtn").prop('disabled', false);
});
 var uid = "<?php echo Yii::$app->getRequest()->getQueryParam('id') ?>";
 if(uid && uid!=''){
 $('input[name="User[user_role_ref_id]').attr('disabled', true);
 }
    $('#user-username').bind('keyup', function() {
        if($(this).val()!=''){
            $(this).next('.help-block').css('display','none');
            $(this).next('.customvalids').css('display','none');
            if($(this).val().match(/<\/?[^>]*>/g)){
                $(this).closest('.form-group').next('.customvalids').text('Html content is not allowed');
                $(this).closest('.form-group').next('.customvalids').css('display','block');
                return false;
            }else{
                $(this).closest('.form-group').next('.customvalids').css('display','none');
                return true;
            }
        }else{
            $(this).next('.customvalids').css('display','none');
            $(this).next('.help-block').css('display','block');
        }
    });
$('#user-email').bind('keyup', function() {
if($(this).val()!='' && $(this).val().match(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/i)){
	$(this).closest('.form-group').next('.customvalids').css('display','none');
	$(this).closest('.form-group').next('.customvalids').text('');
}else if($(this).val()!='' && $(this).val().match(/<\/?[^>]*>/g)){
	$(this).closest('.form-group').next('.customvalids').text('HTML content is not allowed');
	$(this).closest('.form-group').next('.customvalids').css('display','block');
	$(".field-user-email .help-block").hide();
	return false;
}else if($(this).val()!='' && !$(this).val().match(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/i)){
	$(this).closest('.form-group').next('.customvalids').css('display','block');
	$(this).closest('.form-group').next('.customvalids').text('Invalid Email');
	$(".field-user-email .help-block").hide();    
	return false;
}
});			
})
function checkErrors() {
    $('.customvalids').css('display', 'none');

    var regex = /^[a-zA-Z]*$/;
    if ($("#user-username").val() != '' && !regex.test($("#user-username").val())) {
        $("#user-username").closest('.form-group').next('.customvalids').css('display','block');
        $("#user-username").closest('.form-group').next('.customvalids').text('Please enter alphabets only');
    }

	if($('#user-email').val()!='' && $('#user-email').val().match(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/i)) {
		$('#user-email').closest('.form-group').next('.customvalids').css('display','none');
		$('#user-email').closest('.form-group').next('.customvalids').text('');
	} else if($('#user-email').val()!='' && $('#user-email').val().match(/<\/?[^>]*>/g)) {
		$('#user-email').closest('.form-group').next('.customvalids').text('HTML content is not allowed');
		$('#user-email').closest('.form-group').next('.customvalids').css('display','block');
		$(".field-user-email .help-block").hide();    
		//return false;
	} else if($('#user-email').val()!='' && !$('#user-email').val().match(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/i)) {
		$('#user-email').closest('.form-group').next('.customvalids').css('display','block');
		$('#user-email').closest('.form-group').next('.customvalids').text('Invalid Email');
		$(".field-user-email .help-block").hide();    
		//return false;
	}
	//if($('input[name="User[user_role_ref_id]').is(':checked')) {
	if($('input:radio:checked').length > 0){
		$('#errorUserRole').css('display','none');
	}else{
		$('#errorUserRole').css('display','block');
	}

    if($(".customvalids:visible").length>0) {//alert('sds');
        return false;
    } else {
		$('#useradminform').submit();
        return true;
    }
	
}
</script>