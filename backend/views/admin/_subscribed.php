<style>
    .notifyDiv{
        background-color: #B5EBE0;  
    }
    .clsTextbox {
        float: none;
        margin-right: 20px;
        //        width: 20%;
    }
    .searchBox .form-group {
        margin: 0px;
    }
    .empty{
        text-align: center;
    }
	button.btn.btn-link.logout-btn {
    padding-top: 20px !important;
}
</style>
<script>
$(document).ready(function(){

	var email = "<?php echo !empty(Yii::$app->getRequest()->getQueryParam('email')) ? Yii::$app->getRequest()->getQueryParam('email') : '' ?>";
	var ipaddress = "<?php echo !empty(Yii::$app->getRequest()->getQueryParam('ip')) ? Yii::$app->getRequest()->getQueryParam('ip') : '' ?>";
	var fromdate = "<?php echo !empty(Yii::$app->getRequest()->getQueryParam('from')) ? Yii::$app->getRequest()->getQueryParam('from') : '' ?>";
	var todate = "<?php echo !empty(Yii::$app->getRequest()->getQueryParam('to')) ? Yii::$app->getRequest()->getQueryParam('to') : '' ?>";
	$('#subscription-useremail').val(email);
	$('#subscription-ipaddress').val(ipaddress);
	$('#subscription-from_date').val(fromdate);
	$('#subscription-to_date').val(todate);
	
$("#subscription-from_date").attr("placeholder", "From Date");
$("#subscription-to_date").attr("placeholder", "To Date");

$('#btnSearchSubscribed').on('click', function (e) {
            var searchUrl_initiated = $('#searchUrl').val();
            var pjaxContainer_initiated = 'pjax-list' ;
            var userEmail = $('.userssubscribed #subscription-useremail').val();
            var ipAddress = $('.userssubscribed #subscription-ipaddress').val();
            var from_date = $('#subscription-from_date').val();
            var to_date = $('#subscription-to_date').val();
            var pjaxReloadURL_initiated = searchUrl_initiated+'?email='+userEmail+'&ip='+ipAddress+'&from='+from_date+'&to='+to_date;

             $.ajax({
                url:   searchUrl_initiated,
                type: 'get',
                data: {'email': userEmail, 'ip': ipAddress, 'from': from_date, 'to': to_date},
                success: function(data){
                    if(data){ 
                        //$.pjax.reload({url: pjaxReloadURL, container: '#' + $.trim(pjaxContainer, )});
                        $.pjax.reload({url: pjaxReloadURL_initiated, container: '#' + $.trim(pjaxContainer_initiated), async:false, reload: true,});
                        return false;
                    }
                },
                error: function (xhr, status, error) {
                   alert('There was an error with your request.' + xhr.responseText);
                 }
             }); 
             return false;
        });
        
        $('#btnResetSubscribed').on('click', function (e) {
            var searchUrl_initiated = $('#searchUrl').val();
            var pjaxContainer = 'pjax-list' ;
            var pjaxReloadURL = searchUrl_initiated;

             $.ajax({
                url:   searchUrl_initiated,
                type: 'get',
                success: function(data){
                    if(data){ 
                        $('#subscription-useremail').val('');
                        $('#subscription-ipaddress').val('');
                        $('#subscription-from_date').datepicker('setDate', null);
                        $('#subscription-to_date').datepicker('setDate', null);
                        //$.pjax.reload({url: pjaxReloadURL, container: '#' + $.trim(pjaxContainer, )});
                        $.pjax.reload({url: pjaxReloadURL, container: '#' + $.trim(pjaxContainer), async:false});
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
<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'Subscribed Users';
$this->params['breadcrumbs'][] = ['label' => 'Subscribed Users', 'url' => ['user_list']];
$this->params['breadcrumbs'][] = $this->title;


echo "<h1 class='box-title'>$this->title </h1>";
echo "<div class='participation-border fl-left all-userlst'>";
$phpdateformat = Yii::getAlias('@phpdateformat');
$dateformat = Yii::getAlias('@phpdatepickerformat');
?>
<div style="width: 100%; float: left;" class="searchBox all-adminlist">
    <div class="col-sm-12 p-left0">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-sm-2 col-xs-12 p-left0 ad-lst">
            <?php echo $form->field($model, 'userEmail' , ['options' => ['class' => 'userssubscribed']])->textInput(array('placeholder' => 'Email'), ['class' => 'form-control','autocomplete' => 'off']) ?>
        </div>
		<div class="col-sm-2 col-xs-12 p-left0 ad-lst">
            <?php echo $form->field($model, 'ipaddress' , ['options' => ['class' => 'userssubscribed']])->textInput(array('placeholder' => 'IP Addess'), ['class' => 'form-control','autocomplete' => 'off']) ?>
        </div>
        <div class="col-sm-2 col-xs-12 custom-calendar">
            <?php
            echo $form->field($model, 'from_date' , ['options' => ['class' => 'userssubscribed']])->widget(DatePicker::classname(), [
                'value' => @$value, 'dateFormat' => $dateformat, 'value' => date('Y-m-d'), 'options' => ['class' => 'clsDropdown col-sm-3 col-xs-12'],
                'clientOptions' => [
                            'changeMonth' => true,
                            'yearRange' => "2000:2070",
                            'changeYear' => true,
                            'showOn' => 'button',
                            'buttonImage' => 'images/calendar.gif',
                            'buttonImageOnly' => true,
                            'buttonText' => 'Select date',
                            'buttonImage' => Yii::$app->request->BaseUrl . '/images/calendar.gif',
                            'onSelect' => new \yii\web\JsExpression("function(dateStr) {
                                $('#subscription-to_date').val('');  
                                var toDate = $(this).datepicker('getDate');
                                var fromDate = $(this).datepicker('getDate');
                                fromDate.setDate(toDate.getDate()+1);
                                $('#subscription-to_date').datepicker('option', 'minDate', fromDate); 
                                }"
                            ),
                        ],
            ])->textInput(['readonly' => true])->label('From Date');
            ?>
        </div>
        <div class="col-sm-2 col-xs-12 custom-calendar">
            <?php
            echo $form->field($model, 'to_date' , ['options' => ['class' => 'userssubscribed']])->widget(DatePicker::classname(), [
                'value' => @$value, 'dateFormat' => $dateformat, 'value' => date('Y-m-d'), 'options' => ['class' => 'clsDropdown col-sm-3 col-xs-12'],
                'clientOptions' => [
                            'changeMonth' => true,
                            'yearRange' => "2000:2070",
                            'changeYear' => true,
                            'showOn' => 'button',
                            'buttonImage' => 'images/calendar.gif',
                            'buttonImageOnly' => true,
                            'buttonText' => 'Select date',
                            'buttonImage' => Yii::$app->request->BaseUrl . '/images/calendar.gif',                  
                        ],
            ])->textInput(['readonly' => true])->label('To Date');
            ?>
        </div>
        <div class="col-sm-2 btn-sbrt">
            <div class="col-sm-6 col-xs-12 searchBtn">
                <?php echo Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-success', 'id' => 'btnSearchSubscribed']) ?>
                <input type="hidden" value="<?php echo Yii::$app->request->BaseUrl; ?>/admin/subscribed-users" id="searchUrl">
            </div>
            <div class="col-sm-6 col-xs-12 searchBtn" style="padding:0;">
                <?php echo Html::submitButton('<i class="fa fa-undo"></i>', ['class' => 'btn btn-success res-bnt', 'id' => 'btnResetSubscribed']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>    


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
            'email',
            'ip_address',
            [
                'attribute' => 'added_on',
                'label' => 'Created Date',
                'format' => ['date', 'php:'.$phpdateformat]
            ],
        ],
    ]);
\yii\widgets\Pjax::end();
    ?>
                