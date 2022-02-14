<?php
$visitor_name = $this->session->userdata('name');
$visitor_id = $this->session->userdata('visitor_id');
// $visitor_name = $this->db->get_where('visitor',array('name' => $this->session->userdata('name')));

$visitors = $this->db->get_where('visitor', array('visitor_id' => $visitor_id))->result_array();
        foreach($visitors as $key => $visitor):
            // $visitor_id = $this->session->userdata('visitor_id');
            $exhibitor_id = $this->session->userdata('exhibitor_id');
            endforeach;
?>


<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list');?>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Name</th>
                                <!-- <th>Status</th> -->
                                <th>chat</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                             <?php $no = 1 ;  $get_visitor_from_model =( $this->chat_model->list_all_visitor_and_order_with_chat_request($exhibitor_id)) and ($this->crud_model->list_all_visitor_and_order_with_visitor_id());
                            //  <?php $no = 1 ;  $get_visitor_from_model = $this->chat_model->list_all_visitor_and_order_with_chat_request($exhibitor_id);
                                    foreach ($get_visitor_from_model as $key => $visitor):
    ?>

    <?php if($visitor['status'] == 'pending'):?>
                                <td><?php echo $no++ ; ?></td>
                                <!-- <td><?php echo $visitor['visitor_id'];?></td> -->
                                <td><?php echo $visitor['visitor_name'];?></td>
                                <td>
                                <a href="<?php echo base_url();?>exhibition/edit_chat_request/<?php echo $visitor['chat_request_id'];?>"
                                    class="btn btn btn-info btn-circle btn-xs" ><i class="prime zmdi zmdi-comment-outline"></i>sent request</a>

                                </td>
                                <?php endif?>

                                    <!-- <a href="<?php echo base_url();?>exhibitor/edit_jitsi/<?php echo $row['jitsi_id'];?>"><button
				                                        type="button" class="btn btn-info btn-rounded btn-sm"><i
				                                            class="fa fa-edit"></i> edit</button></a> -->


                             </tr>
                            <?php  endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




