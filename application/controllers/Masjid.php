<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masjid extends CI_Controller {

    public function index()
    {
        $this->load->view('front/findMasjid');
    }

    public function search()
    {
        $this->load->model('Masjid_model');

        $keyword = $this->input->get('q');
        $lat = $this->input->get('lat');
        $lng = $this->input->get('lng');
        $radius = $this->input->get('radius');

        $data = $this->Masjid_model->search($keyword, $lat, $lng, $radius);

        echo json_encode($data);
    }
}
