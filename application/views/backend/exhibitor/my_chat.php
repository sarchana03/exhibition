<?php
$visitor_id = $this->session->userdata('visitor_id');
$exhibitor_id = $this->session->userdata('exhibitor_id');
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
                             <?php $no = 1 ;  $get_visitor_from_model = $this->crud_model->list_all_visitor_and_order_with_visitor_id();
                                    foreach ($get_visitor_from_model as $key => $visitor):


        ?>
                                <td><?php echo $no++ ; ?></td>
                                <td><?php echo $visitor['name'];?></td>
                                <td><a href="<?php echo base_url();?>exhibitor/chat/<?php echo $visitor['visitor_id'];?>"
                                    class="btn btn btn-info btn-circle btn-xs" ><i class="prime zmdi zmdi-comment-outline"></i></a></td>


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




