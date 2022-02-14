    <!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span> </div>
                        <!-- /input-group -->
            </li>

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
                        <!-- <span class="fa arrow"></span></span> -->
                    </a>
                        <ul class="nav nav-second-level">
                            <!-- <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li> -->
                            <!-- <li><a href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li> -->
                        </ul>
                </li>



    <li> <a href="<?php echo base_url();?>visitor/dashboard" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard') ;?></span></a> </li>

              <li class="<?php if ($page_name == 'jitsi') echo 'active';?>">
        <a href="<?php echo base_url(); ?>visitor/jitsi">
        <i class="fa fa-laptop p-r-10"></i>
        <span class="hide-menu"><?php echo get_phrase('my_meeting');?></span>
    </a>
        </li>




            <!-- <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-calendar"></i> <span class="hide-menu"><?php echo get_phrase('manage calendar');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level -->
        <?php
            // if ($page_name == 'my_calendar' ||
            //          $page_name == 'appointment' )
            //     echo 'opened active';
            ?>
            <!-- "> -->



                <li class="<?php if ($page_name == 'my_calendar') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>visitor/my_calendar">
                        <i class="fa fa-calendar p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('my_calendar'); ?></span>
                    </a>
                </li>


                <li class="<?php if ($page_name == 'appointment') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>visitor/appointment">
                        <i class="fa fa-calendar p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('appointment'); ?></span>
                    </a>
                </li>

         <!-- </ul>
    </li> -->

    <!-- chat -->
    <!-- <li> <a href="#" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-calendar"></i> <span class="hide-menu"><?php echo get_phrase('manage chat');?><span class="fa arrow"></span></span></a>

        <ul class=" nav nav-second-level -->
        <?php
            if ($page_name == 'chat_request' ||
                     $page_name == 'chat_acceptance'
                      )
                echo 'opened active';
            ?>
            <!-- "> -->
                <li class="<?php if ($page_name == 'chat_request') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>visitor/chat_request">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('chat_request'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'chat_acceptance') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>visitor/chat_acceptance">
                        <i class="fa fa-angle-double-right p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('my_chat'); ?></span>
                    </a>
                </li>
         <!-- </ul>
    </li> -->








            <!-- <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>visitor/invoice">
                    <i class="fa fa-paypal p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Invoice'); ?></span>
                </a>
            </li>

        <li class="<?php if ($page_name == 'payment_history') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>visitor/payment_history">
                    <i class="fa fa-credit-card p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('Payment History'); ?></span>
                </a>
        </li>                -->

            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>visitor/manage_profile">
                    <i class="fa fa-gears p-r-10"></i>
                        <span class="hide-menu"><?php echo get_phrase('manage_profile'); ?></span>
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