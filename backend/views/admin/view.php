<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
//print_r($model[0]); //die;
$model = $model[0];
$phpdateformat = Yii::getAlias('@phpdateformat');
$this->title = $model['username'];
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['admin_list']];
$this->params['breadcrumbs'][] = $this->title;
$phpdateformat = Yii::getAlias('@phpdateformat');
?>
<?php
echo "<h1 class='box-title'>$this->title </h1>";
?>
<div class="user-view participation-border fl-left">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->
<!--
    <p>
        <?= Html::a('Update', ['update', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->

    <style type="text/css">
        .userlist tbody tr td, .userlist tbody tr th {
            padding: 5px;
        }
    </style>
<!--<div style="width:100%">
  <div style="width:50%;float:left">
    <table width="100%" border="1" cellpadding="2" cellspacing="2" class="userlist">
        <tr>
		
            <th>Username</th>
            <td><?php// echo $model['username'] ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php //echo $model['status_name'] ?></td>
        </tr>
        <tr>
            <th>Created Date</th>
            <td><?php //echo date(stripslashes($phpdateformat), $model['created_at']) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php //echo $model['email'] ?></td>
        </tr>
        <tr>
            <th>User Type</th>
            <td><?php //echo $user_type ? $user_type : (!empty($admin_assigned_user_type) ? $admin_assigned_user_type:'-') ?></td>
        </tr>
        <tr>
        <?php //if($model['user_type_ref_id'] == 5 || $model['user_type_ref_id'] == 10) { ?>
            <th>Company Name</th>
            <td><?php// echo $model['name'] ?></td>
        <?php// } //elseif($model['user_type_ref_id'] == 3) { ?>
            <th>Name</th>
            <td><?php// echo $model['name'] ?></td>
        </tr>
        <tr>
            <th>Gender</th>
            <td><?php// echo $model['gender'] ?></td>
        <?php// } ?>
        </tr>
    </table>
	</div>

    <?php /* echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'username',
                'value' => stripslashes($model->username),
            ], 
            [
                'attribute'=>'status',
                'value' => $model['status'] == '1'?'Active':'Inactive',  
            ],
            [
                'attribute'=>'superadmin',
                'value' => $model['superadmin'] == '1'?'Yes':'No',  
            ],
            
            [
                'attribute'=>'created_at',       
                'format' => ['date', 'php:'.$phpdateformat]
            ],                  
            'email:email', 
            [
                'attribute'=>'user_type_ref_id',
                'label'=>empty($user_type)?'Assigned User Type':'User Type',
                'value' => $user_type?$user_type:(!empty($admin_assigned_user_type)?$admin_assigned_user_type:'-'),  
            ],            
            [
                'attribute'=>'fname',
                'label'=>'Name',
                'value' => !empty($data['fname'])?stripslashes($data['fname']).' '.!empty(stripslashes($data['lname'])) ? $data['lname'] : '' :'-'           
            ],
            [
                'attribute'=>'gender',
                'label'=>'gender',
                'value' => !empty($data['gender'])?$data['gender']:'-'
            ]
        ],
    ])*/ ?>
	<?php if($model['user_type_ref_id'] == 5 || $model['user_type_ref_id'] == 10) { ?>
	<div style="width:100%">
		<div style="width:50%;float:left">
				<table width="100%" border="1" cellpadding="2" cellspacing="2" class="userlist">
					<tr>
						<th>Email</th>
						<td><?php echo $model['email'] ?></td>
					</tr>
					<tr>
						<th>User Type</th>
						<td><?php echo $user_type ? $user_type : (!empty($admin_assigned_user_type) ? $admin_assigned_user_type:'-') ?></td>
					</tr>
					<tr>
						<th>Company Name</th>
						<td><?php echo $model['name'] ?></td>
					</tr>
					<tr>
						<th>Sector</th>
						<td><?php echo $details[0]['sector']; ?></td>
					</tr>
					<tr>
						<th>Representing Authority</th>
						<td><?php echo $details[0]['representing_authority']; ?></td>
					</tr>
					<tr>
						<th>Designation</th>
						<td><?php echo $details[0]['designation']; ?></td>
					</tr>
					
				</table>
		</div>
		<div style="width:50%;float:right">
			<table width="100%" border="1" cellpadding="2" cellspacing="2" class="userlist">
				<tr>
					<th>Communication Address</th>
					<td><?php echo $details[0]['communication_address']; ?></td>
				</tr>
				<tr>
					<th>Mobile</th>
					<td><?php echo $details[0]['mobile']; ?></td>
				</tr>
				<tr>
					<th>Portfolio</th>
					<td><?php echo $details[0]['portfolio']; ?></td>
				</tr>
				<tr>
					<th>About</th>
					<td><?php echo $details[0]['about']; ?></td>
				</tr>
				<tr>
					<th>Page Name</th>
					<td><?php echo $details[0]['pagename']; ?></td>
				</tr>
				<tr>
					<th></th>
					<td><?php// echo $details[0]['pagename']; ?></td>
				</tr>
			</table>
		</div>
	</div>	
		
	<?php } else {?>
	<div style="width:100%">
		<div style="width:50%;float:left">
				<table width="100%" border="1" cellpadding="2" cellspacing="2" class="userlist">
					<tr>
						<th>Email</th>
						<td><?php echo $model['email'] ?></td>
					</tr>
					<tr>
						<th>User Type</th>
						<td><?php echo $user_type ? $user_type : (!empty($admin_assigned_user_type) ? $admin_assigned_user_type:'-') ?></td>
					</tr>
					<tr>
						<th>UserName</th>
						<td><?php echo $details[0]['fname'].' '.$details[0]['lname'];  ?></td>
					</tr>
					<tr>
						<th>Mobile</th>
						<td><?php echo $details[0]['mobile']; ?></td>
					</tr>
					<tr>
						<th>Portfolio</th>
						<td><?php echo $details[0]['portfolio']; ?></td>
					</tr>
					
				</table>
		</div>
		<div style="width:50%;float:right">
			<table width="100%" border="1" cellpadding="2" cellspacing="2" class="userlist">
				<tr>
					<th>Gender</th>
					<td><?php echo $model['gender'] ?></td>
				</tr>
				<tr>
					<th>Date Of Birth</th>
					<td><?php echo $details[0]['dob']; ?></td>
				</tr>
				<tr>
					<th>About</th>
					<td><?php echo $details[0]['about']; ?></td>
				</tr>
				<tr>
					<th>Citizen</th>
					<td><?php echo $details[0]['citizen']; ?></td>
				</tr>
				<tr>
					<th>Page Name</th>
					<td><?php echo $details[0]['pagename']; ?></td>
				</tr>
			</table>
		</div>
	</div>
	<?php } ?>
</div>
