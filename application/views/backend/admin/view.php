<?php 
$edit_appointment		=	$this->db->get_where('calendar' , array('id' => $param2) )->result_array();
foreach ( $edit_appointment as $key => $row):
    
?>


<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <?php echo get_phrase('appointment_Details');?></div>

            <div class="panel-wrapper collapse in" aria-expanded="true">
               
                <div class="panel-body">
                    


                    <div class="form-group">
                        
                        <div class="col-sm-12">
                            <p><?php echo get_phrase('appointment_scheduler');?>:- <?php echo $row['start_date'];?><p>
                        </div>
                    </div>
                    <div class="form-group">
                        
                        <div class="col-sm-12">
                            <p><?php echo get_phrase('name');?>:- <?php echo $row['title'];?><p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                            <p><?php echo get_phrase('gender');?>:- <?php echo $row['gender'];?><p>
                        </div>
                    
                    <div class="col-sm-12">
                            <p><?php echo get_phrase('date of birthday');?>:- <?php echo $row['date_o_b'];?><p>
                        </div>
                    
                    <div class="col-sm-12">
                            <p><?php echo get_phrase('phone no.');?>:- <?php echo $row['contact'];?><p>
                        </div>
                    
                    <div class="col-sm-12">
                            <p><?php echo get_phrase('email');?>:- <?php echo $row['email'];?><p>
                        </div>
                    
                    <div class="col-sm-12">
                            <p><?php echo get_phrase('address');?>:- <?php echo $row['address'];?><p>
                        </div>
                    
                    <div class="col-sm-12">
                            <p><?php echo get_phrase('description');?>:- <?php echo $row['description'];?><p>
                        </div>
                    
                    <div class="col-sm-12">
                            <p><?php echo get_phrase('status');?>:- <?php echo $row['status'];?><p>
                        </div>
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>

        <?php endforeach;?>