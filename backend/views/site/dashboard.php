<style type="text/css">
    .dashboard-stat.red {
        background-color: #e7505a !important;
    }
    .dashboard-stat.green {
        background-color: #32c5d2 !important;
    }
    /*.slimScrollDiv {
            width: 100% !important;
    }
    .feeds li .col1>.cont>.cont-col2>.desc {
            margin-left: 0px !important;
    }*/

    .dashboard-page .portlet.light span {
        color: #fff;
    }
    .txtComments {
        width: 100%;
        min-height: 58px;
        border: 0px;
        background: none;
    }
    .table-events.table-head-fix{}
    .table-events.table-head-fix .table-head-fix-body{ overflow-y:auto; height:350px;}
	.unread{
	font-weight:bold;
}
</style>

<?php if(Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') { ?>
    <script src="<?php echo Yii::getAlias('@web'); ?>/themes/metronic/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<?php } ?>
                                <?php
//$this->registerJsFile(yii::getAlias('@web/themes/metronic/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'),['position' => \yii\web\View::POS_HEAD]);
                                ?>

<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Dashboard & Statistics ';
	$phpdateformat = Yii::getAlias('@phpdateformat');
?>



<div class="dashboard-page">
    <h3 class="page-title"> Dashboard & Statistics
      
    </h3>
	<input type='hidden' id='amin_side' value='1'>
  

</div>

   
