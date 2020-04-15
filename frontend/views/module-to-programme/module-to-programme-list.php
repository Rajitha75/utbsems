
<?php
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\bootstrap\Alert;
use yii\helpers\Url;

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'totalCount' => $count,
    'pagination' => [
        'pageSize' => 10,
    ],
        ]);
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
$this->title = 'Module-Programme-List';
echo "<h1 class='box-title'>$this->title </h1>"; ?>
<?php if (Yii::$app->session->getFlash('moduletoprogrammeexists') || Yii::$app->session->getFlash('moduletoprogrammesaved') || Yii::$app->session->getFlash('moduletoprogrammeupdate') || Yii::$app->session->getFlash('moduletoprogrammedeleted')) { 
if(Yii::$app->session->getFlash('moduletoprogrammeexists')){
	$issuccess = 'Failed!';
	$msg = Yii::$app->session->getFlash('moduletoprogrammeexists');
}else if(Yii::$app->session->getFlash('moduletoprogrammesaved')){
	$issuccess = 'Success!';
	$msg = Yii::$app->session->getFlash('moduletoprogrammesaved');
}else if(Yii::$app->session->getFlash('moduletoprogrammeupdate')){
	$issuccess = 'Success!';
	$msg = Yii::$app->session->getFlash('moduletoprogrammeupdate');
}else if(Yii::$app->session->getFlash('moduletoprogrammedeleted')){
	$issuccess = 'Success!';
	$msg = Yii::$app->session->getFlash('moduletoprogrammedeleted');
}
?>
<div id="manualfeedback" ><div id="forceflashmodal" class="alert-success front-noti alert fade in" style="z-index: 999999">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg"><?php echo $issuccess; ?></div><div class="head-text"><?php echo $msg; ?></div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>

</div></div>
<?php } ?>
<div class="login_page" style="padding-top:2%;">
<div class="site-login container">
 <div class="row">
        <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
       
        	<div class="panel-body">

 
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
                'attribute' => 'programme_name',
                'label' => 'Programme Name',
                'value' => function($model) {
                    return $model['programme_name'] ? stripslashes($model['programme_name']) : 'Not Assigned';
                }
            ],
			[
							'format' => 'raw',
                            'attribute' => 'module_name',
							 'options' => ['width' => '180'],
                            'value' => function ($model) {   
                                return $model['module_name'] ? stripslashes($model['module_name']) : 'Not Assigned';
                            }
                        ],
						[
							'format' => 'raw',
                            'attribute' => 'semester',
							 'options' => ['width' => '180'],
                            'value' => function ($model) {   
                                return $model['semister'] ? stripslashes($model['semister']) : 'Not Assigned';
                            }
                        ],
            ['class' => 'yii\grid\ActionColumn',
                            'header'=> 'Edit | Delete' ,
                            //'options' => ['width' => '85'],
                            'headerOptions' => ['style' => 'width:142px'],
                            'template'=>'{update}{delete}',
                            'buttons'=>[
                                        'update' => function ($url, $model) {
										  return Html::a('<span class="glyphicon glyphicon-pencil" title="Edit"></span>', $url, [
                                                  'title' => Yii::t('yii', 'update'),'data-pjax' => 0
                                          ]); 
                                        },
                                         'delete'=>function ($url, $model) {  
                                            return HTML::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
                                                'title' => Yii::t('yii', 'delete'),
                                                'aria-label'=>"Delete",
                                                'class' => 'ajaxDelete', 
                                                'delete-url' => $url, 
                                                'pjax-container' => 'pjax-list',
                                                'data-confirm'=>'Are you sure you want to delete this record?',
                                            ]);                      
                                          },
                                      ],
                            'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'update') {
                                    return Url::toRoute(['../../update-module-to-programme', 'id' => $model['id']]);
                                }else if($action === 'delete'){
                                    return Url::toRoute(['delete-module-to-programme', 'id' => $model['id']]);
                                }
                            } 
                        ],
    ],
]);
\yii\widgets\Pjax::end();
?>
<div id="dataConfirmModal" class="confirm-box" style="display:none;">
    <h3 id="dataConfirmLabel" >Please Confirm</h3>   
    <div style="text-align:right;margin-top:10px;">
        <input class="dataConfirmCancel btn btn-secondary" onclick="$('#dataConfirmModal').css('display','none');" type="button" value="Cancel">
        <input class="dataConfirmOK btn btn-primary" onclick="updateStatus()" type="button" value="Ok">
    </div>
</div>
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
<script>
 function updateStatus(){
    var deleteUrl = $('#updateUrl').val();
    var pjaxContainer = $('#ajaxContainer').val();
     $.ajax({
     url:   deleteUrl,
     type: 'post',
     success: function(data){ 
alert(data)
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