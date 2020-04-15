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
                        <a href="<?php echo Yii::$app->request->BaseUrl; ?>/../../student-login">
                            <h1 class="project-count"><i class="fa fa-user-graduate" id="fa-icons" style="color: #8dd22e;"></i></h1>
                            <p>STUDENTS</p>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-4">
                        <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../professor-login">
                            <h1 class="project-count"><i class="fa fa-chalkboard-teacher" id="fa-icons" style="color: DodgerBlue;"></i></h1>
                            <p>LECTURERS</p>
                        </a>
                        </div>
                        <div class="col-lg-3 col-md-4">
                        <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../exam-officers-login">
                            <h1 class="project-count"><i class="fa fa-edit" id="fa-icons" style="color: #deb3a1;"></i></h1>
                            <p>EXAM OFFICERS</p>
                        </a>
                        </div>
                        <div class="col-lg-3 col-md-4">
                        <a href="<?=Yii::$app->getUrlManager()->getBaseUrl();?>/../../backend/web/site/login">
                            <h1 class="project-count"><i class="fa fa-user-tie" id="fa-icons" style="color: #dae354;"></i></h1>
                            <p>ADMINISTRATORS</p>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
		<div class="home-image">
			<img src="frontend/images/banner-image.jpg">
		</div>
