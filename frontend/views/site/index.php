<style>
	.navbar.compressed {
		padding-top: 10px;
		padding-bottom: 10px;
		box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
		border-color: rgba(34, 34, 34, .1);
		background: rgba(235, 235, 235) !important;
		color: #000;
	}
	.navbar.compressed li a{
		color: #000 !important;
		font-weight: 500;
        font-size: 15px;
	}
	
	.homeimage{
		width:120px;
		height:120px;
	}
	
	.imagediv{
		    display: block;
    padding: 20px;
    font-weight: bold;
	}

     @media (min-width:1025px){
	.navbar.compressed .icon li i{
		color:#000 !important;
	}
    }

    @media (max-width:1024px){

    .navbar.compressed{background: rgba(95, 218, 179) !important;
    box-shadow: -1px -9px 20px 7px #8a8a8a;}
        .navbar.compressed li a{
		color: #e8682a !important;

	}

    }

</style>

	<div class="masthead">
        <div class="container con">
            <div class=" text-center">
                <div class="count">

                    <div class="row">

                        <div class="col-lg-3 col-md-4">
                          <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../student-login">
                             <div class="imagediv">
							<img class="homeimage" src="frontend/images/student.png">
							</div>
                            <p>STUDENTS</p>
                        </a>
                        </div>

                        <div class="col-lg-3 col-md-4">
                        <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../lecturer-login">
                             <div class="imagediv">
							<img class="homeimage" src="frontend/images/lecturers.png">
							</div>
                            <p>LECTURERS</p>
                        </a>
                        </div>
                        <div class="col-lg-3 col-md-4">
                        <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../exam-officers-login">
                             <div class="imagediv">
							<img class="homeimage"  src="frontend/images/exam officers.png">
							</div>
                            <p>EXAM OFFICERS</p>
                        </a>
                        </div>
                        <div class="col-lg-3 col-md-4">
                        <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../backend/web/site/login">
                             <div class="imagediv">
							<img class="homeimage" src="frontend/images/admin.png">
							</div>
                            <p>ADMINISTRATORS</p>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
		<div class="home-image">
		</div>
