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
        <?php echo $form->field($model, 'programme_name')
		->dropDownList(['Bachelor of Business in Applied Economics and Finance' => 'Bachelor of Business in Applied Economics and Finance',
		'Bachelor of Business in Accounting and Information Systems' => 'Bachelor of Business in Accounting and Information Systems',
		'Bachelor of Business in Business Information System' => 'Bachelor of Business in Business Information System',
		'Bachelor of Business in Business Information System(Part Time)' => 'Bachelor of Business in Business Information System(Part Time)',
		'Bachelor of Business in Finance and Risk Management' => 'Bachelor of Business in Finance and Risk Management',
		'Government Scholarship' => 'Government Scholarship',
		'Bachelor of Business in Marketing and Information Systems' => 'Bachelor of Business in Marketing and Information Systems',
		'Bachelor of Business in Technology Management' => 'Bachelor of Business in Technology Management',
		'Master in Management and Technology' => 'Master in Management and Technology',
		'Bachelor of Science in Computing with Data Analytic' => 'Bachelor of Science in Computing with Data Analytic',
		'Bachelor of Science in Creative Multimedia' => 'Bachelor of Science in Creative Multimedia',
		'Bachelor of Science in Computer Network and Security' => 'Bachelor of Science in Computer Network and Security',
		'Bachelor of Science in Computing' => 'Bachelor of Science in Computing',
		'Bachelor of Science in Digital Media' => 'Bachelor of Science in Digital Media',
		'Bachelor of Science in Internet Computing' => 'Bachelor of Science in Internet Computing',
		'Master in Computer Information System' =>  'Master in Computer Information System',
		'Bachelor of Science in Applied Mathematics and Economics' => 'Bachelor of Science in Applied Mathematics and Economics',
		'Bachelor of Science in Food Science and Technology' => 'Bachelor of Science in Food Science and Technology',
		'Bachelor of Science in Architecture' => 'Bachelor of Science in Architecture',
		'Bachelor of Science in Product Design' => 'Bachelor of Science in Product Design',
		'Bachelor of Engineering in Civil Engineering' => 'Bachelor of Engineering in Civil Engineering',
		'Bachelor of Engineering in Chemical Engineering' => 'Bachelor of Engineering in Chemical Engineering',
		'Bachelor of Engineering in Civil and Structural Engineering' => 'Bachelor of Engineering in Civil and Structural Engineering',
		'Bachelor of Engineering in Electrical and Electronics' => 'Bachelor of Engineering in Electrical and Electronics',
		'Bachelor of Engineering in Mechatronic Engineering' => 'Bachelor of Engineering in Mechatronic Engineering',
		'Bachelor of Engineering in Mechanical Engineering' => 'Bachelor of Engineering in Mechanical Engineering',
		'Bachelor of Engineering in Petroleum Engineering' => 'Bachelor of Engineering in Petroleum Engineering',
		'Master of Science in Mechanical Engineering' => 'Master of Science in Mechanical Engineering',
		'Master in Water Resources and Environmental Engineering' => 'Master in Water Resources and Environmental Engineering',
		'Bachelor of Business in Business Information Management' => 'Bachelor of Business in Business Information Management',
		'Bachelor of Business in Business Information Management (Part Time)' => 'Bachelor of Business in Business Information Management (Part Time)',
		'Master in Management and Technology (Part Time)' => 'Master in Management and Technology (Part Time)',
		'Bachelor of Science in Internet Computing (Part Time)' => 'Bachelor of Science in Internet Computing (Part Time)',
		'Master in Information Security' => 'Master in Information Security',
		'Bachelor of Science in Computer and Information Security' => 'Bachelor of Science in Computer and Information Security',
		'Master in Information Security (Part Time)' => 'Master in Information Security (Part Time)',
		'Master of Science in Electrical and Electronic Engineering' => 'Master of Science in Electrical and Electronic Engineering'],['prompt' => 'Select Programme Name'])->label('Programme Name <span class="mandatory">*</span>');?>

        </div>
        <div class="searchBtn">
                <?php echo Html::submitButton('<i class="icon-magnifier"></i>', ['class' => 'btn btn-success', 'id' => 'btnSearch']) ?>
                <input type="hidden" value="<?php echo Yii::$app->request->BaseUrl; ?>/admin/students-list" id="searchUrl">
            </div>
            <div class="searchBtn" style="padding:0;">
                <?php echo Html::submitButton('<i class="fa fa-repeat"> </i>', ['class' => 'btn btn-success res-bnt', 'id' => 'btnReset']) ?>
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
                'label' => 'Email',
                'value' => function($model) {
                    return $model['email'] ? stripslashes($model['email']) : 'Not Assigned';
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                            'header'=> 'View | Edit' ,
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
                                                'data-confirm'=>'Are you sure you want to delete this User?',
                                            ]);                               
                                            }else if(@$model['status'] == 2){
                                                return HTML::a('<span class="glyphicon glyphicon-repeat"></span>',$url,[
                                                    'title' => Yii::t('yii', 'undo'),
                                                    'aria-label'=>"Delete",
                                                    'class' => 'ajaxDelete', 
                                                    'delete-url' => $url, 
                                                    'pjax-container' => 'pjax-list',
                                                    'data-confirm'=>'Are you sure you want to delete this User?',
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
                                    return Url::toRoute(['student-update', 'id' => $model['id']]);
                                }else if($action === 'delete'){
                                    return Url::toRoute(['delete', 'id' => $model['user_ref_id'], 'status' => $model['status']]);
                                }else if ($action === 'creatempdf') {

                                    return Url::toRoute(['creatempdf', 'id' => $model['id']]);
            
                                    }else {
                                    return Url::toRoute(['student-view', 'id' => $model['id']]);
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