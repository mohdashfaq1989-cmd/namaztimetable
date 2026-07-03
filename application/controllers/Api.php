<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('api_model');
        $this->load->model('home_model');
        $this->load->model('masjid_model');
    }
    
    
    public function userRole()
    {
        $query = $this->db->get('user_role');
        $data = $query->result();

        header('Content-Type: application/json');
        echo json_encode([
            'status' => true,
            'result'   => $data
        ]);
    }
    public function userDashboard($user_id=null)
    {
        $masjidCount = $this->db->where('created_by',$user_id)->count_all_results('masjid');
        $adCount = $this->db->where('created_by',$user_id)->count_all_results('ads');
        $data = array(
            "total_masjid"=>$masjidCount,
            "total_ads"=>$adCount,
            );

        header('Content-Type: application/json');
        echo json_encode([
            'status' => true,
            'result'   => $data
        ]);
    }
    
    // REGISTER API
    public function register()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if(empty($input['role_id']) || empty($input['name']) || empty($input['email']) || empty($input['phone']) || empty($input['password']))
        {
            echo json_encode([
                'status' => false,
                'message' => 'All fields are required'
            ]);
            return;
        }

        $check = $this->api_model->getUserByEmail($input['email']);

        if($check)
        {
            echo json_encode([
                'status' => false,
                'message' => 'Email already exists'
            ]);
            return;
        }
        
        $data = [
            'role_id'=>$input['role_id'],
            'name'=>$input['name'],
            'email'=>$input['email'],
            'password'=>$input['password'],
            'phone'=>$input['phone'],
            'created'=>date("Y-m-d H:i:s") 
        ];

        $this->Api_model->register($data);

        echo json_encode([
            'status' => true,
            'message' => 'Registration successful'
        ]);
    }
    
    // LOGIN API
    public function login()
    {
        $input = json_decode(file_get_contents("php://input"), true);
        $password = $input['password'];
        $user = $this->api_model->getUserByEmail($input['email']);

        if(!$user)
        {
            echo json_encode([
                'status' => false,
                'message' => 'User not exist'
            ]);
            return;
        }

        if($user && $user->password == $password)
        {
            echo json_encode([
                'status' => true,
                'message' => 'Login successful',
                'userData' => [
                    'id'    => $user->id,
                    'role_name'=>$user->role_name,
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'password'=>$user->password,
                    'phone'=>$user->phone,
                    'created'=>$user->created
                ]
            ]);
        }
        else
        {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid password'
            ]);
        }
    }
    public function updateProfile()
    {
        $input = json_decode(file_get_contents('php://input'), true);
    
        $user_id = $input['user_id'];
    
        $data = [
            'name'   => $input['name'],
            'phone' => $input['phone'],
            'email'  => $input['email'],
            'email'  => $input['password']
        ];
    
        $this->db->where('id', $user_id);
        $update = $this->db->update('user', $data);
    
        if ($update) {
            echo json_encode([
                'status' => true,
                'message' => 'Profile Updated Successfully'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Update Failed'
            ]);
        }
    }
    
    public function masjidList()
    {
        header('Content-Type: application/json');

        $page  = (int) $this->input->get('page');
        $limit = (int) $this->input->get('limit');

        if ($page <= 0) {
            $page = 1;
        }

        if ($limit <= 0) {
            $limit = 6;
        }

        $offset = ($page - 1) * $limit;

        $result = $this->home_model->getMasjid(null, $limit, $offset);

        // Full Image URL
        foreach ($result as &$row) {
            $row['image'] = !empty($row['image'])
                ? base_url('uploads/masjid/' . $row['image'])
                : '';
        }

        $total = $this->home_model->getMasjidCount();

        $response = array(
            'status'        => true,
            'message'       => 'Masjid List',
            'page'          => $page,
            'limit'         => $limit,
            'total_records' => $total,
            'total_pages'   => ceil($total / $limit),
            'data'          => $result
        );

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    
    public function masjidView($id = null)
    {
        header('Content-Type: application/json');
    
        if (empty($id)) {
            echo json_encode([
                'status'  => false,
                'message' => 'Masjid ID is required.'
            ]);
            return;
        }
    
        $result = $this->home_model->getMasjid($id);
    
        if (!empty($result)) {
    
            if (!empty($result->image)) {
                $result->image = base_url('uploads/masjid/' . $result->image);
            } else {
                $result->image = "";
            }
    
            echo json_encode([
                'status'  => true,
                'message' => 'Masjid Details',
                'data'    => $result
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
        } else {
    
            echo json_encode([
                'status'  => false,
                'message' => 'Masjid not found.'
            ]);
        }
    }
    public function blogList()
    {
        header('Content-Type: application/json');
    
        $page  = (int) $this->input->get('page');
        $limit = (int) $this->input->get('limit');
    
        if ($page <= 0) {
            $page = 1;
        }
    
        if ($limit <= 0) {
            $limit = 6;
        }
    
        $offset = ($page - 1) * $limit;
    
        $result = $this->home_model->getBlog(null, $limit, $offset);
    
        // Full Image URL (if image field exists)
        foreach ($result as &$row) {
            if (!empty($row['image'])) {
                $row['image'] = base_url('uploads/blog/' . $row['image']);
            } else {
                $row['image'] = "";
            }
        }
    
        $total = $this->home_model->getBlogCount();
    
        $response = array(
            'status'        => true,
            'message'       => 'Blog List',
            'page'          => $page,
            'limit'         => $limit,
            'total_records' => $total,
            'total_pages'   => ceil($total / $limit),
            'data'          => $result
        );
    
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    public function blogView($id = null)
    {
        header('Content-Type: application/json');
    
        if (empty($id)) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Blog ID is required.'
            ));
            return;
        }
    
        $result = $this->home_model->getBlog($id);
    
        if ($result) {
    
            if (!empty($result->image)) {
                $result->image = base_url('uploads/blog/' . $result->image);
            } else {
                $result->image = "";
            }
    
            echo json_encode(array(
                'status' => true,
                'message' => 'Blog Details',
                'data' => $result
            ), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
        } else {
    
            echo json_encode(array(
                'status' => false,
                'message' => 'Blog not found.'
            ));
        }
    }
    public function galleryList()
    {
        header('Content-Type: application/json');
    
        $page  = (int)$this->input->get('page');
        $limit = (int)$this->input->get('limit');
    
        if ($page <= 0) {
            $page = 1;
        }
    
        if ($limit <= 0) {
            $limit = 12;
        }
    
        $offset = ($page - 1) * $limit;
    
        $result = $this->home_model->getGallery(null, $limit, $offset);
    
        foreach ($result as &$row) {
            $row['image'] = !empty($row['image'])
                ? base_url('uploads/gallery/' . $row['image'])
                : '';
        }
    
        $total = $this->home_model->getGalleryCount();
    
        echo json_encode([
            'status' => true,
            'message' => 'Gallery List',
            'page' => $page,
            'limit' => $limit,
            'total_records' => $total,
            'total_pages' => ceil($total / $limit),
            'data' => $result
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    public function galleryView($id = null)
    {
        header('Content-Type: application/json');
    
        if (empty($id)) {
            echo json_encode([
                'status' => false,
                'message' => 'Gallery ID is required.'
            ]);
            return;
        }
    
        $result = $this->home_model->getGallery($id);
    
        if ($result) {
    
            $result->image = !empty($result->image)
                ? base_url('uploads/gallery/' . $result->image)
                : '';
    
            echo json_encode([
                'status' => true,
                'message' => 'Gallery Details',
                'data' => $result
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
        } else {
    
            echo json_encode([
                'status' => false,
                'message' => 'Gallery not found.'
            ]);
        }
    }
    public function searchMasjid()
    {
        header('Content-Type: application/json');
    
        $keyword = trim($this->input->get('keyword'));
        $lat      = $this->input->get('lat');
        $lng      = $this->input->get('lng');
        $radius   = $this->input->get('radius');
    
        $result = $this->masjid_model->search(
            $keyword,
            $lat,
            $lng,
            $radius
        );
    
        if (!empty($result)) {
    
            foreach ($result as &$row) {
    
                $row->image = !empty($row->image)
                    ? base_url('uploads/masjid/' . $row->image)
                    : '';
    
                // Format distance (if available)
                if (isset($row->distance)) {
                    $row->distance = round($row->distance, 2);
                }
            }
    
            echo json_encode([
                'status' => true,
                'message' => 'Masjid Found',
                'total' => count($result),
                'data' => $result
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
        } else {
    
            echo json_encode([
                'status' => false,
                'message' => 'No Masjid Found',
                'total' => 0,
                'data' => []
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }
    
    public function getMasjidByUser()
    {
        header('Content-Type: application/json');
    
        $user_id = (int)$this->input->get('user_id');
        $page    = (int)$this->input->get('page');
        $limit   = (int)$this->input->get('limit');
    
        if ($user_id <= 0) {
            echo json_encode([
                'status' => false,
                'message' => 'User ID is required.'
            ]);
            return;
        }
    
        if ($page <= 0) {
            $page = 1;
        }
    
        if ($limit <= 0) {
            $limit = 6;
        }
    
        $offset = ($page - 1) * $limit;
    
        $result = $this->api_model->getMasjidByUser($user_id, $limit, $offset);
    
        foreach ($result as &$row) {
            $row['image'] = !empty($row['image'])
                ? base_url('uploads/masjid/' . $row['image'])
                : '';
        }
    
        $total = $this->api_model->getMasjidCountByUser($user_id);
    
        echo json_encode([
            'status' => true,
            'message' => 'User Masjid List',
            'page' => $page,
            'limit' => $limit,
            'total_records' => $total,
            'total_pages' => ceil($total / $limit),
            'data' => $result
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    
    public function adsByUser()
    {
        header('Content-Type: application/json');
    
        $user_id = $this->input->get('user_id');
    
        if (empty($user_id)) {
            echo json_encode([
                'status' => false,
                'message' => 'User ID is required.'
            ]);
            return;
        }
    
        $result = $this->api_model->getAdsByUser($user_id);
    
        if (!empty($result)) {
    
            foreach ($result as &$row) {
                $row['image'] = !empty($row['image'])
                    ? base_url('uploads/ads/' . $row['image'])
                    : '';
            }
    
            echo json_encode([
                'status' => true,
                'message' => 'Ads List',
                'data' => $result
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
        } else {
    
            echo json_encode([
                'status' => false,
                'message' => 'No Ads Found.',
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }
    
    public function adView($id = null)
    {
        header('Content-Type: application/json');
    
        if (empty($id)) {
            echo json_encode([
                'status' => false,
                'message' => 'Ad ID is required.'
            ]);
            return;
        }
    
        $result = $this->api_model->getAd($id);
    
        if ($result) {
    
            $result->image = !empty($result->image)
                ? base_url('uploads/ads/' . $result->image)
                : '';
    
            echo json_encode([
                'status' => true,
                'data' => $result
            ]);
    
        } else {
    
            echo json_encode([
                'status' => false,
                'message' => 'Ad not found.'
            ]);
        }
    }
    public function updateAd()
    {
        $id = $this->input->post('id');
    
        if (empty($id)) {
            echo json_encode([
                'status' => false,
                'message' => 'Ad ID is required.'
            ]);
            return;
        }
    
        $formData = array(
            'title'       => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'masjid_id'   => $this->input->post('masjid_id')
        );
    
        if (!empty($_FILES['image']['name'])) {
    
            $config['upload_path']   = './uploads/ads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
    
            $this->load->library('upload');
            $this->upload->initialize($config);
    
            if ($this->upload->do_upload('image')) {
    
                $uploadData = $this->upload->data();
    
                $formData['image'] = $uploadData['file_name'];
    
            } else {
    
                echo json_encode([
                    'status' => false,
                    'message' => strip_tags($this->upload->display_errors())
                ]);
                return;
            }
        }
    
        $this->db->where('id', $id);
    
        if ($this->db->update('ads', $formData)) {
    
            echo json_encode([
                'status' => true,
                'message' => 'Advertisement updated successfully.'
            ]);
    
        } else {
    
            echo json_encode([
                'status' => false,
                'message' => 'Update failed.'
            ]);
        }
    }
    
    public function insertAdByUser()
    {
        header('Content-Type: application/json');
    
        $formData = array(
            'title'       => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'masjid_id'   => $this->input->post('masjid_id'),
            'created_by'  => $this->input->post('created_by'),
            'status'      => 1,
            'created'     => date("Y-m-d H:i:s")
        );
    
        if (empty($formData['created_by'])) {
    
            echo json_encode([
                'status' => false,
                'message' => 'User ID is required.'
            ]);
            return;
        }
    
    
        // Image Upload
        if (!empty($_FILES['image']['name'])) {
    
            $config['upload_path']   = './uploads/ads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
    
            $this->load->library('upload');
            $this->upload->initialize($config);
    
    
            if ($this->upload->do_upload('image')) {
    
                $uploadData = $this->upload->data();
    
                $formData['image'] = $uploadData['file_name'];
    
            } else {
    
                echo json_encode([
                    'status' => false,
                    'message' => strip_tags($this->upload->display_errors())
                ]);
                return;
            }
    
        }
    
    
        $insert = $this->db->insert('ads', $formData);
    
    
        if ($insert) {
    
            echo json_encode([
                'status' => true,
                'message' => 'Ad created successfully.',
                'id' => $this->db->insert_id()
            ]);
    
        } else {
    
            echo json_encode([
                'status' => false,
                'message' => 'Failed to create ad.'
            ]);
        }
    }
    
    public function createOrder()
    {
        header('Content-Type: application/json');
    
        $api = new Api($this->keyId, $this->keySecret);
    
        $amount = 200;
    
        $orderData = array(
            'receipt' => 'receipt_' . time(),
            'amount' => $amount * 100,
            'currency' => 'INR',
            'payment_capture' => 1
        );
    
        try {
    
            $order = $api->order->create($orderData);
    
            echo json_encode([
                'status' => true,
                'message' => 'Order Created',
                'key' => $this->keyId,
                'amount' => $amount * 100,
                'order_id' => $order['id']
            ]);
    
        } catch(Exception $e){
    
            echo json_encode([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function verifyPayment()
    {
        header('Content-Type: application/json');
    
        $api = new Api($this->keyId, $this->keySecret);
    
        $attributes = array(
            'razorpay_order_id' => $this->input->post('razorpay_order_id'),
            'razorpay_payment_id' => $this->input->post('razorpay_payment_id'),
            'razorpay_signature' => $this->input->post('razorpay_signature')
        );
    
    
        try {
    
            // Verify Razorpay Payment
            $api->utility->verifyPaymentSignature($attributes);
    
    
            // Generate Masjid Code
    
            $rto_id = $this->input->post('rto_id');
    
            $rto_name = $this->db
                ->get_where('rto', [
                    'rto_id' => $rto_id
                ])
                ->row('rto_name');
    
    
            $this->db->select('id');
            $this->db->from('masjid');
            $this->db->order_by('id','DESC');
            $this->db->limit(1);
    
            $query = $this->db->get();
    
    
            if($query->num_rows() > 0){
    
                $next = $query->row()->id + 1;
    
            }else{
    
                $next = 1;
            }
    
    
            $group = floor(($next-1)/100);
    
            $alphabet = chr(65+$group);
    
            $seq_no = $alphabet . str_pad(
                $next,
                3,
                '0',
                STR_PAD_LEFT
            );
    
    
            // Image Upload
    
            $image = '';
    
            if(!empty($_FILES['image']['name'])){
    
    
                $config['upload_path'] = './uploads/masjid/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
    
    
                $this->load->library('upload',$config);
    
    
                if($this->upload->do_upload('image')){
    
                    $image = $this->upload->data('file_name');
    
                }else{
    
                    echo json_encode([
                        'status'=>false,
                        'message'=>strip_tags(
                            $this->upload->display_errors()
                        )
                    ]);
                    return;
                }
            }
    
    
            // Masjid Data
    
            $masjidData = array(
    
                'masjidCode' => $rto_name.$seq_no,
    
                'name'=>$this->input->post('name'),
                'imam'=>$this->input->post('imam'),
                'mutwalli'=>$this->input->post('mutwalli'),
    
                'ward_village'=>$this->input->post('ward_village'),
    
                'lng'=>$this->input->post('lng'),
                'lat'=>$this->input->post('lat'),
    
                'rto_id'=>$rto_id,
    
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
    
                'image'=>$image,
    
                'razorpay_payment_id'=>
                    $this->input->post('razorpay_payment_id'),
    
                'amount'=>200,
    
                'status'=>1,
    
                'created'=>date('Y-m-d H:i:s')
            );
    
    
            $masjid_id = $this->user_model
                ->insert_masjid($masjidData);
    
    
    
            // Payment Data
    
            $paymentData=array(
    
                'masjid_id'=>$masjid_id,
    
                'razorpay_order_id'=>
                    $this->input->post('razorpay_order_id'),
    
                'razorpay_payment_id'=>
                    $this->input->post('razorpay_payment_id'),
    
                'razorpay_signature'=>
                    $this->input->post('razorpay_signature'),
    
                'amount'=>200,
    
                'payment_status'=>'success',
    
                'created'=>date('Y-m-d H:i:s')
            );
    
    
            $this->user_model
                ->insert_payment($paymentData);
    
    
    
            echo json_encode([
                'status'=>true,
                'message'=>'Payment Verified & Masjid Added Successfully',
                'masjid_id'=>$masjid_id
            ]);
    
    
        } catch(SignatureVerificationError $e){
    
    
            echo json_encode([
                'status'=>false,
                'message'=>'Payment Verification Failed'
            ]);
    
        }
    }
    
    
}