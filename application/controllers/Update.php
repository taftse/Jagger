<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Update extends MY_Controller {
    public function __construct()
    {
       parent::__construct();
       $loggedin = $this->jauth->isLoggedIn();
       $this->current_site = current_url();
       if (!$loggedin)
       {
           $this->session->set_flashdata('target', $this->current_site);
           redirect('auth/login', 'location');
       }
       $this->load->library(array('zacl'));

    }

    public function upgrade()
    {
        $data['error'] = anchor(base_url().'smanage/reports','Go to new location');
        $data['content_view'] = 'nopermission';
        $this->load->view(MY_Controller::$page,$data);
    }
       
}

