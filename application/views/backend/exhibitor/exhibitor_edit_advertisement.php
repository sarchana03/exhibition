
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">&nbsp;
                EDIT ADVERTISEMENT
            </div>

            <div class="panel-body">

			<?php foreach($toSelectFromAdvertisementWithId as $value) : ?>
			<?php echo form_open(base_url() . 'exhibitor/exhibitor_advertisment/edit/'.$value['exhibitor_advertisement_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="row">
                    <div class="col-sm-6">




                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('select_image');?>&nbsp;</label>
                    <div class="col-sm-12">
             	            <input type="file" name="file_name" class="form-control" required>


					</div>
					</div>

                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('content');?>&nbsp;</label>
                    <div class="col-sm-12">
             	            <input type="text" name="advertisement_content" class="form-control" required>


					</div>
					</div>





			</div>


        </div>`

		<input type="submit" class="btn btn-success btn-rounded btn-block btn-sm" value="<?php echo get_phrase('save');?>">

        <?php echo form_close();?>
        <?php endforeach;?>


            </div>
        </div>
    </div>
</div>
