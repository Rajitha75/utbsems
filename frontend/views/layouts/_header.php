
<link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet"> 
<style>
    
         
        ul.nav li.dropdown:hover > .dropdown-menu {
            display: block;
        }
 
                </style>



<?php 
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\Alert;
use common\models\Storage;
use yii\db\Query;
$storagemodel = new \common\models\Storage();
if (($flash = Yii::$app->session->getFlash('signupsuccess') || $flash = Yii::$app->session->getFlash('studentupdatesuccesssave') || $flash = Yii::$app->session->getFlash('studentupdatesuccesssubmit') || $flash = Yii::$app->session->getFlash('change_password')) ) {
   // echo Alert::widget(['options' => ['class' => 'alert-success front-noti', 'id' => 'flashmodal', 'style' => 'z-index: 999999'], 'body' => $flash]);
}
?>
<nav class="navbar navbar-default navbar-fixed-top" id="mainNav">
    <div class="container-fluid">
        <div class="">

            <!-- Navbar Header [collects both toggle button and navbar brand] -->
            <div class="navbar-header col-lg-2">
                <!-- Toggle Button [handles opening navbar menu on mobile screens]-->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#exampleNavComponents" aria-expanded="false"><!--menu-->
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>

                <!-- Navbar Brand -->
                <a href="<?php echo yii::getAlias('@web'); ?>/../../" class="navbar-brand ">
                    <img style="width:235px" src="<?php echo Yii::getAlias('@web'); ?>/images/homepage/utb-logo.png">
                </a>
            </div>


            <!-- Navbar Collapse [collect navbar components such as navbar links and forms ] -->
            <div class="collapse navbar-collapse col-lg-8" id="exampleNavComponents">

                <!-- Navbar Links -->
                <ul class="nav navbar-nav menu_header hbar">
                    <?php if(Yii::$app->user->id){ ?>
					<?php $user = (new Query())->select(['user_image'])->from('user AS u')->where(['id' => Yii::$app->user->id])->one(); ?>
                    <?php if(Yii::$app->session['userRole'] == 2) { ?><li><a class="myprofile" href="<?php echo Yii::$app->request->BaseUrl; ?>/../../student-profile">My profile </a> </li><?php } ?>
					<?php if(Yii::$app->session['userRole'] == 2) { ?><li><a class="myprofile" href="<?php echo Yii::$app->request->BaseUrl; ?>/../../change-password">Change Password </a> </li><?php } ?>
                     <?php }else{ ?>
                    <li><a href="<?php echo Yii::$app->request->BaseUrl; ?>/../../student-login">Student Login</a></li>
                    <li> <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../lecturer-login">Lecturers Login</a> </li>                   
                    <li> <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../exam-officers-login">Exam Officers Login</a> </li>                   
                    <li> <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../backend/web/site/login">Administrator Login</a> </li>
                    <?php } ?>  
                    <?php if(isset(Yii::$app->user->identity->id)) { ?>
                <li>
                                <form class="logoutform" action="<?php echo Yii::$app->homeUrl;?>site/logout" method="post" style="margin:0px;">
                                    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken(); ?>">
                                    <button type="submit" class="no-style">Log Out</button>
									</form>
                            </li>
                    <?php } ?>            

                        </ul>
                        <div class="icon text-right option pull-right" id="notess">

                
            </div>
            </div>

            


            
        </div>
    </div>

</nav>
<div class="checkcontent" style="display:none"></div>


<style>
.myprofile{
    margin-top: -8px;
}
.logoutform button{
    font-weight: bold;
    color: #FFFFFF;
}
.hbar{
    float:right;
}
.openBtn {
    border: none;
  cursor: pointer;
    background: transparent;
}

.overlay {
  height: 100%;
  width: 100%;
  display: none;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.48);
     z-index: 999999 !important;
}

.overlay-content {
  position: relative;
  width:85%;
  text-align: left;
  margin-top: 15px !important;
  margin: auto;
   
}

.overlay .closebtn {
position: absolute;
    top: 9px;
   right: -45px;
  font-size: 60px;
  cursor: pointer;
  color: white;
    z-index: 9999999
}

.overlay .closebtn:hover {
  color: #ccc;
}

.overlay input[type=text] {
/*  padding: 15px;*/
  border: none;
  float: left;
  width: 80%;
  background: white;
    border-radius: 0;
        outline: 0;
    height: 50px;
    padding-left: 15px;
}


.overlay button {
  float: left;
  width: 50px;
/* padding: 15px;*/
  background: #6bdab3;
  border: none;
  cursor: pointer;
    height: 50px
}



</style>
<?php if (($flash = Yii::$app->session->getFlash('signupsuccess') || $flash = Yii::$app->session->getFlash('studentupdatesuccesssubmit') || $flash = Yii::$app->session->getFlash('studentupdatesuccesssave') || $flash = Yii::$app->session->getFlash('studentdetails') || $flash = Yii::$app->session->getFlash('studentdetailsverified') || $flash = Yii::$app->session->getFlash('examofficerupdate') || $flash = Yii::$app->session->getFlash('examofficercreate') || $flash = Yii::$app->session->getFlash('examofficerdelete') || $flash = Yii::$app->session->getFlash('examofficerundodelete') || $flash = Yii::$app->session->getFlash('lecturerdelete') || $flash = Yii::$app->session->getFlash('lecturerundodelete') || $flash = Yii::$app->session->getFlash('lecturerupdate') || $flash = Yii::$app->session->getFlash('lecturercreate') || $flash = Yii::$app->session->getFlash('studentcreated') || $flash = Yii::$app->session->getFlash('studentupdatesuccess') || $flash = Yii::$app->session->getFlash('studentdelete') || $flash = Yii::$app->session->getFlash('studentundodelete') || $flash = Yii::$app->session->getFlash('editformpasaved') || $flash = Yii::$app->session->getFlash('editformpasubmitted') || $flash = Yii::$app->session->getFlash('editformfssaved') || $flash = Yii::$app->session->getFlash('editformfssubmitted') || $flash = Yii::$app->session->getFlash('editformuebsaved') || $flash = Yii::$app->session->getFlash('editformuebsubmitted') || $flash = Yii::$app->session->getFlash('change_password')) ) { 
    if(Yii::$app->session->getFlash('studentdelete')){
    $flashmsg = 'Student Deleted successfully!'; 
    }
	if(Yii::$app->session->getFlash('studentundodelete')){
    $flashmsg = 'Student Delete Undo Success!'; 
    }
	if(Yii::$app->session->getFlash('signupsuccess')){
    $flashmsg = 'You are registered successfully!'; 
    }
	if(Yii::$app->session->getFlash('studentcreated')){
    $flashmsg = 'Student created successfully'; 
    }
	if(Yii::$app->session->getFlash('studentupdatesuccess')){
    $flashmsg = 'Student updated successfully'; 
    }
    if(Yii::$app->session->getFlash('examofficercreate')){
    $flashmsg = 'Exam officer created successfully'; 
    }
    if(Yii::$app->session->getFlash('examofficerupdate')){
    $flashmsg = 'Exam officer updated successfully'; 
    }
    if(Yii::$app->session->getFlash('studentupdatesuccesssubmit')){
        $flashmsg = 'Profile Updated successfully! '; 
        }
		if(Yii::$app->session->getFlash('examofficerdelete')){
    $flashmsg = 'Exam officer Deleted successfully'; 
    }
    if(Yii::$app->session->getFlash('examofficerundodelete')){
        $flashmsg = 'Exam officer Delete Undo Success! '; 
        }
		if(Yii::$app->session->getFlash('lecturercreate')){
    $flashmsg = 'Lecturer created successfully'; 
    }
    if(Yii::$app->session->getFlash('lecturerupdate')){
    $flashmsg = 'Lecturer updated successfully'; 
    }
	if(Yii::$app->session->getFlash('lecturerdelete')){
    $flashmsg = 'Lecturer Deleted successfully'; 
    }
    if(Yii::$app->session->getFlash('lecturerundodelete')){
        $flashmsg = 'Lecturer Delete Undo Success! '; 
        }
	if(Yii::$app->session->getFlash('studentupdatesuccesssave')){
        $flashmsg = 'Profile Saved successfully! '; 
        }
        if(Yii::$app->session->getFlash('studentdetails')){
            $flashmsg = 'Thank you for creating an account at UTBSEMS. </br>Thank you for your interest to study in UTB.</br>You may now login and submit online application '; 
            }
		if(Yii::$app->session->getFlash('studentdetailsverified')){
            $flashmsg = 'Your email is already verified '; 
            }
			if(Yii::$app->session->getFlash('editformpasaved')){
            $flashmsg = 'Saved to Stage Programme Area'; 
            }
			if(Yii::$app->session->getFlash('editformpasubmitted')){
            $flashmsg = 'Submitted to Stage Programme Area'; 
            }
			if(Yii::$app->session->getFlash('editformfssaved')){
            $flashmsg = 'Saved to Stage Faculty/School Exam Boarda'; 
            }
			if(Yii::$app->session->getFlash('editformfssubmitted')){
            $flashmsg = 'Submitted to Stage Faculty/School Exam Board'; 
            }
			if(Yii::$app->session->getFlash('editformuebsaved')){
            $flashmsg = 'Saved to Stage University Exam Board'; 
            }
			if(Yii::$app->session->getFlash('editformuebsubmitted')){
            $flashmsg = 'Submitted to Stage University Exam Board'; 
            }
			if(Yii::$app->session->getFlash('change_password')){
            $flashmsg = 'Password Changed Successfully'; 
            }
        ?>
<div id="manualfeedback" ><div id="forceflashmodal" class="alert-success front-noti alert fade in" style="z-index: 999999">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text"><?php echo $flashmsg; ?></div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>

</div></div>
<div style="display:none;" class="forgotpasswordresetmodal" data-toggle="modal" data-target="#forgotpasswordresetmodal"></div>
<?php } ?>
  <?php
  $model = new common\models\LoginForm();
			if(Yii::$app->request->post()){
			$post_variables =Yii::$app->request->post('LoginForm');  		

			}
			
			?>
 <!-- Latest compiled and minified JavaScript -->
<!--<script src="js/bootstrap.min.js" type="text/javascript"></script>-->


<style>
    .option .navbar-nav > li{
           padding: 0px 2px;
    }
    .option .nav > li > a{
        padding: 10px 12px;
    }
</style>

<script>
$(document).ready(function() {
$('#forceflashmodal .button-ok').click(function(){
        $('#forceflashmodal').hide();
    });
});
</script>