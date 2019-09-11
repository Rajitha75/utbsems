$(function() {
$('#login-form .lg-pgbtn1').click(function(){
var verifycode = $('#login-form #loginform-verifycode').val();
$('#login-form #error-msg').html('');
var uname=$('#login-form #loginform-username').val();
var password=$('#login-form #loginform-password').val();
var encpassword = CryptoJS.AES.encrypt(JSON.stringify($.trim(password)), $.trim(secSaltKey), {format: CryptoJSAesJson}).toString();
//console.log(encpassword)
			var url = BasesiteUrl+"/site/login";
			if ($('#login-form #loginform-verifycode').is(":visible") && verifycode=='' ) {
				$('#login-form #error-msg').html('Please enter Verification code');
				return false;
			}else if ($('#login-form #loginform-verifycode').is(":visible") && verifycode!='' ) {
               $.ajax({
                    url: url,
                    type: "post",
                    data: {captchaverifycode:verifycode},
                    success: function (data) {
					if(!data){
						$('#login-form #error-msg').html('Verification code is incorrect');
						return false;
					}else{
						$('#login-form #loginform-password').val(encpassword);
						$('#login-form #login-form').submit();
					}
                    }
					
                });
            }else{
				$('#login-form #loginform-password').val(encpassword);
				$('#login-form #login-form').submit();
			}				
	});
	

  $(".admin-create-user .usersignup").on("click", function (event) {
	var form = $("#usercreateform");
	if (($('#usercreateform').valid() === true) && (!$('.field-createuserform-profile_images').hasClass('uploaderror'))  && (!$('.field-createuserform-embed_videos').hasClass('linkerror'))){
	var eurl = BasesiteUrl+"/admin/checkexistinguser";
	var eusername = $('#usercreateform #createuserform-email').val();
	var  emobile = $('#usercreateform #createuserform-mobile').val();
	var epassword = $('#usercreateform #createuserform-userpassword').val();	
	var encnewpassword = CryptoJS.AES.encrypt(JSON.stringify($.trim(epassword)), $.trim(secSaltKey), {format: CryptoJSAesJson}).toString();
		$("#usercreateform .usersignup").prop('disabled', true);
		$.ajax({
			url: eurl,
			type: "post",
			data: {eusername:eusername,emobile:emobile},
			success: function (data) { 	
					$('#usercreateform #createuserform-userpassword').val(encnewpassword);	
					$('#usercreateform #createuserform-userconfirmpassword').val(encnewpassword);	
					$( "#usercreateform").submit(); 
			}
		});
		return false;
		}
	});	
	
$('#resetpwd .rst-pswd').click(function(e){
	var form = $("#resetpwd");
	if (form.valid() === true){
	var reseturl = BasesiteUrl+"/profile/validate-old-password";
	var formurl = BasesiteUrl+"/profile/reset-profile-password";
	var oldpwd = $('#resetpwd #resetprofilepasswordform-password').val();
	var changepwd = $('#resetpwd #resetprofilepasswordform-changepassword').val();
	var encoldpassword = CryptoJS.AES.encrypt(JSON.stringify($.trim(oldpwd)), $.trim(secSaltKey), {format: CryptoJSAesJson}).toString();
	var encnewpassword = CryptoJS.AES.encrypt(JSON.stringify($.trim(changepwd)), $.trim(secSaltKey), {format: CryptoJSAesJson}).toString();
	
	$.ajax({
		url: reseturl,
		type: 'post',
		data: {'oldpwd': encoldpassword},
		success: function (data) {
		$('#resetpwd .field-resetprofilepasswordform-checkoldpassword .help-block').text('');
			if(data == true){
				$('#resetpwd .rst-pswd').prop('disabled',true);
				$('#resetpwd #resetprofilepasswordform-checkoldpassword').val('success');
				$('#resetpwd .field-resetprofilepasswordform-password').addClass('has-success');
				$('#resetpwd .field-resetprofilepasswordform-password').removeClass('has-error');
				$('#resetpwd .field-resetprofilepasswordform-password .help-block').empty();
				$('#resetpwd .field-resetprofilepasswordform-password .help-block').css('display','none');
				$('#resetpwd #resetprofilepasswordform-changepassword').val(encnewpassword);	
				$('#resetpwd #resetprofilepasswordform-password').val(encoldpassword);
				$('#resetpwd #resetprofilepasswordform-reenterpassword').val(encnewpassword);
				$.ajax({
					url: formurl,
					type: 'post',
					data: {'changepassword': encnewpassword},
					success: function (data) {
					if(data){
						$('#logout').submit();
					}else{
					$('#resetpwd .rst-pswd').prop('disabled',false);
					}
					}
				});
				return true;
			}else{
				$('#resetpwd .rst-pswd').prop('disabled',false);
				$('#resetpwd #resetprofilepasswordform-checkoldpassword').val('');
			
				$('#resetpwd .field-resetprofilepasswordform-password').removeClass('has-success');
				$('#resetpwd .field-resetprofilepasswordform-password').addClass('has-error');
				$('#resetpwd .field-resetprofilepasswordform-password .help-block').text('Old Password is incorrect');
				$('#resetpwd .field-resetprofilepasswordform-password .help-block').css('display','block');
				
				e.stopImmediatePropagation();
				e.preventDefault();
				return false;
			}
		},
		error: function (xhr, status, error) {
		alert('There was an error with your request.' + xhr.responseText);
		}
	});
	}
	});	
});		