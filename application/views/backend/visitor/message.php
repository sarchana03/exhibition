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
   <br />
   <!-- <div class="col-md-12" align="right">
    <a href="<?php echo base_url(); ?>google_login/logout">Logout</a>
   </div> -->
   <div class="col-md-5" style="padding-right:0;">
    <div class="panel panel-default" style="height: 700px; overflow-y: scroll;">
    <?php echo form_open(base_url() . 'patient/my_chat/add/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

     <div class="panel-heading">List of Doctors</div>
     <div class="panel-body" id="chat_user_area">

     <div class="form-group">
         <label class="col-md-12"
            for="example-text"><?php echo get_phrase('doctor');?></label>
         <div class="col-sm-12">
            <select name="doctor_id" class="form-control select2" style="width:100%"
                  id="doctor_id"
         onchange=""
         >
                  <option value=""><?php echo get_phrase('select');?></option>
                  <?php 
            $doctors = $this->crud_model->get_doctors(); foreach($doctors as $row): ?>
                  <option value="<?php echo $row['doctor_id'];?>"><?php echo $row['name'];?>
                  </option>
                  <?php endforeach; ?>
            </select>
         </div>
      </div>

			<!-- <div id="user_list" class="py-3"> -->

         <table id="#" class="display nowrap" cellspacing="0" width="100%">
                     <thead>
                         <tr>

                             <th>Department</th>
                             <th>Name</th>
                             <!-- <th>Email</th>
                             <th>Phone</th> -->
                         </tr>
                     </thead>
                     <tbody>

                         <tr>
                             <?php $get_doctor_from_model = $this->crud_model->list_all_doctor_and_order_with_doctor_id();
                                    foreach ($get_doctor_from_model as $key => $doctor):?>
                             <td><img src="<?php echo $doctor['face_file'];?>" class="img-circle" width="40px"
                                     height="40px"></td>
                             <td><?php echo $doctor['name'];?></td>
                             <!-- <td><?php echo $doctor['email'];?></td>
                             <td><?php echo $doctor['phone'];?></td> -->
                         </tr>
                         <?php endforeach;?>

                     </tbody>
                 </table>




     </div>
     <!-- <input type="hidden" name="hidden_receiver_id_array" id="#" /> -->
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
         <div id="chat_message_area" contenteditable class="form-control"></div>
       </div>
       <div class="form-group" align="right">
          <button type="button" name="send_chat" id="send_chat" class="btn btn-success btn-xs">send</button>

       </div>

       <div id="messageBar" class="py-4 px-4">
					<div id="textBox_attachment_emoji_container">
						<div id="text_box_message">
							<!-- <input type="text" maxlength = "200" name="txt_message" id="messageText" class="form-control" placeholder="Type your message"> -->
						</div>
						<div id="text_counter">
							<p id="count_text" class="m-0 p-0"></p>
						</div>
					</div>
					<!-- <div id="sendButtonContainer">
						<button class="btn" id="send_message">
							<span class="material-icons">send</span>
						</button>
					</div> -->
				</div>
       </div>
       <div class="form-group" align="right">
        
       </div>
      </div>
     </div>
    </div>
   </div>
   <!-- <div class="col-md-3" style="padding-left:0;">
    <div class="panel panel-default" style="height: 300px; overflow-y: scroll;">
     <div class="panel-heading">Search User</div>
     <div class="panel-body">
      <div class="row">
       <div class="col-md-8">
        <input type="text" name="search_user" id="search_user" class="form-control input-sm" placeholder="Search user"
/>       </div>
       <div class="col-md-4">


       <button type="button" name="search_button" class="btn btn-primary btn-sm">search</button>

        
       </div>
      </div>
      
      <div id="search_user_area"></div>
      
     </div>
    </div>
    <div class="panel panel-default" style="height: 380px; overflow-y: scroll;">
     <div class="panel-heading">Notification</div>
     <div class="panel-body" id="notification_area">
      
     </div>
    </div>
   </div> -->
  </div>

	<script type="text/javascript">

function get_group_sub_groups(group_id) {

$.ajax({
    url: '<?php echo base_url();?>admin/get_group_sub_group/' + group_id,
    success: function(response) {
        jQuery('#section_selector_holder').html(response);
    }
});

}



$(document).ready(function(){


   // function load_chat_user(){
   //    $.ajax({
   //       url:"<?php echo base_url();?>chat/load_chat_user",
   //       method="POST",
   //       data:{action:'load_chat_user'},
   //       dataType:'json',
   //       beforeSend:function(){
   //          $('#load_chat_user').html(loading());

   //       },
   //       success:function(data){

   //       }
   //    });
   // }

// var receiver_id;
//  $(document).on('click','.user_chat_list',function(){
//    //  $('#send_chat').attr('disabled',false);
//    receiver_id = $(this).data('receiver_id');
//    var receiver_id = $(this).text();
//    $('#dynamic_title').text('you chat with' + receiver_name);
//  });

//  $(document).on('click','#send_chat', function(){
//     var chat_message = $.trim($('#chat_message_area').html());
//     if(chat_message !='')
//     {
//       $.ajax({
//          url:"<?php echo base_url();?>message/send_chat",
//          method="POST",
//          data:{
//             receiver_id:unique_id,chat_message:chat_message
//          },

//          beforeSend:function(data)
//          {

//             // $('#send_chat').attr('disabled','disabled');
//          },
//          success:function(data)
//          {
//             $('#send_chat').attr('disabled',false);
//             $('#chat_message_area').html('');
//             var html = '<div class="col=md-10 alert alert-warning">';
//             html += chat_message;
//             html += '</div>';
//             $('#chat_body').append(html);


//          }

//       });
//     }
//     else
//     {
//        alert('type something in chat box');
//     }
//  })


// $('#search').keyup(function (e) {
// 		var user = document.querySelectorAll('.doctor');
		// var name = document.querySelectorAll('#user_list h6');
// 		var val = this.value.toLowerCase();
// 		if (val.length > 0) {
// 			clearInterval(inter2);
// 			for (let i = 0; i < user.length; i++) {
// 				nameVal = name[i].innerHTML
// 				if (nameVal.toLowerCase().indexOf(val) > -1) {
// 					user[i].style.display = '';
// 				} else {
// 					user[i].style.display = 'none';
// 				}
// 			}
// 		} else {
// 			inter2 = setInterval(getUserList, 1000);
// 		}
// 	});


 
});

</script>