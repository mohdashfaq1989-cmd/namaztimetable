<?php
class Home_model extends CI_Model
{
    
    public function getMasjid($id = null, $limit = null, $offset = null)
    {
        $this->db->select('
            masjid.id,
            masjid.name,
            masjid.masjidCode,
            masjid.imam,
            masjid.mutwalli,
            masjid.pincode,
            masjid.lng,
            masjid.lat,
            countries.country_name as country,
            cities.city_name as city,
            states.state_name as state,
            rto.rto_name as rto,
            tehsil.tehsil_name as tehsil,
            user.name as userName,
            masjid.address,
            masjid.image,
            masjid.fajr,
            masjid.dhuhr,
            masjid.asr,
            masjid.maghrib,
            masjid.isha,
            masjid.juma,
            masjid.eid
        ');
    
        $this->db->from('masjid');
    
        $this->db->join('countries', 'countries.country_id = masjid.country_id', 'left');
        $this->db->join('cities', 'cities.city_id = masjid.city_id', 'left');
        $this->db->join('states', 'states.state_id = masjid.state_id', 'left');
        $this->db->join('rto', 'rto.rto_id = masjid.rto_id', 'left');
        $this->db->join('tehsil', 'tehsil.tehsil_id = masjid.tehsil_id', 'left');
        $this->db->join('user', 'user.id = masjid.created_by', 'left');
    
        if (!empty($id)) {
            $this->db->where('masjid.id', $id);
            return $this->db->get()->row();
        }
    
        // Latest first
        $this->db->order_by('masjid.id', 'DESC');
    
        // Pagination
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
    
        return $this->db->get()->result_array();
    }
    
    public function getMasjidCount()
    {
        return $this->db->count_all('masjid');
    }
    
    
    public function getBlog($id = null, $limit = null, $offset = null)
    {
        $this->db->select('*');
        $this->db->from('blog');
    
        if (!empty($id)) {
            $this->db->where('id', $id);
            return $this->db->get()->row();
        }
    
        // Latest blog first
        $this->db->order_by('id', 'DESC');
    
        // Pagination
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
    
        return $this->db->get()->result_array();
    }
    public function getBlogCount()
    {
        return $this->db->count_all('blog');
    }
    public function getAds($masjid_id=null)
    {
        $this->db->select('*');
        if($masjid_id==true){
            $this->db->where('masjid_id',$masjid_id);
            return $this->db
            ->get('ads') 
            ->result_array();
        }
        return $this->db->get('ads')->result_array();

    }
    public function getGallery($id = null, $limit = null, $offset = null)
    {
        $this->db->select('*');
        $this->db->from('gallery');
    
        if (!empty($id)) {
            $this->db->where('id', $id);
            return $this->db->get()->row();
        }
    
        $this->db->order_by('id', 'DESC');
    
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
    
        return $this->db->get()->result_array();
    }
    public function getGalleryCount()
    {
        return $this->db->count_all('gallery');
    }
    
}
    

?>