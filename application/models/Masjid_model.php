<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masjid_model extends CI_Model {

    public function search(
        $keyword = null,
        $lat = null,
        $lng = null,
        $radius = null
    )
    {

        $this->db->select("
            masjid.id,
            masjid.name,
            masjid.image,
            masjid.masjidCode,
            masjid.ward_village,
            masjid.address,
            masjid.lat,
            masjid.lng,

            cities.city_name as city,

            states.state_name as state
        ");

       
        $this->db->from('masjid');
        
        $this->db->join('cities','cities.city_id = masjid.city_id','left');
        $this->db->join('states','states.state_id = masjid.state_id','left');
        $this->db->join('tehsil','tehsil.tehsil_id = masjid.tehsil_id','left');
        $this->db->join('rto','rto.rto_id = masjid.rto_id','left');

        if(!empty($keyword)){

            $this->db->group_start();

            $this->db->like('masjid.name',$keyword);
            $this->db->or_like('masjid.ward_village',$keyword);
            $this->db->or_like('masjid.masjidCode',$keyword);
            $this->db->or_like('masjid.address',$keyword);
            $this->db->or_like('cities.city_name',$keyword);
            $this->db->or_like('states.state_name',$keyword);
            $this->db->or_like('tehsil.tehsil_name',$keyword);
            $this->db->or_like('rto.rto_name',$keyword);

            $this->db->group_end();
        }
 
        // DISTANCE 
        if(!empty($lat) && !empty($lng)){

            $this->db->select("
                (
                    6371 * ACOS(
                        COS(RADIANS(".$lat."))
                        * COS(RADIANS(masjid.lat))
                        * COS(
                            RADIANS(masjid.lng)
                            - RADIANS(".$lng.")
                        )
                        + SIN(RADIANS(".$lat."))
                        * SIN(RADIANS(masjid.lat))
                    )
                ) AS distance
            ");

            // radius filter
            if(!empty($radius)){

                $this->db->having(
                    'distance <=',
                    $radius
                );
            }

            // nearest first
            $this->db->order_by(
                'distance',
                'ASC'
            );
        } 

        return $this->db
            ->get()
            ->result();

    }

}