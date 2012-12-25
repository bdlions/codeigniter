<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('url');
    }

    //redirect if needed, otherwise display the user list
    function index()
    {

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        /*if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        elseif ($this->ion_auth->is_admin())*/
        {
            //redirect them to the home page because they must be an administrator to view this
            $this->template->set('menu_bar', 'design/configuration_menubar');
            $this->template->load("default_template", "program/configuration");
        }
       
    }
}
?>
