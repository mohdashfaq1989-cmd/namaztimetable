<?php
class Login_model extends CI_Model
{
    function __construct() { 
        $this->table = 'user'; 
    }

    public function Login($email,$password)
    {
        $check_user = $this->db->get_where('user',['email'=>$email,'password'=>$password]);
        if ($check_user->num_rows()>0) {
            return true;
        }
        else{
            return false;
        }
    }
    public function getRows($params = array()){ 
        $this->db->select('*'); 
        $this->db->from($this->table); 
         
        if(array_key_exists("where", $params)){ 
            foreach($params['where'] as $key => $val){ 
                $this->db->where($key, $val); 
            } 
        } 
         
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }else{ 
            if(array_key_exists("id", $params)){ 
                $this->db->where('id', $params['id']); 
                $query = $this->db->get(); 
                $result = $query->row_array(); 
            }else{ 
                $this->db->order_by('created', 'desc');  
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                 
                $query = $this->db->get(); 
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
            } 
        } 
         
        // Return fetched data 
        return $result; 
    }
    public function update($data, $id) { 
        if(!empty($data) && !empty($id)){ 
            // Add modified date if not included 
            if(!array_key_exists("modified", $data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
             
            // Update member data 
            $update = $this->db->update($this->table, $data, array('id' => $id));
             
            // Return the status 
            return $update?true:false; 
        } 
        return false; 
    }
    
     
    public function change_password($id,$new_pass)
    { 
        $update_pass=$this->db->query("UPDATE pr_admin set password='$new_pass'  where id='$id'");
    }
    public function email_exists($email)
    {
            $this->db->select('email');
            $this->db->from('user'); 
            $this->db->where('email', $email); 
            $query=$this->db->get();
            $row = $query->row();
            if ($query->num_rows()>0 ) {
                return true ;
            }else{
                return false;
            }
    }
    public function update_password($email)
    {
            $email = $this->input->post('email');
            $password =$this->input->post('password');
            $sql="update user set password ='{$password}' where email = '{$email}' ";
            $result = $this->db->query($sql);
            if ($result) {
                echo 1;
            }else{
                echo 0;
            }

    }
    public function verify_reset_password_code($email,$password)
    {
            $this->db->select('name','email');
            $this->db->from('user'); 
            $this->db->where('email', $email); 
            $query=$this->db->get();
            $row = $query->row();
            if ($query->num_rows()===1 ) {
                return true;
            }else{
                return false;
            }
    }
    
    public function createAccount()
    {
        $cname=$this->input->post('company_name');
        $email=$this->input->post('email');
        $pword=$this->input->post('password');
        $mob=$this->input->post('mobile_no');
        $pcode=$this->input->post('pincode');
        $pno=$this->input->post('panno');
        $gno=$this->input->post('gstno');

        $formData = array(
            'cname' => $cname, 
            'email' => $email, 
            'password' => $pword, 
            'mobile_no' => $mob, 
            'pincode' => $pcode, 
            'panno' => $pno, 
            'gstno' => $gno ,
            'created' => date('Y-m-d'), 
            'month' => date('m'), 
            'year' => date('Y')
        );
        $insert_seller = $this->db->insert('seller',$formData);
        if ($insert_seller) {
            return true;
        }
        else{
            return false;
        }

    }

    function profile_fetch($user_id){
        $query = $this->db->get_where('user',array('id'=>$user_id));
        return $query->row_array();
    }

    function fetch_state($country_id){
        $this->db->where('country_id', $country_id);
        $this->db->order_by('state_name', 'ASC');
        $query = $this->db->get('states');
        $output = '<option value="">Select State</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
        }        
        return $output;
    }
    function fetch_city($state_id){
        $this->db->where('state_id', $state_id);
        $this->db->order_by('city_name', 'ASC');
        $query = $this->db->get('cities');
        $output = '<option value="">Select District</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
        }        
        return $output;
    }
    function fetch_tehsil($city_id){
        $this->db->where('city_id', $city_id);
        $this->db->order_by('tehsil_name', 'ASC');
        $query = $this->db->get('tehsil');
        $output = '<option value="">Select Tehsil</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->tehsil_id.'">'.$row->tehsil_name.'</option>';
        }        
        return $output;
    }
    function fetch_rto($city_id){
        $this->db->where('city_id', $city_id);
        $this->db->order_by('rto_name', 'ASC');
        $query = $this->db->get('rto');
        $output = '<option value="">Select RTO</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->rto_id.'">'.$row->rto_name.'</option>';
        }        
        return $output;
    }



    function fetch_single_details($order_id)
	{
		 
		$ordersData = $this->db->get_where('orders',array('id'=> $order_id))->row();
		$paid_amount = $ordersData->paid_amount/100;
		$item_price = $ordersData->item_price/100;
		$adminsData = $this->db->get_where('user')->row();
		$appName1 = ($ordersData->service_id==1)?'Permanent swimming pool':'';
		$appName2 = ($ordersData->service_id==2)?'Permanent spa':'';
		$appName3 = ($ordersData->service_id==3)?'Relocable Pool':'';
		$appName4 = ($ordersData->service_id==4)?'Relocable Spa':'';
		$userData = $this->db->get_where('users',array('id'=>$ordersData->user_id))->row();
		$output = '';
		$output = '
		            <div class="dashboard-content">
                        <div class="view-invoice">
                            <div class="company-logo-details">
                                <div style="width:70%; float:left">
                                    <img src="assets/images/invoice/logo.png" height="48px" alt="invoice icon">
                                    <br><br>
                                    <p style="margin: 0;">Website: Poolregistration.com.au</p>
                                    <p style="margin: 0;">Email: <a href="mailto:admin@poolregistration.com.au"
                                            style="text-decoration: none;">'.$adminsData->email.'</a></p>
                                    <p style="margin: 0;">ABN: '.$adminsData->abn_no.'</p>
                                </div>
                                <div style="width:30%; float:right">
                                    <h2 style="font-size: 36px; margin: 0; text-align: right;">Invoice</h2>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                            <br><br>
                    
                            <div class="customer_details_invoice_details">
                                <div style="width:40%; float:left">
                                    <h4 style="font-size: 24px; margin: 0 0 10px;">'.$userData->first_name.' '.$userData->last_name.'</h4>
                                    <p style="margin: 0;"><strong>Address: </strong>'.$userData->postal_address.'</p>
                                    <p style="margin: 0;"><strong>Email ID: </strong>'.$userData->email.'</p>
                                    <p style="margin: 0;"><strong>Contact No: </strong>'.$userData->phone.'</p>
                                </div>
                                <div style="width:40%; float:right">
                                    <table width="100%" style="border-collapse: collapse;">
                                        <tbody>
                                            <tr>
                                                <td><strong>INVOICE NO :</strong></td>
                                                <td style="text-align: right;">'.$adminsData->invoice_prefix.'-'.$ordersData->id.'</td>
                                            </tr>
                                            <tr>
                                                <td><strong>INVOICE DATE :</strong></td>
                                                <td style="text-align: right;">'.date('d M Y', strtotime(str_replace('.', '/',
                                                    $ordersData->created))).'</td>
                                            </tr>
                                            <tr>
                                                <td style="height: 20px;"></td>
                                            </tr>
                                            <tr style="background: #f5f5f5; border: 1px solid #ddd;">
                                                <td style="padding: 10px;">
                                                    <h4 style="font-size: 24px; margin: 0;">Total Paid:</h4>
                                                </td>
                                                <td style="padding: 10px;">
                                                    <h4 style="text-align: right; font-size: 24px; margin: 0; color: #19692c; ">
                                                        $'.$paid_amount.' AUD</h4>
                                                </td>
                                            </tr>
                                            /tbody>
                                    </table>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                            <br><br>
                    
                            <div class="price-details">
                                <table style="background: #f5f5f5; border-collapse: collapse;" width="100%">
                                    <thead style="background: #1e2a4b;">
                                        <tr>
                                            <th style="padding: 8px 6px; color: #fff; vertical-align: top; ">QTY</th>
                                            <th style="padding: 8px 6px; color: #fff; vertical-align: top; " width="70%">DESCRIPTION</th>
                                            <th style="padding: 8px 6px; color: #fff; vertical-align: top; ">PRICE</th>
                                            <th style="padding: 8px 6px; color: #fff; vertical-align: top; ">SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding: 6px; vertical-align: top; " class="text-center"><strong>1</strong></td>
                                            <td style="padding: 6px; vertical-align: top; ">Registration of
                                                '.$appName1.$appName2.$appName3.$appName4.' at '.$userData->postal_address.'</td>
                    
                                            <td style="padding: 6px; vertical-align: top; ">$'.$item_price.'</td>
                                            <td style="padding: 6px; vertical-align: top; ">$'.$item_price.'</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 6px; vertical-align: top; " colspan="3">GST</td>
                                            <td style="padding: 6px; vertical-align: top; "><strong>$'.$ordersData->Tax.'</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 6px; vertical-align: top; " colspan="3">Total</td>
                                            <td style="padding: 6px; vertical-align: top; "><strong>$'.$paid_amount.'</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px 10px; text-align: right;" colspan="4">
                                                <h4 style="text-align: right; font-size: 24px; margin: 0; ">Total Paid: <span
                                                        style="color: #19692c; ">$'.$paid_amount.' AUD</span></h4>
                                            </td>
                                        </tr>
                    
                                    </tbody>
                                </table>
                            </div>
                    
                        </div>
                    </div>';
	
		return $output;
	}
	
    
}

 ?>