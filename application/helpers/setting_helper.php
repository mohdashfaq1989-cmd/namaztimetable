<?php

if (!function_exists('setting')) {

    function setting()
    {

        $CI =& get_instance();

        $CI->load->database();

        static $setting;

        if (empty($setting)) {

            $setting = $CI->db
                          ->where('id',1)
                          ->get('settings')
                          ->row();

        }

        return $setting;

    }

}