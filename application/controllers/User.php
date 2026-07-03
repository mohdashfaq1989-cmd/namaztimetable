<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require APPPATH . '../vendor/autoload.php';

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
 
class User extends CI_Controller { 
    
    // private $keyId     = "rzp_test_Spes1IxGygoR9I";
    // private $keySecret = "iBJNdDwPdCsAQ9m0zBVN7Fug";
    
    private $keyId     = "rzp_live_Ss1K0JVNgGiIsI";
    private $keySecret = "S1f2PG6d2EbcLxUpmI5gQ5UO";
     
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
        $this->sessionid = $this->session->userdata('user_id');


    } 
    
    public function masjidList(){ 
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "")  
        {
            return redirect('login/index');
        }
        else{
        $data = array();   
        $data['userData'] = $this->db->get_where('user',array('id'=>$this->sessionid))->row();
        $data['result'] = $this->user_model->getMasjidbyUserId($this->sessionid); 
        $data['title'] = 'Masjid'; 
        $data['page_title'] = 'Masjid List'; 
         
        // Load the list page view 
        $this->load->view('common/header', $data); 
        $this->load->view('common/sidebar', $data);
        $this->load->view($this->controller.'/masjidList', $data); 
        $this->load->view('common/footer'); 
        }
    }
    public function adList(){ 
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "")  
        {
            return redirect('login/index');
        }
        else{
        $data = array();   
        $data['userData'] = $this->db->get_where('user',array('id'=>$this->sessionid))->row();
        $data['result'] = $this->user_model->getAdsbyUserId($this->sessionid);
        $data['title'] = 'Masjid'; 
        $data['page_title'] = 'Masjid List'; 
         
        // Load the list page view 
        
        $this->load->view('common/header', $data); 
        $this->load->view('common/sidebar', $data);
        $this->load->view($this->controller.'/adList', $data); 
        $this->load->view('common/footer'); 
        }
    }
    public function addAd(){
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "") 
        {
            return redirect('login/index');
        }
        else{ 
        $data['userData'] = $this->db->get_where('user',array('id'=>$this->sessionid))->row();
        $data['title'] = 'Add Ad'; 
        $data['page_title'] = 'Add Ad';
        $data['action'] = 'Upload'; 
         
        // Load the add page view 
        $this->load->view('common/header', $data); 
        $this->load->view('common/sidebar', $data);
        $this->load->view($this->controller.'/add-ad', $data); 
        $this->load->view('common/footer');
        }
    }
    public function insertAd(){ 
        
        $formData = array(
            'title'=>$this->input->post('title'),
            'description'=>$this->input->post('description'),
            'masjid_id'=>$this->input->post('masjid_id'),
            'created_by'=>$this->input->post('created_by'),
            'status'=>1,
            'created'=>date("Y-m-d H:i:s")  
            );
        $image = '';
        if(!empty($_FILES['image']['name'])){  
            
            $config['upload_path'] = './uploads/ads/'; 
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
    public function editAd($id){
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "") 
        {
            return redirect('login/index');
        }
        else{   
         
        $data['dbData'] = $this->user_model->getAds($id);
        $data['userData'] = $this->db->get_where('user',array('id'=>$this->sessionid))->row();
        $data['title'] = 'Edit masjid'; 
        $data['page_title'] = 'Edit Ad';
        // Load the add page view 
        $this->load->view('common/header', $data); 
        $this->load->view('common/sidebar', $data);
        $this->load->view($this->controller.'/edit-ad', $data); 
        $this->load->view('common/footer');
        }
    }
    public function updateAd(){ 
        $ad_id = $this->input->post('ad_id');
        $formData = array(
            'title'=>$this->input->post('title'),
            'description'=>$this->input->post('description'),
            'masjid_id'=>$this->input->post('masjid_id'),
            'created_by'=>$this->input->post('created_by'),
            'modified'=>date("Y-m-d H:i:s")  
            );
        if(!empty($_FILES['image']['name'])){  
            
            $config['upload_path'] = './uploads/ads/'; 
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
        $updateData = $this->db->update('ads',$formData,array('id'=>$ad_id));
        if($updateData)
        {
            $response = array('status'=>1);
        }
        else{
            $response = array('status'=>0); 
        }
        echo json_encode ($response);
         
    }
    public function addMasjid(){
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "") 
        {
            return redirect('login/index');
        }
        else{ 
        $data['userData'] = $this->db->get_where('user',array('id'=>$this->sessionid))->row();
        $data['title'] = 'Add masjid'; 
        $data['page_title'] = 'Add masjid';
        $data['action'] = 'Upload'; 
         
        // Load the add page view 
        $this->load->view('common/header', $data); 
        $this->load->view('common/sidebar', $data);
        $this->load->view($this->controller.'/add-masjid', $data); 
        $this->load->view('common/footer');
        }
    }
    public function create_order()
    {
        $api = new Api($this->keyId, $this->keySecret);

        $orderData = array(
            'receipt' => 'receipt_'.time(),
            'amount'  => 200 * 100,
            'currency'=> 'INR',
            'payment_capture' => 1
        );

        $order = $api->order->create($orderData);

        echo json_encode(array(
            'status'   => true,
            'key'      => $this->keyId,
            'amount'   => 200 * 100,
            'order_id' => $order['id']
        ));
    }
    
    public function verify_payment()
    {
        $api = new Api($this->keyId, $this->keySecret);

        $attributes = array(
            'razorpay_order_id'   => $this->input->post('razorpay_order_id'),
            'razorpay_payment_id' => $this->input->post('razorpay_payment_id'),
            'razorpay_signature'  => $this->input->post('razorpay_signature')
        );

        try {

            $api->utility->verifyPaymentSignature($attributes);

        $rto_id = $this->input->post('rto_id');
        $rto_name = $this->db->get_where('rto',array('rto_id'=>$rto_id))->row('rto_name');
        $this->db->select('id');
        $this->db->from('masjid');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
    
            $row  = $query->row();
            $next = $row->id + 1;
        
        } else {
        
            $next = 1;
        }
        $group = floor(($next - 1) / 100);
        $alphabet = chr(65 + $group);
        $seq_no = $alphabet . str_pad($next, 3, '0', STR_PAD_LEFT);
        
        
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
            'masjidCode'=>$rto_name.$seq_no,
            'name'=>$this->input->post('name'),
            'imam'=>$this->input->post('imam'),
            'mutwalli'=>$this->input->post('mutwalli'),
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
            'created_by'=>$this->input->post('created_by'),
            'status'=>1,
            'image' => $image,
            'razorpay_payment_id' => $this->input->post('razorpay_payment_id'),
            'amount' => 200,
            'created'=>date("Y-m-d H:i:s")  
            );
            
           
 
            
            $masjid_id = $this->user_model->insert_masjid($formData);

            $paymentData = array(
                'masjid_id' => $masjid_id,
                'razorpay_order_id' => $this->input->post('razorpay_order_id'),
                'razorpay_payment_id' => $this->input->post('razorpay_payment_id'),
                'razorpay_signature' => $this->input->post('razorpay_signature'),
                'amount' => 200,
                'payment_status' => 'success'
            );

            $this->user_model->insert_payment($paymentData);

            echo json_encode(array(
                'status' => true,
                'message' => 'Payment Verified Successfully'
            ));

        } catch(SignatureVerificationError $e){

            echo json_encode(array(
                'status' => false,
                'message' => 'Payment Verification Failed'
            ));
        }
    }
    
    public function editMasjid($id){
        if ($this->session->userdata('user_email') == "" && $this->session->userdata('user_password') == "") 
        {
            return redirect('login/index');
        }
        else{ 
           
        $data = $imgData = array();  
        $con = array('id' => $id); 
        $imgData = $this->user_model->getMasjid($con);  
         
        $data['dbData'] = $imgData; 
        $data['userData'] = $this->db->get_where('user',array('id'=>$this->sessionid))->row();
        $data['title'] = 'Edit masjid'; 
        $data['page_title'] = 'Edit masjid';
        // Load the add page view 
        $this->load->view('common/header', $data); 
        $this->load->view('common/sidebar', $data);
        $this->load->view($this->controller.'/edit-masjid', $data); 
        $this->load->view('common/footer');
        }
    }
    public function updateMasjid(){ 
        $masjid_id = $this->input->post('masjid_id');
        $image = $this->input->post('image');
        $error = ''; 
        $formData = array(
            'name'=>$this->input->post('name'),
            'imam'=>$this->input->post('imam'),
            'mutwalli'=>$this->input->post('mutwalli'),
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
            'status'=>1, 
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
    public function file_check($str){ 
        if(empty($_FILES['image']['name'])){ 
            $this->form_validation->set_message('file_check', 'Select an image file to upload.'); 
            return FALSE; 
        }else{ 
            return TRUE; 
        } 
    } 
}