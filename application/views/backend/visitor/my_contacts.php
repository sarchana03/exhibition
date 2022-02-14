<?php
// $visitor_id = $this->session->userdata('visitor_id');
// $exhibitor_id = $this->session->userdata('exhibitor_id');

$exhibitor_id = $this->session->userdata('exhibitor_id');
$name = $this->session->userdata('name');

// $receivetovisitor = $this->db->get_where('chat', array('visitor_id' => $visitor_id))->row()->visitor_id;


$visitor_namee= $this->db->get_where('visitor',array('name' => $visitor_name))->row()->visitor_name;


$visitors = $this->db->get_where('visitor', array('visitor_id' => $visitor_id, 'name'=>$visitor_namee))->result_array();
        foreach($visitors as $key => $visitor):
            $exhibitor_id = $this->session->userdata('exhibitor_id');
            endforeach;
?>

<?php
          echo form_open(base_url() . 'visitor/chat_request/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
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
                             <?php
                             $no = 1 ;
                              $get_exhibitor_from_model = $this->crud_model->list_all_exhibitor_and_order_with_chat_id();
                              // $get_exhibitor_from_model = $this->chat_model->list_all_chat_and_order_with_chatid();

                                    foreach ($get_exhibitor_from_model as $key => $exhibitor):

        ?>
                                <td><?php
                                echo $no++ ; ?></td>
                                <td><?php echo $exhibitor['name'];?></td>
                                <td><a href="<?php echo base_url();?>visitor/chat_Rsend/<?php echo $exhibitor['exhibitor_id'];?>"
                                    class="btn btn btn-info btn-circle btn-xs" ><i class="prime zmdi zmdi-comment-outline"></i></a></td>
                                    <!-- <td><button type="submit" href="<?php echo base_url();?>visitor/chat_request/<?php echo $exhibitor['exhibitor_id'];?>" class="btn btn-info">send request</button></td> -->
                                    <!-- <td><button type="submit" href="<?php echo base_url();?>visitor/chat_request/<?php echo $exhibitor['exhibitor_id'];?>" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">send request</button></td> -->


                            <td>

                            </td>
                             </tr>
                            <?php
                        endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2>Send chat request</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send request</button>
      </div>
    </div>
  </div>
</div>

<!-- <form id="createForm">
<div class="input-group">
    <input type="text" class="form-control" name="message" value="<?php echo $row['message'];?>" />
    <input type="hidden" class="form-control" name="visitor_id" value="<?php echo $visitor['visitor_id'];?>" required/>
    <input type="hidden" class="form-control" name="exhibitor_id" value="<?php echo"$exhibitor_id"; ?>" required/>
    <span class="input-group-btn">

        <button type="submit" class="btn btn-success">
             Send</button>
    </span>
</div>
</form> -->




<script>

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})

</script>






