<section class="clinic-scroll">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-12 p-0">
                    <div class="owl-carousel owl-theme owl-loaded exhibitor-advertise-scroll-in">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <?php
                                 $select = $this->exhibitor_advertisment_model->selectAdvertismentExhibitorInsert();
                                foreach ($select as $key => $row) {
                                ?>
                                    <div class="owl-item">
                                        <div class="service-text">
                                        <a href="#"><img src="<?php
                                        echo base_url() . "uploads/exhibitor_advertisement_image/" . $row['file_name'];?>" class="hvrbox-layer_bottom img-rounded"></a>

                                        </div>
                                        <h2><?=$row['advertisement_content']?></h2>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>