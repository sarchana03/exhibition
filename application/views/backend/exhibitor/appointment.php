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
                                <th>#</th>
                                <th>Name</th>
                                <th>Start_date</th>
                                <th>Start Time - End_Time</th>
                                <th>Status</th>
                                <!-- <th>visitor-id</th>
                                <th>exhibitor-Id</th>
                                <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                             <tr><?php $no = 1 ; $get_calendar_from_model = $this->crud_model->list_all_calendar_and_order1_with__id(); foreach ($get_calendar_from_model as $key => $calendar):?>
                                <td><?php echo $no++ ; ?></td>
                                <td><?php echo $calendar['title'];?></td>
                                <td><?php $wop = $calendar['start_date']; print date('Y-m-d ', strtotime ($wop))?></td>
                                <td><?php $wop = $calendar['start_date']; print date('h:i a', strtotime ($wop)) ?> - <?php $wop = $calendar['end_date']; print date('h:i a', strtotime ($wop)) ?></td>
                                <td><?php echo $calendar['status'];?></td>
                                <!-- <td><?php echo $calendar['visitor_id'];?></td>
                                <td><?php echo $calendar['exhibitor_id'];?></td>
                                <td>
                            <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_calendar/<?php echo $calendar['id'];?>')" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></a>

                                <a href="<?php echo base_url();?>exhibitor/edit_calendar/<?php echo $calendar['id'];?>"><button
				                                        type="button" class="btn btn-info btn-rounded btn-sm"><i
				                                            class="fa fa-edit"></i> edit</button></a>
                                <a href="#"
                        onclick="confirm_modal('<?php echo base_url();?>exhibitor/calendar/<?php echo $calendar['id'];?>');"><button
                            type="button" class="btn btn-danger btn-rounded btn-sm"><i
                                class="fa fa-times"></i> delete</button></a>



                                </td> -->
                             </tr>
                            <?php
                        endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


</script>



