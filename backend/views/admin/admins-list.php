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
</style>
<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'Admins List';

$this->params['breadcrumbs'][] = $this->title;

$dateformat = Yii::getAlias('@phpdatepickerformat');
$phpdateformat = Yii::getAlias('@phpdateformat');
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
            <?php echo $form->field($model, 'adminname')->textInput(array('placeholder' => 'Admin Name'), ['class' => 'form-control']) ?>
        </div>
        <div class="searchBtn">
                <?php echo Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-success', 'id' => 'btnSearch']) ?>
                <input type="hidden" value="<?php echo Yii::$app->request->BaseUrl; ?>/admin/admins-list" id="searchUrl">
            </div>
            <div class="searchBtn" style="padding:0;">
                <?php echo Html::submitButton('<i class="fa fa-repeat"> </i>', ['class' => 'btn btn-success res-bnt', 'id' => 'btnReset']) ?>
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
                'attribute' => 'email',
                'label' => 'Email',
                'value' => function($model) {
                    return $model['email'] ? stripslashes($model['email']) : 'Not Assigned';
                }
            ],		
            [
                'attribute' => 'gender',
                'label' => 'Gender',
                'value' => function($model) {
                    return $model['gender'] ? stripslashes($model['gender']) : 'Not Assigned';
                }
            ],
            [
                'attribute' => 'mobile',
                'label' => 'Mobile',
                'value' => function($model) {
                    return $model['mobile'] ? stripslashes($model['mobile']) : 'Not Assigned';
                }
            ],
			['class' => 'yii\grid\ActionColumn',
                            'header'=> 'Delete' ,
                            //'options' => ['width' => '85'],
                            'headerOptions' => ['style' => 'width:142px'],
                            'template'=>'{delete}',
                            'buttons'=>[
                                        'delete'=>function ($url, $model) { 
                                            if(@$model['status'] == 1){    
                                            return HTML::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
                                                'title' => Yii::t('yii', 'delete'),
                                                'aria-label'=>"Delete",
                                                'class' => 'ajaxDelete', 
                                                'delete-url' => $url, 
                                                'pjax-container' => 'pjax-list',
                                                'data-confirm'=>'Are you sure you want to delete this Admin?',
                                            ]);                               
                                            }else if(@$model['status'] == 2){
                                                return HTML::a('<span class="glyphicon glyphicon-repeat"></span>',$url,[
                                                    'title' => Yii::t('yii', 'undo'),
                                                    'aria-label'=>"Delete",
                                                    'class' => 'ajaxDelete', 
                                                    'delete-url' => $url, 
                                                    'pjax-container' => 'pjax-list',
                                                    'data-confirm'=>'Are you sure you want to undo delete this Admin?',
                                                ]);        
                                            }
                                          }
                                      ],
                            'urlCreator' => function ($action, $model, $key, $index) {
                                if($action === 'delete'){
                                    return Url::toRoute(['admin-delete', 'id' => $model['user_ref_id'], 'status' => $model['status']]);
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

$(document).ready(function(){
	var name = "<?php echo !empty(Yii::$app->getRequest()->getQueryParam('name')) ? Yii::$app->getRequest()->getQueryParam('name') : '' ?>";
	$('#admin-adminname').val(name);
});
  
    $(function () {

        $('#btnSearch').on('click', function (e) {
            var searchUrl = $('#searchUrl').val();
            var pjaxContainer = 'pjax-list';
            var name = $('#admin-adminname').val();
                var pjaxReloadURL = searchUrl + '?name=' + name;

            $.ajax({
                url: searchUrl,
                type: 'get',
                data: {'name': name},
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


        $('#btnReset').on('click', function (e) {
            var searchUrl = $('#searchUrl').val();
            var pjaxContainer = 'pjax-list';
                var pjaxReloadURL = searchUrl;

            $.ajax({
                url: searchUrl,
                type: 'get',
                success: function (data) {
                    if (data) {
                        $('#admin-adminname').val('');
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