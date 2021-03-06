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
                        'value' => stripslashes($studentdetails['title']).' '.stripslashes($studentdetails['name']),
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
                        'value' => stripslashes($studentdetails['ic_no_format']).' - '.stripslashes($studentdetails['ic_no']),
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
                        'attribute'=>'Age',       
                        'value' => stripslashes($studentdetails['age']),
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
                        'attribute'=>'Highest Qualification',       
                        'value' => stripslashes($studentdetails['highest_qualification']),
                    ],
                    [
                        'attribute'=>'Highest Qualification (Other)',       
                        'value' => ($studentdetails['highest_qualification'] == 'Other') ? stripslashes($studentdetails['highestqualificationother']) : 'NA',
                    ],
					[
                        'attribute'=>'Course Taken',
                        'value' => ($studentdetails['highest_qualification'] == 'Advanced National Diploma' || $studentdetails['highest_qualification'] == 'Higher National Diploma' || $studentdetails['highest_qualification'] == 'International Baccalaureate' || $studentdetails['highest_qualification'] == 'Undergraduate Degree' || $studentdetails['highest_qualification'] == 'Masters by Coursework' || $studentdetails['highest_qualification'] == 'Masters by Research' || $studentdetails['highest_qualification'] == 'Doctor of Philosophy (PhD)') ? stripslashes($studentdetails['highestqualification_coursetaken']) : 'NA',
                    ],
					[
                        'attribute'=>'Result',       
                        'value' => ($studentdetails['highest_qualification'] == 'Advanced National Diploma' || $studentdetails['highest_qualification'] == 'Higher National Diploma' || $studentdetails['highest_qualification'] == 'International Baccalaureate' || $studentdetails['highest_qualification'] == 'Undergraduate Degree' || $studentdetails['highest_qualification'] == 'Masters by Coursework' || $studentdetails['highest_qualification'] == 'Masters by Research' || $studentdetails['highest_qualification'] == 'Doctor of Philosophy (PhD)') ? stripslashes($studentdetails['highestqualification_result']) : 'NA',
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
                        'attribute'=>'Type of Residential',       
                        'value' => stripslashes($studentdetails['type_of_residential']),
                    ],
		    [
                        'attribute'=>'Type of Residential (Other)',       
                        'value' => ($studentdetails['type_of_residential'] == 'Other') ? stripslashes($studentdetails['typeofresidentialother']) : 'NA',
                    ],
                    [
                        'attribute'=>'Address Line',       
                        'value' => stripslashes($studentdetails['address']),
                    ],
                    /*[
                        'attribute'=>'Address Line 2',       
                        'value' => stripslashes($studentdetails['address2']),
                    ],
                    [
                        'attribute'=>'Address Line 3',       
                        'value' => stripslashes($studentdetails['address3']),
                    ],*/
		    [
                        'attribute'=>'Country',       
                        'value' => stripslashes($studentdetails['countrycode']),
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
                        'attribute'=>'Bank Account Name',       
                        'value' => stripslashes($studentdetails['bank_account_name']),
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
                        'attribute'=>'Type of Programme',       
                        'value' => stripslashes($studentdetails['type_of_programme']),
                    ],
                    [
                        'attribute'=>'Programme Name',       
                        'value' => stripslashes($studentdetails['programmename']),
                    ],
		    [
                        'attribute'=>'School/Faculty',       
                        'value' => stripslashes($studentdetails['faculty_name']),
                    ],
                    [
                        'attribute'=>'Entry',       
                        'value' => stripslashes($studentdetails['entry']),
                    ],
					[
                        'attribute'=>'Entry (Other)',       
                        'value' => ($studentdetails['entry'] == 'Other') ? stripslashes($studentdetails['entry_other']) : 'NA',
                    ],
                    [
                        'attribute'=>'Status of Student',       
                        'value' => stripslashes($studentdetails['status_of_student']),
                    ],
					[
                        'attribute'=>'Status of Student (Other)',       
                        'value' => ($studentdetails['status_of_student_other'] == 'Other') ? stripslashes($studentdetails['status_of_student_other']) : 'NA',
                    ],
                    [
                        'attribute'=>'Intake No',       
                        'value' => stripslashes($studentdetails['intake']),
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
                        'attribute'=>'Date of Registration',       
                        'value' => stripslashes($studentdetails['date_of_registration']),
                    ],
                    [
                        'attribute'=>'Date of Leaving',       
                        'value' => stripslashes($studentdetails['date_of_leaving']),
                    ],

                ],
            ]);
    ?>
	</div>
</div>
</div>
