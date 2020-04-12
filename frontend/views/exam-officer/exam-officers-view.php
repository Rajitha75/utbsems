<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Exam Officer View';
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
<div class="center-table">
</br>
       <?php //print_r($examofficerdetails); exit;
        echo DetailView::widget([
                'model' => $examofficerdetails,
				'template' => '<tr><td style="width: 40% !important; font-weight:bold">{label}</td><td style="width: 80% !important;">{value}</td></tr>',
                'attributes' => [
                    [
                        'attribute' => 'Name',
                        'value' => stripslashes($examofficerdetails['name']),
                    ], 
                    [
                        'attribute'=>'Gender',
                        'value' => stripslashes($examofficerdetails['gender']),
                    ],
                    [
                        'attribute'=>'Martial Status',
                        'value' => stripslashes($examofficerdetails['martial_status']),
                    ],
                    
                    [
                        'attribute'=>'Age',
                        'value' => stripslashes($examofficerdetails['age']),
                    ],
                    [
                        'attribute'=>'Place of Birth',
                        'value' => stripslashes($examofficerdetails['place_of_birth']),
                    ],
		    [
                        'attribute'=>'Telephone No. (Mobile)',
                        'value' => stripslashes($examofficerdetails['telephone_mobile']),
                    ],
		    [
                        'attribute'=>'Telephone No. (Home)',
                        'value' => stripslashes($examofficerdetails['tele_home']),
                    ],
                    [
                        'attribute'=>'IC No',
                        'value' => stripslashes($examofficerdetails['ic_no']),
                    ],
                    [
                        'attribute'=>'Passport No',       
                        'value' => stripslashes($examofficerdetails['passportno']),
                    ],
                    [
                        'attribute'=>'Email',       
                        'value' => stripslashes($examofficerdetails['email']),
                    ],
                    [
                        'attribute'=>'Email (Other)',       
                        'value' => stripslashes($examofficerdetails['emailother']),
                    ],
                ],
        ]);
?>
	</div>
</div>
</div>
