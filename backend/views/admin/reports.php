<script src="<?php echo Yii::getAlias('@web'); ?>/js/highcharts/highcharts.js"></script>
<script src="<?php echo Yii::getAlias('@web'); ?>/js/highcharts/exporting.js"></script>
<script src="<?php echo Yii::getAlias('@web'); ?>/js/highcharts/export-data.js"></script>
<style>
.btn-grn{ background: rgb(144, 237, 125); color:#FFFFFF }
.btn-violet{ background: rgb(128, 133, 233); color:#FFFFFF}
.btn-pnk{ background: rgb(241, 92, 128); color:#FFFFFF}
.btn-gry { background: rgb(92, 92, 97); color:#FFFFFF}
.btn-org{ background: rgb(247, 163, 92); color:#FFFFFF}
.btn-drkgrn{ background: rgb(43, 144, 143); color:#FFFFFF}
.btn-ylw{ background: rgb(228, 211, 84); color:#FFFFFF}
.fadebox{opacity: 0.6;}
.btn{
    margin-right: 10px;
    margin-bottom: 10px;
}

#advancedSearch{
        top:10%;
        left:22%
    }
</style>

<?php 
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>

<h3>Report:</h3>
<button type="button" class="btn btn-success" category="rumpun" categoryname="Rumpun">Rumpun</button>
<button type="button" class="btn btn-danger" category="nationality" categoryname="Nationality">Nationality</button>
<button type="button" class="btn btn-warning" category="race" categoryname="Race">Race</button>
<button type="button" class="btn btn-info" category="religion" categoryname="Religion">Religion</button>
<button type="button" class="btn btn-grn" category="ic_color" categoryname="IC Color">IC Color</button>
<button type="button" class="btn btn-violet" category="gender" categoryname="Gender">Gender</button>
<button type="button" class="btn btn-pnk" category="martial_status" categoryname="Martial Status">Martial Status</button>
<button type="button" class="btn btn-gry" category="type_of_entry" categoryname="Type of Entry">Type of Entry</button>
<button type="button" class="btn btn-org" category="father_ic_color" categoryname="Father / Guardian IC Color">Father / Guardian IC Color</button>
<button type="button" class="btn btn-drkgrn" category="mother_ic_color" categoryname="Mother IC Color">Mother IC Color</button>
<button type="button" class="btn btn-ylw" category="sponsor_type" categoryname="Sponsor Type">Sponsor Type</button>
<button type="button" class="btn btn-success" category="programme_name" categoryname="Programme Name">Programme Name</button>
<button type="button" class="btn btn-danger" category="entry" categoryname="Entry">Entry</button>
<button type="button" class="btn btn-warning" category="intake" categoryname="Intake No">Intake No</button>
<button type="button" class="btn btn-info" category="mode" categoryname="Mode">Mode</button>
<button type="button" class="btn btn-grn" category="bank_name" categoryname="Bank Name">Bank Name</button>
<button type="button" class="btn btn-success" category="district" categoryname="District">District</button>
<button type="button" class="btn btn-danger" category="age" categoryname="Age">Age</button>
<button type="button" class="btn btn-warning" category="highest_qualification" categoryname="Highest Qualification Obtained">Highest Qualification Obtained</button>
<button type="button" class="btn btn-info" category="type_of_programme" categoryname="Type of Programme">Type of Programme</button>
<button type="button" class="btn btn-grn" category="school" categoryname="School/Faculty">School/Faculty</button>


<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

<button type="button" id="advsearch" class="btn-success">Advanced Search</button> 

<div id="advancedSearch" class="confirm-box" style="display:none;">
    <h3 id="dataConfirmLabel" >Advance Search</h3>   
    
    
    <div class="row">
        <div class="col-xs-16 col-sm-16">

 <?php 
 $fromyear = date('Y', strtotime('-20 years'));
 $range = range($fromyear, $fromyear+40);
 $years = array_combine($range, $range);
 $form = ActiveForm::begin([
			'id' => 'advsearchform'
			]); ?>
	<div class="col-xs-4 col-sm-3">
	
	<?php //echo $form->field($model, 'userid')->hiddenInput(['autocomplete' => 'off','value'=>!empty(Yii::$app->getRequest()->getQueryParam('id')) ? Yii::$app->getRequest()->getQueryParam('id') : ''])->label('');?>
    <?php echo $form->field($model, 'name')->textInput(array('placeholder' => 'Student Name'),['autocomplete' => 'off'])->label(false);?>
    
    <?php echo $form->field($model, 'rollno')->textInput(array('placeholder' => 'Roll No'),['autocomplete' => 'off'])->label(false);?>

	<?php echo $form->field($model, 'rumpun')->dropDownList([ 'XLR8' => 'XLR8', 'PRO-XTIV' => 'PRO-XTIV', 'XCEL' => 'XCEL', 'CRTIV' => 'CRTIV'],['prompt' => 'Rumpun'])->label(false); ?>

	
	<?php echo $form->field($model, 'nationality')->textInput(array('placeholder' => 'Nationality'),['autocomplete' => 'off'])->label(false); ?>

	<?php echo $form->field($model, 'ic_no')->textInput(array('placeholder' => 'IC No'),['autocomplete' => 'off'])->label(false);?>

	<?php echo $form->field($model, 'ic_color')->dropDownList(['Yellow' => 'Yellow', 'Red' => 'Red', 'Green' => 'Green', 'Purple' => 'Purple'], ['prompt' => 'IC Color'])->label(false);?>
	
	<?php echo $form->field($model, 'passportno')->textInput(array('placeholder' => 'Passport No'),['autocomplete' => 'off'])->label(false);?>

	
	<?php echo $form->field($model, 'race')->textInput(array('placeholder' => 'Race'),['autocomplete' => 'off'])->label(false); ?>

	<?php echo $form->field($model, 'religion')->textInput(array('placeholder' => 'Religion'),['autocomplete' => 'off'])->label(false); ?>

    </div>
    <div class="col-xs-4 col-sm-3">
	<?php echo $form->field($model, 'gender')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female'],['prompt' => 'Gender'])->label(false); ?>
	
    <?php echo $form->field($model, 'martial_status')->dropDownList([ 'Married' => 'Married', 'Single' => 'Single'],['prompt' => 'Martial Status'])->label(false); ?>
	
	<?php echo $form->field($model, 'age')->textInput(array('placeholder' => 'Age'),['autocomplete' => 'off'])->label(false);?>
    
		<?php echo $form->field($model, 'telephone_mobile')->textInput(array('placeholder' => 'Telephone No. (Mobile)'),['autocomplete' => 'off'])->label(false);?>

		<?php echo $form->field($model, 'tele_home')->textInput(array('placeholder' => 'Telephone No. (Home)'),['autocomplete' => 'off'])->label(false);?>
	
		<?php //echo $form->field($model, 'email')->textInput(array('placeholder' => 'Email'),['autocomplete' => 'off'])->label(false);?>
		
		<?php echo $form->field($model, 'lastschoolname')->textInput(array('placeholder' => 'Name of Last School Attended'),['autocomplete' => 'off'])->label(false);?>
		
		<?php echo $form->field($model, 'highest_qualification')->textInput(array('placeholder' => 'Highest Qualification Obtained'),['autocomplete' => 'off'])->label(false);?>
		
		<?php echo $form->field($model, 'type_of_entry')->textInput(array('placeholder' => 'Type of Entry'),['autocomplete' => 'off'])->label(false); ?>
		
		<?php echo $form->field($model, 'address')->textInput(array('placeholder' => 'Postal Address'))->label(false); ?>
		
		</div>
	<div class="col-xs-4 col-sm-3">
	
		<?php echo $form->field($model, 'state_address')->textInput(array('placeholder' => 'District'),['autocomplete' => 'off' ])->label(false); ?>
		
		<?php echo $form->field($model, 'type_of_residential')->textInput(array('placeholder' => 'Type of Residential'),['autocomplete' => 'off' ])->label(false); ?>

		<?php echo $form->field($model, 'bank_name')->dropDownList([ 'BAIDURI' => 'BAIDURI', 'BIBD' => 'BIBD', 'STANDARD CHARTERED BANK' => 'STANDARD CHARTERED BANK', 'TAIB' => 'TAIB'],['prompt' => 'Bank Name'])->label(false); ?>
		
		<?php echo $form->field($model, 'bank_account_name')->textInput(array('placeholder' => 'Bank Account Name'),['autocomplete' => 'off'])->label(false);?>
		
		<?php echo $form->field($model, 'account_no')->textInput(array('placeholder' => 'Bank Account No'),['autocomplete' => 'off'])->label(false);?>
	
		<?php echo $form->field($model, 'father_name')->textInput(array('placeholder' => 'Father/Guardian Name'),['autocomplete' => 'off'])->label(false);?>

		<?php echo $form->field($model, 'fathericno')->textInput(array('placeholder' => 'Father/Guardian IC No '),['autocomplete' => 'off'])->label(false);?>

		<?php echo $form->field($model, 'mother_name')->textInput(array('placeholder' => 'Mother Name '),['autocomplete' => 'off'])->label(false);?>

		<?php echo $form->field($model, 'mothericno')->textInput(array('placeholder' => 'Mother IC No '),['autocomplete' => 'off'])->label(false);?>

		

</div>
    <div class="col-xs-4 col-sm-3">
	
<?php echo $form->field($model, 'sponsor_type')->textInput(array('placeholder' => 'Sponsor Type'),['autocomplete' => 'off' ])->label(false); ?>
		
		<?php echo $form->field($model, 'type_of_programme')->dropDownList(['Undergraduate Degree' => 'Undergraduate Degree', 'Masters by Coursework' => 'Masters by Coursework', 'Masters by Research' => 'Masters by Research', 'Doctor of Philosophy (PhD)' => 'Doctor of Philosophy (PhD)'], ['prompt' => 'Type of Programme'])->label(false);?>
	
		<?php echo $form->field($model, 'programme_name')->dropDownList(ArrayHelper::map($programme,'id','programme_name'),['prompt'=>'Please select Programme'])->label(false); ?>
		
		<?php echo $form->field($model, 'entry')->dropDownList(['First Year' => 'First Year', 'Second Year' => 'Second Year', 'Other' => 'Other'], ['prompt' => 'Entry'])->label(false);?>

		
		<?php //echo $form->field($model, 'status_of_student')->dropDownList(['Current Student' => 'Current Student', 'Withdrawn' => 'Withdrawn'], ['prompt' => 'Status of Student'])->label(false);?>

<?php echo $form->field($model, 'intake')->dropDownList($years,['prompt' => 'Intake No'])->label(false);?>

<?php echo $form->field($model, 'mode')->dropDownList(['Full Time' => 'Full Time', 'Part Time'=> 'Part Time'],['prompt' => 'Mode'])->label(false);?>

<?php echo $form->field($model, 'utb_email_address')->textInput(array('placeholder' => 'UTB Email Address'),['autocomplete' => 'off'])->label(false);?>

<?php //echo $form->field($model, 'degree_classification')->textInput(array('placeholder' => 'Degree Classification'),['autocomplete' => 'off'])->label(false);?>

<?php 
echo $form->field($model, 'date_of_registration')->widget(\yii\jui\DatePicker::classname(), [
	'value'  => '1232', 'dateFormat' => 'dd-MM-yyyy', 'options' => ['class' => 'form-control'],
				'options' => ['class' => 'form-control'],            
				'clientOptions' => [
					'changeMonth' => true,
					'yearRange'=> '-40:+20',
					'defaultDate' => '-70y',
					'changeYear' => true,
					'maxDate' => 0, 
					'showOn' => 'button',
					'buttonImage' => 'images/calendar.gif',
					'buttonImageOnly' => true,
					'buttonText' => 'Select date',
					 'buttonImage' => Yii::$app->request->BaseUrl.'/images/calendar.gif',
				],
])->textInput(array('placeholder' => 'Date of Registration'),['readonly' => true])->label(false); ?>

<?php 
echo $form->field($model, 'date_of_leaving')->widget(\yii\jui\DatePicker::classname(), [
	'value'  => '1232', 'dateFormat' => 'dd-MM-yyyy', 'options' => ['class' => 'form-control'],
				'options' => ['class' => 'form-control'],            
				'clientOptions' => [
					'changeMonth' => true,
					'yearRange'=> '-40:+20',
					'defaultDate' => '-70y',
					'changeYear' => true,
					'maxDate' => 0, 
					'showOn' => 'button',
					'buttonImage' => 'images/calendar.gif',
					'buttonImageOnly' => true,
					'buttonText' => 'Select date',
					 'buttonImage' => Yii::$app->request->BaseUrl.'/images/calendar.gif',
				],
])->textInput(array('placeholder' => 'Date of Leaving'),['readonly' => true])->label(false); ?>

<?php //echo $form->field($model, 'previous_roll_no')->textInput(array('placeholder' => 'Previous Roll No'),['autocomplete' => 'off'])->label(false);?>

<?php //echo $form->field($model, 'previous_programme_name')->textInput(array('placeholder' => 'Previous Programmme Name'),['autocomplete' => 'off'])->label(false);?>

<?php //echo $form->field($model, 'previous_intake_no')->dropDownList($years,['prompt' => 'Previous Intake No'])->label(false);?>

<?php //echo $form->field($model, 'previous_utb_email')->textInput(array('placeholder' => 'Previous UTB Email'),['autocomplete' => 'off'])->label(false);?>		

	
 </div>
 
 </div>
					</div>
 <div class="row text-center">
         <div class="form-group">
 <?= Html::submitButton('Submit', ['class' => 'btn-primary btnadvsearch', 'id' => 'btnadvsearch']) ?>

 <button type="button" id="btnadvreset" class="btn-primary res-bnt btnadvreset">Reset</button>

 <button type="button" id="btnadvcancel" class="btn-primary btnadvcancel">Cancel</button>
 </div>
        
        </div>
		<?php ActiveForm::end(); ?>
</div>
<script>
$(document).ready(function(){
	$('#advsearch').click(function(){
        $('#advancedSearch').show();
    })
	
	$('#btnadvcancel').on('click', function (e) {
            $('#advancedSearch').hide();
            $('#advsearchform').reset();
        });

        $('#btnadvreset').on('click', function (e) {
            $('#advsearchform').reset();
        });

        $('#btnReset').on('click', function (e) {
            var searchUrl = $('#searchUrl').val();
            var pjaxContainer = 'pjax-list';
                var pjaxReloadURL = searchUrl;

            $.ajax({
                url: searchUrl,
                type: 'get',
                success: function (data) {
                    if (data) {
                        $('#student-studentname').val('');
                        $('#student-programme_name').val('');
                        //$.pjax.reload({url: pjaxReloadURL, container: '#' + $.trim(pjaxContainer, )});
                        $.pjax.reload({url: pjaxReloadURL, container: '#' + $.trim(pjaxContainer), async: false});
                        return false;
                    }
                },
                error: function (xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            });
            return false;
        });
		
		
		$('#btnadvsearch').on('click', function (e) {
            var searchUrl = $('#searchUrl').val();
            var pjaxContainer = 'pjax-list';
            var name = $('#student-name').val();
            var rollno = $('#student-rollno').val();
            var rumpun = $('#student-rumpun').val();
            var nationality = $('#student-nationality').val();
            var studenticno = $('#student-ic_no').val();
            var studenticcolor = $('#student-ic_color').val();
            var passportno = $('#student-passportno').val();
            var race = $('#student-race').val();
            var religion = $('#student-religion').val();
            var gender = $('#student-gender').val();
            var martialstatus = $('#student-martial_status').val();
            var mobile = $('#student-telephone_mobile').val();
            var telehome = $('#student-tele_home').val();
            //var email = $('#student-email').val();
            var typeofentry = $('#student-type_of_entry').val();
            var address = $('#student-address').val();
            var bankname = $('#student-bank_name').val();
            var accountno = $('#student-account_no').val();

            var fathername = $('#student-father_name').val();
            var fathericno = $('#student-fathericno').val();
            var mothername = $('#student-mother_name').val();
            var mothericno = $('#student-mothericno').val();
            var sponsortype = $('#student-sponsor_type').val();
            var programme_name = $('#student-programme_name').val();
            var entry = $('#student-entry').val();
            //var status = $('#student-status_of_student').val();
            var intake = $('#student-intake').val();

            var mode = $('#student-mode').val();
            var utbemail = $('#student-utb_email_address').val();
            //var degree = $('#student-degree_classification').val();
            var dateofregistration = $('#student-date_of_registration').val();
            var dateofleaving = $('#student-date_of_leaving').val();
            //var prevrollno = $('#student-previous_roll_no').val();
            //var prevprogname = $('#student-previous_programme_name').val();
            //var previntakeno = $('#student-previous_intake_no').val();
            //var prevutbemail = $('#student-previous_utb_email').val();
			var age = $('#student-age').val();
            var highest_qualification = $('#student-highest_qualification').val();
            var lastschoolname = $('#student-lastschoolname').val();
            var state_address = $('#student-state_address').val();
            var type_of_residential = $('#student-type_of_residential').val();
            var type_of_programme = $('#student-type_of_programme').val();
			var bank_account_name = $('#student-bank_account_name').val();
			var searchUrl = "<?php echo Yii::$app->request->BaseUrl; ?>"+'/admin/search-students';
			alert(searchUrl);
                var pjaxReloadURL = searchUrl + '?name=' + name+ '&rollno=' + rollno+ '&rumpun=' + rumpun+ '&nationality=' + nationality+ '&studenticno=' + studenticno+ '&studenticcolor=' + studenticcolor+ '&passportno=' + passportno+ '&race=' + race+ '&religion=' + religion+ '&gender=' + gender+ '&martialstatus=' + martialstatus+ '&mobile=' + mobile+ '&telehome=' + telehome+ '&typeofentry=' + typeofentry+ '&address=' + address+ '&bankname=' + bankname+ '&accountno=' + accountno+ '&fathername=' + fathername+ '&fathericno=' + fathericno+ '&mothername=' + mothername+ '&mothericno=' + mothericno+ '&sponsortype=' + sponsortype+ '&programme_name=' + programme_name+ '&entry=' + entry+ '&intake=' + intake+ '&mode=' + mode+ '&utbemail=' + utbemail+ '&dateofregistration=' + dateofregistration+ '&dateofleaving=' + dateofleaving + '&age=' + age + '&highest_qualification=' + highest_qualification + '&lastschoolname=' + lastschoolname + '&state_address=' + state_address + '&type_of_residential=' + type_of_residential + '&type_of_programme=' + type_of_programme + '&bank_account_name=' + bank_account_name;
            
			$.ajax({
                url: pjaxReloadURL,
                type: 'get',
                success: function (data) {
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    alert('There was an error with your request.' + xhr.responseText);
                }
            });
			
            return false;
        });
		
		
    $('.btn').click(function(){
        $('.btn').removeClass('activebox');
        $('.btn').addClass('fadebox');
        $(this).removeClass('fadebox');
        $(this).addClass('activebox');
        var curl = "<?php echo Yii::$app->request->BaseUrl.'/admin/get-report-details'; ?>";
        var category = $(this).attr('category');
        var categoryname = $(this).attr('categoryname');
        $.ajax({
            url: curl,
            type: 'GET',
            data: {'category': category },
            success: function(result){   
                var obj = jQuery.parseJSON(result);
                var series = [];
        $.each(obj, function(key,value) {
			console.log('studentscount',value.studentscount);
			console.log('category',value.category);
            series.push({name : value.category, y : parseInt(value.studentscount)});
        }); 
    Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: categoryname
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    credits: {
                enabled: false
            },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: series
    }]	
});
            },
            
            error: function(xhr, status, error) {
                //  alert('There was an error with your request.' + xhr.responseText);
            }
        }); 
    });

    $('.btn').mouseenter(function(){
        $(this).removeClass('fadebox');
    });

    $('.btn').mouseleave(function(){
        var boxlength = $('.activebox').length;
        if(boxlength == 1){
            if($(this).hasClass('activebox')){
                $(this).removeClass('fadebox');
            }else{
                $(this).addClass('fadebox');
            }
        }
       
    });

})
</script>