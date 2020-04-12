<style>
    .notifyDiv, .notifyVerifyDiv{
        background-color: #B5EBE0;  
    }
    .clsTextbox {
        float: none;
        margin-right: 20px;
        width: 20%;
    }
    .searchBox .form-group {
        margin: 0px;
    }
    .empty{
        text-align: center;
    }
    .dropdwn{
        width: 160px;
    }
	button.btn.btn-link.logout-btn {
    padding-top: 20px !important;
}
    @media (max-width: 770px){
        ul.pagination{ display:flex;}
    }

    #advancedSearch{
        top:10%;
        left:22%
    }
	
	.form-group {
		margin-bottom: 10px !important;
	}
</style>
<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

    $this->title = 'Students List';

$this->params['breadcrumbs'][] = $this->title;
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'totalCount' => $count,
    'pagination' => [
        'pageSize' => 10,
    ],
        ]);

echo "<h1 class='box-title'>$this->title </h1>";
echo "<div class='participation-border fl-left all-userlst'>";
?> 
<div class='participation-border fl-left notifyDiv' style="display:none;">You have successfully changed the user status.</div>    
<div class='participation-border fl-left notifyVerifyDiv' style="display:none;">You have successfully changed the verification status.</div>
<div style="width: 100%; float: left;" class="searchBox all-adminlist">
    <div class="col-sm-12 p-left0">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-sm-2 col-xs-12 p-left0 ad-lst">
            <?php echo $form->field($model, 'studentname')->textInput(array('placeholder' => 'Student Name / IC No / Passport No'), ['class' => 'form-control']) ?>
        </div>
        <div class="col-sm-2 col-xs-12 p-left0 ad-lst">
        <?php echo $form->field($model, 'programme_name')->dropDownList(ArrayHelper::map($programme,'id','programme_name'),['prompt'=>'Please select Programme'])->label('Programme'); ?>

        </div>
       
        <div class="searchBtn">
                <?php echo Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-success', 'id' => 'btnSearch']) ?>
                <input type="hidden" value="<?php echo Yii::$app->request->BaseUrl; ?>/../../students-list" id="searchUrl">
            </div>
            <div class="searchBtn" style="padding:0;">
                <?php echo Html::submitButton('<i class="fa fa-repeat"> </i>', ['class' => 'btn btn-success res-bnt', 'id' => 'btnReset']) ?>
            </div>
            <div class="searchBtn">
                <button type="button" id="advsearch" class="btn btn-success">Advanced Search</button> 
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>    
<div id="dataConfirmModal" class="confirm-box" style="display:none;">
    <h3 id="dataConfirmLabel" >Please Confirm</h3>   
    <div style="text-align:right;margin-top:10px;">
        <input class="dataConfirmCancel btn btn-secondary" onclick="$('#dataConfirmModal').css('display','none');" type="button" value="Cancel">
        <input class="dataConfirmOK btn btn-primary" onclick="updateStatus()" type="button" value="Ok">
    </div>
</div>

<div id="advancedSearch" class="confirm-box" style="display:none;">
    <h3 id="dataConfirmLabel" >Advance Search</h3>   
    
    
    <div class="row">
        <div class="col-xs-16 col-sm-16">

 <?php 
 $fromyear = date('Y', strtotime('-20 years'));
 $range = range($fromyear, $fromyear+40);
 $years = array_combine($range, $range);
 $form = ActiveForm::begin([
			'id' => 'advsearchform'
			]); ?>
	<div class="col-xs-4 col-sm-3">
	
	<?php //echo $form->field($model, 'userid')->hiddenInput(['autocomplete' => 'off','value'=>!empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : ''])->label('');?>
    <?php echo $form->field($model, 'name')->textInput(array('placeholder' => 'Student Name'),['autocomplete' => 'off'])->label(false);?>
    
    <?php echo $form->field($model, 'rollno')->textInput(array('placeholder' => 'Roll No'),['autocomplete' => 'off'])->label(false);?>

	<?php echo $form->field($model, 'rumpun')->dropDownList([ 'XLR8' => 'XLR8', 'PRO-XTIV' => 'PRO-XTIV', 'XCEL' => 'XCEL', 'CRTIV' => 'CRTIV'],['prompt' => 'Rumpun'])->label(false); ?>

	
	<?php echo $form->field($model, 'nationality')->textInput(array('placeholder' => 'Nationality'),['autocomplete' => 'off'])->label(false); ?>

	<?php echo $form->field($model, 'ic_no')->textInput(array('placeholder' => 'IC No'),['autocomplete' => 'off'])->label(false);?>

	<?php echo $form->field($model, 'ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'IC Color'])->label(false);?>
	
	<?php echo $form->field($model, 'passportno')->textInput(array('placeholder' => 'Passport No'),['autocomplete' => 'off'])->label(false);?>

	
	<?php echo $form->field($model, 'race')->textInput(array('placeholder' => 'Race'),['autocomplete' => 'off'])->label(false); ?>

	<?php echo $form->field($model, 'religion')->textInput(array('placeholder' => 'Religion'),['autocomplete' => 'off'])->label(false); ?>

    </div>
    <div class="col-xs-4 col-sm-3">
	<?php echo $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'],['prompt' => 'Gender'])->label(false); ?>
	
    <?php echo $form->field($model, 'martial_status')->dropDownList([ 'Married' => 'Married', 'Single' => 'Single'],['prompt' => 'Martial Status'])->label(false); ?>
	
	<?php echo $form->field($model, 'age')->textInput(array('placeholder' => 'Age'),['autocomplete' => 'off'])->label(false);?>
    
		<?php echo $form->field($model, 'telephone_mobile')->textInput(array('placeholder' => 'Telephone No. (Mobile)'),['autocomplete' => 'off'])->label(false);?>

		<?php echo $form->field($model, 'tele_home')->textInput(array('placeholder' => 'Telephone No. (Home)'),['autocomplete' => 'off'])->label(false);?>
	
		<?php //echo $form->field($model, 'email')->textInput(array('placeholder' => 'Email'),['autocomplete' => 'off'])->label(false);?>
		
		<?php echo $form->field($model, 'lastschoolname')->textInput(array('placeholder' => 'Name of Last School Attended'),['autocomplete' => 'off'])->label(false);?>
		
		<?php echo $form->field($model, 'highest_qualification')->textInput(array('placeholder' => 'Highest Qualification Obtained'),['autocomplete' => 'off'])->label(false);?>
		
		<?php echo $form->field($model, 'type_of_entry')->textInput(array('placeholder' => 'Type of Entry'),['autocomplete' => 'off'])->label(false); ?>
		
		<?php echo $form->field($model, 'address')->textInput(array('placeholder' => 'Postal Address'))->label(false); ?>
		
		</div>
	<div class="col-xs-4 col-sm-3">
	
		<?php echo $form->field($model, 'state_address')->textInput(array('placeholder' => 'District'),['autocomplete' => 'off' ])->label(false); ?>
		
		<?php echo $form->field($model, 'type_of_residential')->textInput(array('placeholder' => 'Type of Residential'),['autocomplete' => 'off' ])->label(false); ?>

		<?php echo $form->field($model, 'bank_name')->dropDownList([ 'BAIDURI' => 'BAIDURI', 'BIBD' => 'BIBD', 'STANDARD CHARTERED BANK' => 'STANDARD CHARTERED BANK', 'TAIB' => 'TAIB'],['prompt' => 'Bank Name'])->label(false); ?>
		
		<?php echo $form->field($model, 'bank_account_name')->textInput(array('placeholder' => 'Bank Account Name'),['autocomplete' => 'off'])->label(false);?>
		
		<?php echo $form->field($model, 'account_no')->textInput(array('placeholder' => 'Bank Account No'),['autocomplete' => 'off'])->label(false);?>
	
		<?php echo $form->field($model, 'father_name')->textInput(array('placeholder' => 'Father/Guardian Name'),['autocomplete' => 'off'])->label(false);?>

		<?php echo $form->field($model, 'fathericno')->textInput(array('placeholder' => 'Father/Guardian IC No '),['autocomplete' => 'off'])->label(false);?>

		<?php echo $form->field($model, 'mother_name')->textInput(array('placeholder' => 'Mother Name '),['autocomplete' => 'off'])->label(false);?>

		<?php echo $form->field($model, 'mothericno')->textInput(array('placeholder' => 'Mother IC No '),['autocomplete' => 'off'])->label(false);?>

		

</div>
    <div class="col-xs-4 col-sm-3">
	
<?php echo $form->field($model, 'sponsor_type')->textInput(array('placeholder' => 'Sponsor Type'),['autocomplete' => 'off' ])->label(false); ?>
		
		<?php echo $form->field($model, 'type_of_programme')->dropDownList(['Undergraduate Degree' => 'Undergraduate Degree', 'Masters by Coursework' => 'Masters by Coursework', 'Masters by Research' => 'Masters by Research', 'Doctor of Philosophy PhD' => 'Doctor of Philosophy PhD'], ['prompt' => 'Type of Programme'])->label(false);?>
	
		<?php echo $form->field($model, 'programme_name')->dropDownList(ArrayHelper::map($programme,'id','programme_name'),['prompt'=>'Please select Programme'])->label(false); ?>
		
		<?php echo $form->field($model, 'entry')->dropDownList(['First Year' => 'First Year', 'Second Year' => 'Second Year'], ['prompt' => 'Entry'])->label(false);?>

		
		<?php //echo $form->field($model, 'status_of_student')->dropDownList(['Current Student' => 'Current Student', 'Withdrawn' => 'Withdrawn'], ['prompt' => 'Status of Student'])->label(false);?>

<?php echo $form->field($model, 'intake')->dropDownList($years,['prompt' => 'Intake No'])->label(false);?>

<?php echo $form->field($model, 'mode')->dropDownList(['Full Time' => 'Full Time', 'Part Time'=> 'Part Time'],['prompt' => 'Mode'])->label(false);?>

<?php echo $form->field($model, 'utb_email_address')->textInput(array('placeholder' => 'UTB Email Address'),['autocomplete' => 'off'])->label(false);?>

<?php //echo $form->field($model, 'degree_classification')->textInput(array('placeholder' => 'Degree Classification'),['autocomplete' => 'off'])->label(false);?>

<?php 
echo $form->field($model, 'date_of_registration')->widget(\yii\jui\DatePicker::classname(), [
	'value'  => '1232', 'dateFormat' => 'dd-MM-yyyy', 'options' => ['class' => 'form-control'],
				'options' => ['class' => 'form-control'],            
				'clientOptions' => [
					'changeMonth' => true,
					'yearRange'=> '-40:+20',
					'defaultDate' => '-70y',
					'changeYear' => true,
					'maxDate' => 0, 
					'showOn' => 'button',
					'buttonImage' => 'images/calendar.gif',
					'buttonImageOnly' => true,
					'buttonText' => 'Select date',
					 'buttonImage' => Yii::$app->request->BaseUrl.'/images/calendar.gif',
				],
])->textInput(array('placeholder' => 'Date of Registration'),['readonly' => true])->label(false); ?>

<?php 
echo $form->field($model, 'date_of_leaving')->widget(\yii\jui\DatePicker::classname(), [
	'value'  => '1232', 'dateFormat' => 'dd-MM-yyyy', 'options' => ['class' => 'form-control'],
				'options' => ['class' => 'form-control'],            
				'clientOptions' => [
					'changeMonth' => true,
					'yearRange'=> '-40:+20',
					'defaultDate' => '-70y',
					'changeYear' => true,
					'maxDate' => 0, 
					'showOn' => 'button',
					'buttonImage' => 'images/calendar.gif',
					'buttonImageOnly' => true,
					'buttonText' => 'Select date',
					 'buttonImage' => Yii::$app->request->BaseUrl.'/images/calendar.gif',
				],
])->textInput(array('placeholder' => 'Date of Leaving'),['readonly' => true])->label(false); ?>

<?php //echo $form->field($model, 'previous_roll_no')->textInput(array('placeholder' => 'Previous Roll No'),['autocomplete' => 'off'])->label(false);?>

<?php //echo $form->field($model, 'previous_programme_name')->textInput(array('placeholder' => 'Previous Programmme Name'),['autocomplete' => 'off'])->label(false);?>

<?php //echo $form->field($model, 'previous_intake_no')->dropDownList($years,['prompt' => 'Previous Intake No'])->label(false);?>

<?php //echo $form->field($model, 'previous_utb_email')->textInput(array('placeholder' => 'Previous UTB Email'),['autocomplete' => 'off'])->label(false);?>		

	
 </div>
 
 </div>
					</div>
 <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btnadvsearch', 'id' => 'btnadvsearch']) ?>

 <button type="button" id="btnadvreset" class="btn btn-primary res-bnt btnadvreset">Reset</button>

 <button type="button" id="btnadvcancel" class="btn btn-primary btnadvcancel">Cancel</button>
 </div>
        
        </div>
		<?php ActiveForm::end(); ?>
</div>
<script>
 function updateStatus(){
    var deleteUrl = $('#updateUrl').val();
    var pjaxContainer = $('#ajaxContainer').val();
     $.ajax({
     url:   deleteUrl,
     type: 'post',
     success: function(data){        
       if(data){ 
           $('#dataConfirmModal').css('display','none');
           $.pjax.reload({container: '#' + $.trim(pjaxContainer)});
           $('.notifyDiv').slideDown('slow',function () {
               $(this).delay(2000).fadeOut(1000);
           });           
       }
     },
     error: function(xhr, status, error) {
        // alert('There was an error with your request.' + xhr.responseText);
     }
     }); 
     return false;
 }   
</script>
<?php
\yii\widgets\Pjax::begin([
    'id' => 'pjax-list',
    'timeout' => false,
    'enablePushState' => false
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //'username',
       
		 [
							'format' => 'raw',
                            'attribute' => 'name',
							 'options' => ['width' => '180'],
                            'value' => function ($model) {   
                                return $model['name'] ? stripslashes($model['name']) : 'Not Assigned';
                            }
                        ],
            [
                'attribute' => 'rollno',
                'label' => 'Roll No',
                'value' => function($model) {
                    return $model['rollno'] ? stripslashes($model['rollno']) : 'Not Assigned';
                }
            ],		
            [
                'attribute' => 'utb_email_address',
                'label' => 'Student Email',
                'value' => function($model) {
                    return $model['utb_email_address'] ? stripslashes($model['utb_email_address']) : 'Not Assigned';
                }
            ],
            [
                'attribute' => 'entry',
                'label' => 'Entry',
                'value' => function($model) {
                    return $model['entry'] ? stripslashes($model['entry']) : 'Not Assigned';
                }
            ],
            [
                'attribute' => 'ic_no',
                'label' => 'IC No',
                'value' => function($model) {
                    return $model['ic_no'] ? stripslashes($model['ic_no']) : 'Not Assigned';
                }
            ],
            [
                'attribute' => 'passportno',
                'label' => 'Passport No',
                'value' => function($model) {
                    return $model['passportno'] ? stripslashes($model['passportno']) : 'Not Assigned';
                }
            ],
            [
                'attribute' => 'email',
                'label' => 'Email (other)',
                'value' => function($model) {
                    return $model['email'] ? stripslashes($model['email']) : 'Not Assigned';
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                            'header'=> 'View | Edit | Delete | Download' ,
                            //'options' => ['width' => '85'],
                            'headerOptions' => ['style' => 'width:142px'],
                            'template'=>'{view}{update}{delete}{creatempdf}',
                            'buttons'=>[
                                        'update' => function ($url, $model) {
										  return Html::a('<span class="glyphicon glyphicon-pencil" title="Edit"></span>', $url, [
                                                  'title' => Yii::t('yii', 'update'),'data-pjax' => 0
                                          ]); 
                                        },
                                        'view'=>function ($url, $model) {     
                                          return Html::a('<span class="glyphicon glyphicon-eye-open" title="View"></span>',  $url, [
                                                  'title' => Yii::t('yii', 'view'), 'data-pjax' => 0, 'target' => '_blank'
                                          ]);                                

                                        },
                                        'delete'=>function ($url, $model) { 
                                            if(@$model['status'] == 1){    
                                            return HTML::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
                                                'title' => Yii::t('yii', 'delete'),
                                                'aria-label'=>"Delete",
                                                'class' => 'ajaxDelete', 
                                                'delete-url' => $url, 
                                                'pjax-container' => 'pjax-list',
                                                'data-confirm'=>'Are you sure you want to delete this Student?',
                                            ]);                               
                                            }else if(@$model['status'] == 2){
                                                return HTML::a('<span class="glyphicon glyphicon-repeat"></span>',$url,[
                                                    'title' => Yii::t('yii', 'undo'),
                                                    'aria-label'=>"Delete",
                                                    'class' => 'ajaxDelete', 
                                                    'delete-url' => $url, 
                                                    'pjax-container' => 'pjax-list',
                                                    'data-confirm'=>'Are you sure you want to undo delete this Student?',
                                                ]);        
                                            }
                                          },
                                          'creatempdf'=>function($url,$model) {

                                            return Html::a('<span class="glyphicon glyphicon-download-alt" title="Download"></span>', $url, [
              
                                                    'title' => Yii::t('yii', 'Download'), 'data-pjax' => 0, 'target' => '_blank'
              
                                            ]);                               
              
               
              
                                          }
                                      ],
                            'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'update') {
                                    return Url::toRoute(['../../update-student', 'id' => $model['id']]);
                                }else if($action === 'delete'){
                                    return Url::toRoute(['student-delete', 'id' => $model['user_ref_id'], 'status' => $model['status']]);
                                }else if ($action === 'creatempdf') {

                                    return Url::toRoute(['creatempdf', 'id' => $model['id']]);
            
                                    }else {
                                    return Url::toRoute(['student-view', 'id' => $model['id']]);
                                }
                            } 
                        ],
					['class' => 'yii\grid\ActionColumn',
                            'header'=> 'Marks' ,
                            //'options' => ['width' => '85'],
                            'headerOptions' => ['style' => 'width:142px'],
                            'template'=>'{marks}',
                            'buttons'=>[
                                        'marks' => function ($url, $model) {
										  return Html::a('<span class="glyphicon glyphicon-list-alt" title="Marks"></span>', $url, [
                                                  'title' => Yii::t('yii', 'marks'),'data-pjax' => 0
                                          ]); 
                                        }
                                      ],
                            'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'marks') {
                                    return Url::toRoute(['../../student-marks', 'id' => $model['id']]);
                                }
                            } 
                        ],
    ],
]);
\yii\widgets\Pjax::end();
?>
	<input type="hidden" value="" id="updateUrl">
<input type="hidden" value="" id="ajaxContainer">
<?php
$this->registerJs(" $(document).on('ready pjax:success', function () {  var deleteUrl; 
  $('.ajaxDelete').on('click', function (e) {
    e.preventDefault();
    deleteUrl     = $(this).attr('delete-url');
    $('#updateUrl').val(deleteUrl);
    var pjaxContainer = $(this).attr('pjax-container');
    $('#ajaxContainer').val(pjaxContainer);
    
    $('#dataConfirmLabel').text($(this).attr('data-confirm'));
    $('#dataConfirmModal').css('display','block');
   
    return false;
 
});
    $(document).on('pjax:timeout', function(event) {
      // Prevent default timeout redirection behavior
      event.preventDefault()
    });
}); 

");
                ?>
</div>
<script>
$(document).ready(function(){

    $('#advsearch').click(function(){
        $('#advancedSearch').show();
    })
	var name = "<?php echo !empty(Yii::$app->getRequest()->getQueryParam('name')) ? Yii::$app->getRequest()->getQueryParam('name') : '' ?>";
    var programme_name = "<?php echo !empty(Yii::$app->getRequest()->getQueryParam('programme_name')) ? Yii::$app->getRequest()->getQueryParam('programme_name') : '' ?>";
	$('#student-studentname').val(name);
    $('#student-programme_name').val(programme_name);
});
    $(function () {

        $('#btnSearch').on('click', function (e) {
            var searchUrl = $('#searchUrl').val();
            var pjaxContainer = 'pjax-list';
            var name = $('#student-studentname').val();
            var programme_name = $('#student-programme_name').val();
                var pjaxReloadURL = searchUrl + '?name=' + name+ '&programme_name=' + programme_name;

            $.ajax({
                url: searchUrl,
                type: 'get',
                data: {'name': name, 'programme_name': programme_name},
                success: function (data) {
                    if (data) {
                        //$.pjax.reload({url: pjaxReloadURL, container: '#' + $.trim(pjaxContainer, )});
                        $.pjax.reload({url: pjaxReloadURL, container: '#' + $.trim(pjaxContainer), async: false});
                        return false;
                    }
                },
                error: function (xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            });
            return false;
        });


        $('#btnadvsearch').on('click', function (e) {
            var searchUrl = $('#searchUrl').val();
            var pjaxContainer = 'pjax-list';
            var name = $('#student-name').val();
            var rollno = $('#student-rollno').val();
            var rumpun = $('#student-rumpun').val();
            var nationality = $('#student-nationality').val();
            var studenticno = $('#student-ic_no').val();
            var studenticcolor = $('#student-ic_color').val();
            var passportno = $('#student-passportno').val();
            var race = $('#student-race').val();
            var religion = $('#student-religion').val();
            var gender = $('#student-gender').val();
            var martialstatus = $('#student-martial_status').val();
            var mobile = $('#student-telephone_mobile').val();
            var telehome = $('#student-tele_home').val();
            //var email = $('#student-email').val();
            var typeofentry = $('#student-type_of_entry').val();
            var address = $('#student-address').val();
            var bankname = $('#student-bank_name').val();
            var accountno = $('#student-account_no').val();

            var fathername = $('#student-father_name').val();
            var fathericno = $('#student-fathericno').val();
            var mothername = $('#student-mother_name').val();
            var mothericno = $('#student-mothericno').val();
            var sponsortype = $('#student-sponsor_type').val();
            var programme_name = $('#student-programme_name').val();
            var entry = $('#student-entry').val();
            //var status = $('#student-status_of_student').val();
            var intake = $('#student-intake').val();

            var mode = $('#student-mode').val();
            var utbemail = $('#student-utb_email_address').val();
            //var degree = $('#student-degree_classification').val();
            var dateofregistration = $('#student-date_of_registration').val();
            var dateofleaving = $('#student-date_of_leaving').val();
            //var prevrollno = $('#student-previous_roll_no').val();
            //var prevprogname = $('#student-previous_programme_name').val();
            //var previntakeno = $('#student-previous_intake_no').val();
            //var prevutbemail = $('#student-previous_utb_email').val();
			var age = $('#student-age').val();
            var highest_qualification = $('#student-highest_qualification').val();
            var lastschoolname = $('#student-lastschoolname').val();
            var state_address = $('#student-state_address').val();
            var type_of_residential = $('#student-type_of_residential').val();
            var type_of_programme = $('#student-type_of_programme').val();
			var bank_account_name = $('#student-bank_account_name').val();
                var pjaxReloadURL = searchUrl + '?name=' + name+ '&rollno=' + rollno+ '&rumpun=' + rumpun+ '&nationality=' + nationality+ '&studenticno=' + studenticno+ '&studenticcolor=' + studenticcolor+ '&passportno=' + passportno+ '&race=' + race+ '&religion=' + religion+ '&gender=' + gender+ '&martialstatus=' + martialstatus+ '&mobile=' + mobile+ '&telehome=' + telehome+ '&typeofentry=' + typeofentry+ '&address=' + address+ '&bankname=' + bankname+ '&accountno=' + accountno+ '&fathername=' + fathername+ '&fathericno=' + fathericno+ '&mothername=' + mothername+ '&mothericno=' + mothericno+ '&sponsortype=' + sponsortype+ '&programme_name=' + programme_name+ '&entry=' + entry+ '&intake=' + intake+ '&mode=' + mode+ '&utbemail=' + utbemail+ '&dateofregistration=' + dateofregistration+ '&dateofleaving=' + dateofleaving + '&age=' + age + '&highest_qualification=' + highest_qualification + '&lastschoolname=' + lastschoolname + '&state_address=' + state_address + '&type_of_residential=' + type_of_residential + '&type_of_programme=' + type_of_programme + '&bank_account_name=' + bank_account_name;
                $.pjax.reload({url: pjaxReloadURL, container: '#' + $.trim(pjaxContainer), async: false});
                location.reload();
           
            return false;
        });
        
        $('#btnadvcancel').on('click', function (e) {
            $('#advancedSearch').hide();
            $('#advsearchform').reset();
        });

        $('#btnadvreset').on('click', function (e) {
            $('#advsearchform').reset();
        });

        $('#btnReset').on('click', function (e) {
            var searchUrl = $('#searchUrl').val();
            var pjaxContainer = 'pjax-list';
                var pjaxReloadURL = searchUrl;

            $.ajax({
                url: searchUrl,
                type: 'get',
                success: function (data) {
                    if (data) {
                        $('#student-studentname').val('');
                        $('#student-programme_name').val('');
                        //$.pjax.reload({url: pjaxReloadURL, container: '#' + $.trim(pjaxContainer, )});
                        $.pjax.reload({url: pjaxReloadURL, container: '#' + $.trim(pjaxContainer), async: false});
                        return false;
                    }
                },
                error: function (xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            });
            return false;
        });

    });

</script>