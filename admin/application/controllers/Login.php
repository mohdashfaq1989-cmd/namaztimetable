<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model'); 
    }
    public function index()
    {
        $data = array();
        if ($this->session->userdata('admin_email') == "" && $this->session->userdata('admin_password') == "") 
        {
            $this->load->view('login/index'); 
        }
        else{
            return redirect('login/dashboard/');
        }
    }
    public function pdfdetails()
	{
		if($this->uri->segment(3))
		{
			$adminsData = $this->db->get_where('admin')->row();
			$adminsData->invoice_prefix;
			$order_id = $this->uri->segment(3);
			$html_content = '';
			$html_content .= $this->login_model->fetch_single_details($order_id);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$this->pdf->stream("".$adminsData->invoice_prefix.'_'.$order_id.".pdf", array("Attachment"=>0));
		}
	}
	
    public function check_login(){ 
        $admin_user = $this->input->post('email');
        $email_exists = $this->login_model->email_exists($admin_user); 
        if ($email_exists) 
        {
            $email =$this->input->post('email');
            $password=$this->input->post('password'); 
            $result = $this->login_model->login($email,$password);
            if ($result) {
                $adminsID = $this->db->get_where('admin',array('email'=>$email))->row('id');
                $session_data = ['admin_email' => $email,'admin_password' => $password,'admin_id'=>$adminsID];
                $this->session->set_userdata($session_data);
                echo base_url()."dashboard"; 
            }
            else{ 
                echo 0;
            }
        }
        else{
            echo 0;
        }
          
    }
    public function Dashboard()
    {
        $data = array();
        $data['page_title'] = 'Dashboard'; 
        if ($this->session->userdata('admin_email') == "" && $this->session->userdata('admin_password') == "") 
        {
            return redirect('login/index');
        }
        else{
            $data['title'] = 'Dashboard'; 
            $data['page_title'] = 'Dashboard'; 
            $this->load->view('common/header',$data);  
            $this->load->view('common/sidebar');  
            $this->load->view('dashboard');
            $this->load->view('common/footer'); 
            
        }
    }
    public function settings()
    {
        $data = array();
        $data['page_title'] = 'Settings'; 
        if ($this->session->userdata('admin_email') == "" && $this->session->userdata('admin_password') == "") 
        {
            return redirect('login/index');
        }
        else{
            $data['title'] = 'Settings'; 
            $data['page_title'] = 'Settings'; 
            $data['setting'] = $this->login_model->getSetting();
            $this->load->view('common/header',$data);  
            $this->load->view('common/sidebar');  
            $this->load->view('settings');
            $this->load->view('common/footer'); 
            
        }
    }
    public function updateSetting()
    {
        $formData = array(
            'siteName'   => $this->input->post('siteName'),
            'email1'     => $this->input->post('email1'),
            'email2'     => $this->input->post('email2'),
            'phone1'     => $this->input->post('phone1'),
            'phone2'     => $this->input->post('phone2'),
            'address'    => $this->input->post('address'),
            'copyrights' => $this->input->post('copyrights'),
            'status'     => $this->input->post('status'),
            'modified'   => date('Y-m-d H:i:s')

        );
        
        // Logo Upload
        if(!empty($_FILES['logo']['name'])){
            $config['upload_path'] = '../uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
            if($this->upload->do_upload('logo')){
                $fileData = $this->upload->data();
                $formData['logo'] = $fileData['file_name']; 
            }else{ 
                 $error = 'Image size can not exceed 2 mb';  
            } 
        }
        // Favicon Upload
        if(!empty($_FILES['favicon']['name'])){
            $config['upload_path'] = '../uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
            if($this->upload->do_upload('favicon')){
                $fileData = $this->upload->data();
                $formData['favicon'] = $fileData['file_name']; 
            }else{ 
                 $error = 'Image size can not exceed 2 mb';  
            } 
        }
        
        
        $updateData = $this->db->update('settings',$formData,array('id'=>1));
        if($updateData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response); 

    }
    public function Logout()
    {
        $this->session->unset_userdata('admin_email');
        $this->session->unset_userdata('admin_password');
        $this->session->unset_userdata('admin_id');
        redirect('login');
    }
    

    public function profile_fetch($id){
         $data = $this->login_model->profile_fetch($id);
         echo json_encode ($data);
    }

    public function fetch_state() {
      $country_id = $this->input->post('country_id');
      $data = $this->login_model->fetch_state($country_id);    

      if ($data==true) {
          echo $data;
      }else{
        echo false;
      }      
    }
    public function fetch_city() {
      $state_id = $this->input->post('state_id');
      $data = $this->login_model->fetch_city($state_id);    

      if ($data==true) {
          echo $data;
      }else{
        echo false;
      }
      
    }
    public function fetch_tehsil() {
      $city_id = $this->input->post('city_id');
      $data = $this->login_model->fetch_tehsil($city_id);    

      if ($data==true) {
          echo $data;
      }else{
        echo false;
      }
      
    }
    public function fetch_rto() {
      $city_id = $this->input->post('city_id');
      $data = $this->login_model->fetch_rto($city_id);    

      if ($data==true) {
          echo $data;
      }else{
        echo false;
      }
      
    }

    
    
    public function password_reset()
    {   
        $data = array(); 
        $data['page_title'] ='Reset Password';
        $this->load->view('login/reset_password', $data);
    }
    public function reset_password() 
    {
        $email=$this->input->post('email');
        
        $result=$this->login_model->email_exists($email);
        if ($result) {   
            $userStatus = $this->db->get_where('admin',array('email'=>$email))->row('status');
            $password = $this->db->get_where('admin',array('email'=>$email))->row('password');
            if($userStatus==1){ 
                $this->send_reset_password_email($email,$password);               
                echo 1;
            }
            else{
                echo 2;
            }
            
        } 
        else{
            echo 0;
        }
    }
    private function send_reset_password_email($email,$password){ 
        $this->load->library('email'); 
        $config['charset'] = 'utf-8';
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7'; 
        $config['smtp_user']    = 'allmosquedetails@gmail.com';
        $config['smtp_pass']    = 'Ahmad@123';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = TRUE;
        $config['wordwrap'] = TRUE;
        $email_code = md5($this->config->item('salt'));
        $password= base64_encode($password);
        $this->email->set_mailtype('html');
        $this->email->from('noreply@namaztimetable.com','Support');
        $this->email->to($email);
        $this->email->subject('Please reset your password');
        $message = '<p>Hello,</p>';
        $message .= '<p>We received a request to reset the password for your Namaz Timetable account.</p>';
        $message .= '<p>To create a new password, please click the link below:</p>';
        $message .= "<p>Please choose a password that is at least six characters long and contains minimum one uppercase and one special character.</p>\r\n";
        $message .= '<p><a href="' . base_url() . 'login/reset_password_form/' . $email . '/' . $password . '">Reset Password</a></p>';
        $message .= '<p>If you did not request a password reset, you can safely ignore this email. Your account will remain secure.</p>';
        $message .= '<p>For security reasons, this link may expire after a certain period.</p>';
        $message .= '<p>Thank you,<br>Namaz Timetable Team</p>';
        $this->email->message($message);
        $this->email->send();

    }
    public function reset_password_form($email,$password){
        $data = array(); 
        $data['page_title'] ='Update Password';
        if (isset($email,$password)) {
            $email = trim($email);
            $verified= $this->login_model->verify_reset_password_code($email,$password);
            if ($verified) { 
                $this->load->view('login/update_password', array('password'=>$password,'email'=>$email,'page_title'=>'Update Password'));
            }
            else{
                $this->load->view('login/update_password', $data,array('error'=>'there was the problen with your link','email'=>$email));
            }
        }

    }
    
    public function update_password(){ 
        $email = $this->input->post('email');
        $password=$this->input->post('password');
        $formData = array('password' => $this->input->post('password'));
        $update = $this->login_model->update_password($formData);
        if($update){ 
            echo 1;
        }else
        { 
            echo 0;
        } 
        
    }
    
    public function change_password(){
        if ($this->session->userdata('admin_email') == "" && $this->session->userdata('admin_password') == "") 
        {
            return redirect('login/index');
        }
        else{
            $data['page_title'] = 'Change Password'; 
            // Load the edit page view 
            $this->load->view('common/header', $data); 
            $this->load->view('login/change_password', $data); 
            $this->load->view('common/footer');
        }
    }
    public function password_change()
    {
        $user_id=$this->input->post('user_id');
        $old_pass=$this->input->post('old_pass');
    	$new_pass=$this->input->post('new_pass');
    	$confirm_pass=$this->input->post('confirm_pass');
    	echo $session_id = $this->session->userdata('id');
    	$que=$this->db->query("select * from pr_admin where id='$user_id'");
    	$dbpass = $que->row('password');
    	//$dbpass = $row->password;
    	if((!strcmp($old_pass, $dbpass))&& (!strcmp($new_pass, $confirm_pass)))
    	{
    	    $this->login_model->change_password($user_id,$new_pass);
    		echo 1;  
    	}
        else{
    		echo 0;
    	}
             
    }
    
    
    public function createAccount()
    {
        $data = array();
        $this->form_validation->set_rules('company_name', 'company name', 'required');
        $this->form_validation->set_rules('email', 'email name', 'required');
        $this->form_validation->set_rules('password', 'password name', 'required');
        $this->form_validation->set_rules('mobile_no', 'mobile no', 'required');
        $this->form_validation->set_rules('pincode', 'pincode', 'required');
        $this->form_validation->set_rules('panno', 'pan no', 'required');
        $this->form_validation->set_rules('gstno', 'gst no', 'required');
        
        if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('seller/index');
                }
                else
                {
                        $result = $this->login_model->createAccount();
                        $seller_email=$this->input->post('email');
                        $seller_email=$this->input->post('email');
                        $seller_pass=$this->input->post('password');
                        $this->load->view('seller/mymail','',true);
                        if ($result) {                            
                            //$this->session->set_flashdata('msg', 'Data added');
                            $session_data = [
                              'seller_username' => $seller_email,
                              'seller_password' => $seller_pass
                            ];
                            $this->session->set_userdata($session_data);

                            redirect('seller/dashboard');
                        }
                        else{
                            return redirect('seller/index');
                        }
                }

         
    }
    
    
}



