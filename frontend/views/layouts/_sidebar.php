<style>
.page-sidebar .page-sidebar-menu>li.start>a{border-top-color:#3d4957 !important;}


.navbar-collapse {float:left}
.page-sidebar-wrapper{margin-top: 40px;}
</style>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<!-- BEGIN CONTAINER -->
<!--        <div class="page-container">-->
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 40px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <?php if((Yii::$app->session['userRole'] && Yii::$app->session['userRole'] == 3) && (Yii::$app->session['isEaAdmin'] && Yii::$app->session['isEaAdmin'] == 1)){ ?>
                        <li class="nav-item">
			 <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-user" style="margin-top: 5px;"></i>
                                <span class="title">Exam Officer</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../create-exam-officer");?>" class="nav-link nav-toggle">
                                        <i class="icon-user"></i>
                                        <span class="title">Create Exam Officer</span>
                                    </a>
                                </li>
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../exam-officers-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Exam Officers List</span>
                                    </a>
                                </li>
				</ul>
                        </li>
						<?php } if((Yii::$app->session['userRole'] && Yii::$app->session['userRole'] == 3) && (Yii::$app->session['isEaAdmin'] && Yii::$app->session['isEaAdmin'] == 1)){ ?>
						 <li class="nav-item">
			 <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-user" style="margin-top: 5px;"></i>
                                <span class="title">Lecturer</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../create-lecturer");?>" class="nav-link nav-toggle">
                                        <i class="icon-user"></i>
                                        <span class="title">Create Lecturer</span>
                                    </a>
                                </li>
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../lecturers-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Lecturers List</span>
                                    </a>
                                </li>
				</ul>
                        </li>
						<?php } if((Yii::$app->session['userRole'] && Yii::$app->session['userRole'] == 3) && (Yii::$app->session['isEaAdmin'] && Yii::$app->session['isEaAdmin'] == 1)){ ?>
						 <li class="nav-item">
			 <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-user" style="margin-top: 5px;"></i>
                                <span class="title">Student</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../create-student");?>" class="nav-link nav-toggle">
                                        <i class="icon-user"></i>
                                        <span class="title">Create Student</span>
                                    </a>
                                </li>
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../students-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Students List</span>
                                    </a>
                                </li>
								
				<li class="nav-item  ">
					<a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../all-students-marks");?>" class="nav-link nav-toggle">
						<i class="icon-list"></i>
						<span class="title">Students Marks</span>
					</a>
				</li>
				</ul>
                        </li>
						<?php } if(Yii::$app->session['userRole'] && Yii::$app->session['userRole'] == 4){ ?>
						 <li class="nav-item">
			 <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-user" style="margin-top: 5px;"></i>
                                <span class="title">Student</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../students-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Students List</span>
                                    </a>
                                </li>
				<li class="nav-item  ">
					<a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../all-students-marks");?>" class="nav-link nav-toggle">
						<i class="icon-list"></i>
						<span class="title">Students Marks</span>
					</a>
				</li>

				</ul>
                        </li>
						<?php } if(Yii::$app->session['userRole'] && Yii::$app->session['userRole'] == 3){ ?>
			 <li class="nav-item">
			 <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-plus-sign-alt" style="margin-top: 5px;"></i>
                                <span class="title">Faculty</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../add-faculty");?>" class="nav-link nav-toggle">
                                        <i class="icon-plus-sign-alt"></i>
                                        <span class="title">Add Faculty</span>
                                    </a>
                                </li>
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../faculty-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Faculty List</span>
                                    </a>
                                </li>
				</ul>
                        </li>
						<?php } if(Yii::$app->session['userRole'] && Yii::$app->session['userRole'] == 3){ ?>
						<li class="nav-item">
			 <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-plus-sign-alt" style="margin-top: 5px;"></i>
                                <span class="title">Programme</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../add-programme");?>" class="nav-link nav-toggle">
                                        <i class="icon-plus-sign-alt"></i>
                                        <span class="title">Add Programme</span>
                                    </a>
                                </li>
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../programmes-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Programmes List</span>
                                    </a>
                                </li>
				</ul>
                        </li>
						<?php } if(Yii::$app->session['userRole'] && Yii::$app->session['userRole'] == 3){ ?>
						<li class="nav-item">
			 <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-plus-sign-alt" style="margin-top: 5px;"></i>
                                <span class="title">Module</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../add-module");?>" class="nav-link nav-toggle">
                                        <i class="icon-plus-sign-alt"></i>
                                        <span class="title">Add Module</span>
                                    </a>
                                </li>
								
							 <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../modules-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Modules List</span>
                                    </a>
                                </li>
				</ul>
                        </li>
						<?php } if(Yii::$app->session['userRole'] && Yii::$app->session['userRole'] == 3){ ?>	
						<li class="nav-item">
			 <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-external-link" style="margin-top: 5px;"></i>
                                <span class="title">Assign</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../add-programme-to-faculty");?>" class="nav-link nav-toggle">
                                        <i class="icon-external-link"></i>
                                        <span class="title">Programme to Faculty</span>
                                    </a>
                                </li>
								
							<li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../programme-to-faculty-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Programme to Faculty List</span>
                                    </a>
                                </li>
								
							 <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../add-module-to-programme");?>" class="nav-link nav-toggle">
                                        <i class="icon-external-link"></i>
                                        <span class="title">Module to Programme</span>
                                    </a>
                                </li>
								
								<li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../module-to-programme-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Module to Programme List</span>
                                    </a>
                                </li>
								
								<li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../add-lecturer-to-module");?>" class="nav-link nav-toggle">
                                        <i class="icon-external-link"></i>
                                        <span class="title">Lecturer to Module</span>
                                    </a>
                                </li>
								
								<li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../lecturer-to-module-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Lecturer to Module List</span>
                                    </a>
                                </li>
				</ul>
                        </li>
						
						<?php } if(Yii::$app->session['userRole'] && Yii::$app->session['userRole'] == 4){ ?>	
						<li class="nav-item">
			 <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-external-link" style="margin-top: 5px;"></i>
                                <span class="title">Marks</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("../../add-marks");?>" class="nav-link nav-toggle">
                                        <i class="icon-external-link"></i>
                                        <span class="title">Add / Edit Marks</span>
                                    </a>
                                </li>
								
							
				</ul>
                        </li>
						<?php } ?>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            
            <!-- END SIDEBAR -->

        