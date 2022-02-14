<?php if (!defined('BASEPATH'))exit('No direct script access allowed');


class Login extends CI_Controller {

    function __construct() {
      parent::__construct();

		$this->load->database();
		$this->load->library('session');
    }

    //***************** The function below redirects to logged in user area
    public function index() {

        if ($this->session->userdata('superadmin_login') == 1) redirect (base_url(). 'superadmin/school_setting');
        if ($this->session->userdata('admin_login', 'clinic_id')== 1) redirect (base_url(). 'admin/dashboard');
        if ($this->session->userdata('parent_login')== 1) redirect (base_url(). 'parent/dashboard');
        if ($this->session->userdata('doctor_login')== 1) redirect (base_url(). 'doctor/dashboard');
        if ($this->session->userdata('exhibitor_login')== 1) redirect (base_url(). 'exhibitor/dashboard');
        if ($this->session->userdata('visitor_login')== 1) redirect (base_url(). 'visitor/dashboard');

        if ($this->session->userdata('patient_login')== 1) redirect (base_url(). 'patient/dashboard');
        $this->load->view('backend/login');
    }
  //***************** / The function below redirects to logged in user area

  //********************************** the function below validating user login request
    function validate_login() {
        $login_check_model = $this->login_model->loginFunctionForAllUsers();
        $login_user = $this->session->userdata('login_type');
        if(!$login_check_model){
          // Here, if the above conditions are not meant, the user will be redirected to login page again.
          $this->session->set_flashdata('error_message', get_phrase('Wrong email or password'));
          redirect(base_url() . 'login', 'refresh');
        }

        if($login_user == 'superadmin') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'superadmin/school_setting', 'refresh');
        }
        if($login_user == 'admin') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'admin/dashboard', 'refresh');
        }
        if($login_user == 'doctor') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'doctor/dashboard', 'refresh');
        }
        if($login_user == 'exhibitor') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'exhibitor/dashboard', 'refresh');
        }
        if($login_user == 'visitor') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'visitor/dashboard', 'refresh');
        }
        if($login_user == 'parent') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'parents/dashboard', 'refresh');
        }
        if($login_user == 'patient') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'patient/dashboard', 'refresh');
        }
     }


    function logout(){
      $login_user = $this->session->userdata('login_type');
      if($login_user == 'superadmin'){
          $this->login_model->logout_model_for_super_admin();
      }
      if($login_user == 'admin'){
          $this->login_model->logout_model_for_admin();
      }
      if($login_user == 'parent'){
        $this->login_model->logout_model_for_parent();
      }
      if($login_user == 'doctor'){
        $this->login_model->logout_model_for_doctor();
      }
      if($login_user == 'exhibitor'){
        $this->login_model->logout_model_for_exhibitor();
      }
      if($login_user == 'visitor'){
        $this->login_model->logout_model_for_visitor();
      }
      if($login_user == 'patient'){
        $this->login_model->logout_model_for_patient();
      }
      $this->session->sess_destroy();
      redirect('login', 'refresh');
     }
}
