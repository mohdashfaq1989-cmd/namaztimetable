<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Ads extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        // Load image model 
        $this->load->model('ads_model'); 
         
        $this->load->helper('form'); 
        $this->load->library('form_validation'); 
          
        // Default controller name 
        $this->controller = 'ads'; 
         
        // File upload path 
        $this->uploadPath = '../uploads/ads/'; 
    } 
    
    public function add_ads(){  
        $image = '';
        if(!empty($_FILES['image']['name'])){  
            
            $config['upload_path'] = $this->uploadPath; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
            
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 
                      
            if($this->upload->do_upload('image')){ 
                $uploadData = $this->upload->data();
                $image = $uploadData['file_name']; 
            }
            else{
                echo json_encode(array(
                        'status' => false,
                        'message' => strip_tags($this->upload->display_errors())
                    ));
                exit;
            }
        } 
        $formData = array(
            'masjid_id'=>$this->input->post('masjid_id'),
            'title'=>$this->input->post('title'),
            'description'=>$this->input->post('description'),
            'image'=>$image, 
            'status'=>$this->input->post('status'),
            'created'=>date("Y-m-d H:i:s")  
            ); 
        
        $insertData = $this->db->insert('ads',$formData);
        if($insertData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }
    public function edit_ads(){  
        $ads_id= $this->input->post('ads_id');
        $image = $this->input->post('image');
        
        $formData = array(
            'masjid_id'=>$this->input->post('masjid_id'),
            'title'=>$this->input->post('title'),
            'description'=>$this->input->post('description'), 
            'status'=>$this->input->post('status'),
            'modified'=>date("Y-m-d H:i:s")  
            );
        if(!empty($_FILES['image']['name'])){
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
        $updateData = $this->db->update('ads',$formData,array('id'=>$ads_id));
        if($updateData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }
    public function deleteAds(){
        $ads_id = $this->input->post('ads_id');
        $delete = $this->db->delete('ads', array('id'=>$ads_id));
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
 
        $data['gallery'] = $this->ads_model->getRows(); 
        $data['title'] = 'All ads'; 
        $data['page_title'] = 'ads'; 
         
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
           
        $data['title'] = 'Add ads'; 
        $data['page_title'] = 'Add ads';
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
        $imgData = $this->ads_model->getRows($con);  
         
        $data['dbData'] = $imgData; 
        $data['title'] = 'Edit ads'; 
        $data['page_title'] = 'Edit ads'; 
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
            $update = $this->ads_model->update($data, $id); 
             
            if($update){ 
                $this->session->set_userdata('success_msg', 'ads has been disable successfully.'); 
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
            $update = $this->ads_model->update($data, $id); 
             
            if($update){ 
                $this->session->set_userdata('success_msg', 'ads has been activated successfully.'); 
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
            $imgData = $this->ads_model->getRows($con); 
             
            // Delete gallery data 
            $delete = $this->ads_model->delete($id); 
             
            if($delete){ 
                // Remove file from the server  
                if(!empty($imgData['file_name'])){ 
                    @unlink($this->uploadPath.$imgData['file_name']);  
                }  
                 
                $this->session->set_userdata('success_msg', 'ads has been removed successfully.'); 
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