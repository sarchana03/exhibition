<!-- Page Content -->
<div id="page-wrapper">
            <div class="container-fluid">

            <section class="gallery-scroll-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 p-0">
                    <div class="owl-carousel owl-theme owl-loaded gallery-scroll-in">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <?php  $select = $this->advertisment_model->selectAdvertismentAdminInsert();
                                    foreach ($select as $key => $row) {
                                ?>
                                    <div class="owl-item">
                                        <div class="service-text">
                                            <a href="#"><img src="<?php echo base_url() . "uploads/advertisment_image/" . $row['file_name'];?>" class="hvrbox-layer_bottom img-rounded"></a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $page_title;?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" target="_blank" class="btn btn-warning btn-sm pull-right m-l-20 btn-rounded hidden-xs hidden-sm waves-effect waves-light">Clinic website</a>
                        <ol class="breadcrumb">
                            <li><a href=""><?php echo $system_name;?></a></li>
                            <li class="active"><?php echo date('d M,Y');?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>