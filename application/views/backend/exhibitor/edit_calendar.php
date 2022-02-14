<?php 
	$edit_calendar		=	$this->db->get_where('calendar' , array('id' => $param2) )->result_array();
	foreach ( $edit_calendar as $key => $row):
?>


<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
					  <div class="panel-heading"> <?php echo get_phrase('Create_calendar_update');?></div>
					  <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">

								<?php 
								// foreach($toSelectFromCalendarWithId as $value) : ?>
                    <?php
                     echo form_open(base_url() . 'doctor/appointment/edit/'. $row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>



					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('Name of patient');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['patient_name'];?>"/>
                                </div>
                            </div>

							<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('start date');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['start_date'];?>"/>
                                </div>
                            </div>

							<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('end date');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['end_date'];?>"/>
                                </div>
                            </div>

						        <!-- <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Status');?></label>
                    <div class="col-sm-12">
                            <select name="status" class="form-control select2" style="width:100%" required>
                              <option <?php echo isset($row['status']) && $row['status'] == "Padding" ? "selected": "" ?>>Padding</option>
                    <option <?php echo isset($row['status']) && $row['status'] == "Confirmed" ? "selected": "" ?>>Confirmed</option>
                
                    
                          <option <?php echo isset($row['status']) && $row['status'] == "Cancelled" ? "selected": "" ?>>Cancelled</option>
                
                          </select>
                            

                        </div> 
                        </div> -->

                        <div class="form-group">
                <label for="status" class="control-label">Status</label>
                <select name="status" id="status" class="custom custom-select">
                    <option value="0"<?php echo isset($status) && $status == "0" ? "selected": "" ?>>Pending</option>
                    <option value="1"<?php echo isset($status) && $status == "1" ? "selected": "" ?>>Confirmed</option>
                    <option value="2"<?php echo isset($status) && $status == "2" ? "selected": "" ?>>Cancelled</option>
                </select>
            </div>







							  
<div class="form-group">
<button type="submit" class="btn btn-success btn-block btn-rounded btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('update_status');?></button>
</div>
<?php
//  endforeach?>

					  </div>
					  </div>
					  </div>

					</div>
</div>

<?php echo form_close();?>


<?php 
endforeach?>





                    <!-- <script type="text/javascript">

function get_class_sections(class_id) {

    $.ajax({
        url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
        success: function(response)
        {
            jQuery('#section_selector_holder').html(response);
        }
    });

}


$('#check').click(function(){

    if($('#check').is(':checked') == true){
        $("#send_sms").show(500);
        $("#initial").hide(500);
    }else{

        $("#send_sms").hide(500);
        $("#initial").show(500);
    }

});

$("#send_sms").hide();




$(document).ready(function(){
    var class_id = $('#class_id').val();
    get_class_sections(class_id);
});

</script> -->


<script >


$(function(){
    $('#appointment_form').submit(function(e){
        e.preventDefault();
            var _this = $(this)
			//  $('.err-msg').remove();
			start_loader();
			$.ajax({
				// url:_base_url_+"classes/Master.php?f=save_appointment",
				// data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				// error:err=>{
				// 	console.log(err)
				// 	alert_toast("An error occured",'error');
				// 	end_loader();
				// },
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
                       location.reload()
					}
                    else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: $('#uni_modal').offset().top }, "fast");
                    }
                    else{
						alert_toast("An error occured",'error');
                        console.log(resp)
					}
						end_loader();
				}
			})
    })
    // $('#uni_modal').on('hidden.bs.modal', function (e) {
    //     if($('#appointment_form').length <= 0)
    //         location.reload()
    // })
})
				</script>