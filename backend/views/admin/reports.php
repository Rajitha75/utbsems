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
</style>
<h3>Report:</h3>
<button type="button" class="btn btn-success" category="rumpun" categoryname="Rumpun">Rumpun</button>
<button type="button" class="btn btn-danger" category="nationality" categoryname="Nationality">Nationality</button>
<button type="button" class="btn btn-warning" category="race" categoryname="Race">Race</button>
<button type="button" class="btn btn-info" category="religion" categoryname="Religion">Religion</button>
<button type="button" class="btn btn-grn" category="ic_color" categoryname="IC Color">IC Color</button>
<button type="button" class="btn btn-violet" category="gender" categoryname="Gender">Gender</button>
<button type="button" class="btn btn-pnk" category="martial_status" categoryname="Martial Status">Martial Status</button>
<button type="button" class="btn btn-gry" category="type_of_entry" categoryname="Type of Entry">Type of Entry</button>
<button type="button" class="btn btn-org" category="father_ic_color" categoryname="Father / Gaurdian IC Color">Father / Gaurdian IC Color</button>
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
<button type="button" class="btn btn-grn" category="school_faculty" categoryname="School/Faculty">School/Faculty</button>


<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

<script>
$(document).ready(function(){
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