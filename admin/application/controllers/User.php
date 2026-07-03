<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class User extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        // Load image model 
        $this->load->model('user_model');
        $this->load->helper('form'); 
        $this->load->library('form_validation'); 
          
        // Default controller name 
        $this->controller = 'user'; 
         
        // File upload path 
        $this->uploadPath = './uploads/images/'; 
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
    public function add_user(){ 
        $image = $this->input->post('image');
        $error = ''; 
        $formData = array(
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password'),
            'phone'=>$this->input->post('phone'),
            'status'=>$this->input->post('status'),
            'created'=>date("Y-m-d H:i:s")  
            );
        if(!empty($_FILES['image']['name'])){ 
            $imageName = $_FILES['image']['name']; 
            $config['upload_path'] = $this->uploadPath; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
            if($this->upload->do_upload('image')){ 
                $fileData = $this->upload->data();
                $formData['image'] = $fileData['file_name']; 
                }else{ 
                    $error = 'Image size can not exceed 2 mb';  
                } 
            } 
               
        
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
    public function edit_user(){ 
        $image = $this->input->post('image');
        $user_id= $this->input->post('user_id');
        $formData = array(
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'password'=>$this->input->post('password'),
            'phone'=>$this->input->post('phone'),
            'status'=>$this->input->post('status'),
            'modified'=>date("Y-m-d H:i:s")  
            );
        if(!empty($_FILES['image']['name'])){ 
            $imageName = $_FILES['image']['name'];
            $config['upload_path'] = $this->uploadPath; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
            if($this->upload->do_upload('image')){
                $fileData = $this->upload->data();
                $formData['image'] = $fileData['file_name']; 
            }else{ 
                 $error = 'Image size can not exceed 2 mb';  
            } 
        }
    
        $updateData = $this->db->update('user',$formData,array('id'=>$user_id));
        if($updateData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }
    public function deleteUser(){
        $user_id = $this->input->post('user_id');
        $delete = $this->db->delete('user', array('id'=>$user_id));
        if($delete)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0);
        }
        echo json_encode ($response);
         
    }
    public function index(){ 
        if ($this->session->userdata('admin_email') == "" && $this->session->userdata('admin_password') == "")  
        {
            return redirect('login/index');
        }
        else{
        $data = array();          
        // Get messages from the session 
        if($this->session->userdata('success_msg')){ 
            $data['success_msg'] = $this->session->userdata('success_msg'); 
            $this->session->unset_userdata('success_msg'); 
        } 
        if($this->session->userdata('error_msg')){ 
            $data['error_msg'] = $this->session->userdata('error_msg'); 
            $this->session->unset_userdata('error_msg'); 
        } 
 
        $data['gallery'] = $this->user_model->getRows(); 
        $data['title'] = 'All User'; 
        $data['page_title'] = 'User'; 
         
        // Load the list page view 
        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view($this->controller.'/index', $data); 
        $this->load->view('common/footer'); 
        }
    } 
     
    
     
    public function add(){
        if ($this->session->userdata('admin_email') == "" && $this->session->userdata('admin_password') == "") 
        {
            return redirect('login/index');
        }
        else{ 
           
        $data['title'] = 'Add user'; 
        $data['page_title'] = 'Add user';
        $data['action'] = 'Upload'; 
         
        // Load the add page view 
        $this->load->view('common/header', $data); 
        $this->load->view('common/sidebar', $data);
        $this->load->view($this->controller.'/add', $data); 
        $this->load->view('common/footer');
        }
    }
     
    public function edit($id){
        if ($this->session->userdata('admin_email') == "" && $this->session->userdata('admin_password') == "") 
        {
            return redirect('login/index');
        }
        else{
        $data = $imgData = array(); 
         
        // Get image data 
        $con = array('id' => $id); 
        $imgData = $this->user_model->getRows($con);  
         
        $data['dbData'] = $imgData; 
        $data['title'] = 'Edit user'; 
        $data['page_title'] = 'Edit user'; 
        // Load the edit page view 
        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view($this->controller.'/edit', $data); 
        $this->load->view('common/footer'); 
        }
    } 
 
       
     
    public function block($id){ 
        if ($this->session->userdata('admin_email') == "" && $this->session->userdata('admin_password') == "") 
        {
            return redirect('login/index');
        }
        else{
        // Check whether id is not empty 
        if($id){ 
            // Update image status 
            $data = array('status' => 0); 
            $update = $this->user_model->update($data, $id); 
             
            if($update){ 
                $this->session->set_userdata('success_msg', 'user has been disable successfully.'); 
            }else{ 
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.'); 
            } 
        } 
 
        redirect($this->controller);
        }
    } 
     
    public function unblock($id){ 
        if ($this->session->userdata('admin_email') == "" && $this->session->userdata('admin_password') == "") 
        {
            return redirect('login/index');
        }
        else{
        // Check whether is not empty 
        if($id){ 
            // Update image status 
            $data = array('status' => 1); 
            $update = $this->user_model->update($data, $id); 
             
            if($update){ 
                $this->session->set_userdata('success_msg', 'user has been activated successfully.'); 
            }else{ 
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.'); 
            } 
        } 
 
        redirect($this->controller); 
        }
    } 
     
    public function delete($id){ 
        if ($this->session->userdata('admin_email') == "" && $this->session->userdata('admin_password') == "") 
        {
            return redirect('login/index');
        }
        else{
        // Check whether id is not empty 
        if($id){ 
            $con = array('id' => $id); 
            $imgData = $this->user_model->getRows($con); 
             
            // Delete gallery data 
            $delete = $this->user_model->delete($id); 
             
            if($delete){ 
                // Remove file from the server  
                if(!empty($imgData['file_name'])){ 
                    @unlink($this->uploadPath.$imgData['file_name']);  
                }  
                 
                $this->session->set_userdata('success_msg', 'user has been removed successfully.'); 
            }else{ 
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.'); 
            } 
        } 
 
        redirect($this->controller); 
        }
    } 
     
    public function file_check($str){ 
        if(empty($_FILES['image']['name'])){ 
            $this->form_validation->set_message('file_check', 'Select an image file to upload.'); 
            return FALSE; 
        }else{ 
            return TRUE; 
        } 
    } 
}