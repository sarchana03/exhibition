<?php
$name = $this->session->userdata('name');

       $exhibitors = $this->db->get_where('exhibitor', array('exhibitor_id' => $exhibitor_id))->result_array();
        foreach($exhibitors as $key => $exhibitor):
            $visitor_id = $this->session->userdata('visitor_id');
            $visitor_name = $this->session->userdata('visitor_name');
            endforeach;




            ?>



<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info" style="margin-top: -10px;">
            <div class="panel-heading"><span
                    style="font-size:18px; margin-left:10px; position:relative; top:13px;"><strong><span
                            id="user_details"><span class="glyphicon glyphicon-user"></span></span>
                        <?php echo $exhibitor['name'];?>
                    </strong></span></div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="showme hidden" style="position: absolute; left:-120px; top:20px;">
                                <div class="well">
                                    <strong>Room Member/s:</strong>
                                    <div style="height: 10px;"></div>
                                </div>
                            </div>
                            <div>

                            </div>

                            <style type="text/css">
                            .container {
                                border: 2px solid #dedede;
                                background-color: #f1f1f1;
                                border-radius: 5px;
                                padding: 10px;
                                margin: 10px 0;
                            }

                            .darker {
                                border-color: #ccc;
                                background-color: #ddd;
                            }

                            .container::after {
                                content: "";
                                clear: both;
                                display: table;
                            }

                            .container img {
                                float: left;
                                max-width: 60px;
                                width: 100%;
                                margin-right: 20px;
                                border-radius: 50%;
                            }

                            .container img.right {
                                float: right;
                                margin-left: 20px;
                                margin-right: 0;
                            }

                            .time-right {
                                float: right;
                                color: #aaa;
                            }

                            .time-left {
                                float: left;
                                color: #999;
                            }
                            </style>

				                    <?php
                                    echo form_open(base_url() . 'visitor/my_chat/insert/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                            <div class="" style="height: 290px; margin-top: -10px;">
                            <div class="">
                                <div style="height:10px;"></div>
                                <span style="margin-left:10px;">Welcome to chat</span><br>
                                <?php
                                //  $get_chat_from_model = $this->crud_model->get_chat_messages();
                                 $get_chat_from_model = $this->chat_model->list_all_chat_and_order_with_chatid($visitor_id,$exhibitor_id);
                                 foreach ($get_chat_from_model as $key => $chat):?>



                                <?php
                                  if($chat['message_sent_by'] == $this->session->userdata('login_type')): ?>
                                            <div class="chat_send">
                                    <p><?php echo $chat['message'];?></p>

                                    <span class="time-right"><?php  echo $chat['chat_date'];?></span>


                                <div style="height:10px;"></div>
                                </div>

                                <!-- <div id="chat_area" style="margin-left:10px; max-height:320px; overflow-y:scroll;">

                                </div>  -->
                                <?php
                                 endif?>

                                <?php
                                  if($chat['message_sent_by'] != $this->session->userdata('login_type')): ?>
                                            <div class="chat_receive">
                                    <p><?php echo $chat['message'];?></p>

                                    <span class="time-right"><?php  echo $chat['chat_date'];?></span>


                                <div style="height:10px;"></div>
                                </div>

                                <!-- <div id="chat_area" style="margin-left:10px; max-height:320px; overflow-y:scroll;">

                                </div>  -->
                                <?php
                                 endif?>






                            <?php
                            endforeach;?>



                        </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="createForm">
            <div class="input-group">
                <input type="text" class="form-control" name="message" value="<?php echo $row['message'];?>" />
                <input type="hidden" class="form-control" name="exhibitor_id"
                    value="<?php echo $exhibitor['exhibitor_id'];?>" required />
                    <input type="hidden" class="form-control" name="exhibitor_name"
                    value="<?php echo $exhibitor['name'];?>" required />
                <input type="hidden" class="form-control" name="visitor_id" value="<?php echo"$visitor_id"; ?>"
                    required />
                    <input type="hidden" class="form-control" name="visitor_name" value="<?php echo"$visitor_name"; ?>"
                    required />
                <span class="input-group-btn">

                    <button type="submit" class="btn btn-success">
                        <!-- <span class="glyphicon glyphicon-comment"></span> -->
                        Send
                    </button>
                </span>
            </div>
        </form>
        <script type="text/javascript">
        // $("#createForm").submit(function(event) {
        //     event.preventDefault();
        //     $.ajax({
        //         url: "<?php echo base_url('visitor/create'); ?>",
        //         data: $("#createForm").serialize(),
        //         type: "post",
        //         async: false,
        //         dataType: 'json',
        //         success: function(response) {

        //             $('#createModal').modal('hide');
        //             $('#createForm')[0].reset();
        //             $('#exampleTable').DataTable().ajax.reload();
        //         },
        //         error: function() {
        //             alert("error");
        //         }
        //     });
        // });


        // $(document).on('click', '#msg', function() {
        //     let xhr = new XMLHttpRequest();
        //     xhr.open("POST", "php/insert_chat.php", true);
        //     xhr.onload = () => {
        //         if (xhr.readyState == XMLHttpRequest.DONE) {
        //             if (xhr.status == 200) {
        //                 let data = xhr.response;
        //                 console.log(data);
        //                 if (data == "success") {
        //                     location.href = "my_chat.php";
        //                 } else {
        //                     errorText.style.display = "block";
        //                     errorText.textcontent = data;
        //                 }
        //             }
        //         }
        //     }
        // });






        //     function load_chat_data(exhibitor_id,message)
        //     {
        //     $.ajax({
        //      url:"<?php echo base_url();?>visitor/load_chat_data",
        //      method="POST",
        //      data:{exhibitor_id:receiver_message_id, message:message},
        //      dataType:'json',
        //      success:function(data){
        //          var html = '';
        //         for(var count = 0;count< data.length;count++)
        //          {
        //              html += '<div class="row" style="margin-left:0; margin-right:0">';
        //              if(data[count].message_direction == 'right')
        //              {
        //                  html += '<div align="left"><span class="text-muted"><small><b>'+data[count].time+'</b></small></span></div>';
        //                  html += '<div class="col-md-10 alert alert-warning">';

        //              }
        //              else{

        //                 html += '<div align="right"><span class="text-muted"><small><b>'+data[count].time+'</b></small></span></div>';
        //                 html += '<div class="col-md-2>&nbps;</div>';
        //                 html += '<div class="col-md-2 alert alert-info">';



        //              }

        //              html += data[count].message +'</div></div>';

        //          }

        //          $('#chat_area').html(html);

        //      }
        //   });

        //     }

        // setInterval(function(){
        //     if(receiver_message_id > 0)
        //     {
        //         load_chat_data(receiver_message_id,'yes');
        //     }
        // },5000);
        </script>
        <script src="js/chat.js">

        </script>