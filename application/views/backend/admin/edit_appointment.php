<?php 
$edit_appointment		=	$this->db->get_where('calendar' , array('id' => $param2) )->result_array();
foreach ( $edit_appointment as $key => $row):
    
?>


<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <?php echo get_phrase('edit_appointment_list');?></div>

            <div class="panel-wrapper collapse in" aria-expanded="true">
               
                <div class="panel-body">
                    <?php echo form_open(base_url() . 'admin/appointment_list/update/'. $row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>


                    <div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase('Full Name');?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['title'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase('Email id');?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase('phone no.');?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="contact" value="<?php echo $row['contact'];?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase('gender');?></label>
                        <div class="col-sm-12">
                            <select name="gender" class="form-control select2" style="width:100%" required>
                              
                                <option <?php echo isset($row['gender']) && $row['gender'] == "Male" ? "selected": "" ?>>Male</option>
                    <option <?php echo isset($row['gender']) && $row['gender'] == "Female" ? "selected": "" ?>>Female</option>
                
                          </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                                <label class="col-md-12" for="example-text"><?php echo get_phrase('Data of Birthday');?></label>
                                <div class="col-sm-12">
                                    <input class="form-control m-r-10" name="date_o_b" type="date"  id="example-date-input" value="<?php echo $row['date_o_b'];?>" required>
                                </div> 
                            </div>
                            <div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase('address');?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>" />
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase('ailment');?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="ailment" value="<?php echo $row['ailment'];?>" />
                        </div>
                    </div> -->
                    <div class="form-group">
                                <label class="col-md-12"
                                    for="example-text">Description</label>
                                <div class="col-sm-12">
                                <textarea name="description" rows="3" class="form-control"  placeholder="description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                <label class="col-md-12" for="example-text"><?php echo get_phrase(' Appointment Start Date');?></label>
                                <div class="col-sm-12">
                                    <input class="form-control m-r-10" name="start_date" type="datetime-local" value="<?php echo isset($row['start_date'])? date("Y-m-d\TH:i",strtotime($row['start_date'])) : "" ?>"  id="example-date-input" required>
                                </div> 

                            </div>
                            <div class="form-group">
                                <label class="col-md-12" for="example-text"><?php echo get_phrase('Appointment End Date');?></label>
                                <div class="col-sm-12">
                                    <input class="form-control m-r-10" name="end_date" type="datetime-local" value="<?php echo isset($row['end_date'])? date("Y-m-d\TH:i",strtotime($row['end_date'])) : "" ?>"  id="example-date-input" required>
                                </div> 
                                
                            </div>
                            

                            <!-- <div class="form-group">
                                <label class="col-md-12" for="example-text"><?php echo get_phrase('Appointment Date');?></label>
                                <div class="col-sm-12">
                                    <input type="datetime-local" class="form-control" name="a_date" value="<?php echo isset($row['a_date'])? date("Y-m-d\TH:i",strtotime($row['a_date'])) : "" ?>" required>
                                </div> 
                            </div> -->
                            <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Status');?></label>
                    <div class="col-sm-12">
                            <select name="status" class="form-control select2" style="width:100%" required>
                              <option <?php echo isset($row['status']) && $row['status'] == "Padding" ? "selected": "" ?>>Padding</option>
                    <option <?php echo isset($row['status']) && $row['status'] == "Confirmed" ? "selected": "" ?>>Confirmed</option>
                
                    
                          <option <?php echo isset($row['status']) && $row['status'] == "Cancelled" ? "selected": "" ?>>Cancelled</option>
                
                          </select>
                            

                        </div> 
                        </div>

                            
                    <div class="col-sm-12">
                        
                          
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i
                                        class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('update_group  ');?></button>
                            </div>
                            <?php echo form_close();?>
                        
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach;?>