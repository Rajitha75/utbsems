<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['user_list']];
$this->params['breadcrumbs'][] = $this->title;
	$dateformat = Yii::getAlias('@phpdatepickerformat');
?>
    <style type="text/css">
        #pac-input {
            amrgin-top: 10px;
            padding: 3px;
            left: 115px !important;
        }    
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDL1Xs264nIq1NoVhqtdBThrBa9da3f52k"></script>
    <script type="text/javascript">

;
        function initMap() {
            
            var latitude = 17.385044;
            var longitude = 78.486671;
            
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
              center: {
                lat: latitude,
                lng: longitude
              },
              zoom: 12
            });

            
            
            <?php if(empty($model->user_ref_id)) { ?>
                var startPos;
                var geoSuccess = function(position) {
                    startPos = position;
                    //alert(startPos.coords.latitude+"______"+startPos.coords.longitude);
                    //document.getElementById('startLat').value = startPos.coords.latitude;
                    //document.getElementById('startLon').value = startPos.coords.longitude;
                    latitude = startPos.coords.latitude
                    longitude = position.coords.longitude;
                };
                navigator.geolocation.getCurrentPosition(geoSuccess);
             <?php } else { ?>
                 latitude = parseFloat("<?php echo $model->latitude; ?>");
                 longitude = parseFloat("<?php echo $model->longitude; ?>");
             <?php } ?>
             var pos = {
               lat: latitude,
               lng: longitude
             };
            var mapCanvas = document.getElementById("map_canvas");
            var myCenter = new google.maps.LatLng(latitude, longitude); 
            var mapOptions = {center: myCenter, zoom: 12};
            var map = new google.maps.Map(mapCanvas,mapOptions);
            var marker = new google.maps.Marker({
                position: myCenter,
                animation: google.maps.Animation.DROP,
                draggable: true,
                raiseOnDrag: true
            });
            marker.setMap(map);
            
            google.maps.event.addListener(marker, 'dragend', function () {
                geocodePosition(marker.getPosition());
            });

            var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
            google.maps.event.addListener(searchBox, 'places_changed', function() {
                searchBox.set('map_canvas', null);
                
                var places = searchBox.getPlaces();
                
                marker.setMap(null);

                var bounds = new google.maps.LatLngBounds();
                var i, place;
                for (i = 0; place = places[i]; i++) {
                    (function(place) {
                        var marker = new google.maps.Marker({
                            position: place.geometry.location,
                            draggable: true,
                            raiseOnDrag: true
                        });
                        marker.bindTo('map', searchBox, 'map');
                        marker.setMap(null);
                        google.maps.event.addListener(marker, 'map_changed', function() {
                            if (!this.getMap()) {
                                this.unbindAll();
                            }
                        //geocodePosition(marker.getPosition());
                        });
                        google.maps.event.addListener(marker, 'dragend', function () {
                            geocodePosition(marker.getPosition());
                        });
                        bounds.extend(place.geometry.location);

                        geocodePosition(marker.getPosition());
                    }(place));

                }
                map.fitBounds(bounds);
                searchBox.set('map', map);
                map.setZoom(Math.min(map.getZoom(),12));

            });
        }
        
        function geocodePosition(pos) {
            geocoder = new google.maps.Geocoder();
            geocoder.geocode ({
                latLng: pos
            },
            function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
//                    document.getElementById("projects-location").value = results[0].formatted_address;
//                    document.getElementById("projects-latitude").value = results[0].geometry.location.lat();
//                    document.getElementById("projects-longitude").value = results[0].geometry.location.lng();
                    
                    document.getElementById("createuserform-current_location").value = results[0].formatted_address;
                    document.getElementById("createuserform-latitude").value = results[0].geometry.location.lat();
                    document.getElementById("createuserform-longitude").value = results[0].geometry.location.lng();
                }
                else {
                    //$("#mapErrorMsg").html('Cannot determine address at this location.' + status).show(100);
                }
            });
        }
 </script>
<div class="user-create">

    <h1 class="box-title"><?= Html::encode($this->title) ?></h1>

    <div class="user-signup participation-border fl-left">
     <div class="row">
        <div class="col-xs-12 col-sm-6">
<?php $UsersList= (ArrayHelper::map($usertypemodel::find()->where('user_type_id in (3, 5, 10)')->orderBy('user_type')->all(),'user_type_id','user_type'));     
            $MediaList= (ArrayHelper::map($mediatypemodel::find()->orderBy('media_agency_name')->all(),'media_agency_id','media_agency_name'));    
            ?>
    <?php $form = ActiveForm::begin(['options' => [
                'id' => 'usercreateform',
            'enctype' => 'multipart/form-data',
			'enableAjaxValidation' => false,
             ]]); ?>
    
    <?php 
    echo $form->field($model, 'email')->textInput(['autocomplete' => 'off'])->label('Email / Mobile');?>
   <div id="errorObj" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>

  <?php  echo $form->field($model, 'validemail')->hiddenInput(['autocomplete' => 'off'])->label(false); ?>

    <?php echo $form->field($model, 'password')->passwordInput(['autocomplete' => 'off']); ?>
    <div id="errorObj" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>
   
   <?php echo $form->field($model, 'confirmpassword')->passwordInput(['autocomplete' => 'off']);?>
  <div id="errorObj" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>


   <?php echo $form->field($model, 'user_type_ref_id')->dropDownList($UsersList, ['prompt'=>'Select User Type']) ;?>
   <div id="errorObj" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>
   
   <?php echo  $form->field($model, 'media_agency_ref_id')->dropDownList($MediaList, ['prompt'=>'Select Media Agency']);
   //echo $form->field($model, 'validmediaagency')->hiddenInput()->label(false);?>
   
  
  <?php  echo $form->field($model, 'fname')->textInput(['autocomplete' => 'off']);?>
  <div id="errorObj" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>
   
   <?php echo $form->field($model, 'lname')->textInput(['autocomplete' => 'off']);?>
   <div id="errorObj" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>

   <?php echo $form->field($model, 'mobile')->textInput(['autocomplete' => 'off']);?>
   <div id="errorObj" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>

   <?php  if($model->gender==''){$model->gender = 'Male';}
   echo $form->field($model,'gender')->radioList(['Male' => 'Male', 'Female' => 'Female']);
    echo $form->field($model, 'dob')->widget(\yii\jui\DatePicker::classname(), [
			'value'  => '1232', 'dateFormat' => $dateformat, 'options' => ['class' => 'form-control'],
                        'options' => ['class' => 'form-control'],            
                        'clientOptions' => [
                            'changeMonth' => true,
                            'yearRange'=> (date('Y')-70).':'.(date('Y')+50),
                            'changeYear' => true,
                            //'maxDate' => 0, 
                            'showOn' => 'button',
                            'buttonImage' => 'images/calendar.gif',
                            'buttonImageOnly' => true,
                            'buttonText' => 'Select date',
                            'buttonImage' => Yii::$app->request->BaseUrl.'/images/calendar.gif',
                        ],
        ])->textInput(['readonly' => true]);
    ?>
    </div>
        
    <div class="col-xs-12 col-sm-6">    
    <?php
	
    echo $form->field($model, 'citizen')->dropDownList($countries,['prompt'=>'Select citizen']);?>
    <div id="errorObj" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>
   
   <?php echo $form->field($model, 'domicile')->textInput(['autocomplete' => 'off']);?>
   <div id="errorObj" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>

    <?php echo '<input id="pac-input" class="controls" type="text" placeholder="Search Box" size="50">';?>
   
   <?php echo '<div id="map_canvas" style="height:300px; width:auto; position: relative; overflow: hidden; "></div>';
    echo $form->field($model, 'current_location')->textInput();?>

    <div id="errorObj" class="help-block customvalids" style="display: none; margin: -17px 49px 15px; color: #e73d4a;">Html content is not allowed</div>
    <?php  echo $form->field($model, 'latitude')->hiddenInput()->label(false);?>
    <?php echo $form->field($model, 'longitude')->hiddenInput()->label(false);
		?>
        
        
        </div>
      
     </div>

  <div class="row text-center admin-create-user">
         <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary usersignup']) ?>
    </div>
        
        </div>
		<?php ActiveForm::end(); ?>
        </div>
</div>
<script>
$(function(){
$('.field-resetprofilepasswordform-checkoldpassword').hide();
jQuery.validator.addMethod("notHtml", function(value, element, param) {
  return this.optional(element) || !value.match(/<\/?[^>]*>/g);
}, "HTML content is not allowed");

jQuery.validator.addMethod("notEqualTo", function(value, element, param) {
var oldpswd = $(param).val();
  return this.optional(element) || value != oldpswd;
}, "Please specify a different (non-default) value");

jQuery.validator.addMethod("notEqual", function(value, element, param) {
  return this.optional(element) || value != param;
}, "Please specify a different (non-default) value");

jQuery.validator.addMethod('onechar', function(value, element) {
return this.optional(element) || (value.match(/[a-zA-Z]/));
 });
jQuery.validator.addMethod('onedigit', function(value, element) {
return this.optional(element) || (value.match(/[0-9]/));
 });
 jQuery.validator.addMethod('onespecialcharacter', function(value, element) {
return this.optional(element) || (value.match(/[~_{}$&+,:;=?@#|'<>.^*()[\]\|\\"\/`%!-]/));
 });
 $.validator.addMethod('email_phone', function( value, element ) {
			return this.optional(element) || (value.match(/^([0-9]{10})$|^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/));
		});
jQuery.validator.addMethod("checknumber",function(value,element)
{
return this.optional(element) || /^([0-9]{10})$/i.test(value); 
},"Mobile Number is invalid");	
$("#usercreateform").validate({
            rules: {
                "CreateUserForm[email]": {
                    required: true,
                    email_phone: true,
					notHtml: true
                },
                "CreateUserForm[password]": {
                    required: true,
					notHtml: true,
					minlength:6,
					onespecialcharacter:true,
					onechar:true,
					onedigit:true,
                },
				"CreateUserForm[confirmpassword]":{
					required: true,
					notHtml: true,
					equalTo: '#createuserform-password',
				},
				'CreateUserForm[user_type_ref_id]':{
					required: true,
					notHtml: true,
				},
				"CreateUserForm[mobile]":{
					notHtml: true,
					checknumber:true,
				},
				"CreateUserForm[gender]":{
					notHtml: true,
				},
				"CreateUserForm[dob]":{
					required: true,
					notHtml: true,
				},
				"CreateUserForm[citizen]":{
					notHtml: true,
				},
				"CreateUserForm[domicile]":{
					notHtml: true,
				},
				"CreateUserForm[current_location]":{
					notHtml: true,
				},
				"CreateUserForm[fname]":{
					notHtml: true,
				},
				"CreateUserForm[lname]":{
					notHtml: true,
				},
            },
            messages: {
                "CreateUserForm[email]": {
                    required: "Email cannot be blank",
                    email_phone: "Please enter a valid email address/ phone",
                },
                "CreateUserForm[password]": {
                    required: "Password cannot be blank",
					minlength: "Password should contain atleast 6 characters",
					onespecialcharacter:"Password must contain atleast one special character",
					onechar:"Password must contain at least one character",
					onedigit:"Password must contain at least one number",
                },
				"CreateUserForm[confirmpassword]":{
					required: "Please re-enter password",
					equalTo: "Passwords do not match",
				},
				'CreateUserForm[user_type_ref_id]':{
					required: "Please select user type",
				},
				"CreateUserForm[mobile]":{
					checknumber:"Please enter valid mobile number",
				},
				"CreateUserForm[dob]":{
					required: "Please select date of birth",
				}
            }
        });
});
</script>
   <script>    		
		$('#usercreateform .form-control').keyup(function(){
			$(".usersignup").prop('disabled', false);
			$(".field-createuserform-email .help-block").hide();    
		});
		$('#usercreateform .form-control').change(function(){
			$(".usersignup").prop('disabled', false);
			$(".field-createuserform-email .help-block").hide();    
		});
//for vaklidation of media agency
       $(function()
     {        
        $(".field-createuserform-validemail .help-block").hide();   
       $(".field-createuserform-media_agency_ref_id").css('display','none');
        $("select[id^=createuserform-user_type_ref_id]").change(function(){
        var usertype = $(this).val();
        if(usertype == 9){
            $(".field-createuserform-media_agency_ref_id").css('display','block');  
        }else{
            $('#createuserform-media_agency_ref_id').val("");
            $(".field-createuserform-media_agency_ref_id").css('display','none');
        }
        });
        
        initMap();
     });
 

   $(document).ready(function(){
        if($('#createuserform-fname').val() != ''){
	$('.field-createuserform-fname').css('display','block');
    $('.field-createuserform-lname').css('display','block');
}else{
	$('.field-createuserform-fname').css('display','none');
    $('.field-createuserform-lname').css('display','none');
}
 
 $('#createuserform-user_type_ref_id').change(function(){
     if($(this).val() == '3'){
     $('.field-createuserform-fname').css('display','block');
     $('.field-createuserform-lname').css('display','block');
     }else{
     $('.field-createuserform-fname').css('display','none');
     $('.field-createuserform-lname').css('display','none');
     $('#createuserform-fname').val('');
     $('#createuserform-lname').val('');
     }
 });
 })

        </script>

    <style>
.field-createuserform-dob{ position:relative;}
        
    </style>