$(document).ready(function() {
	
	
    $("#popup-login-button").on("click", function(event) {
        $('.modalloginform .login-form-popup').removeClass('inc-height');
        $('#login-form #error-msg').empty();
        event.preventDefault();
        if ($("#login-form").valid()) {
            var uname = $('#login-form #username').val();
            var password = $('#login-form #password').val();
            var verifycode = $('#login-form #loginform-verifycode').val();
            var reference_url = $('#reference_url').val();

            var encpassword = CryptoJS.AES.encrypt(JSON.stringify($.trim(password)), $.trim(secSaltKey), { format: CryptoJSAesJson }).toString();
            var url = siteUrl + "/site/validateuser";
            $.ajax({
                url: url,
                type: "post",
                data: { uname: uname, password: encpassword, verifycode: verifycode, reference_url: reference_url, _csrf: yii.getCsrfToken() },
                success: function(data) {
				console.log(data);
                    jsonParsedObject = JSON.parse(data);
                    if (jsonParsedObject.msg == 'Please enter Verification code' || jsonParsedObject.msg == 'Verification code is incorrect') {
                        $('.modalloginform .login-form-popup').addClass('inc-height');
                    } else {
                        $('.modalloginform .login-form-popup').removeClass('inc-height');
                    }
                    if ((jsonParsedObject.msg == 'Please try after 5 minutes' || jsonParsedObject.msg == 'Incorrect username or password') && ($("#login-form .field-loginform-verifycode").is(":visible") == true)) {
                        $('.modalloginform .login-form-popup').addClass('inc-height');
                    }
					
                    if (jsonParsedObject.redirect) {
                        window.location.href = jsonParsedObject.redirect;
                    } else if (jsonParsedObject.msg) {
                        $('#login-form #loginform-verifycode-image').trigger('click');
                        if (jsonParsedObject.msg == 'Verification code is incorrect' || jsonParsedObject.msg == 'Please enter Verification code') {
                            $('#login-form .captchacode').show();
                        }
                        $('#login-form #error-msg').html(jsonParsedObject.msg);
                    } else {
                        $('#login-form #loginform-verifycode-image').trigger('click');
                        $('#login-form #error-msg').html("Incorrect username or password");
                    }
                }
            });
        }
    });

	$("#popup-login-button").on("click", function(event) {
        $('.modalloginform .login-form-popup').removeClass('inc-height');
        $('#login-form #error-msg').empty();
        event.preventDefault();
        if ($("#login-form").valid()) {
            var uname = $('#login-form #username').val();
            var password = $('#login-form #password').val();
            var verifycode = $('#login-form #loginform-verifycode').val();
            var reference_url = $('#reference_url').val();

            var encpassword = CryptoJS.AES.encrypt(JSON.stringify($.trim(password)), $.trim(secSaltKey), { format: CryptoJSAesJson }).toString();
            var url = siteUrl + "/site/validateuser";
            $.ajax({
                url: url,
                type: "post",
                data: { uname: uname, password: encpassword, verifycode: verifycode, reference_url: reference_url, _csrf: yii.getCsrfToken() },
                success: function(data) {
				console.log(data);
                    jsonParsedObject = JSON.parse(data);
                    if (jsonParsedObject.msg == 'Please enter Verification code' || jsonParsedObject.msg == 'Verification code is incorrect') {
                        $('.modalloginform .login-form-popup').addClass('inc-height');
                    } else {
                        $('.modalloginform .login-form-popup').removeClass('inc-height');
                    }
                    if ((jsonParsedObject.msg == 'Please try after 5 minutes' || jsonParsedObject.msg == 'Incorrect username or password') && ($("#login-form .field-loginform-verifycode").is(":visible") == true)) {
                        $('.modalloginform .login-form-popup').addClass('inc-height');
                    }
					
                    if (jsonParsedObject.redirect) {
                        window.location.href = jsonParsedObject.redirect;
                    } else if (jsonParsedObject.msg) {
                        $('#login-form #loginform-verifycode-image').trigger('click');
                        if (jsonParsedObject.msg == 'Verification code is incorrect' || jsonParsedObject.msg == 'Please enter Verification code') {
                            $('#login-form .captchacode').show();
                        }
                        $('#login-form #error-msg').html(jsonParsedObject.msg);
                    } else {
                        $('#login-form #loginform-verifycode-image').trigger('click');
                        $('#login-form #error-msg').html("Incorrect username or password");
                    }
                }
            });
        }
    });

	$('#login-form').submit(function(){
		$("#popup-login-button").trigger('click');
	});
	
	
	$('#resetpwd-form-popup').submit(function(){
		$('#resetpwd-form-popup .rst-pswd').trigger('click');
	});

    $('#resetpwd-form-popup .rst-pswd').click(function(e) {
        var form = $("#resetpwd-form-popup");
        if (form.valid() === true) {
            var reseturl = siteUrl + "/profile/validate-old-password";
            var oldpwd = $('#resetpwd-form-popup #resetprofilepasswordform-password').val();
            var changepwd = $('#resetpwd-form-popup #resetprofilepasswordform-changepassword').val();
            var encoldpassword = CryptoJS.AES.encrypt(JSON.stringify($.trim(oldpwd)), $.trim(secSaltKey), { format: CryptoJSAesJson }).toString();
            var encnewpassword = CryptoJS.AES.encrypt(JSON.stringify($.trim(changepwd)), $.trim(secSaltKey), { format: CryptoJSAesJson }).toString();
            $.ajax({
                url: reseturl,
                type: 'post',
                data: { 'oldpwd': encoldpassword, _csrf: yii.getCsrfToken() },
                success: function(data) {
                    console.log(data);
                    $('#resetpwd-form-popup .field-resetprofilepasswordform-checkoldpassword .help-block').text('');
                    if (data == true) {
                        $('#resetpwd-form-popup #resetprofilepasswordform-checkoldpassword').val('success');
                        $('#resetpwd-form-popup .field-resetprofilepasswordform-password').addClass('has-success');
                        $('#resetpwd-form-popup .field-resetprofilepasswordform-password').removeClass('has-error');
                        $('#resetpwd-form-popup .field-resetprofilepasswordform-password .help-block').empty();
                        $('#resetpwd-form-popup .field-resetprofilepasswordform-password .help-block').css('display', 'none');
                        $('#resetpwd-form-popup #resetprofilepasswordform-changepassword').val(encnewpassword);
                        $('#resetpwd-form-popup #resetprofilepasswordform-password').val(encoldpassword);
                        $('#resetpwd-form-popup #resetprofilepasswordform-reenterpassword').val(encnewpassword);
                        $('#resetpwd-form-popup').submit();
                        return true;
                    } else {
                        $('#resetpwd-form-popup #resetprofilepasswordform-checkoldpassword').val('');
                        $('#resetpwd-form-popup .field-resetprofilepasswordform-password').removeClass('has-success');
                        $('#resetpwd-form-popup .field-resetprofilepasswordform-password').addClass('has-error');
                        $('#resetpwd-form-popup .field-resetprofilepasswordform-password .help-block').text('Old Password is incorrect');
                        $('#resetpwd-form-popup .field-resetprofilepasswordform-password .help-block').css('display', 'block');
                        e.stopImmediatePropagation();
                        e.preventDefault();
                        return false;
                    }
                },
                error: function(xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            });
        }
    });

    $('#resetpwd .rst-pswd').click(function(e) {
        var form = $("#resetpwd");
        if (form.valid() === true) {
            var reseturl = siteUrl + "/profile/validate-old-password";
            var oldpwd = $('#resetpwd #resetprofilepasswordform-password').val();
            var changepwd = $('#resetpwd #resetprofilepasswordform-changepassword').val();
			//console.log(oldpwd);
            var encoldpassword = CryptoJS.AES.encrypt(JSON.stringify($.trim(oldpwd)), $.trim(secSaltKey), { format: CryptoJSAesJson }).toString();
            var encnewpassword = CryptoJS.AES.encrypt(JSON.stringify($.trim(changepwd)), $.trim(secSaltKey), { format: CryptoJSAesJson }).toString();
			//console.log(encoldpassword);
            $.ajax({
                url: reseturl,
                type: 'post',
                data: { 'oldpwd': encoldpassword, _csrf: yii.getCsrfToken() },
                success: function(data) {
				console.log(data);
                    $('#resetpwd .field-resetprofilepasswordform-checkoldpassword .help-block').text('');
                    if (data == true) {
                        $('#resetpwd #resetprofilepasswordform-checkoldpassword').val('success');
                        $('#resetpwd .field-resetprofilepasswordform-password').addClass('has-success');
                        $('#resetpwd .field-resetprofilepasswordform-password').removeClass('has-error');
                        $('#resetpwd .field-resetprofilepasswordform-password .help-block').empty();
                        $('#resetpwd .field-resetprofilepasswordform-password .help-block').css('display', 'none');
                        $('#resetpwd #resetprofilepasswordform-changepassword').val(encnewpassword);
                        $('#resetpwd #resetprofilepasswordform-password').val(encoldpassword);
                        $('#resetpwd #resetprofilepasswordform-reenterpassword').val(encnewpassword);
                        $('#resetpwd').submit();
                        return true;
                    } else {
                        $('#resetpwd #resetprofilepasswordform-checkoldpassword').val('');
                        $('#resetpwd .field-resetprofilepasswordform-password').removeClass('has-success');
                        $('#resetpwd .field-resetprofilepasswordform-password').addClass('has-error');
                        $('#resetpwd .field-resetprofilepasswordform-password .help-block').text('Old Password is incorrect');
                        $('#resetpwd .field-resetprofilepasswordform-password .help-block').css('display', 'block');
                        e.stopImmediatePropagation();
                        e.preventDefault();
                        return false;
                    }
                },
                error: function(xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            });
        }
    });
});

