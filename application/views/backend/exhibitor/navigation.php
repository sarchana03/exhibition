    <!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span> </div>
            </li>
            <!-- <li><a href="javascript:void(0)" class="open-close hidden-xs waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li> -->

            <li class="user-pro">
                        <?php
                            $key = $this->session->userdata('login_type') . '_id';
                            $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . '.jpg';
                            if (!file_exists($face_file)) {
                                $face_file = 'uploads/default.jpg';
                            }
                            ?>

                    <a href="#" class="waves-effect"><img src="<?php echo base_url() . $face_file;?>" alt="user-img" class="img-circle"> <span class="hide-menu">

                       <?php
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                        ?>
                    </a>
                        <ul class="nav nav-second-level">
                            <!-- <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li> -->
                            <!-- <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li> -->
                            <!-- <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li> -->
                        </ul>
                </li>



    <li> <a href="<?php echo base_url();?>exhibitor/dashboard" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard') ;?></span></a> </li>

                <li class="<?php if ($page_name == 'jitsi') echo 'active';?>">
        <a href="<?php echo base_url();?>exhibitor/jitsi">
        <i class="fa fa-laptop p-r-10"></i>
        <span class="hide-menu"><?php echo get_phrase('Online_consultancy');?></span>
    </a>
        </li>

    <!-- <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-download p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('information_page');?><span class="fa arrow"></span></span></a>

                        <ul class=" nav nav-second-level -->
                        <?php
            if (
                    $page_name == 'health_tip'
                    )
                echo 'opened active';
            ?>
             <!-- "> -->



                 <!-- </ul>
        </li> -->

        <!-- <li class="attendance"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-calendar"></i> <span class="hide-menu"><?php echo get_phrase('manage_calendar');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level -->
        <?php

            // if (
                // $page_name == 'manage_calendar' ||
            //  $page_name == 'my_calendar' ||
            //     $page_name == 'appointment')
            // echo 'opened active';
            ?>
            <!-- "> -->


                <li class="<?php if ($page_name == 'my_calendar') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>exhibitor/my_calendar ">
                    <i class="fa fa-calendar p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('my_calendar'); ?></span>
                    </a>
                </li>


                <li class="<?php if ($page_name == 'appointment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>exhibitor/appointment">
                    <i class="fa fa-calendar p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Appointment'); ?></span>
                    </a>
                </li>
        <!-- </ul>
    </li> -->



    <!-- <li class="attendance"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-calendar"></i> <span class="hide-menu"><?php echo get_phrase('manage_chat');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level -->
        <?php
            if (
                $page_name == 'chat_request' ||
             $page_name == 'message' )
            echo 'opened active';
            ?>
            <!-- "> -->


                <li class="<?php if ($page_name == 'chat_request') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>exhibitor/my_chat_request ">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('my_chat_request'); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>exhibitor/my_chat ">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('my_chat'); ?></span>
                    </a>
                </li>



        <!-- </ul>
    </li> -->








    <!-- <li class="attendance"> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-hospital-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('manage_attendance');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level<?php
            if ($page_name == 'manage_attendance' || $page_name == 'staff_attendance' ||
                $page_name == 'attendance_report')
            echo 'opened active';
            ?>">


                <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>exhibitor/manage_attendance/<?php echo date("d/m/Y"); ?>">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('mark_attendance'); ?></span>
                    </a>
                </li>


                <li class="<?php if ($page_name == 'attendance_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>exhibitor/attendance_report">
                    <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('view_attendance'); ?></span>
                    </a>
                </li>


        </ul>
    </li>

    <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-bar-chart-o p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('report_cards');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level<?php
            if ($page_name == 'marks' ||
                    $page_name == 'exam_marks_sms'||
                    $page_name == 'tabulation_sheet')
                echo 'opened active';
            ?>">

        <?php $select_role = $this->db->get_where('exhibitor', array('exhibitor_id' => $this->session->userdata('exhibitor_id')))->row()->role;?>
        <?php if($select_role == '1'):?>
                    <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>exhibitor/marks">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('class_exhibitor'); ?></span>
                        </a>
                    </li>
        <?php endif;?>

        <?php $select_role = $this->db->get_where('exhibitor', array('exhibitor_id' => $this->session->userdata('exhibitor_id')))->row()->role;?>
        <?php if($select_role == '2'):?>
                    <li class="<?php if ($page_name == 'student_marksheet_subject') echo 'active'; ?> ">
                        <a href="<?php echo base_url(); ?>exhibitor/student_marksheet_subject">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                           <span class="hide-menu"><?php echo get_phrase('subject_exhibitor'); ?></span>
                        </a>
                    </li>
        <?php endif;?>

        </ul>
    </li> -->


            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>exhibitor/manage_profile">
                    <i class="fa fa-gears p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('manage_profile'); ?></span>
                </a>
            </li>

            <li class="<?php if ($page_name == 'setting') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>exhibitor/exhibitor_advertisment">
                    <i class="fa fa-gears p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('settings'); ?></span>
                </a>
            </li>

            <li class="">
                <a href="<?php echo base_url(); ?>login/logout">
                    <i class="fa fa-sign-out p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Logout'); ?></span>
                </a>
            </li>


        </ul>
    </div>
</div>
<!-- Left navbar-header end -->