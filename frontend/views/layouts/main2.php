<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\CustomAsset;
CustomAsset::register($this);

//AppAsset::register($this);
$asset = ((Yii::$app->controller->action->id=='dynamic-map')? frontend\assets\GoogleAsset::register($this):frontend\assets\AppAsset::register($this));
$baseUrl = $asset->baseUrl;

?>
<?php
$bundle = new \DotsUnited\BundleFu\Bundle();
$bundle
    // Set the document root
    ->setDocRoot(Yii::getAlias('@webroot').'/themes/custom')

    // Set the css cache path (relative to the document root)
    ->setCssCachePath('css/cache')

    // Set the javascript cache path (relative to the document root)
    ->setJsCachePath('js/cache');
?>
<?php $bundle->start(); ?>     
    <link rel="stylesheet" type="text/css" href="css/components.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/hover.css" media="screen" />   
    <link rel="stylesheet" type="text/css" href="plugins/cubeportfolio/css/cubeportfolio.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="plugins/owl-carousel/owl.carousel.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="plugins/owl-carousel/owl.theme.css" media="screen" />   
	<link rel="stylesheet" type="text/css" href="./../../../../common/css/font-linearicons.css" media="screen" />
    <!--<link rel="stylesheet" type="text/css" href="css/fancybox.css" media="screen" />-->    
    
    <script type="text/javascript" src="plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
    <script type="text/javascript" src="plugins/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/masonry-portfolio.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
<?php $bundle->end(); ?>
    <!--<script type="text/javascript" src="js/components.js"></script>
    <script type="text/javascript" src="js/fancybox.js"></script>-->
<?php $this->beginPage() ?>

<!DOCTYPE html>
 <html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title);?></title>
	<link rel="icon" href="<?=Yii::getAlias('@web').'/images/favicon.png';?>" type="image/x-icon" />
    <script src="<?php echo Yii::$app->request->BaseUrl; ?>/js/jquery.min.js"></script>  
	<link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/themes/custom/css/style-wizard.css';?>" type="text/css" />
	

    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        
    <?php  echo $bundle->renderCss(); ?>
     <?php  echo $bundle->renderJs(); ?>    
	<script type="text/javascript" src="<?=Yii::getAlias('@web').'/js/aes.js'?>"></script>
	<script type="text/javascript" src="<?=Yii::getAlias('@web').'/js/aes-json-format.js'?>"></script>
	<script type="text/javascript" src="<?=Yii::getAlias('@web').'/themes/custom/js/encryptdata.js'?>"></script>
	<script src="<?php echo Yii::$app->request->BaseUrl; ?>/js/jquery.validate.min.js"></script>
	<script src="<?php echo Yii::$app->request->BaseUrl; ?>/js/additional-methods.js"></script>	
    <!--  Load twitter SDK for JavaScript  -->
    <?php if(Yii::$app->controller->action->id=='dynamic-new' || Yii::$app->controller->action->id=='index'){?>   
        <script>
			var siteUrl = '<?php echo Yii::getAlias('@web'); ?>';
            window.twttr = (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = siteUrl+"/themes/custom/js/tsdk.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function(f) {
            t._e.push(f);
            };

            return t;
            }(document, "script", "twitter-wjs"));

        </script>
     <?php } ?>

    <?php $this->head();	?>

</head>
<script>
var siteUrl = '<?php echo Yii::getAlias('@web'); ?>';
</script>
<body>

<?php $this->beginBody() ?>  

<input type='hidden' id='ip_name' name='ip_name' value="<?php echo getHostByName(getHostName()); ?>">
<input type='hidden' id='ip_name' name='ip_name' value="<?php echo gethostname();?>">

<?php require_once("_header.php"); 
    ?>
    <div class="wrap home-toggle">
    <?php
   /* NavBar::begin([
         'brandLabel' => Html::img('@web/themes/custom/images/logo.png', ['alt'=>Yii::$app->name]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
          ['label' => 'Home', 'url' => ['/site/index']],
        //['label' => 'About', 'url' => ['/site/about']],
          ['label' => 'Create Project', 'url' => ['/projects/create']],
          ['label' => 'How It Works', 'url' => ['/site/comingsoon']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
       require_once("_header1.php");
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>   
        
<?php
    } */
?>
        <div class="page-container">
            <?php require_once ('_content1.php');?>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
        </div>
    <?php require_once ('_footer.php');?>
      

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
$(document).ready(function(){
var siteUrl = '<?php echo Yii::getAlias('@web'); ?>';
});
</script>
