$(document).ready(function() {
$('.imagefileexceed').hide();
$('.document_size_err').hide();
var uploadField = $('.pjimages');

$('.pjimages').change(function(){
$('.imagefileexceed').hide();
			var filesize=this.files[0].size;
			console.log(filesize);
			if(filesize > 2000000){
				$('.imagefileexceed').show();
			}
		});
		

$('.docfiles').change(function(){
$('.document_size_err').hide();
			var filesize=this.files[0].size;
			console.log(filesize);
			if(filesize > 2000000){
				$('.document_size_err').show();
			}
		})
$('#pac-input').blur(function(){
$('.prjgeolocation').each(function(){
	if($(this).val() != ''){
	$('.prjgeolocation').removeClass('locerror');
	}else{
	$('.prjgeolocation').addClass('locerror');
	}
	});
});
$('.basicinfo_submit').click(function(){
if($('.prjgeolocation').val() == ''){
$('.prjlocationerror').show();
}else{
$('.prjlocationerror').hide();
}
});
    $.validator.addMethod("checkprimarynumber", function(value, element) {
        return this.optional(element) || /^([0-9]{11})$|^([0-9]{10})$/i.test(value);
    }, "Mobile Number is invalid");
	
	$.validator.addMethod("checknumber", function(value, element) {
        return this.optional(element) || /^([0-9]{10})$/i.test(value);
    }, "Mobile Number is invalid");

    jQuery.validator.addMethod("notHtml", function(value, element, param) {
        return this.optional(element) || !value.match(/<\/?[^>]*>/g);
    }, "HTML content is not allowed");

    $.validator.addMethod("checkemail", function(value, element) {
        return this.optional(element) || /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/i.test(value);
    }, "Email is invalid");
	
	$.validator.addMethod("checkdocsize", function(value, element) {
	var filesize=element.files[0].size;
        return this.optional(element) || filesize < 2000000;
    }, "File size should not exceed 2MB");
	
	$.validator.addMethod("checkimagesize", function(value, element) {
	var filesize=element.files[0];
        return this.optional(element) || filesize < 2000000;
    }, "File size should not exceed 2MB");

    $.validator.addMethod("decimalnumber", function(value, element) {
        return this.optional(element) || value < 100;
    }, "Interest rate cannot be greater than 100");

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s]+$/i.test(value);
    }, "Only Letters, numbers or spaces are allowed");
	
	$.validator.addMethod("alphanumerichyphen", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\s-]+$/i.test(value);
    }, "Only Letters, numbers, spaces or '-' are allowed");

    jQuery.validator.addMethod("notEqualTo", function(value, element, param) {
        var oldvalue = $(param).val();
        return this.optional(element) || value != oldvalue;
    }, "Please specify a different (non-default) value");
	
	jQuery.validator.addMethod("greaterThan", 
		function(value, element, params) {

			if (!/Invalid|NaN/.test(new Date(value))) {
				return new Date(value) > new Date($(params).val());
			}

			return isNaN(value) && isNaN($(params).val()) 
				|| (Number(value) > Number($(params).val())); 
		},'Must be greater than Start date.');
    
	/*jQuery.validator.addMethod("checkurl",function(value,element)
	{
	return this.optional(element) || (value.match(/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/\?v=|watch\?v=))((\w|-){11})(?:\S+)?$/)); 
	},"Please enter a valid Link");*/
        $.validator.addMethod("validimagename", function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9\\:_-]*)(\.)(jpg|png|jpeg)$/i.test(value);
        }, "");
        
            $.validator.addMethod("validdocname", function(value, element) {
                return this.optional(element) || /^([a-zA-Z0-9\\:_-]*)(\.)(pdf|doc|docx|txt)$/i.test(value);
            }, "");
       $.validator.addMethod("impagencyreqd", $.validator.methods.required,"Agency name is required"); 
    $('#step5, .MultiFile-remove').click(function() {
	
        $('.images_err').css('display', 'none');
        $('.document_err').css('display', 'none');
        $('.field-projects-project_image').removeClass('uploaderror');
        $('.field-projects-document_name').removeClass('uploaderror');
        if ($(".field-projects-project_image .MultiFile-title:visible").length > 1) {
            $('#projects-project_image_list').each(function() {
                $('#projects-project_image_list div.MultiFile-label').each(function() {
                    var count = $(this).find('span.MultiFile-label').length;
                    if (count > 1) {
                        $('.images_err').css('display', 'block');
                        $('.field-projects-project_image').addClass('uploaderror');
						return false;
                    } else {
                        $('.images_err').css('display', 'none');
                        $('.field-projects-project_image').removeClass('uploaderror');
                    }

                });
            });
        }


        if ($(".field-projects-document_name .MultiFile-title:visible").length > 1) {
            $('#projects-document_name_list').each(function() {
                $('#projects-document_name_list div.MultiFile-label').each(function() {
                    var count = $(this).find('span.MultiFile-label').length;
                    if (count > 1) {
                        $('.document_err').css('display', 'block');
                        $('.field-projects-document_name').addClass('uploaderror');
						return false;
                    } else {
                        $('.document_err').css('display', 'none');
                        $('.field-projects-document_name').removeClass('uploaderror');
                    }

                });
            });
        }
    });
	/*$('#clk').click(function(){
	$('#projects-project_desc').prop('style','visibility: hidden;');
	});*/
    $(".nexttab").click(function() {
	$('.imagefileexceed').hide();
	$('.document_size_err').hide();
	$('#prjdescription').prop('style','visibility: hidden;');
        var form = $(".project_create");
        form.validate({
            errorElement: 'span',
            errorClass: 'help-block',
            highlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').addClass("has-error");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.form-group').removeClass("has-error");
            },
            rules: {
                "Projects[project_title]": {
                    required: true,
					alphanumerichyphen: true,
                    notHtml: true
                },
                "Projects[project_category_ref_id]": {
                    required: true,
                    notHtml: true
                },
                "Projects[project_type_ref_id]": {
                    required: true,
                    notHtml: true
                },
                "Projects[name_of_unit]": {
                    notHtml: true
                },
                "Projects[project_start_date]": {
                    required: true,
                    notHtml: true
                },
                "Projects[project_end_date]": {
                    required: true,
                    notHtml: true,
					greaterThan: "#projects-project_start_date" 
                },
                "Projects[primary_email_contact]": {
                    //required: true,
                    checkemail: true,
                    notHtml: true
                },
                /*"Projects[location]": {
                    required: true,
                    notHtml: true
                },*/
                "Projects[Organization_name]": {
                    notHtml: true
                },
                "Projects[primary_contact]": {
                    required: true,
                    checkprimarynumber: true,
                    notHtml: true
                },
                "Projects[secondary_contact]": {
                    checknumber: true,
                    notHtml: true,
                    notEqualTo: '#projects-primary_contact',
                },
                "Projects[secondary_email_contact]": {
                    checkemail: true,
                    notHtml: true,
                    notEqualTo: '#projects-primary_email_contact',
                },
				"Projects[implementingagency_contact]": {
                    checknumber: true,
                },
                "Projects[need_of_project_problem]": {
                    notHtml: true,
                },
                "Projects[need_of_project_severity]": {
                    notHtml: true,
                },
                "Projects[need_of_project_no_of_people]": {
                    notHtml: true,
                },
                "Projects[targeted_govt_authority]": {
                    notHtml: true,
                },
                "Projects[targeted_govt_authority_type]": {
                    notHtml: true,
                },
                "Projects[govt_authority_name]": {
                    notHtml: true
                },
                "Projects[objective]": {
                    required: true,
                    notHtml: true
                },
                "Projects[scope]": {
                    required: true,
                    notHtml: true
                },
                "Projects[project_desc]": {
                    required: function () {
						
						CKEDITOR.instances.prjdescription.updateElement();
                    },
                    minlength: 1
                },
                "Projects[implementingagency]": {
                    notHtml: true
                },
                "Projects[conditions]": {
                    notHtml: true
                },
                "Projects[estimated_project_cost]": {
                    //required: true,
                    digits: true,
                    notHtml: true
                },
                "Projects[approved_value]": {
                    digits: true,
                    notHtml: true
                },
                "Projects[project_image][]": {
                    extension: "jpg|jpeg|png",
					checkimagesize: true,
                },
                "Projects[document_name][]": {
                    extension: "pdf|doc|docx|txt",
					checkdocsize: true
                },
				"Projects[implementingagency_contact_field]": {
                    checknumber: true,
                    notHtml: true
                },
				"Projects[embed_videos][]":{
					//checkurl: true,
				},

            },
            messages: {
                "Projects[project_title]": {
                    required: "Project Title cannot be blank"
                },
                "Projects[project_category_ref_id]": {
                    required: "Project Category cannot be blank"
                },
                "Projects[project_type_ref_id]": {
                    required: "Project Type cannot be blank"
                },
                "Projects[project_start_date]": {
                    required: "Start Date cannot be blank",
                },
                "Projects[project_end_date]": {
                    required: "End Date cannot be blank",
                },
				"Projects[project_desc]": {
                    required: "Project Description cannot be blank",
				},
                "Projects[primary_email_contact]": {
                    // required: "Primary Email cannot be blank",
                    checkemail: "Primary Email is invalid",
                },
                /*"Projects[location]": {
                    required: "Location cannot be blank",
                },*/
                "Projects[primary_contact]": {
                    required: "Primary Contact number is required",
                    checkprimarynumber: "Primary Contact number is invalid",
                },
                "Projects[secondary_contact]": {
                    checknumber: "Secondary Contact number is invalid",
                    notEqualTo: 'Secondary Contact should not be same as Primary Contact'
                },
                "Projects[secondary_email_contact]": {
                    checkemail: "Secondary Email is invalid",
                    notEqualTo: 'Secondary email should not be same as Primary email'
                },
				"Projects[implementingagency_contact]": {
                    checknumber: "Agency Contact number is invalid",
					notHtml: true
                },
                "Projects[objective]": {
                    required: "Objective cannot be blank"
                },
                "Projects[scope]": {
                    required: "Scope cannot be blank"
                },
                "Projects[estimated_project_cost]": {
                   // required: "Estimated Cost cannot be blank",
                    digits: "Only digits are allowed"
                },
                "Projects[approved_value]": {
                    digits: "Only digits are allowed"
                },
                "Projects[project_image][]": {
                    extension: "Only file type jpg/jpeg/png are allowed"
                },
                "Projects[document_name][]": {
                    extension: "Only file type pdf/doc/docx/txt are allowed"
                },
				"Projects[implementingagency_contact_field]": {
                    checknumber: "Agency contact number is invalid",
                },
            }
        });
        $.validator.addClassRules("dynrequired", {
            required: true,
        });
        $.validator.addClassRules("dynalphanum", {
            alphanumeric: true
        });
        $.validator.addClassRules("dynnum", {
            digits: true,
        });
        $.validator.addClassRules("dynfields", {
            notHtml: true
        });
		$.validator.addClassRules("impagencyreq", {
			impagencyreqd: true,
		});
        if (form.valid() === true) {
            if ($('#step1').is(":visible")) {
                current_fs = $('#step1');
                next_fs = $('#step2');
				$('.prjgeolocation').each(function(){
						if($(this).val() != ''){
						$('.prjgeolocation').removeClass('locerror');
						}else{
						$('.prjgeolocation').addClass('locerror');
						}
						});
						if($('.locerror').length == 0){
							$('.prjlocationerror').hide();
							}else{
							$('.prjlocationerror').show();
							return false;
							}
            } else if ($('#step2').is(":visible")) {
                current_fs = $('#step2');
                next_fs = $('#step3');
            } else if ($('#step3').is(":visible")) {
			
                if (checkErrorsTargetedGovtAuth() == false) {
                    return false;
                }
                var projectdata = $('textarea[name="Projects[project_desc]"]').val();
                /*if (projectdata == '' || ($('.field-projects-project_desc').hasClass('has-error')) || ($('.field-projects-impact_of_project').hasClass('has-error'))) {
                    if (projectdata == '') {
                        $('#errorProjDesc').css('display', 'block');
                        $('#errorProjDesc').text('Project Description cannot be blank');
                    }
                    return false;
                }*/
                current_fs = $('#step3');
                next_fs = $('#step4');
            } else if ($('#step4').is(":visible")) {
                if (checkErrorsFinancial() == false) {
                    return false;
                }
                current_fs = $('#step4');
                next_fs = $('#step5');
            } else if ($('#step5').is(":visible")) {
                $('.images_err').css('display', 'none');
                $('.document_err').css('display', 'none');
                $('.field-projects-project_image').removeClass('uploaderror');
                $('.field-projects-document_name').removeClass('uploaderror');
                if ($(".field-projects-project_image .MultiFile-title:visible").length > 1) {
                    $('#projects-project_image_list').each(function() {
				
                        $('#projects-project_image_list div.MultiFile-label').each(function() {
                            var count = $(this).find('span.MultiFile-label').length;
                            if (count > 1) {
                                $('.images_err').css('display', 'block');
                                $('.field-projects-project_image').addClass('uploaderror');
                                return false;
                            } else {
                                $('.images_err').css('display', 'none');
                                $('.field-projects-project_image').removeClass('uploaderror');
                            }

                        });
                    });
                }


                if ($(".field-projects-document_name .MultiFile-title:visible").length > 1) {
                    $('#projects-document_name_list').each(function() {
                        $('#projects-document_name_list div.MultiFile-label').each(function() {
                            var count = $(this).find('span.MultiFile-label').length;
                            if (count > 1) {
                                $('.document_err').css('display', 'block');
                                $('.field-projects-document_name').addClass('uploaderror');
                                return false;
                            } else {
                                $('.document_err').css('display', 'none');
                                $('.field-projects-document_name').removeClass('uploaderror');
                            }

                        });
                    });
                }
				
			$('.youtube_link').each(function() {
              var youtube_src=($(this).val());
              if(youtube_src)
               {
            var iframepattern = /^<iframe.+?<\/iframe>$/i;
			if(youtube_src.match(/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/\?v=|watch\?v=))((\w|-){11})(?:\S+)?$/) || (youtube_src.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*$/) && (iframepattern.test(youtube_src))))
             {
              $('.youtube_error').text('');
			  $('#projects-embed_videos').removeClass('linkerror');
			  if(youtube_src.indexOf('youtu.be') >= 0){
				  youtube_src = youtube_src.replace('youtu.be', 'youtube.com/embed');
			  }
			  if(youtube_src.indexOf('watch?v=') >= 0){
				  youtube_src = youtube_src.replace('watch?v=', 'embed/');
			  }
				  $('.doc-uploads .projct-imgsfrm').each(function() {
					var prevideolink = $(this).find('a').attr('href');
					//console.log(prevideolink); console.log(youtube_src);
					if(prevideolink == youtube_src){
					$('.youtube_error').text('This video is already added');
				   $('#projects-embed_videos').addClass('linkerror');
					return false;
					}
				  });
	
                return true;
             }
             else
                 {
                   $('.youtube_error').text('Please enter a valid Link ');
				   $('#projects-embed_videos').addClass('linkerror');
                    return false;
                 }
                 }
                 else
                    {
                       $('.youtube_error').text(''); 
						$('#projects-embed_videos').removeClass('linkerror');
                        return true;   
                     }
					 });
                if ($('#projects-embed_videos').hasClass('linkerror') || $('.field-projects-project_image').hasClass('uploaderror') || $('.field-projects-document_name').hasClass('uploaderror')  || $('.field-projects-embed_videos').hasClass('has-error')) {
                    return false;
                }
                current_fs = $('#step5');
                next_fs = $('#step6');
            } else if ($('#step6').is(":visible")) {
                if (form.valid() === true) {
				$('#projects-project_type_ref_id').attr("disabled", false);
                    $('.project_create').submit();
                }
            }
            var nextId = $(this).parents('.tab-pane').next().attr("id");
            $('[href="#' + nextId + '"]').tab('show');
            return false;
        }
    });
   $(document.body).on('change', '.field-projects-project_image .multi' ,function(){
var len = $('#projects-project_image .MultiFile').length;
var imglen = $('.project-allimg .img-spanpost').length;
var uploadedimgs = $('#projects-project_image #projects-project_image_list div.MultiFile-label').length;
$("#projects-project_image_list .MultiFile-remove").html('<i class="fa fa-trash" aria-hidden="true"></i>');
//alert(len);
if(imglen!=0){
var uplength = uploadedimgs+imglen;
$("#projects-project_image_list > .MultiFile-label:nth-child("+uploadedimgs+")").append("<input type='text' placeholder='Image Caption' name='file_caption[]' autocomplete='off'/>");
}else{
$("#projects-project_image_list > .MultiFile-label:nth-child("+uploadedimgs+")").append("<input type='text' placeholder='Image Caption' name='file_caption[]' autocomplete='off'/>");
}
});				

 $(document.body).on('change', '#projects-document_name', function() {
		$("#projects-document_name_list .MultiFile-remove").html('<i class="fa fa-trash" aria-hidden="true"></i>');
    });
	 $(document.body).on('change', '#projects-project_image', function() {
		$("#projects-project_image_list .MultiFile-remove").html('<i class="fa fa-trash" aria-hidden="true"></i>');
    });

	
    /*$(".basicinfo_submit").on('click', function(){
    $(".project_create").validate({
                rules: {
                    "Projects[project_title]": {
                        required: true,
    					notHtml: true
                    },
    				"Projects[project_category_ref_id]":{
    					required: true,
    					notHtml: true
    				},
    				"Projects[project_type_ref_id]":{
    					required: true,
    					notHtml: true
    				},
    				"Projects[name_of_unit]":{
    					notHtml: true
    				},
                    "Projects[project_start_date]": {
                        required: true,
    					notHtml: true
                    },
    				"Projects[project_end_date]": {
                        required: true,
    					notHtml: true
                    },
    				"Projects[primary_email_contact]": {
    					required: true,
    					email: true,
    					notHtml: true
    				},
    				"Projects[location]":{
    					required: true,
    					notHtml: true
    				},
    				"Projects[Organization_name]":{
    					notHtml: true
    				},
    				"Projects[primary_contact]":{
    					required: true,
    					checknumber: true,
    					notHtml: true
    				},
    				"Projects[secondary_contact]":{
    					checknumber: true,
    					notHtml: true
    				},
    				"Projects[secondary_email]":{
    					email: true,
    					notHtml: true
    				}
                },
                messages: {
                    "Projects[project_title]": {
                        required: "Project Title cannot be blank"
                    },
    				"Projects[project_category_ref_id]": {
                        required: "Project Category cannot be blank"
                    },
    				"Projects[project_type_ref_id]": {
                        required: "Project Type cannot be blank"
                    },
                    "Projects[project_start_date]": {
                        required: "Start Date cannot be blank",
                    },
    				"Projects[project_end_date]": {
                        required: "End Date cannot be blank",
                    },
    				"Projects[primary_email_contact]": {
                        required: "Primary Email cannot be blank",
    					email: "Primary Email is invalid",
                    },
    				"Projects[location]": {
                        required: "Location cannot be blank",
                    },
    				"Projects[primary_contact]": {
    					required: "Primary Contact number is required",
                        checknumber: "Primary Contact number is invalid",
                    },
    				"Projects[secondary_contact]": {
                        checknumber: "Secondary Contact number is invalid",
                    },
    				"Projects[secondary_email]": {
                        email: "Secondary Email is invalid",
                    },
                }
            });     
    if ($(".project_create").valid()) {
    $('.detailedinfo').attr('href','#step2');
    var nextId = $(this).parents('.tab-pane').next().attr("id");
      $('[href="#'+nextId+'"]').tab('show');
      
      return false;
    }else{
    return false;
    }		
    });

    $(".detailedinfo_submit").on('click', function(){
    $(".project_create").valid() = false;
    $(".project_create").validate({
                rules: {
                    "Projects[objective]": {
                        required: true,
    					notHtml: true
                    },
                    "Projects[scope]": {
    					notHtml: true
                    },
    				"Projects[project_desc]": {
                        ckeditor_required: true,
                    },
    				"Projects[implementing_agency]":{
    					notHtml: true
    				},
    				"Projects[conditions]":{
    					notHtml: true
    				},
                },
                messages: {
                    "Projects[objective]": {
                        required: "Objective cannot be blank"
                    },
                }
            });  
    if ($(".project_create").valid() && $(".detailedinfo .customvalids:visible").length<=0) {alert('sds');
    $('.financeinfo').attr('href','#step3');
    var nextId = $(this).parents('.tab-pane').next().attr("id");
      $('[href="#'+nextId+'"]').tab('show');
      return false;
    }else{alert('11');
    return false;
    }		
    });

    $(".financialdetail_submit").on('click', function(){
    $(".project_create").validate({
                rules: {
                    "Projects[estimated_project_cost]": {
                        required: true,
    					digits: true,
    					notHtml: true
                    },
                    "Projects[approved_value]": {
    					digits: true,
    					notHtml: true
                    },
                },
                messages: {
                    "Projects[estimated_project_cost]": {
                        required: "Estimated Cost cannot be blank",
    					digits: "Only digits are allowed"
                    },
    				"Projects[approved_value]": {
    					digits: "Only digits are allowed"
                    },
                }
            });  
    if ($(".project_create").valid() && checkErrorsFinancial()) {
    $('.mediainfo').attr('href','#step4');
    var nextId = $(this).parents('.tab-pane').next().attr("id");
      $('[href="#'+nextId+'"]').tab('show');
      return false;
    }else{
    return false;
    }		
    });*/

    $('#projects-amount').keyup(function() {
        var totalamount = parseInt($('#projects-estimated_project_cost').val());
        var investamount = parseInt($(this).val());
        $('.balance').empty();
        if (totalamount != '' && totalamount > investamount) {
            var diffamount = totalamount - investamount;
            $('.balance').append('<span>Balance Amount to be received: ' + diffamount + '</span>');
        }
    });
    $('#projects-participation_type').on('change', function() {
        if ($('#projects-participation_type').val() == "Support") {
            $('.field-projects-investment_type').attr('style', 'display: none');
            //$('.field-projects-equity_type').attr('style', 'display: none');
            $('.field-projects-amount').attr('style', 'display: none');
            //$('.field-projects-interest_rate').attr('style', 'display: none');

            $('.investment_type_hint').attr('style', 'display: none');
            // $('.equity_type_hint').attr('style', 'display: none');
            $('.amount_hint').attr('style', 'display: none');
            // $('.interest_rate_hint').attr('style', 'display: none');

            $('#projects-investment_type').val(0);
            //$('#projects-equity_type').val(0);
            $('#projects-amount').val('');
            // $('#projects-interest_rate').val('');
        } else if ($('#projects-participation_type').val() == "Invest") {
            $('.field-projects-investment_type').attr('style', 'display: block');
            //$('.investment_type_hint').attr('style', 'display: block');
            //$('.field-projects-equity_type').attr('style', 'display: block');
            $('.field-projects-amount').attr('style', 'display: block');
            //$('.field-projects-interest_rate').attr('style', 'display: block');
        } else {
            $('.field-projects-investment_type').attr('style', 'display: none');
            //$('.field-projects-equity_type').attr('style', 'display: none');
            $('.field-projects-amount').attr('style', 'display: none');
            // $('.field-projects-interest_rate').attr('style', 'display: none');

            $('.investment_type_hint').attr('style', 'display: none');
            $('.equity_type_hint').attr('style', 'display: none');
            $('.amount_hint').attr('style', 'display: none');
            $('.interest_rate_hint').attr('style', 'display: none');
        }
    });

    $('#projects-investment_type').on('change', function() {
        //if($('#projects-investment_type').val() == "Grant") {
        // $('.field-projects-equity_type').attr('style', 'display: none');
        // $('.field-projects-amount').attr('style', 'display: block');
        // $('.field-projects-interest_rate').attr('style', 'display: none');

        // $('.equity_type_hint').attr('style', 'display: none');
        //$('.amount_hint').attr('style', 'display: block');
        //  $('.interest_rate_hint').attr('style', 'display: none');

        //  $('#projects-equity_type').val('');
        // $('#projects-amount').val('');
        //  $('#projects-interest_rate').val('');
        // } //else if($('#projects-investment_type').val() == "Equity") {
        // $('.field-projects-equity_type').attr('style', 'display: block');
        // $('.field-projects-amount').attr('style', 'display: none');
        //  $('.field-projects-interest_rate').attr('style', 'display: none');

        // $('.equity_type_hint').attr('style', 'display: block');
        // $('.amount_hint').attr('style', 'display: none');
        //  $('.interest_rate_hint').attr('style', 'display: none');
        // }
        // else {
        //$('.field-projects-equity_type').attr('style', 'display: none');
        //  $('.field-projects-amount').attr('style', 'display: none');
        // $('.field-projects-interest_rate').attr('style', 'display: none');

        // $('.equity_type_hint').attr('style', 'display: none');
        //$('.amount_hint').attr('style', 'display: none');
        // $('.interest_rate_hint').attr('style', 'display: none');
        // }
    });

    /* $('#projects-equity_type').on('change', function() {
         if($('#projects-equity_type').val() == "Interest_Earning") {
             $('.field-projects-interest_rate').attr('style', 'display: block');
             $('.field-projects-amount').attr('style', 'display: block');

             $('.interest_rate_hint').attr('style', 'display: block');
             $('.amount_hint').attr('style', 'display: block');
         } else if($('#projects-equity_type').val() == "Principal_Protection") {
             $('.field-projects-interest_rate').attr('style', 'display: none');
             $('.field-projects-amount').attr('style', 'display: block');

             $('.interest_rate_hint').attr('style', 'display: none');
             $('.amount_hint').attr('style', 'display: block');
         
             $('#projects-interest_rate').val('');
         } else {
             $('.field-projects-interest_rate').attr('style', 'display: none');
             $('.field-projects-amount').attr('style', 'display: none');

             $('.interest_rate_hint').attr('style', 'display: none');
             $('.amount_hint').attr('style', 'display: none');
         
             $('#projects-interest_rate').val('');
         }
     });*/
    $('#projects-participation_type, #projects-investment_type').change(function() {
        checkErrorsFinancial();
    });
    $('#projects-amount').blur(function() {
        checkErrorsFinancial();
    });

    $('#projects-targeted_govt_authority, #projects-targeted_govt_authority_type_field').blur(function() {
        checkErrorsTargetedGovtAuth();
    });

    $('#projects-targeted_govt_authority, #projects-targeted_govt_authority_type_field').change(function() {
        checkErrorsTargetedGovtAuth();
    });

    function checkErrorsFinancial() {
        $('.customvalids').css('display', 'none');
        $('#errorInvestmentType').css('display', 'none');
        $('#errorAmount').css('display', 'none');
		$('#errorapprovedvalue').css('display', 'none');
        $('#errorEquityType').css('display', 'none');
        $('#errorInterestRate').css('display', 'none');
        if ($('#projects-participation_type').val() == "Invest" && ($('#projects-investment_type').val() == "" || $('#projects-investment_type').val() == null)) {
            $('#errorInvestmentType').html('Select project investment type');
            $('#errorInvestmentType').css('display', 'block');
            return false;
        }

        if ($('#projects-participation_type').val() == "Invest" && ($('#projects-amount').val().trim() == "" || $('#projects-amount').val() == null)) {
            $('#errorAmount').html('Project Investment Amount should not be empty');
            $('#errorAmount').css('display', 'block');
            return false;
        }
		if(parseInt($('#projects-approved_value').val()) > parseInt($('#projects-estimated_project_cost').val())){
			$('#errorapprovedvalue').html('Approved value should not be greater than Estimated Project Cost');
			$('#errorapprovedvalue').css('display', 'block');
			return false;
		}

        /*if($('#projects-participation_type').val() == "Invest" && $('#projects-investment_type').val() == "Equity" && 
                    $('#projects-equity_type').val() == "") {
                    $('#errorEquityType').html('Project Equity Type should not be empty');
                    $('#errorEquityType').css('display', 'block');
                    return false;
                }
            
                if($('#projects-participation_type').val() == "Invest" && $('#projects-investment_type').val() == "Equity" && 
                    $('#projects-equity_type').val() == "Principal_Protection" && $('#projects-amount').val().trim() == "") {
                    $('.field-projects-equity_type').css('display','block');
                    $('.field-projects-amount').css('display','block');
                    $('#errorAmount').html('Project Cash Amount should not be empty');
                    $('#errorAmount').css('display', 'block');
                    $('#errorInterestRate').css('display', 'none');
                    return false;
                }
            
                if($('#projects-participation_type').val() == "Invest" && $('#projects-investment_type').val() == "Equity" && 
                    $('#projects-equity_type').val() == "Interest_Earning") {
                    var flag = true;
                    if($('#projects-amount').val().trim() == "") {
                        $('#errorAmount').html('Project Cash Amount should not be empty');
                        $('#errorAmount').css('display', 'block');
                        flag = false;
                    }
                    if($('#projects-interest_rate').val().trim() == "") {
                        $('#errorInterestRate').html('Project Interest Rate should not be empty');
                        $('#errorInterestRate').css('display', 'block');
                        flag = false;
                    }
                    return flag; 
                }*/

        if (parseInt($('#projects-estimated_project_cost').val()) > 0 && parseInt($('#projects-amount').val()) > 0 &&
            (parseInt($('#projects-amount').val()) > parseInt($('#projects-estimated_project_cost').val()))) {
            $('#errorAmount').html('Project Investment Amount should not be greater than Estimated Project Cost');
            $('#errorAmount').css('display', 'block');
            return false;
        }
		if(parseInt($('#projects-approved_value').val()) > parseInt($('#projects-estimated_project_cost').val())){
			$('#errorapprovedvalue').html('Approved value should not be greater than Estimated Project Cost');
			$('#errorapprovedvalue').css('display', 'block');
			return false;
		}
        return true;
    }

    function checkErrorsTargetedGovtAuth() {
        $('#errorTargetGovt').css('display', 'none');
        if ($('#projects-targeted_govt_authority').val() == "Y" && ($('#projects-targeted_govt_authority_type_field').val() == "" || $('#projects-targeted_govt_authority_type_field').val() == null)) {
            $('#errorTargetGovt').html('Please select Government Authority Type');
            $('#errorTargetGovt').css('display', 'block');
            return false;
        }
    }


    /*$('.nexttab').click(function(){
      var nextId = $(this).parents('.tab-pane').next().attr("id");
      $('[href="#'+nextId+'"]').tab('show');
      return false;
      
    });*/

    $('.backtab').click(function() {
        var prevId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href="#' + prevId + '"]').tab('show');
        return false;

    })

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

        //update progress
        var step = $(e.target).data('step');
        var percent = (parseInt(step) / 4) * 100;

        $('.progress-bar').css({ width: percent + '%' });
        $('.progress-bar').text("Step " + step + " of 5");

        //e.relatedTarget // previous tab

    })

    $('.first').click(function() {

            $('#myWizard a:first').tab('show')

        })
        // Generated by CoffeeScript 1.8.0

    /*
    jQuery Credit Card Validator 1.0

    Copyright 2012-2015 Pawel Decowski

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software
    is furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included
    in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
    OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
    THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
    IN THE SOFTWARE.
     */

    $(function() {
        var $,
            __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

        $ = jQuery;

        $.fn.validateCreditCard = function(callback, options) {
            var bind, card, card_type, card_types, get_card_type, is_valid_length, is_valid_luhn, normalize, validate, validate_number, _i, _len, _ref;
            card_types = [{
                name: 'amex',
                pattern: /^3[47]/,
                valid_length: [15]
            }, {
                name: 'diners_club_carte_blanche',
                pattern: /^30[0-5]/,
                valid_length: [14]
            }, {
                name: 'diners_club_international',
                pattern: /^36/,
                valid_length: [14]
            }, {
                name: 'jcb',
                pattern: /^35(2[89]|[3-8][0-9])/,
                valid_length: [16]
            }, {
                name: 'laser',
                pattern: /^(6304|670[69]|6771)/,
                valid_length: [16, 17, 18, 19]
            }, {
                name: 'visa_electron',
                pattern: /^(4026|417500|4508|4844|491(3|7))/,
                valid_length: [16]
            }, {
                name: 'visa',
                pattern: /^4/,
                valid_length: [16]
            }, {
                name: 'mastercard',
                pattern: /^5[1-5]/,
                valid_length: [16]
            }, {
                name: 'maestro',
                pattern: /^(5018|5020|5038|6304|6759|676[1-3])/,
                valid_length: [12, 13, 14, 15, 16, 17, 18, 19]
            }, {
                name: 'discover',
                pattern: /^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)/,
                valid_length: [16]
            }];
            bind = false;
            if (callback) {
                if (typeof callback === 'object') {
                    options = callback;
                    bind = false;
                    callback = null;
                } else if (typeof callback === 'function') {
                    bind = true;
                }
            }
            if (options == null) {
                options = {};
            }
            if (options.accept == null) {
                options.accept = (function() {
                    var _i, _len, _results;
                    _results = [];
                    for (_i = 0, _len = card_types.length; _i < _len; _i++) {
                        card = card_types[_i];
                        _results.push(card.name);
                    }
                    return _results;
                })();
            }
            _ref = options.accept;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                card_type = _ref[_i];
                if (__indexOf.call((function() {
                        var _j, _len1, _results;
                        _results = [];
                        for (_j = 0, _len1 = card_types.length; _j < _len1; _j++) {
                            card = card_types[_j];
                            _results.push(card.name);
                        }
                        return _results;
                    })(), card_type) < 0) {
                    throw "Credit card type '" + card_type + "' is not supported";
                }
            }
            get_card_type = function(number) {
                var _j, _len1, _ref1;
                _ref1 = (function() {
                    var _k, _len1, _ref1, _results;
                    _results = [];
                    for (_k = 0, _len1 = card_types.length; _k < _len1; _k++) {
                        card = card_types[_k];
                        if (_ref1 = card.name, __indexOf.call(options.accept, _ref1) >= 0) {
                            _results.push(card);
                        }
                    }
                    return _results;
                })();
                for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
                    card_type = _ref1[_j];
                    if (number.match(card_type.pattern)) {
                        return card_type;
                    }
                }
                return null;
            };
            is_valid_luhn = function(number) {
                var digit, n, sum, _j, _len1, _ref1;
                sum = 0;
                _ref1 = number.split('').reverse();
                for (n = _j = 0, _len1 = _ref1.length; _j < _len1; n = ++_j) {
                    digit = _ref1[n];
                    digit = +digit;
                    if (n % 2) {
                        digit *= 2;
                        if (digit < 10) {
                            sum += digit;
                        } else {
                            sum += digit - 9;
                        }
                    } else {
                        sum += digit;
                    }
                }
                return sum % 10 === 0;
            };
            is_valid_length = function(number, card_type) {
                var _ref1;
                return _ref1 = number.length, __indexOf.call(card_type.valid_length, _ref1) >= 0;
            };
            validate_number = (function(_this) {
                return function(number) {
                    var length_valid, luhn_valid;
                    card_type = get_card_type(number);
                    luhn_valid = false;
                    length_valid = false;
                    if (card_type != null) {
                        luhn_valid = is_valid_luhn(number);
                        length_valid = is_valid_length(number, card_type);
                    }
                    return {
                        card_type: card_type,
                        valid: luhn_valid && length_valid,
                        luhn_valid: luhn_valid,
                        length_valid: length_valid
                    };
                };
            })(this);
            validate = (function(_this) {
                return function() {
                    var number;
                    number = normalize($(_this).val());
                    return validate_number(number);
                };
            })(this);
            normalize = function(number) {
                return number.replace(/[ -]/g, '');
            };
            if (!bind) {
                return validate();
            }
            this.on('input.jccv', (function(_this) {
                return function() {
                    $(_this).off('keyup.jccv');
                    return callback.call(_this, validate());
                };
            })(this));
            this.on('keyup.jccv', (function(_this) {
                return function() {
                    return callback.call(_this, validate());
                };
            })(this));
            callback.call(this, validate());
            return this;
        };

    });
}); // JavaScript Document