<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Lecturer Dashboard';
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['admin_list']];
$this->params['breadcrumbs'][] = $this->title;
$phpdateformat = Yii::getAlias('@phpdateformat');

?>

<style>
    .table-striped.table>tbody>tr>td { white-space: inherit !important; }
    .fancybox-wrap { width: 60% !important; margin: 0 auto; }
    .fancybox-inner { width: 100% !important; }
</style>
<script>
$(document).ready(function(){
   // $('.prjdetails td').attr('align','center');
})
</script>

<div class="user-view participation-border fl-left" style="margin-top: 80px;">
<div> 
<h1 class="box-title"><?php echo Html::encode($this->title) ?></h1>

<div class="container prjdetails" >
</div>
</div>
