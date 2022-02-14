<?php 

$get_calendar_from_model     =   $this->db->get_where('calendar' , array('id' => $param2) )->result_array();
foreach ( $get_calendar_from_model as $key => $row):
    
?>
            
            <div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <?php echo get_phrase('edit_appointment');?></div>

            <div class="panel-wrapper collapse in" aria-expanded="true">
               
                <div class="panel-body">
                    <?php echo form_open(base_url() . 'doctor/appointment/edit/'. $row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>


                    <div class="form-group">
                        <label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['title'];?>" />
                        </div>
                    </div>
                    

                    

                    
                    <div class="col-sm-6">
                        <div class="white-box">
                          
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i
                                        class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('update_group  ');?></button>
                            </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            <?php endforeach;?>