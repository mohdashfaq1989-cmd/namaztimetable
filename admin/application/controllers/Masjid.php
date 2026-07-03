<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Masjid extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        // Load image model 
        $this->load->model('masjid_model'); 
         
        $this->load->helper('form'); 
        $this->load->library('form_validation'); 
          
        // Default controller name 
        $this->controller = 'masjid'; 
         
        // File upload path 
        $this->uploadPath = '../uploads/images/'; 
    } 
    
    public function add_masjid(){ 
        $image = $this->input->post('image');
        $rto_id = $this->input->post('rto_id');
        $rto_name = $this->db->get_where('rto',array('rto_id'=>$rto_id))->row('rto_name');
        // Current RTO ka last record nikalo
        $this->db->select('id');
        $this->db->from('masjid');
        $this->db->where('rto_id', $rto_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
        
            $row = $query->row();
        
            // Is RTO ke total records count karo
            $count = $this->db->where('rto_id', $rto_id)
                              ->count_all_results('masjid');
        
            $next = $count + 1;
        
        } else {
        
            $next = 1;
        }
        
        // 100 records ke baad alphabet change hoga
        $group = floor(($next - 1) / 100);
        $alphabet = chr(65 + $group); // A, B, C...
        
        $seq_no = $alphabet . str_pad($next, 3, '0', STR_PAD_LEFT);

        // $this->db->select('id');
        // $this->db->from('masjid');
        // $this->db->order_by('id', 'DESC');
        // $this->db->limit(1);
    
        // $query = $this->db->get();
    
        // if ($query->num_rows() > 0) {
    
        //     $row  = $query->row();
        //     $next = $row->id + 1;
        
        // } else {
        
        //     $next = 1;
        // }
        // $group = floor(($next - 1) / 100);
        // $alphabet = chr(65 + $group);
        // $seq_no = $alphabet . str_pad($next, 3, '0', STR_PAD_LEFT);
        
        $error = ''; 
        $formData = array(
            'masjidCode'=>$rto_name.$seq_no,
            'name'=>$this->input->post('name'),
            'imam'=>$this->input->post('imam'),
            'mutwalli'=>$this->input->post('mutwalli'),
            'student'=>$this->input->post('student'),
            'imamPhone'=>$this->input->post('imamPhone'),
            'mutwalliPhone'=>$this->input->post('mutwalliPhone'),
            'studentPhone'=>$this->input->post('studentPhone'),
            'ward_village'=>$this->input->post('ward_village'),
            'lng'=>$this->input->post('lng'),
            'lat'=>$this->input->post('lat'),
            'rto_id'=>$this->input->post('rto_id'),
            'country_id'=>$this->input->post('country_id'),
            'state_id'=>$this->input->post('state_id'),
            'city_id'=>$this->input->post('city_id'),
            'tehsil_id'=>$this->input->post('tehsil_id'),
            'address'=>$this->input->post('address'),
            'pincode'=>$this->input->post('pincode'),
            'description'=>$this->input->post('description'),
            'fajr'=>$this->input->post('fajr'),
            'dhuhr'=>$this->input->post('dhuhr'),
            'asr'=>$this->input->post('asr'),
            'maghrib'=>$this->input->post('maghrib'),
            'isha'=>$this->input->post('isha'),
            'juma'=>$this->input->post('juma'),
            'eid'=>$this->input->post('eid'),            
            'status'=>$this->input->post('status'),
            'created_by'=>$this->input->post('created_by'),
            'created'=>date("Y-m-d H:i:s")  
            );
        if(!empty($_FILES['image']['name'])){ 
                    $imageName = $_FILES['image']['name']; 
                     
                    // File upload configuration 
                    $config['upload_path'] = $this->uploadPath; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                     
                    // Load and initialize upload library 
                    $this->load->library('upload', $config); 
                    $this->upload->initialize($config); 
                     
                    // Upload file to server 
                    if($this->upload->do_upload('image')){ 
                        // Uploaded file data 
                        $fileData = $this->upload->data();
                        //$this->_create_thumbs($fileData['file_name']); 
                        $formData['image'] = $fileData['file_name']; 
                    }else{ 
                        $error = 'Image size can not exceed 2 mb';  
                    } 
                } 
              
        
        $updateData = $this->db->insert('masjid',$formData);
        if($updateData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }

    public function edit_masjid(){ 
        $image = $this->input->post('image');
       
        $masjid_id= $this->input->post('masjid_id');
        $formData = array(
            'masjidCode'=>$this->input->post('masjidCode'),
            'name'=>$this->input->post('name'),
            'imam'=>$this->input->post('imam'),
            'mutwalli'=>$this->input->post('mutwalli'),
            'student'=>$this->input->post('student'),
            'imamPhone'=>$this->input->post('imamPhone'),
            'mutwalliPhone'=>$this->input->post('mutwalliPhone'),
            'studentPhone'=>$this->input->post('studentPhone'),
            'ward_village'=>$this->input->post('ward_village'),
            'lng'=>$this->input->post('lng'),
            'lat'=>$this->input->post('lat'),
            'rto_id'=>$this->input->post('rto_id'),
            'country_id'=>$this->input->post('country_id'),
            'state_id'=>$this->input->post('state_id'),
            'city_id'=>$this->input->post('city_id'),
            'tehsil_id'=>$this->input->post('tehsil_id'),
            'address'=>$this->input->post('address'),
            'pincode'=>$this->input->post('pincode'),
            'description'=>$this->input->post('description'),
            'fajr'=>$this->input->post('fajr'),
            'dhuhr'=>$this->input->post('dhuhr'),
            'asr'=>$this->input->post('asr'),
            'maghrib'=>$this->input->post('maghrib'),
            'isha'=>$this->input->post('isha'),
            'juma'=>$this->input->post('juma'),
            'eid'=>$this->input->post('eid'),            
            'status'=>$this->input->post('status'),
            'created_by'=>$this->input->post('created_by'),
            'modified'=>date("Y-m-d H:i:s")  
            );
            if(!empty($_FILES['image']['name'])){ 
                    $imageName = $_FILES['image']['name']; 
                     
                    // File upload configuration 
                    $config['upload_path'] = $this->uploadPath; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                     
                    // Load and initialize upload library 
                    $this->load->library('upload', $config); 
                    $this->upload->initialize($config); 
                     
                    // Upload file to server 
                    if($this->upload->do_upload('image')){ 
                        // Uploaded file data 
                        $fileData = $this->upload->data();
                        //$this->_create_thumbs($fileData['file_name']); 
                        $formData['image'] = $fileData['file_name']; 
                    }else{ 
                        $error = 'Image size can not exceed 2 mb';  
                    } 
                } 
        $updateData = $this->db->update('masjid',$formData,array('id'=>$masjid_id));
        if($updateData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }
    public function deleteMasjid(){
        $masjid_id = $this->input->post('masjid_id');
        $delete = $this->db->delete('masjid', array('id'=>$masjid_id));
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
 
        $data['gallery'] = $this->masjid_model->getRows(); 
        $data['title'] = 'Masjid'; 
        $data['page_title'] = 'All Masjid'; 
         
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
           
        $data['title'] = 'Add masjid'; 
        $data['page_title'] = 'Add masjid';
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
        $imgData = $this->masjid_model->getRows($con);  
         
        $data['dbData'] = $imgData; 
        $data['title'] = 'Edit masjid'; 
        $data['page_title'] = 'Edit masjid'; 
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
            $update = $this->masjid_model->update($data, $id); 
             
            if($update){ 
                $this->session->set_userdata('success_msg', 'masjid has been disable successfully.'); 
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
            $update = $this->masjid_model->update($data, $id); 
             
            if($update){ 
                $this->session->set_userdata('success_msg', 'masjid has been activated successfully.'); 
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
            $imgData = $this->masjid_model->getRows($con); 
             
            // Delete gallery data 
            $delete = $this->masjid_model->delete($id); 
             
            if($delete){ 
                // Remove file from the server  
                if(!empty($imgData['file_name'])){ 
                    @unlink($this->uploadPath.$imgData['file_name']);  
                }  
                 
                $this->session->set_userdata('success_msg', 'masjid has been removed successfully.'); 
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