<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Countries extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        // Load image model 
        $this->load->model('countries_model'); 
         
        $this->load->helper('form'); 
        $this->load->library('form_validation'); 
          
        // Default controller name 
        $this->controller = 'countries'; 
         
        // File upload path 
        $this->uploadPath = './uploads/images/'; 
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
 
        $data['result'] = $this->countries_model->getRows(); 
        $data['title'] = 'All Countries'; 
        $data['page_title'] = 'Countries'; 
         
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
           
        $data['title'] = 'Add countries'; 
        $data['page_title'] = 'Add countries';
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
        //$con = array('country_id' => $id); 
        $imgData = $this->db->get_where('countries',array('country_id' => $id))->row_array();  
         
        $data['dbData'] = $imgData; 
        $data['title'] = 'Edit countries'; 
        $data['page_title'] = 'Edit countries'; 
        // Load the edit page view 
        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view($this->controller.'/edit', $data); 
        $this->load->view('common/footer'); 
        }
    } 
    public function add_countries(){  
        $error = ''; 
        $formData = array(
            'countryCode'=>$this->input->post('countryCode'),
            'country_name'=>$this->input->post('country_name'),
            'created'=>date("Y-m-d H:i:s")  
            );
        
        $insertData = $this->db->insert('countries',$formData);
        if($insertData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }
    public function edit_countries(){ 
        $error = '';  
        $country_id= $this->input->post('country_id');
        $formData = array(
            'countryCode'=>$this->input->post('countryCode'),
            'country_name'=>$this->input->post('country_name'),
            'modified'=>date("Y-m-d H:i:s")  
            );
             
        $updateData = $this->db->update('countries',$formData,array('country_id'=>$country_id));
        if($updateData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }
    public function deleteCountries(){
        $country_id = $this->input->post('country_id');
        $delete = $this->db->delete('countries', array('country_id'=>$country_id));
        if($delete)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0);
        }
        echo json_encode ($response);
         
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
            $imgData = $this->countries_model->getRows($con); 
             
            // Delete gallery data 
            $delete = $this->countries_model->delete($id); 
             
            if($delete){ 
                // Remove file from the server  
                if(!empty($imgData['file_name'])){ 
                    @unlink($this->uploadPath.$imgData['file_name']);  
                }  
                 
                $this->session->set_userdata('success_msg', 'countries has been removed successfully.'); 
            }else{ 
                $this->session->set_userdata('error_msg', 'Some problems occurred, please try again.'); 
            } 
        } 
 
        redirect($this->controller); 
        }
    } 
     
     
}