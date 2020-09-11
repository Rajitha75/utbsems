<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>PDF</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link type="text/css" href="<?php echo Yii::getAlias('@web'); ?>/themes/metronic/assets/global/css/bootstrap.min.css" rel="stylesheet"  media="print" media="screen"/>
<link type="text/css" href="<?php echo Yii::getAlias('@web'); ?>/themes/metronic/assets/global/css/font-awesome.css" rel="stylesheet"   media="print" media="screen"/>
<link type="text/css" href="<?php echo Yii::getAlias('@web'); ?>/themes/metronic/assets/global/css/pdf.css" rel="stylesheet"  media="print" media="screen"/>

<link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,700" rel="stylesheet" media="print" media="screen"> 

<script src="<?php echo Yii::getAlias('@web'); ?>/themes/metronic/assets/global/scripts/bootstrap.js" type="text/javascript" media="print" media="screen"></script>

<style>
@media print { 
body{
	font-family: 'Titillium Web', sans-serif !important;
	font-size:13px;
}

.col-lg-6, .col-sm-6{width: 50% !important;float:left !important;}
.col-sm-4{float:left !important;}
.col-sm-8{float:left !important;}
.col-lg-3{width: 25% !important;float:left !important;}
.col-lg-9{width: 75% !important;float:left !important;}

.top_header{
	background:url(images/header-print.jpg) no-repeat !important;
	background-size: contain !important;
	width:100%;
	
	padding: 3px 15px !important;
	margin-top: 15px !important;
	float:none !important;
	clear:both !important;
	display:block !important;
	overflow:hidden !important;
}
.text {
    text-align: right !important;
}
.title_header h1 {
    color: #fff !important;
    font-weight: 600 !important;
    font-size: 26px !important;
    margin:0 !important;
    text-transform: uppercase !important;
	padding:0 !important;
}
.title_header {
    margin: 15px 0 !important;
}
.address {
    /* margin: 35px 15px; */
    padding-left: 15px !important;
    font-size: 14px !important;
    font-weight: normal !important;
	line-height:24px !important;
}
.title_header span {
    font-size: 14px !important;
    color: #fff !important;
}
.address h2 {
    color: #4b96f3 !important;
    font-size: 18px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
}
.top_footer{
    background:url(images/header.jpg) no-repeat !important;
	background-size:cover !important;
	height:auto !important;
	min-height:43px !important;
	padding: 3px 15px !important;
	margin-bottom:10px !important;
    margin-top: 15px !important;
}
.description .tit{
	background:#e7505a !important;
	padding: 10px !important;
    color: #fff !important;
    font-size: 18px !important;
    text-transform: uppercase !important;
}

.table > tbody > tr > td {
    font-size: 12px !important;
    
    vertical-align: middle !important;
}
.table > tbody > tr {
   
     	border: dashed #b3b3b3 !important;
        border-width: 10px 0 0 10px !important;
		
}

.table-striped>tbody>tr:nth-child(odd)>td,
.table-striped>tbody>tr:nth-child(odd)>th {
	background-color: #f8f8f8 !important;
}

.t_width{ 
    width: 180px !important;
}
.ft_pad {
    padding: 10px !important;
    color: #fff !important
}
.img1{float:left !important;margin-left:5px !important;margin-bottom:5px !important;width:30px !important;}
.map .img-responsive{ margin:0 auto; width:100%;}
@page{margin:0.3cm;padding:.3cm;}
.map_locationblock{width:100%;margin-bottom:10px;	padding: 0px 5px !important;}
.container {
    margin-left:15px;
	margin-right:15px;
  }
 .mgn-btm{margin-bottom:20px !important;display:block;} 
 .container p{margin: !important;padding:0 !important;line-height:24px !important;font-size:12px !important;color:#121212 !important;}
 .container ul li{line-height:24px !important;}
.container ul li, .container>.table>tr>td{font-size:12px !important;word-break:break-word !important;padding:0 !important;}
.table>tr>td>ul>li:first-child,  .table>tr>td:first-child, .container ul li:first-child{color:#121212 !important;}
td{border:dashed #b3b3b3 !important;border-width:0 0 1px 0 !important;}
.address{border:dashed #e7505a !important;border-width:0 0 0 3px !important;margin-left:10px;}
ul{padding-left:15px;margin:0;}
ul li{list-style:none;}
.container>table>tr> {border: dashed #b3b3b3 !important;border-width: 10px 0 0 10px !important;}
}
    
</style>
</head>
<body>
    <div class="" style="">
     <div class="top_header" style="width:100% !important;">
        	<div class="col-lg-3">
              <img src="<?php echo $imageurl ?>" class="img-responsive" width="75px" height="81px" style="padding:0 0 10px 0 !important;margin:0 !important;">
              
            </div>
            <div class="col-lg-9">
             <div class="title_header text">
               <h1><?php echo !empty($studentdata['name']) ? $studentdata['name'] : ''; ?></h1>
               <span>Student Data</span>
            </div>
            </div>
        </div>
      
		
		
		
		
		
        <div class="clearfix"></div>
      <div class="description">
         <div class="tit">Personal Information</div>
             <div class="container">
              <table class="table table-striped" width="100%" cellpadding="0" cellspacing="0" style="padding:0 10px;">
   
    <tbody>
    <tr style="background:#f8f8f8;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Name :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#208992 !important;font-weight:bold;"><?php echo !empty($studentdata['name']) ? strtoupper($studentdata['name']) : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;"></td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"></td>
        </tr>
      <tr style="border: dashed #b3b3b3 !important;border-width: 10px 0 0 10px !important;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Roll No :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['rollno']) ? $studentdata['rollno'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Rumpun :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['rumpun']) ? $studentdata['rumpun'] : ''; ?>&nbsp;</td>
      </tr>

      <tr style="background:#f8f8f8;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Nationality :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['nationality']) ? $studentdata['nationality'] : (!empty($studentdata['nationalityother']) ? $studentdata['nationalityother'] : ''); ?></td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">IC No :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['ic_no']) ? $studentdata['ic_no'] : ''; ?>&nbsp;</td>
      </tr>
      <tr>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">IC Color :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['ic_color']) ? $studentdata['ic_color'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Passport No :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['passportno']) ? $studentdata['passportno'] : ''; ?>&nbsp;</td>
      </tr>

      <tr style="background:#f8f8f8;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Race :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['race']) ? $studentdata['race'] : (!empty($studentdata['raceother']) ? $studentdata['raceother'] : ''); ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Religion :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['religion']) ? $studentdata['religion'] : (!empty($studentdata['religionother']) ? $studentdata['religionother'] : ''); ?>&nbsp;</td>
      </tr>

      <tr>
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Gender :</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['gender']) ? $studentdata['gender'] : ''; ?>&nbsp;</td>
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Marital Status :</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['martial_status']) ? $studentdata['martial_status'] : ''; ?>&nbsp;</td>
      </tr>

      <tr style="background:#f8f8f8;">
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Date of Birth :</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['dob']) ? $studentdata['dob'] : ''; ?>&nbsp;</td>
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Place of Birth :</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['place_of_birth']) ? $studentdata['place_of_birth'] : ''; ?>&nbsp;</td>
      </tr>

      <tr>
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Telephone No (Mobile) :</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['telephone_mobile']) ? $studentdata['telephone_mobile'] : ''; ?>&nbsp;</td>
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Telephone No. (Home) :</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['tele_home']) ? $studentdata['tele_home'] : ''; ?>&nbsp;</td>
      </tr>

      <tr style="background:#f8f8f8;">
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Email:</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['email']) ? $studentdata['email'] : ''; ?>&nbsp;</td>
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Highest Qualification :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['highest_qualification']) ? $studentdata['highest_qualification'] : (!empty($studentdata['highestqualificationother']) ? $studentdata['highestqualificationother'] : ''); ?>&nbsp;</td>
       
      </tr>
		
	<?php if($studentdata['highest_qualification'] == 'Advanced National Diploma' || $studentdata['highest_qualification'] == 'Higher National Diploma' || $studentdata['highest_qualification'] == 'International Baccalaureate' || $studentdata['highest_qualification'] == 'Undergraduate Degree' || $studentdata['highest_qualification'] == 'Masters by Coursework' || $studentdata['highest_qualification'] == 'Masters by Research' || $studentdata['highest_qualification'] == 'Doctor of Philosophy (PhD)'){ ?>
	  <tr style="background:#f8f8f8;">
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Course Taken:</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['highestqualification_coursetaken']) ? $studentdata['highestqualification_coursetaken'] : ''; ?>&nbsp;</td>
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Result :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['highestqualification_result']) ? $studentdata['highestqualification_result'] : ''; ?>&nbsp;</td>
       
      </tr>
	  <?php } ?>
	  
		<tr>
		<td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Name of Last School Attended :</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['lastschoolname']) ? $studentdata['lastschoolname'] : ''; ?>&nbsp;</td>
      <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Type of Entry :</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['type_of_entry']) ? $studentdata['type_of_entry'] :  ''; ?>&nbsp;</td>
       
      </tr> 
	  
      <tr style="background:#f8f8f8;">
       <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Special Needs :</td>
       <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['specialneeds']) ? $studentdata['specialneeds'] : ''; ?>&nbsp;</td>
      </tr>      
    </tbody>

  </table>


            </div>
            </div>
            </div>

            <div class="clearfix"></div>
      <div class="description">
         <div class="tit">Postal Address</div>
             <div class="container">
              <table class="table table-striped" width="100%" cellpadding="0" cellspacing="0" style="padding:0 10px;">
   
    <tbody>
	<tr>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Type of Residential :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['type_of_residential']) ? $studentdata['type_of_residential'] : (!empty($studentdata['typeofresidentialother']) ? $studentdata['typeofresidentialother'] : ''); ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Address Line :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['address']) ? $studentdata['address'] : ''; ?>&nbsp;</td>
      </tr>
	  <!--
      <tr style="background:#f8f8f8;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Address Line 2 :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php //echo  !empty($studentdata['address2']) ? $studentdata['address2'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Address Line 3 :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php //echo !empty($studentdata['address3']) ? $studentdata['address3'] : ''; ?>&nbsp;</td>
      </tr>
	  -->

      <tr>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Country :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['countrycode']) ? $studentdata['countrycode'] : ''; ?></td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Postal Code :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['postal_code']) ? $studentdata['postal_code'] : ''; ?>&nbsp;</td>
      </tr>
      
      
    </tbody>

  </table>

  
            </div>
            </div>
            </div>
            <div class="clearfix"></div>
      <div class="description">
         <div class="tit">Bank Information</div>
             <div class="container">
              <table class="table table-striped" width="100%" cellpadding="0" cellspacing="0" style="padding:0 10px;">
   
    <tbody>
      <tr style="background:#f8f8f8;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Bank Name :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['bank_name']) ? $studentdata['bank_name'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Bank Account Name :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['bank_account_name']) ? $studentdata['bank_account_name'] : ''; ?>&nbsp;</td>
      </tr>
	  
	  <tr>
	  <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Bank Account No :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['account_no']) ? $studentdata['account_no'] : ''; ?>&nbsp;</td>
      </tr>
      
      
    </tbody>

  </table>

  
            </div>
            </div>
            </div>

            <div class="clearfix"></div>
      <div class="description">
         <div class="tit">Parents Information</div>
             <div class="container">
              <table class="table table-striped" width="100%" cellpadding="0" cellspacing="0" style="padding:0 10px;">
   
    <tbody>
      <tr>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Father / Guardian Name :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['father_name']) ? $studentdata['father_name'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Guardian Relation :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['gaurdian_relation']) ? $studentdata['gaurdian_relation'] : ''; ?>&nbsp;</td>
      </tr>
      
      <tr style="background:#f8f8f8;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Father / Guardian IC No :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['fathericno']) ? $studentdata['fathericno'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Father / Guardian IC Color :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['father_ic_color']) ? $studentdata['father_ic_color'] : ''; ?>&nbsp;</td>
      </tr>

      <tr>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Father\'s Telephone No :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['father_mobile']) ? $studentdata['father_mobile'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Telephone No (Home) :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['mobile_home']) ? $studentdata['mobile_home'] : ''; ?>&nbsp;</td>
      </tr>

      <tr style="background:#f8f8f8;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Father/Guardian Employment :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['gaurdian_employment']) ? $studentdata['gaurdian_employment'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Father/Guardian Employer :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['gaurdian_employer']) ? $studentdata['gaurdian_employer'] : ''; ?>&nbsp;</td>
      </tr>

      <tr>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Remarks :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['remarks']) ? $studentdata['remarks'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Telephone No. (Work) :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['telphone_work']) ? $studentdata['telphone_work'] : ''; ?>&nbsp;</td>
      </tr>

      <tr style="background:#f8f8f8;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Mother Name :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['mother_name']) ? $studentdata['mother_name'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Mother IC No :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['mothericno']) ? $studentdata['mothericno'] : ''; ?>&nbsp;</td>
      </tr>

      <tr>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Mother IC Color :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['mother_ic_color']) ? $studentdata['mother_ic_color'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Mother\'s Telephone No :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['mother_mobile']) ? $studentdata['mother_mobile'] : ''; ?>&nbsp;</td>
      </tr>
    </tbody>

  </table>

  
            </div>
            </div>
            </div>

            <div class="clearfix"></div>
      <div class="description">
         <div class="tit">Programme Information</div>
             <div class="container">
              <table class="table table-striped" width="100%" cellpadding="0" cellspacing="0" style="padding:0 10px;">
   
    <tbody>
      <tr style="background:#f8f8f8;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Sponsor Type :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['sponsor_type']) ? $studentdata['sponsor_type'] : ''; ?>&nbsp;</td>
		<td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Type of Programme :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['type_of_programme']) ? $studentdata['type_of_programme'] : ''; ?>&nbsp;</td>
        
      </tr>
      
      <tr>
	  <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Programme Name :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['programmename']) ? $studentdata['programmename'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">School/Faculty :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['faculty_name']) ? $studentdata['faculty_name'] : ''; ?>&nbsp;</td>
      </tr>
	  
	  <tr style="background:#f8f8f8;">
	  <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Entry :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['entry']) ? $studentdata['entry'] : (!empty($studentdata['entry_other']) ? $studentdata['entry_other'] : ''); ?></td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Status of Student :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['status_of_student']) ? $studentdata['status_of_student'] : (!empty($studentdata['status_of_student_other']) ? $studentdata['status_of_student_other'] : ''); ?></td>
      </tr>

      <tr>
		<td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Intake No :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['intake']) ? $studentdata['intake'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Mode :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['mode']) ? $studentdata['mode'] : ''; ?>&nbsp;</td>
      </tr>

      <tr style="background:#f8f8f8;">
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">UTB Email Address :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['utb_email_address']) ? $studentdata['utb_email_address'] : ''; ?>&nbsp;</td>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Date of Registration :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo !empty($studentdata['date_of_registration']) ? $studentdata['date_of_registration'] : ''; ?>&nbsp;</td>
      </tr>

      <tr>
        <td style="padding:15px!important;font-size: 12px !important;font-weight:bold;color:#484848;">Date of Leaving :</td>
        <td style="padding:15px!important;font-size: 12px !important;color:#121212 !important;"><?php echo  !empty($studentdata['date_of_leaving']) ? $studentdata['date_of_leaving'] : ''; ?>&nbsp;</td>
      </tr>

    </tbody>

  </table>

  
            </div>
            </div>
            </div>

            </div>

</body>
</html>
