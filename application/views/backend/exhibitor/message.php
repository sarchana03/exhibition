<?php

// if (isset($_SESSION)) {
// 	$image = $_SESSION['image'];
// 	$name = $data[0]['user_fname']." ".$data[0]['user_lname'];
// }
?>
<head>
<style type="text/css">

   #chat_message_area
   {
    width: 100%;
    height: auto;
    min-height: 80px;
    overflow: auto;
    padding:6px 24px 6px 12px;
    border: 1px solid #CCC;
       border-radius: 3px;
   }

   .notification_circle {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background-color: #FF0000;
    text-align: center;
    color:#fff;
    padding:3px 6px;
   }
   .online
   {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background-color: #5cb85c;
    text-align: center;
    color:#fff;
    padding:3px 6px;
   }
   .offline
   {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background-color: #ccc;
    text-align: center;
    color:#fff;
    padding:3px 6px;
   }

  </style>
</head>
<div clas="container-fluid">
   <br />
   <!-- <h2 align="center">Chat Application in Codeigniter</h2> -->
   <br />
   <div class="col-md-12" align="right">
    <a href="<?php echo base_url(); ?>google_login/logout">Logout</a>
   </div>
   <div class="col-md-5" style="padding-right:0;">
    <div class="panel panel-default" style="height: 700px; overflow-y: scroll;">
     <div class="panel-heading">Select Patient</div>
     <div class="panel-body" id="chat_user_area">

     </div>
     <input type="hidden" name="hidden_receiver_id_array" id="#" />
     <!-- <input type="hidden" name="hidden_receiver_id_array" id="hidden_receiver_id_array" /> -->
    </div>
   </div>
   <div class="col-md-7" style="padding-left:0; padding-right: 0;">
    <div class="panel panel-default" style="">
     <div class="panel-heading">Chat Area</div>
     <div class="panel-body">
      <div id="chat_header">
       <h2 align="center" style="margin:0; padding-bottom:16px;"><span id="dynamic_title">Welcome <?php echo $this->session->userdata('username'); ?></span></h2>
      </div>
      <div id="chat_body" style="height:406px; overflow-y: scroll;"></div>
      <div id="chat_footer" style="">
       <hr />
       <div class="form-group">

       </div>
       <div class="form-group" align="right">

       </div>
      </div>
     </div>
    </div>
   </div>

  </div>

	<script type="text/javascript">

      function loading(){
         var output = '<div align="center"><br/><br/><br/>';
         output += '<img src="#" /> Please wait..</div>';
         return output;
      }

      $(document).on('click','#search_button', function(){
         var search_query = $.trim($('#search_user').val());
         $('#search_user_area').html('');
         if(search_query !=''){
            $.ajax({
               url     : "<?php echo base_url(); ?>doctor/search_user",
               method : "POST",
                type    : element.attr('method'),
                data    : {search_query:search_query},
                dataType: "JSON",
                beforeSend:function()
                {
                   $('#search_user_area').html(loading());
                   $('#search_button').attr('disabled','disabled');

                },
                success:function(data)
                {
                  $('#search_button').attr('disabled',false);
                  var output = '<hr/><div class="row">';
                  var send_userid = "<?php echo $this->session->userdata('user_id'); ?>";
                  if(data.length > 0)
                  {
                     for(var count = 0; count < data.length; count++)
                     {
                        output += '<div class="col-md-7"><img src="'+data[count].profile_picture+'"class ="img-thumbnail img-rounded" width="35" />'+data[count].first_name+' '+data[count].last_name+'</div>';
                        if(data[count].is_request_send == 'yes')
                        {
                           output += '<div class="col-md-5"><button type="button" name="request_button" class="btn btn-warning btn-xs">Request Sended</button></div>';


                        }
                         else
                         {
                           output += '<div class="col-md-5"><button type="button" name="request_button" class="btn btn-warning btn-xs request_button" id="request_button'+data[count].user_id+'" data-receiver_userid="'+data[count].user_id+' "  data-send_userid="'+send_userid+' ">Send request</button></div>';



                        }

                     }

                  }
                  else{
                     output +='<div align="center"><b>No data found</b></div>';
                  }

                  output +='</div>';
                  $('#search_user_area').html(output);

                }
            }

            )
         }
      })


</script>