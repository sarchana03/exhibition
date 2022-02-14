 <!--row -->



 <div class="dashboard-box">
     <div class="dashboard-box-in">
         <div class="r-icon-stats">
             <!-- <i class="ti-user bg-megna"></i> -->

             <i class="fa fa-heartbeat" aria-hidden="true"></i>
             <div class="bodystate">
                 <h4><?php echo $this->db->count_all_results('newuser');?></h4>
             </div>
         </div>
         <span class="text-muted"><?php echo get_phrase('Appointments');?></span>
     </div>
     <div>
     <div class="dashboard-box-in">
     <div class="r-icon-statsb">
                 <!-- <i class="ti-user bg-megna"></i> -->
                 <!-- <i class="fa fa-heartbeat" aria-hidden="true"></i> -->
                 <i class="fa fa-user-plus" aria-hidden="true"></i>



                 <div class="bodystate">
                     <h4><?php echo $this->db->count_all_results('visitor');?></h4>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('visitors');?></span>
     </div>
     </div>
     <div>
     <div class="dashboard-box-in">
     <div class="r-icon-statsw">
                 <!-- <i class="ti-user bg-megna"></i> -->


                 <i class="fa fa-user-plus" aria-hidden="true"></i>
                 <div class="bodystate">
                     <h4><?php echo $this->db->count_all_results('jitsi');?></h4>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('Consultancy');?></span>
     </div>
     </div>
     <div>
     <div class="dashboard-box-in">
     <div class="r-icon-statsy">
                 <!-- <i class="ti-user bg-megna"></i>
                                 -->
                 <i class="fa fa-inr" aria-hidden="true"></i>
                 <div class="bodystate">
                     <h4>
                         <?php

                                    $check_daily_attendance = array('date' => date('Y-m-d'), 'status' => '1');
                                    $get_attendance_information = $this->db->get_where('attendance', $check_daily_attendance);
                                    $display_attendance_here = $get_attendance_information->num_rows();
                                    echo $display_attendance_here;
                                    ?>

                     </h4>
                     <!-- <span class="text-muted"><?php echo get_phrase('Exhibition Earning');?></span> -->
                 </div>
             </div>
                     <span class="text-muted"><?php echo get_phrase('Exhibition Earning');?></span>


     </div>
     </div>
 </div>

 <!-- <div class="row">
     <div class="col-md-3 col-sm-6">
         <div class="white-box-in blue-bg">
             <div class="r-icon-stats">
                 <i class="ti-user bg-megna"></i>

                 <i class="fa fa-heartbeat" aria-hidden="true"></i>
                 <div class="bodystate">
                     <h4><?php echo $this->db->count_all_results('librarian');?></h4>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('Heart Rate');?></span>
         </div>
     </div>
     <div class="col-md-3 col-sm-6">
         <div class="white-box-in green-bg">
             <div class="r-icon-statsb">
                 <i class="ti-user bg-megna"></i>
                 <i class="fa fa-heartbeat" aria-hidden="true"></i>
                 <i class="fa fa-tint" aria-hidden="true"></i>



                 <div class="bodystate">
                     <h4><?php echo $this->db->count_all_results('publisher');?></h4>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('Blood Pressure');?></span>
         </div>
     </div>
     <div class="col-md-3 col-sm-6">
         <div class="white-box-in dark-blue-bg">
             <div class="r-icon-statsw">
                 <i class="ti-user bg-megna"></i>


                 <i class="fa fa-user-plus" aria-hidden="true"></i>
                 <div class="bodystate">
                     <h4><?php echo $this->db->count_all_results('book');?></h4>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('New visitors');?></span>
         </div>
     </div>

     <div class="col-md-3 col-sm-6">
         <div class="white-box-in pink-bg">
             <div class="r-icon-statsy">
                 <i class="ti-user bg-megna"></i>

                 <i class="fa fa-inr" aria-hidden="true"></i>
                 <div class="bodystate">
                     <h4>
                         <?php

                                    $check_daily_attendance = array('date' => date('Y-m-d'), 'status' => '1');
                                    $get_attendance_information = $this->db->get_where('attendance', $check_daily_attendance);
                                    $display_attendance_here = $get_attendance_information->num_rows();
                                    echo $display_attendance_here;
                                    ?>

                     </h4>
                     <span class="text-muted"><?php echo get_phrase('Exhibition Earning');?></span>
                 </div>
             </div>
             <span class="text-muted"><?php echo get_phrase('Exhibition Earning');?></span>
         </div>
     </div>




 </div> -->
 <!--/row -->

 <div class="row">

     <div class="col-sm-12">

         <div class="panel panel-info">

             <div class="panel-body table-responsive">
                 <?php echo get_phrase('Recently Added visitors');?>
                 <hr class="sep-2">


                 <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                     <thead>
                         <tr>
                             <th>Image</th>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Phone</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <?php $get_visitor_from_model = $this->crud_model->list_all_visitor_and_order_with_visitor_id();
                                    foreach ($get_visitor_from_model as $key => $visitor):?>
                             <td><img src="<?php echo $visitor['face_file'];?>" class="img-circle" width="40px"></td>
                             <td><?php echo $visitor['name'];?></td>
                             <td><?php echo $visitor['email'];?></td>
                             <td><?php echo $visitor['phone'];?></td>
                         </tr>
                         <?php endforeach;?>

                     </tbody>
                 </table>


             </div>
         </div>












     </div>
 </div>
 <!-- /.row -->