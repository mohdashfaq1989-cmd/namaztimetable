<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() { 
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('home_model'); 
        $this->controller = 'home'; 
    }
    
    public function index(){ 
        $data = array();  
        $data['page_title'] ='Home Page';     
        $this->load->view('common/header', $data);
        $this->load->view('front/home', $data); 
        $this->load->view('common/footer', $data); 
    }
    public function about(){ 
        $data = array();  
        $data['page_title'] ='About Page';   
        $this->load->view('common/header', $data);
        $this->load->view('front/about', $data); 
        $this->load->view('common/footer', $data); 
    }
    public function gallery()
    {
        $config['base_url'] = base_url('home/gallery');
        $config['total_rows'] = $this->home_model->getGalleryCount();
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;
    
        // Pagination Design
        $config['full_tag_open'] = '<nav><ul class="custom-pagination">';
        $config['full_tag_close'] = '</ul></nav>';
    
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
    
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
    
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
    
        $config['prev_link'] = '&lsaquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
    
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
    
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
    
        $config['attributes'] = array('class' => 'page-link');
    
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        $data['page_title'] = 'Photo Gallery';
    
        $data['result'] = $this->home_model->getGallery(
            null,
            $config['per_page'],
            $page
        );
    
        $data['links'] = $this->pagination->create_links();
    
        $this->load->view('common/header', $data);
        $this->load->view('front/gallery', $data);
        $this->load->view('common/footer', $data);
    }
    public function blog(){ 
        $config['base_url'] = base_url('home/blog');
        $config['total_rows'] = $this->home_model->getBlogCount();
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<nav><ul class="custom-pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&lsaquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['result'] = $this->home_model->getBlog(
            null,
            $config['per_page'],
            $page
        );
        
        $data['links'] = $this->pagination->create_links();
   
        $data['page_title'] ='Blog Post';   
        $this->load->view('common/header', $data);
        $this->load->view('front/blog', $data); 
        $this->load->view('common/footer', $data); 
    }
    
    public function search()
    {
        $keyword = $this->input->get('q');
        $data = $this->home_model->search($keyword);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public function masjid(){  
        $config['base_url'] = base_url('home/masjid');
        $config['total_rows'] = $this->home_model->getMasjidCount();
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<nav><ul class="custom-pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&lsaquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data['result'] = $this->home_model->getMasjid(
            null,
            $config['per_page'],
            $page
        );
        
        $data['links'] = $this->pagination->create_links();  
       
        $data['page_title'] ='masjid Page';   
        $this->load->view('common/header', $data);
        $this->load->view('front/masjid', $data); 
        $this->load->view('common/footer', $data); 
    }
    public function faq(){ 
        $data = array();  
        $data['page_title'] ='Faq Page';  
        $this->load->view('common/header', $data);
        $this->load->view('front/faq', $data); 
        $this->load->view('common/footer', $data); 
    }
    public function contact(){ 
        $data = array();  
        $data['page_title'] ='Contact Page';  
        $this->load->view('common/header', $data);
        $this->load->view('front/contact', $data); 
        $this->load->view('common/footer', $data); 
    }
    
    public function masjidView($id)
    {
        $data = array(); 
        $data['masjidData'] = $this->home_model->getMasjid($id);
        $data['adData'] = $this->home_model->getAds($id);
        $data['page_title'] ='Masjid View'; 
        $this->load->view('common/header', $data);
        $this->load->view('front/masjid-detail', $data); 
        $this->load->view('common/footer', $data);
    }
    public function blogView($id)
    {
        $data = array(); 
        $data['blogData'] = $this->home_model->getblog($id);
        $data['page_title'] ='Blog View'; 
        $this->load->view('common/header', $data);
        $this->load->view('front/blog-detail', $data); 
        $this->load->view('common/footer', $data);
    }

    
    
 
	
}
