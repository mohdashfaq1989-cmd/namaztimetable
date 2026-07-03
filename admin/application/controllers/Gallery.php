<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class gallery extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        // Load image model 
        $this->load->model('gallery_model'); 
         
        $this->load->helper('form'); 
        $this->load->library('form_validation'); 
          
        // Default controller name 
        $this->controller = 'gallery'; 
         
        // File upload path 
        $this->uploadPath = '../uploads/gallery/'; 
    } 
    
    public function add_gallery(){ 

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
            'title'=>$this->input->post('title'),
            'image'=>$image, 
            'status'=>$this->input->post('status'),
            'created'=>date("Y-m-d H:i:s")  
            );        
        
        $insertData = $this->db->insert('gallery',$formData);
        if($insertData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }
    public function edit_gallery(){  
        $gallery_id= $this->input->post('gallery_id');
        $image = $this->input->post('image');
        $formData = array(
            'title'=>$this->input->post('title'), 
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
        
        $updateData = $this->db->update('gallery',$formData,array('id'=>$gallery_id));
        if($updateData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }
    public function deleteGallery(){
        $gallery_id = $this->input->post('gallery_id');
        $delete = $this->db->delete('gallery', array('id'=>$gallery_id));
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
 
        $data['gallery'] = $this->gallery_model->getRows(); 
        $data['title'] = 'All Gallery'; 
        $data['page_title'] = 'Gallery'; 
         
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
           
        $data['title'] = 'Add Gallery'; 
        $data['page_title'] = 'Add Gallery'; 
         
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
        $imgData = $this->gallery_model->getRows($con);  
         
        $data['dbData'] = $imgData; 
        $data['title'] = 'Edit Gallery'; 
        $data['page_title'] = 'Edit Gallery'; 
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
            $update = $this->gallery_model->update($data, $id); 
             
            if($update){ 
                $this->session->set_userdata('success_msg', 'gallery has been disable successfully.'); 
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
            $update = $this->gallery_model->update($data, $id); 
             
            if($update){ 
                $this->session->set_userdata('success_msg', 'gallery has been activated successfully.'); 
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
            $imgData = $this->gallery_model->getRows($con); 
             
            // Delete gallery data 
            $delete = $this->gallery_model->delete($id); 
             
            if($delete){ 
                // Remove file from the server  
                if(!empty($imgData['file_name'])){ 
                    @unlink($this->uploadPath.$imgData['file_name']);  
                }  
                 
                $this->session->set_userdata('success_msg', 'gallery has been removed successfully.'); 
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