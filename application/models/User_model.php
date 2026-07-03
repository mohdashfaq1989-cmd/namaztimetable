<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class User_model extends CI_Model{ 
     
    function __construct() { 
        $this->table = 'user'; 
    } 
     
    /* 
     * Returns rows from the database based on the conditions 
     * @param array filter data based on the passed parameters 
     */ 
     
    public function insert_masjid($data)
    {
        $this->db->insert('masjid', $data);
        return $this->db->insert_id();
    }

    public function insert_payment($data)
    {
        return $this->db->insert('payments', $data);
    }

    public function get_masjid()
    {
        $this->db->select('masjid.*, payments.payment_status');
        $this->db->from('masjid');
        $this->db->join('payments', 'payments.masjid_id = masjid.id', 'left');
        $this->db->order_by('masjid.id', 'DESC');

        return $this->db->get()->result_array();
    }
    public function getAds($id)
    {
        $this->db->where('id', $id);
            return $this->db
            ->get('ads') 
            ->row();
    }
    
    public function getAdsbyUserId($id=null)
    {
        
        $this->db->select('
            ads.id,
            ads.title,
            ads.description,
            ads.image,
            ads.created,
            ads.status,
            user.name as userName,
            masjid.name as masjidName
        ');
        $this->db->join(
            'user',
            'user.id = ads.created_by',
            'left'
        );
        $this->db->join(
            'masjid',
            'masjid.id = ads.masjid_id',
            'left'
        );
        if($id==true){
            $this->db->where('ads.created_by',$id);
            return $this->db
            ->get('ads') 
            ->result_array();
        }
        return $this->db
            ->get('ads') 
            ->result_array();
        
        

    }
    public function getMasjidbyUserId($id=null)
    {
        
        $this->db->select('*,
            masjid.id,
            masjid.name,
            countries.country_name as country,
            cities.city_name as city,
            states.state_name as state,
            rto.rto_name as rto,
            tehsil.tehsil_name as tehsil,
            user.name as userName,
            masjid.address,
            masjid.image
        ');
        
        $this->db->join(
            'countries',
            'countries.country_id = masjid.country_id',
            'left'
        );
        $this->db->join(
            'cities',
            'cities.city_id = masjid.city_id',
            'left'
        );
        $this->db->join(
            'states',
            'states.state_id = masjid.state_id',
            'left'
        );
        $this->db->join(
            'rto',
            'rto.rto_id = masjid.rto_id',
            'left'
        );
        $this->db->join(
            'tehsil',
            'tehsil.tehsil_id = masjid.tehsil_id',
            'left'
        );
        $this->db->join(
            'user',
            'user.id = masjid.created_by',
            'left'
        );
        if($id==true){
            $this->db->where('masjid.created_by',$id);
            return $this->db
            ->get('masjid') 
            ->result_array();
        }
        return $this->db
            ->get('masjid') 
            ->result_array();
        
        

    }
    
    public function getMasjid($params = array()){ 
        $this->db->select('*'); 
        $this->db->from('masjid'); 
         
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
                 
                $query = $this->db->order_by('name', 'ASC')->get(); 
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
            } 
        } 
         
        // Return fetched data 
        return $result; 
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
                 
                $query = $this->db->order_by('name', 'ASC')->get(); 
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
            } 
        } 
         
        // Return fetched data 
        return $result; 
    } 
     
    /* 
     * Insert image data into the database 
     * @param $data data to be insert based on the passed parameters 
     */ 
    public function insert($data = array()) { 
        if(!empty($data)){ 
            // Add created and modified date if not included 
            if(!array_key_exists("created", $data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            } 
            if(!array_key_exists("modified", $data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
             
            // Insert member data 
            $insert = $this->db->insert($this->table, $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    } 
     
    /* 
     * Update image data into the database 
     * @param $data array to be update based on the passed parameters 
     * @param $id num filter data 
     */ 
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
     
    /* 
     * Delete image data from the database 
     * @param num filter data based on the passed parameter 
     */ 
    public function delete($id){ 
        // Delete member data 
        $delete = $this->db->delete($this->table, array('id' => $id)); 
         
        // Return the status 
        return $delete?true:false; 
    } 
     
}