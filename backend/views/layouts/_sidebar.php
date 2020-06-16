<?php 
use common\models\User;
?>
<style>
.page-sidebar .page-sidebar-menu>li.start>a{border-top-color:#3d4957 !important;}
.page-sidebar{
    margin-top: 32px;
}
</style>
<?php 
$users = User::find()->where(['id' => Yii::$app->user->id])->one();
$issuperadmin = $users['superadmin'];
?>
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
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-user" style="margin-top: 5px;"></i>
                                <span class="title">Student</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("admin/student-create");?>" class="nav-link nav-toggle">
                                        <i class="icon-group"></i>
                                        <span class="title">Create Student</span>
                                    </a>
                                </li>
                            <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("admin/students-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-list"></i>
                                        <span class="title">Students List</span>
                                    </a>
                                </li>
                            </ul>                           
                        </li>
							<?php if($issuperadmin == 1) { ?>
						<li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-user" style="margin-top: 5px;"></i>
                                <span class="title">Admin</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">                                
                                <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("admin/admin-create");?>" class="nav-link nav-toggle">
                                        <i class="icon-user"></i>
                                        <span class="title">Create Admin User</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("admin/admins-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-th-list"></i>
                                        <span class="title">Admin Users</span>
                                    </a>
                                </li>
                            </ul>                           
                        </li>
						<?php } ?>
						<li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link nav-toggle">
                                <i class="icon-user" style="margin-top: 5px;"></i>
                                <span class="title">Exam Officer</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">                                
                                <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("admin/create-exam-officer");?>" class="nav-link nav-toggle">
                                        <i class="icon-user"></i>
                                        <span class="title">Create Exam Officer</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("admin/exam-officers-list");?>" class="nav-link nav-toggle">
                                        <i class="icon-th-list"></i>
                                        <span class="title">Exam Officers List</span>
                                    </a>
                                </li>
                            </ul>                           
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("admin/import-students");?>" class="nav-link nav-toggle">
                                <i class="icon-cloud-upload" style="margin-top: 5px;"></i>
                                <span class="title">Import Students</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl("admin/reports");?>" class="nav-link nav-toggle">
                                <i class="icon-bar-chart" style="margin-top: 5px;"></i>
                                <span class="title">Reports</span>
                            </a>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            
            <!-- END SIDEBAR -->

        