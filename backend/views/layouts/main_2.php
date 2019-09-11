<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;


$asset = backend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;

?>
<style>
.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:focus{background: #00224c;}
.navbar-inverse {
    background: #00224c;
}
ul#w1 {
    margin-top: 15px;
    }
	ul#w1 li:first-child {
      margin-top: -14px;
     }
</style>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>   

    <?php $this->head() ?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<?php $this->beginBody() ?>

<input type='hidden' id='ip_name' name='ip_name' value="<?php echo getHostByName(getHostName()); ?>">
<input type='hidden' id='ip_name' name='ip_name' value="<?php echo gethostname();?>">

<?php require_once("_header.php");?>

<div class="wrap">  
    <div class="page-container">
        <?php require_once ('_content.php');?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <?php require_once('_footer.php');?>
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
