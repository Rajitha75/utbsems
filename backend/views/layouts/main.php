<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\db\Query;

$asset = backend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;

?>
<?php
 $imagePath = (PROD == 1)?'/frontend/web': Yii::$app->request->BaseUrl; ?>   
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>   
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<?php // echo $bundle->renderCss(); ?>
<script src="<?php echo $baseUrl;?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<?php // echo $bundle->renderJs(); ?>
    <?php $this->head() ?>
<script>
var BasesiteUrl = '<?php echo Yii::getAlias('@web'); ?>';
$(document).ready(function(){
 $('#logoutuser').hide();
 });
</script>	
<script type="text/javascript" src="<?php echo $baseUrl;?>/assets/global/scripts/encrypt/aes.js"></script>	
<script type="text/javascript" src="<?php echo $baseUrl;?>/assets/global/scripts/encrypt/aes-json-format.js"></script>		
<script type="text/javascript" src="<?php echo $baseUrl;?>/assets/global/scripts/encrypt/secretkey.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/assets/global/scripts/encrypt/encryptdata.js"></script>
<script src="<?php echo Yii::$app->request->BaseUrl; ?>/themes/metronic/assets/global/scripts/jquery.validate.min.js"></script>
<script src="<?php echo Yii::$app->request->BaseUrl; ?>/themes/metronic/assets/global/scripts/additional-methods.js"></script>	
<style>
    #w0-collapse #w1 li a{
        font-size: 14px !important; 
        font-weight: bold;
        font-family: headerfont;
        text-transform: uppercase;
    }
    .navbar-inverse .navbar-nav>li>a, .navbar-inverse .navbar-text{
        color: #fff !important;
    }
	.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:focus{background: #00224c;}
	.navbar-inverse {
    background: #00224c;
}
	ul#w1 {
    margin-top: 15px;
    }
	ul.navbar-nav.navbar-right.nav{margin-top:10px;}
	#w0-collapse #w1 li a{text-transform: capitalize;}
	.drpdwn ul.dropdown-menu{margin-top:10px;}
	.drpdwn a.dropdown-toggle{margin-top:0 !important;}
	.drpdwn ul.dropdown-menu{margin-top:2px !important;}
	ul.navbar-nav.navbar-right.nav li{list-style:none;}
	#w0 .container{width:100%; padding:0 3%;}
</style>

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<?php $this->beginBody() ?>

<input type='hidden' id='ip_name' name='ip_name' value="<?php echo getHostByName(getHostName()); ?>">
<input type='hidden' id='ip_name' name='ip_name' value="<?php echo gethostname();?>">

<?php  require_once("_header.php");?>

    
    <div class="page-container">
        <?php if($this->context->action->id != 'login') require_once ('_content.php');?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>

                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
<!--        </div>-->
        <!-- END CONTAINER -->
</div>


<footer class="footer">
    <div class="container">
        <?php  require_once('_footer.php');?>
<!--        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
