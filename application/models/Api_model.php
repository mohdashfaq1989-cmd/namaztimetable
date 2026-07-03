<?php
class Api_model extends CI_Model
{
    public function register($data)
    {
        return $this->db->insert('user', $data);
    }

    public function getUserByEmail($email)
    {
        $this->db->select("
            *,
            user_role.role_name
        ");
    
        $this->db->from('user');
        $this->db->join('user_role', 'user_role.role_id = user.role_id', 'left');
        $this->db->where('user.email', $email);
    
        return $this->db->get()->row();
    }
    
    public function getMasjidByUser($user_id, $limit = null, $offset = null)
    {
        $this->db->select("
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
        ");
    
        $this->db->from('masjid');
    
        $this->db->join('countries', 'countries.country_id = masjid.country_id', 'left');
        $this->db->join('cities', 'cities.city_id = masjid.city_id', 'left');
        $this->db->join('states', 'states.state_id = masjid.state_id', 'left');
        $this->db->join('rto', 'rto.rto_id = masjid.rto_id', 'left');
        $this->db->join('tehsil', 'tehsil.tehsil_id = masjid.tehsil_id', 'left');
        $this->db->join('user', 'user.id = masjid.created_by', 'left');
    
        $this->db->where('masjid.created_by', $user_id);
    
        $this->db->order_by('masjid.id', 'DESC');
    
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
    
        return $this->db->get()->result_array();
    }
    
    public function getMasjidCountByUser($user_id)
    {
        $this->db->where('created_by', $user_id);
        return $this->db->count_all_results('masjid');
    }
    public function getAdsByUser($user_id)
    {
        $this->db->select('*');
        $this->db->from('ads');
        $this->db->where('created_by', $user_id);
        $this->db->order_by('id', 'DESC');
    
        return $this->db->get()->result_array();
    }
    public function getAd($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('ads')
            ->row();
    }
}