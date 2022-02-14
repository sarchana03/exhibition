


  <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">&nbsp;
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD NEW ADVERTISEMENT</a> <a href="#" data-perform="panel-dismiss"></a> </div>
                            </div>
                            <div class="panel-wrapper collapse out" aria-expanded="true">
                                <div class="panel-body">


			<?php echo form_open(base_url() . 'admin/add_advertisment/add' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('select_image');?>&nbsp;</label>
                    <div class="col-sm-12">
             	            <input type="file" name="file_name" class="form-control" required>


					</div>
					</div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;<?php echo get_phrase('add');?></button>
					</div>
		</div>
	</div>


                <?php echo form_close();?>


                                </div>
                            </div>
                        </div>
                    </div>
				</div>


            <!----TABLE LISTING ENDS--->
            <div class="row">
				    <div class="col-sm-12">
				        <div class="panel panel-info">

				            <div class="panel-body table-responsive">
				                <?php echo get_phrase('abcd');?>
								<?php
											// echo "Today is " . date("Y/m/d") . "<br>";
											// echo "The time is " . date("h:i:sa");?>
				                <hr class="sep-2">

				                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
				                    <thead>
				                        <tr>
				                            <th><?=get_phrase('uploaded_by')?></th>
				                            <th><?=get_phrase('uploaded_image')?></th>



				                            <th><?=get_phrase('action')?></th>
				                        </tr>
				                    </thead>
				                    <tbody>

				                        <?php
                                        $select = $this->advertisment_model->selectAdvertismentAdminInsert();
					 		            foreach ($select as $key => $row) : ?>
				                        <tr>
				                            <!-- <td>
				                                <?php

													// $user = explode('-', $row['user_id']);
													// $user_type = $user[1];
													// $user_id = $user[1];
													// echo $this->db->get_where($user_type,array($user_type.'_id' => $user_id))->row()->name;
													?>

				                            </td> -->

				                            <td><?=$row['clinic_advertisment_id'];?></td>
				                            <td><?=$row['file_name'];?></td>


				                            <td>

				                                <a href="<?php echo base_url();?>admin/edit_advertisment/<?php echo $row['clinic_advertisment_id'];?>"><button
				                                        type="button" class="btn btn-info btn-rounded btn-sm"><i
				                                            class="fa fa-edit"></i> replace</button></a>



				                                <a href="#"
				                                    onclick="confirm_modal('<?php echo base_url();?>admin/add_advertisment/delete/<?php echo $row['clinic_advertisment_id'];?>');"><button
				                                        type="button" class="btn btn-danger btn-rounded btn-sm"><i
				                                            class="fa fa-times"></i> delete</button></a>



				                            </td>

				                        </tr>


				                        <?php endforeach;?>
				                    </tbody>
				                </table>
				            </div>
				        </div>
				    </div>
				</div>