<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct()    {
        parent::__construct();
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

    }

    public function index(){
      echo "Profile";
    }
}