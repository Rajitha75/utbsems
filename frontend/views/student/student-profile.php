<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Student Profile';
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

<div class="editprofile-sec">
    <div class="profileimage">
    <?php if (!file_exists('../../frontend/web/uploads/profile_images/'.$studentdetails['user_ref_id'].'/'.$studentdetails['user_image'])) { ?>
<img style="width:120px; height:130px"src="<?php echo 'frontend/web/images/avatar.png'; ?>" />
<?php }else{ ?>
    <img style="width:120px; height:130px"src="<?php echo 'frontend/web/uploads/profile_images/'.$studentdetails['user_ref_id'].'/'.$studentdetails['user_image']; ?>" />
<?php } ?>
</div>
<a class="btn" href="<?php echo Yii::$app->request->BaseUrl; ?>/../../student-edit-profile">Edit Profile</a></div>

       <br>
 
       
       </div>
<div class="container prjdetails" >
<div class="center-table">
       <h1 class="box-title" style="background-color:#31539c;"><?php echo "Personal Information"; ?></h1>
       <?php //print_r($studentdetails); exit;
        echo DetailView::widget([
                'model' => $studentdetails,
				'template' => '<tr><td style="width: 40% !important; font-weight:bold">{label}</td><td style="width: 80% !important;">{value}</td></tr>',
                'attributes' => [
                    [
                        'attribute' => 'Name',
                        'value' => stripslashes($studentdetails['name']),
                    ], 
                    [
                        'attribute'=>'Roll No',
                        'value' => stripslashes($studentdetails['rollno']),
                    ],
                    [
                        'attribute'=>'Rumpun',
                        'value' => stripslashes($studentdetails['rumpun']),
                    ],
                    
                    [
                        'attribute'=>'Nationality',
                        'value' => stripslashes($studentdetails['nationality']),
                    ],
                    [
                        'attribute'=>'Nationality (Other)',
                        'value' => ($studentdetails['nationality'] == 'Other') ? stripslashes($studentdetails['nationalityother']) : 'NA',
                    ],
                    [
                        'attribute'=>'IC No',
                        'value' => stripslashes($studentdetails['ic_no']),
                    ],
                    [
                        'attribute'=>'IC Color',
                        'value' => stripslashes($studentdetails['ic_color']),
                    ],
                    [
                        'attribute'=>'Passport No',       
                        'value' => stripslashes($studentdetails['passportno']),
                    ],
                    [
                        'attribute'=>'Race',       
                        'value' => stripslashes($studentdetails['race']),
                    ],
                    [
                        'attribute'=>'Race (Other)',       
                        'value' => ($studentdetails['race'] == 'Other') ? stripslashes($studentdetails['raceother']) : 'NA',
                    ],
                    [
                        'attribute'=>'Religion',       
                        'value' => stripslashes($studentdetails['religion']),
                    ],
                    [
                        'attribute'=>'Religion (Other)',       
                        'value' => ($studentdetails['religion'] == 'Other') ? stripslashes($studentdetails['religionother']) : 'NA',
                    ],
                    [
                        'attribute'=>'Gender',       
                        'value' => stripslashes($studentdetails['gender']),
                    ],
                    [
                        'attribute'=>'Martial Status',       
                        'value' => stripslashes($studentdetails['martial_status']),
                    ],
                    [
                        'attribute'=>'Date of Birth',       
                        'value' => stripslashes($studentdetails['dob']),
                    ],
                    [
                        'attribute'=>'Place of Birth',       
                        'value' => stripslashes($studentdetails['place_of_birth']),
                    ],
                    [
                        'attribute'=>'Telephone No.(Mobile)',       
                        'value' => stripslashes($studentdetails['telephone_mobile']),
                    ],
                    [
                        'attribute'=>'Telephone No.(Home)',       
                        'value' => stripslashes($studentdetails['tele_home']),
                    ],
                    [
                        'attribute'=>'Email',       
                        'value' => stripslashes($studentdetails['email']),
                    ],
                    [
                        'attribute'=>'Name of Last School Attended',       
                        'value' => stripslashes($studentdetails['lastschoolname']),
                    ],
                    [
                        'attribute'=>'Type of Entry',       
                        'value' => stripslashes($studentdetails['type_of_entry']),
                    ],
                    /*[
                        'attribute'=>'Type of Entry (Other)',       
                        'value' => ($studentdetails['type_of_entry'] == 'Other') ? stripslashes($studentdetails['typeofentryother']) : 'NA',
                    ],*/
                    [
                        'attribute'=>'Special Needs',       
                        'value' => stripslashes($studentdetails['specialneeds']),
                    ],
                ],
        ]);
?>
        <h1 class="box-title" style="background-color:#31539c;"><?php echo "Parents Information"; ?></h1> 
    <?php    echo DetailView::widget([
            'model' => $studentdetails,
            'template' => '<tr><td style="width: 40% !important; font-weight:bold">{label}</td><td style="width: 80% !important;">{value}</td></tr>',
            'attributes' => [
                    [
                        'attribute'=>'Father/Guardian Name',       
                        'value' => stripslashes($studentdetails['father_name']),
                    ],
                    [
                        'attribute'=>'Guardian Relation',       
                        'value' => stripslashes($studentdetails['gaurdian_relation']),
                    ],
                    [
                        'attribute'=>'Father/Guardian IC No',       
                        'value' => stripslashes($studentdetails['fathericno']),
                    ],
                    [
                        'attribute'=>'Father IC Color',       
                        'value' => stripslashes($studentdetails['father_ic_color']),
                    ],
                    [
                        'attribute'=>'Father\'s Telephone No',       
                        'value' => stripslashes($studentdetails['father_mobile']),
                    ],
                    [
                        'attribute'=>'Telephone No (Home)',       
                        'value' => stripslashes($studentdetails['mobile_home']),
                    ],
                    [
                        'attribute'=>'Father/Guardian Employment',       
                        'value' => stripslashes($studentdetails['gaurdian_employment']),
                    ],
                    [
                        'attribute'=>'Father/Guardian Employer',       
                        'value' => stripslashes($studentdetails['gaurdian_employer']),
                    ],
                    [
                        'attribute'=>'Remarks',       
                        'value' => stripslashes($studentdetails['remarks']),
                    ],
                    [
                        'attribute'=>'Telephone No. (Work)',       
                        'value' => stripslashes($studentdetails['telphone_work']),
                    ],
                    [
                        'attribute'=>'Mother Name',       
                        'value' => stripslashes($studentdetails['mother_name']),
                    ],
                    [
                        'attribute'=>'Mother IC No',       
                        'value' => stripslashes($studentdetails['mothericno']),
                    ],
                    [
                        'attribute'=>'Mother IC Color',       
                        'value' => stripslashes($studentdetails['mother_ic_color']),
                    ],
                    [
                        'attribute'=>'Mother\'s Telephone No',       
                        'value' => stripslashes($studentdetails['mother_mobile']),
                    ],
                ],
    ]);
?>
    <h1 class="box-title" style="background-color:#31539c;"><?php echo "Postal Address"; ?></h1> 
<?php    echo DetailView::widget([
        'model' => $studentdetails,
        'template' => '<tr><td style="width: 40% !important; font-weight:bold">{label}</td><td style="width: 80% !important;">{value}</td></tr>',
        'attributes' => [
                    [
                        'attribute'=>'Postal Address',       
                        'value' => stripslashes($studentdetails['address']),
                    ],
                    [
                        'attribute'=>'Address Line 2',       
                        'value' => stripslashes($studentdetails['address2']),
                    ],
                    [
                        'attribute'=>'Address Line 3',       
                        'value' => stripslashes($studentdetails['address3']),
                    ],
                    [
                        'attribute'=>'Postal Code',       
                        'value' => stripslashes($studentdetails['postal_code']),
                    ],
                ],
                ]);
            ?>
                <h1 class="box-title" style="background-color:#31539c;"><?php echo "Bank Details"; ?></h1> 
            <?php    echo DetailView::widget([
                    'model' => $studentdetails,
                    'template' => '<tr><td style="width: 40% !important; font-weight:bold">{label}</td><td style="width: 80% !important;">{value}</td></tr>',
                    'attributes' => [
                    [
                        'attribute'=>'Bank Name',       
                        'value' => stripslashes($studentdetails['bank_name']),
                    ],
                    [
                        'attribute'=>'Bank Account No',       
                        'value' => stripslashes($studentdetails['account_no']),
                    ],
                ],
                ]);
            ?>
                <h1 class="box-title" style="background-color:#31539c;"><?php echo "Programme Information"; ?></h1> 
            <?php    echo DetailView::widget([
                    'model' => $studentdetails,
                    'template' => '<tr><td style="width: 40% !important; font-weight:bold">{label}</td><td style="width: 80% !important;">{value}</td></tr>',
                    'attributes' => [
                        [
                            'attribute'=>'Sponsor Type',       
                            'value' => stripslashes($studentdetails['sponsor_type']),
                        ],
                        /*[
                            'attribute'=>'Sponsor Type (Other)',       
                            'value' => ($studentdetails['sponsor_type'] == 'Other') ? stripslashes($studentdetails['sponsor_type_other']) : 'NA',
                        ],*/
                    [
                        'attribute'=>'Programme Name',       
                        'value' => stripslashes($studentdetails['programmename']),
                    ],
                    [
                        'attribute'=>'Entry',       
                        'value' => stripslashes($studentdetails['entry']),
                    ],
                    [
                        'attribute'=>'Status of Student',       
                        'value' => stripslashes($studentdetails['status_of_student']),
                    ],
                    [
                        'attribute'=>'Status Remarks',       
                        'value' => stripslashes($studentdetails['status_remarks']),
                    ],
                    [
                        'attribute'=>'Intake',       
                        'value' => stripslashes($studentdetails['intake']),
                    ],
                    [
                        'attribute'=>'Entry',       
                        'value' => stripslashes($studentdetails['entry']),
                    ],
                    [
                        'attribute'=>'Mode',       
                        'value' => stripslashes($studentdetails['mode']),
                    ],
                    [
                        'attribute'=>'UTB Email Address',       
                        'value' => stripslashes($studentdetails['utb_email_address']),
                    ],
                    [
                        'attribute'=>'Degree Classification',       
                        'value' => stripslashes($studentdetails['degree_classification']),
                    ],
                    [
                        'attribute'=>'Date of Registration',       
                        'value' => stripslashes($studentdetails['date_of_registration']),
                    ],
                    [
                        'attribute'=>'Date of Leaving',       
                        'value' => stripslashes($studentdetails['date_of_leaving']),
                    ],
                    [
                        'attribute'=>'Previous Roll No',       
                        'value' => stripslashes($studentdetails['previous_roll_no']),
                    ],
                    [
                        'attribute'=>'Previous Programme Name',       
                        'value' => stripslashes($studentdetails['previous_programme_name']),
                    ],
                    [
                        'attribute'=>'Previous Intake No',       
                        'value' => stripslashes($studentdetails['previous_intake_no']),
                    ],
                    [
                        'attribute'=>'Previous UTB Email',       
                        'value' => stripslashes($studentdetails['previous_utb_email']),
                    ],

                ],
            ]);
    ?>
	</div>
</div>
</div>
