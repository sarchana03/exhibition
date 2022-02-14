<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Chat_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }


/**************************** The function below insert into bank and teacher tables   **************************** */
    function insertApplicantFunction(){
        // session_start();
        // $clinic_id = $this->session->userdata('clinic_id');
        // $admin_id = $this->session->userdata('admin_id');


        $page_data = array(
            // 'clinic_id' => $this->session->userdata('clinic_id'),
            'message'           => $this->input->post('message'),
			'chat_date'        => $this->input->post('d-m-Y H:i'),
			// //'chat_password'       => $this->input->post('chat_password'),
            // // 'sender_message_id'              => $this->session->userdata('admin_id'),
            'exhibitor_id'              => $this->input->post('exhibitor_id'),
            'visitor_id'          => $this->input->post('visitor_id'),
            'visitor_name'          => $this->input->post('visitor_name'),
            'exhibitor_name'          => $this->input->post('exhibitor_name'),
            'message_sent_by'           => $this->session->userdata('login_type')
            // 'message_sent_by'   => $this->input->post('visitor_id')


            );


            $this->db->insert('chat', $page_data);


    }


    // function updatechatFunction($param2){

    //     $page_data = array(
    //         'chat_name'           => $this->input->post('chat_name'),
	// 		//'date_created'        => $this->input->post('date_created'),
	// 		//'chat_password'       => $this->input->post('chat_password'),

    //         );

    //         $this->db->where('chatroomid', $param2);
    //         $this->db->update('chatroom', $page_data);
    // }


    function updatechatFunction($param2){

        $page_data = array(
            'message'           => $this->input->post('message'),
			//'date_created'        => $this->input->post('date_created'),
			//'chat_password'       => $this->input->post('chat_password'),

            );

            $this->db->where('chat_id', $param2);
            $this->db->update('chat', $page_data);
    }


    function deletechatFunction($param2){

        $this->db->where('chatroomid', $param2);
        $this->db->delete('chatroom');
    }
    function createData($data)
    {


        $query = $this->db->insert('chat',$data);
        return $query;
    }






    // function update_chat_message_status($user_id)
    // {

    //     $data = array('chat_message_status' =>'yes');
    //     $this->db->where('receiver_message_id',$user_id);
    //     $this->db->where('chat_message_status','no');
    //     $this->db->update('message',$data);


    // }

    function selectChatStaffInsert(){
        $staff = $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');
        $sql = "select * from chat where user_id='".$staff."' order by chat_id asc";
        return $this->db->query($sql)->result_array();
    }


    function fetch_chat_data($visitor_id, $exhibitor_id){
        // $sender_message_id = mysqli_real_escape_string($conn, $_POST['sender_message_id']);
        // $receiver_message_id = 9;
        // $output= "";
        // $sql = "select * FROM chat WHERE (sender_message_id = {$sender_message_id} AND receiver_message_id = {$receiver_message_id})
        // OR(sender_message_id = {$receiver_message_id} AND receiver_message_id = {$sender_message_id} ) ORDER BY chat_id DESC";
        // $query = mysqli_query($conn,$sql);
        // if(mysqli_num_rows($query)> 0){
        //     while($row = mysqli_fetch_assoc($query)){
        //         if($row['sender_message_id'] === $sender_message_id){
        //             $output.=   ' <div class="chat_outgoing">
        //                             <div class="details">
        //                                 <p>'.$row['message'].'</p>
        //                             </div>
        //                         </div>';

        //         }
        //         else{
        //             $output.=   ' <div class="chat_incoming">
        //             <div class="details">
        //                 <p>'.$row['message'].'</p>
        //             </div>
        //         </div>';

        //         }
        //     }
        //     echo $output;
        // }


        // $this->db->where('(sender_message_id = "'.$visitor_id.'" OR sender_message_id="'.$exhibitor_id.'")');
        // $this->db->where('(receiver_message_id = "'.$exhibitor_id.'" OR receiver_message_id="'.$visitor_id.'")');
        $this->db->orderby('chat_id','ASC');
        return $this->db->get('chat');

    }


    function selectchatexhibitorbyexhibitorId(){
        $receiveexhibitor = $this->db->get_where('chat', array('exhibitor_id' => $this->session->userdata('exhibitor_id')))->row()->exhibitor_id;
        $sendvisitor = $this->db->get_where('chat', array('visitor_id' => $this->session->userdata('visitor_id')))->row()->visitor_id;


        $sql = "select * from chat where exhibitor_id ='".$receiveexhibitor."' and visitor_id='".$sendvisitor."' order by chat_id asc";
        return $this->db->query($sql)->result_array();

        // $visitor_id = $this->session->userdata('visitor_id');
        // $exhibitor_id = $this->session->userdata('exhibitor_id');


        // $this->db->where('(visitor_id = "'.$visitor_id.'")');
        // $this->db->where('(exhibitor_id = "'.$exhibitor_id.'")');
        // $this->db->orderby('chatid','ASC');
        // return $this->db->get('chat');
    }

    function selectJitsivisitorbyvisitorId(){
        $studentClassvisitor = $this->db->get_where('visitor', array('visitor_id' => $this->session->userdata('visitor_id')))->row()->visitor_id;
        // $visitorsubgroup = $this->db->get_where('visitor', array('visitor_id' => $this->session->userdata('visitor_id')))->row()->subgroup_id;

        $sql = "select * from jitsi where visitor_id='".$studentClassvisitor."'  order by jitsi_id asc";
        return $this->db->query($sql)->result_array();
    }


    function list_all_chat_and_order_with_chatid($visitor_id,$exhibitor_id){

            $receiveexhibitor = $this->db->get_where('chat', array('exhibitor_id' => $exhibitor_id))->row()->exhibitor_id;
            $sendvisitor = $this->db->get_where('chat', array('visitor_id' =>  $visitor_id))->row()->visitor_id;
            $sql = "select * from chat where exhibitor_id ='".$receiveexhibitor."' and visitor_id='".$sendvisitor."' order by chat_id asc";
            return $this->db->query($sql)->result_array();

        }

        function list_all_chat_and_order_with_chatid1($visitor_id,$exhibitor_id){

                $receivetovisitor = $this->db->get_where('chat', array('visitor_id' => $visitor_id))->row()->visitor_id;
                $sendbyexhibitor = $this->db->get_where('chat', array('exhibitor_id' =>  $exhibitor_id))->row()->exhibitor_id;
                $sql = "select * from chat where exhibitor_id ='".$sendbyexhibitor."' and visitor_id='".$receivetovisitor."' order by chat_id asc";
                return $this->db->query($sql)->result_array();


            }

            function insertChatRequest(){
                $page_data = array(

            'visitor_id'           => $this->input->post('visitor_id'),
            'visitor_name'           => $this->input->post('visitor_name'),
            'exhibitor_name'           => $this->input->post('exhibitor_name'),
            'exhibitor_id'           => $this->input->post('exhibitor_id'),
            'status'           => $this->input->post('status'),



                );

                $this->db->insert('chat_request', $page_data);
            }


            function updateChatRequest( $param2){

                $page_data = array(
                    // 'visitor_id'           => $this->input->post('visitor_id'),
                    // 'exhibitor_id'           => $this->input->post('exhibitor_id'),
                    'status'           => $this->input->post('status'),

                    //'date_created'        => $this->input->post('date_created'),
                    //'chat_password'       => $this->input->post('chat_password'),

                    );
        // $page_data['visitor_id']  = html_escape($this->input->post('visitor_id'));
        // $page_data['exhibitor_id']  = html_escape($this->input->post('exhibitor_id'));


                    $this->db->where('chat_request_id', $param2);
                    $this->db->update('chat_request', $page_data);

            }


            function selectChatrequestvisitorbyvisitorId(){
                $studentClassvisitor = $this->db->get_where('exhibitor', array('exhibitor_id' => $this->session->userdata('exhibitor_id')))->row()->exhibitor_id;
                // $visitorsubgroup = $this->db->get_where('visitor', array('visitor_id' => $this->session->userdata('visitor_id')))->row()->subgroup_id;

                $sql = "select * from chat_request where visitor_id='".$studentClassvisitor."'  order by chat_request_id asc";
                return $this->db->query($sql)->result_array();
            }
function retrive_visitor_name_from_visitor_name(){

   $sql= "select * from visitor inner join chat_request on visitor.visitor_id=chat_request.visitor_id";
   return $this->db->query($sql)->result_array();
}

            function list_all_visitor_and_order_with_chat_request($exhibitor_id){

                // $visitor_name= $this->session->userdata('visitor_name');
                $exhibitor_id= $this->session->userdata('exhibitor_id');

                $receivetovisitor = $this->db->get_where('chat_request', array('exhibitor_id' => $exhibitor_id))->row()->exhibitor_id;
                // $visitor_name = $this->db->get_where('visitor', array('name' =>   $visitor_name))->row()->visitor_name;
                $sql = "select * from chat_request where exhibitor_id ='". $receivetovisitor."' order by chat_request_id asc";
                // return $this->db->query($sql)->result_array();

                $data = array();
                // $sql = "select  * from chat_request order by exhibitor_id asc limit 0,20";
                $all_visitor_selected = $this->db->query($sql)->result_array();
                foreach($all_visitor_selected as $key => $selected_visitors_from_visitor_table){
                    $visitor_id = $selected_visitors_from_visitor_table['visitor_id'];
                    $face_file = 'uploads/visitor_image/'. $visitor_id . '.jpg';
                    if(!file_exists($face_file)){
                        $face_file = 'uploads/visitor_image/default_image.jpg/';
                    }

                    $selected_visitors_from_visitor_table['face_file'] = base_url() . $face_file;
                    array_push($data, $selected_visitors_from_visitor_table);
                }

                return $data;
            }

            function list_all_exhibitor_who_accepted_chat_request($visitor_id){

                $visitor_id= $this->session->userdata('visitor_id');
                $exhibitor_id= $this->session->userdata('exhibitor_id');

                // $receivetovisitor = $this->db->get_where('chat_request', array('exhibitor_id' => $exhibitor_id))->row()->exhibitor_id;
                $sendbyexhibitor = $this->db->get_where('chat_request', array('visitor_id' =>   $visitor_id))->row()->visitor_id;
                $sql = "select * from chat_request where visitor_id ='". $sendbyexhibitor."' order by chat_request_id asc";
                // return $this->db->query($sql)->result_array();

                $data = array();
                // $sql = "select  * from chat_request order by exhibitor_id asc limit 0,20";
                $all_visitor_selected = $this->db->query($sql)->result_array();
                foreach($all_visitor_selected as $key => $selected_visitors_from_visitor_table){
                    $visitor_id = $selected_visitors_from_visitor_table['visitor_id'];
                    $face_file = 'uploads/visitor_image/'. $visitor_id . '.jpg';
                    if(!file_exists($face_file)){
                        $face_file = 'uploads/visitor_image/default_image.jpg/';
                    }

                    $selected_visitors_from_visitor_table['face_file'] = base_url() . $face_file;
                    array_push($data, $selected_visitors_from_visitor_table);
                }

                return $data;
            }


    function toSelectFromchatRequestWithId($chat_request_id){
        $sql = "select * from chat_request where chat_request_id ='".$chat_request_id."'";
        return $this->db->query($sql)->result_array();
    }



    function fetch_chat_status_from_exhibitor($visitor_id,$exhibitor_id){

        $receiveexhibitor = $this->db->get_where('chat_request', array('exhibitor_id' => $exhibitor_id))->row()->exhibitor_id;
        $sendvisitor = $this->db->get_where('chat_request', array('visitor_id' =>  $visitor_id))->row()->visitor_id;
        $sql = "select * from chat_request where exhibitor_id ='".$receiveexhibitor."' and visitor_id='".$sendvisitor."' order by chat_request_id asc";
        return $this->db->query($sql)->result_array();

    }
}


  ?>