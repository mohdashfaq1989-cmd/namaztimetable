<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');
        $this->uploadPath = './uploads/profile/';
        $this->sessionid = $this->session->userdata('user_id');
    }
    
    public function Dashboard()
    {
        $data = array();
        $data['page_title'] = 'Dashboard';  
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "") 
        {
            return redirect('login/index');
        }
        else{
            $data['userData'] = $this->db->get_where('user',array('id'=>$this->sessionid))->row();
            $data['result'] = $this->user_model->getMasjidbyUserId($this->sessionid); 
            $data['title'] = 'Dashboard'; 
            $data['page_title'] = 'Dashboard'; 
            $this->load->view('common/header',$data);   
            $this->load->view('common/sidebar',$data);
            $this->load->view('dashboard');
            $this->load->view('common/footer'); 
            
        }
    }
    public function profile()
    {
        $data = array();
        $data['page_title'] = 'Profile';  
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "") 
        {
            return redirect('login/index');
        }
        else{
            $data['userData'] = $this->db->get_where('user',array('id'=>$this->sessionid))->row(); 
            $data['title'] = 'profile'; 
            $data['page_title'] = 'profile'; 
            $this->load->view('common/header',$data);   
            $this->load->view('common/sidebar',$data);
            $this->load->view('profile');
            $this->load->view('common/footer'); 
            
        }
    }
    public function updateProfile(){
        $id = $this->input->post('id');
        $formData = array(
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password'), 
            'phone'=>$this->input->post('phone'),
            'address'=>$this->input->post('address'),
            'modified'=>date("Y-m-d H:i:s")  
            );
        
        if(!empty($_FILES['image']['name'])){             
            $config['upload_path'] = $this->uploadPath; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';          
            $this->load->library('upload', $config); 
            $this->upload->initialize($config);                     
            if($this->upload->do_upload('image')){ 
                $uploadData = $this->upload->data();
                $formData['image'] = $uploadData['file_name']; 
            }
            else{
                echo json_encode(array(
                        'status' => false,
                        'message' => strip_tags($this->upload->display_errors())
                    ));
                exit;
            }
        }
                    
        $updateData = $this->db->update('user',$formData, array('id'=>$id));
        if($updateData){
            $response = array(
                'status'=>1,
                'message' => 'Profile Updated Successfully'
            );
        }
        else{
            $response = array(
                'status'=>0,
                'message' => 'Profile not updated'
            ); 
        }
        echo json_encode ($response);
         
    }
    
    public function index()
    {
        $data = array();
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "") 
        {
            $data = array();  
            $data['page_title'] ='Home Page'; 
            $this->load->view('common/header', $data);
            $this->load->view('login/index', $data); 
            $this->load->view('common/footer', $data);  
        }
        else{
            return redirect('login/dashboard/');
        }
    }
    public function register()
    {
        $data = array();  
        $data['page_title'] ='Signup Page'; 
        $this->load->view('common/header', $data);
        $this->load->view('login/register', $data); 
        $this->load->view('common/footer', $data);
    }
    public function forget()
    {
        $data = array();  
        $data['page_title'] ='Forget Password'; 
        $this->load->view('common/header', $data);
        $this->load->view('login/forget', $data); 
        $this->load->view('common/footer', $data);
    }
    public function check_email()
    {
        $email = $this->input->post('email');
    
        if(empty($email))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email required'
            ]);
            return;
        }
    
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid Email'
            ]);
            return;
        }
    
        $this->db->where('email', $email);
        $query = $this->db->get('user');
    
        if($query->num_rows() > 0)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email already exists'
            ]);
        }
        else
        {
            echo json_encode([
                'status' => 'success',
                'message' => 'Email available'
            ]);
        }
    }
    public function signup(){  
        $error = ''; 
        $phone = preg_replace('/[^0-9]/', '', $this->input->post('phone'));
        $formData = array(
            'role_id'=>$this->input->post('role_id'),
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password'),
            'phone'=>$phone,
            'created'=>date("Y-m-d H:i:s")  
            );
        
        $insertData = $this->db->insert('user',$formData);
        if($insertData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }

    
	
    public function check_login(){ 
        $email = $this->input->post('email');
        $email_exists = $this->login_model->email_exists($email); 
        if ($email_exists) 
        {
            $email =$this->input->post('email');
            $password=$this->input->post('password'); 
            $result = $this->login_model->login($email,$password);
            if ($result) {
                $userID = $this->db->get_where('user',array('email'=>$email))->row('id');
                $session_data = ['user_email' => $email,'user_password' => $password,'user_id'=>$userID];
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
    
    public function Logout()
    {
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_password');
        $this->session->unset_userdata('admin_id');
        redirect('login');
    }
    public function settings(){
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "") 
        {
            return redirect('login/index');
        }
        else{
            // Get messages from the session 
            if($this->session->userdata('success_msg')){ 
                $data['success_msg'] = $this->session->userdata('success_msg'); 
                $this->session->unset_userdata('success_msg'); 
            } 
            if($this->session->userdata('error_msg')){ 
                $data['error_msg'] = $this->session->userdata('error_msg'); 
                $this->session->unset_userdata('error_msg'); 
            }
            
            $data['title'] = 'Settings'; 
            $data['page_title'] = 'Settings'; 
            // Load the edit page view 
            $this->load->view('common/header', $data); 
            $this->load->view('common/sidebar', $data); 
            $this->load->view('login/profile', $data); 
            $this->load->view('common/footer');
        }
    }
    

    
    
    
    public function reset_password() 
    {
        $email=$this->input->post('email');
        
        $result=$this->login_model->email_exists($email);
        if ($result) {   
            $userStatus = $this->db->get_where('user',array('email'=>$email))->row('status');
            $password = $this->db->get_where('user',array('email'=>$email))->row('password');
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
                $this->load->view('common/header', $data);
                $this->load->view('login/update_password', array('password'=>$password,'email'=>$email,'page_title'=>'Update Password'));
                $this->load->view('common/footer', $data);
            }
            else{
                $this->load->view('common/header', $data);
                $this->load->view('login/update_password', $data,array('error'=>'there was the problen with your link','email'=>$email));
                $this->load->view('common/footer', $data);
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
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "") 
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
    
    
    
    public function user_exists()
    {
        $email = $this->input->post('email');
            $this->db->select('email');
            $this->db->from('user'); 
            $this->db->where('email', $email); 
            $query=$this->db->get();
            $row = $query->row();
            if ($query->num_rows()>0 ) {
                $Query = $this->db->get_where('user',array('email'=>$email,'status'=>'1')); 
                if($Query->num_rows()>0){
                    $response = array(
                    'status'=>1,
                    'message'=>'User Already Exist',
                    ); 
                }else{
                    $response = array(
                    'status'=>1,
                    'message'=>'User Already Registered but account not active',
                    ); 
                }
                
            }else{
                $response = array(
                    'status'=>0,
                    'message'=>'User not registered',
                    ); 
            }
            echo json_encode ($response);
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
    
    
}



