
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
if (($flash = Yii::$app->session->getFlash('studentdelete')) || ($flash = Yii::$app->session->getFlash('studentundodelete')) || ($flash = Yii::$app->session->getFlash('signupsuccess')) || ($flash = Yii::$app->session->getFlash('admincreatesuccess')) || ($flash = Yii::$app->session->getFlash('studentupdatesuccess')) ) {
    echo Alert::widget(['options' => ['class' => 'alert-success front-noti', 'id' => 'flashmodal', 'style' => 'z-index: 999999'], 'body' => $flash]);
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
                <a href="<?php echo yii::getAlias('@web'); ?>/../../backend/web/" class="navbar-brand ">
                    <img style="width:235px" src="<?php echo Yii::getAlias('@web'); ?>/images/utb-logo.png">
                </a>
            </div>


            <!-- Navbar Collapse [collect navbar components such as navbar links and forms ] -->
            <div class="collapse navbar-collapse col-lg-8" id="exampleNavComponents">

                <!-- Navbar Links -->
                <ul class="nav navbar-nav menu_header">
                <?php if(!Yii::$app->user->id){ ?>
                   <li><a href="<?php echo Yii::$app->request->BaseUrl; ?>/../../student-login">Student Login</a></li>
                    <li> <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../professor-login">Professors Login</a> </li>    
                    <li> <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../exam-officers-login">Exam Officers Login</a> </li>                                  
                    <li> <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../backend/web/site/login">Administrator Login</a> </li>
                <?php } if(Yii::$app->user->id){ ?>
                        <li class="login-sec">
                                    <form action="<?php echo Yii::$app->homeUrl;?>site/logout" method="post">
                                        <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken(); ?>">
                                            <a href="javascript:void(0)" class="tp-nav-btn">
                                                <button type="submit" class="no-style">
                                                <i class="icon-key"></i> Log Out 
                                                </button>
                                            </a>
                                    </form>
                                </li>
                    <?php } ?>
			    <li>


                        </ul>
            </div>


            </div>
        </div>
    </div>

</nav>
<div class="checkcontent" style="display:none"></div>

<style>
.searchBtn{
width: 42px;
float: left;
}
.page-sidebar{
    float:left;
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



    .ser_mob i.fa.fa-search{
        font-size: 16px;
        color: #fff;
    }
    
    .overlay-content i.fa.fa-search{
         font-size: 19px;
         color: #fff !important;
    }
    #se .closebtn{
         color: #fff !important;
    }
</style>
<div id="manualfeedback" style="display:none;"><div id="forceflashmodal" class="alert-success front-noti alert fade in" style="z-index: 999999">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

<div class="update-created"> <div class="header-flash-msg" style="text-align: center; padding: 20px 10px;"><span class="lnr lnr-checkmark-circle"></span></div><div class="success-msg">Success!</div><div class="head-text">Your feedback has been submitted successfully.</div><div class="flash-content">&nbsp;</div><div class="button-sucess"><input type="button" class="button-ok" data-dismiss="alert" aria-hidden="true" value="OK"></div></div>

</div></div>
<div style="display:none;" class="forgotpasswordresetmodal" data-toggle="modal" data-target="#forgotpasswordresetmodal"></div>
  <?php
  $model = new common\models\LoginForm();
  $captcha = false;
			if(Yii::$app->request->post()){
			$post_variables =Yii::$app->request->post('LoginForm');  		
				if ($model->checkattempts($post_variables['username'])) {
					$model->scenario = 'withCaptcha'; //useful only for view
					$captcha = true;
				}
			}
			
			?>
 <!-- Latest compiled and minified JavaScript -->
<!--<script src="js/bootstrap.min.js" type="text/javascript"></script>-->

<!--<script src="<?php // echo Yii::getAlias('@web'); ?>/js/bootstrap.min.js" type="text/javascript"></script>-->


<script>
    
      
   var emailNotificationUrl = '<?php echo \Yii::$app->getUrlManager()->createAbsoluteUrl('site/communique-details'); ?>';
var communiqueUrl = '<?php echo \Yii::$app->getUrlManager()->createAbsoluteUrl('site/getcommuniques'); ?>';
var communiquecountUrl = '<?php echo \Yii::$app->getUrlManager()->createAbsoluteUrl('site/getcommuniquecount'); ?>';
var prjNotificationUrl = '<?php echo \Yii::$app->getUrlManager()->createAbsoluteUrl('site/notification-details'); ?>';
var notificationUrl = '<?php echo \Yii::$app->getUrlManager()->createAbsoluteUrl('site/getnotifications'); ?>';
var notificationcountUrl = '<?php echo \Yii::$app->getUrlManager()->createAbsoluteUrl('site/getnotificationcount'); ?>';
    $(document).ready(function() {
	$(".scroller").slimScroll({ alwaysVisible: true  });  

	$('.communiquedata').scroll(function() {
	if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
	var last_count = $(".communiquemsg:last").attr("commid");
	$('.loader').remove();
	$('.communiquedata').append('<li class="loader">Loading....</li>');
		$.ajax({
                url:   communiqueUrl,
                type: "get",
				data: {lastcount:last_count},
                success: function(data){
                    //console.log(data);
					 $('.loader').remove();
					$('.communiquedata').append(data);
					$.ajax({
						url:   communiquecountUrl,
						type: "get",
						success: function(data){
							console.log(data);
							if(data==0){
							$('.communiquecount').hide();
							}else{
							$('.communiquecount').html(data);
							}
							$('.emcount').html(data);
						},
						error: function (xhr, status, error) {
						   alert('There was an error with your request.' + xhr.responseText);
						 }
					 });
                },
                error: function (xhr, status, error) {
                   alert('There was an error with your request.' + xhr.responseText);
                 }
             });
		 
	}
	});
		$('.notifdata').scroll(function() {
	if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
	var last_count = $(".notifmsg:last").attr("notifid");
	$('.loader').remove();
	$('.notifdata').append('<li class="loader">Loading....</li>');
		$.ajax({
                url:   notificationUrl,
                type: "get",
				data: {lastcount:last_count},
                success: function(data){
					 $('.loader').remove();
					$('.notifdata').append(data);
					$.ajax({
						url:   notificationcountUrl,
						type: "get",
						success: function(data){
							if(data==0){
							$('.notifcount').hide();
							}else{
							$('.notifcount').html(data);
							}
							$('.noticount').html(data);
						},
						error: function (xhr, status, error) {
						   alert('There was an error with your request.' + xhr.responseText);
						 }
					 });
                },
                error: function (xhr, status, error) {
                   alert('There was an error with your request.' + xhr.responseText);
                 }
             });
		 
	}
	});
	$('#usercommunique').click(function(){
	$('.notificons').hide();
		$('.communiquedata').show();
		if($('.communiquedata').is(":visible")){
				var commarray = [];
			$(".communiquemsg").each(function() {
				commarray.push($(this).attr('commid'));
				//$(this).find('.commnotifs').removeClass('notifread');
			});
			
			$.ajax({
                url:   emailNotificationUrl,
                type: "post",
				data: {commarray:commarray},
                success: function(data){
					$.ajax({
						url:   communiquecountUrl,
						type: "get",
						success: function(data){
							console.log(data);
							if(data==0){
							$('.communiquecount').hide();
							}else{
							$('.communiquecount').html(data);
							}
						},
						error: function (xhr, status, error) {
						   alert('There was an error with your request.' + xhr.responseText);
						 }
					 });
                },
                error: function (xhr, status, error) {
                   alert('There was an error with your request.' + xhr.responseText);
                 }
             });
		}
	});
	
	$('#usernotif').click(function(){
	$('.notificons').hide();
		$('.notifdata').show();
		if($('.notifdata').is(":visible")){
				var notifarray = [];
				var notiftypearray = [];
			$(".notifmsg").each(function() {
				notifarray.push($(this).attr('notifid'));
				notiftypearray.push($(this).attr('notiftype'));
			});
			
			$.ajax({
                url:   prjNotificationUrl,
                type: "post",
				data: {notifarray:notifarray, notiftypearray:notiftypearray},
                success: function(data){
					$.ajax({
						url:   notificationcountUrl,
						type: "get",
						success: function(data){
							if(data==0){
							$('.notifcount').hide();
							}else{
							$('.notifcount').html(data);
							}
						},
						error: function (xhr, status, error) {
						   alert('There was an error with your request.' + xhr.responseText);
						 }
					 });
                },
                error: function (xhr, status, error) {
                   alert('There was an error with your request.' + xhr.responseText);
                 }
             });
		}
	});
        
        if($(window).width() < 768){
    
    if($('.dropdown').hasClass('open')){
        $('.dropdown-menu').css('display', 'block')
    }else{
        
       $('.dropdown-menu').css('display', 'none')
    }    
        
    }
        
        $(window).on("scroll", function() {
            if ($(window).scrollTop() >= 20) {
                $(".navbar, .icon").addClass("compressed");
            } else {
                $(".navbar, .icon").removeClass("compressed");
            }
        });

        /*$('ul.nav li.dropdown').hover(function() {
            // you could also use this condition: $( window ).width() >= 768
            if ($('.navbar-toggle').css('display') === 'none' &&
                false === ('ontouchstart' in document)) {

                $('.dropdown-toggle', this).trigger('click');
            }
        }, function() {
            if ($('.navbar-toggle').css('display') === 'block' &&
                false === ('ontouchstart' in document)) {

                $('.dropdown-toggle', this).trigger('click');
            }
        });
*/
       
     
    });


    $(document).ready(function() {
		$('#signupmodal .close, .signinmodal').click(function(){
		$('#form-sign-up')[0].reset();
		$("label.error").hide(); 
		$('#sign-up-error-msg').html('');
	});
    
	$('#signinmodal .close, .signinmodal').click(function(){
		$('#login-form')[0].reset();
		$('#login-form #error-msg').html('');
		$("label.error").hide(); 
	});
	$('#forgotpasswordModal .close, .signinmodal').click(function(){
		$('#request-password-reset-form')[0].reset();
		$("label.error").hide(); 
	});
	
	$('#signupresendotpmodal .close, .signinmodal').click(function(){
		$('#form-resend-otp')[0].reset();
		$("label.error").hide(); 
	});
	
	$('#signupotpmodal .close, .signinmodal').click(function(){
		$('#form-signup-otp')[0].reset();
		$("label.error").hide(); 
	});
	
	$('#feedbackpopupmodal .close, #feedbk').click(function(){
		$('#form-feedback')[0].reset();
		$("label.error").hide(); 
	});
	
	$('.signinmdal').click(function(){
	$('#signupmodal .close').trigger('click');
	});
	$('.signupmdal').click(function(){
	$('#signinmodal .close').trigger('click');
	});	
	
	$('.forgotmdal').click(function(){
	$('#signinmodal .close').trigger('click');
	});	
	
	
    $("#signup-otp-back").on("click", function (event) {
	$('#signupotpmodal .close').trigger('click');
	$('.signupmdal').trigger('click');
    });
});

</script>

<style>
    .option .navbar-nav > li{
           padding: 0px 2px;
    }
    .option .nav > li > a{
        padding: 10px 12px;
    }
</style>

