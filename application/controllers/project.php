<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        $this->load->library('ion_auth');        
        $this->load->helper('file');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('array');
    }
    public function index()
    {
              
    }
    
    /*
     * creating a new project
     */
    function create_project()
    {
        $this->data['title'] = "Create Project";
        //authentication checking
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth', 'refresh');
        }
        $template_id = "";
        $publish_code = "";
        //validate form input
        $this->form_validation->set_rules('project_name', 'Project Name', 'required|xss_clean');
        $this->form_validation->set_rules('templates', 'Template', 'required|xss_clean');
        //retrieving project name
        if ($this->form_validation->run() == true)
        {
            $duplicate_project_name = false;
            $user_projects = $this->ion_auth->where('users.id',$this->session->userdata('user_id'))->projects()->result();
            foreach ($user_projects as $user_project):
                if($this->input->post('project_name') == $user_project->project_name)
                {
                    $duplicate_project_name = true;
                }
            endforeach;
            if($duplicate_project_name == true)
            {
                $this->data['message'] = "Project name already exists. Please use different project name.";

                $this->data['project_name'] = array('name' => 'project_name',
                    'id' => 'project_name',
                    'type' => 'text',
                    'value' => $this->input->post('project_name'),
                );
                
                $this->data['templates'] = array();
                $this->data['templates']['1'] = 'Template1';
                $this->data['templates']['2'] = 'Template2';

                $base = base_url();
                $css = "<link rel='stylesheet' href='{$base}css/form_design.css' />"."<link rel='stylesheet' href='{$base}css/bluedream.css' />"."<link rel='stylesheet' href='{$base}css/menu_style.css' />";
                $this->template->set('css', $css);
                $this->template->set('menu_bar', 'design/menu_bar_member_demo');
                $this->template->load("default_template", 'auth/create_project', $this->data);
                return;
            }
            else
            {
                $template_name = "";
                if($this->input->post('templates') == "1")
                {
                    $template_name = "Template1";
                }
                else if($this->input->post('templates') == "2")
                {
                    $template_name = "Template2";
                }
                $publish_code = uniqid(); 
                $template_id = $this->input->post('templates');
                $additional_data = array('project_name' => $this->input->post('project_name'),
                    'template_id' => $this->input->post('templates'),
                    'template_name' => $template_name,
                    'publish_code' => $publish_code,
                );
            }
        }
        //creating the project
        if ($this->form_validation->run() == true && ($project_id = $this->ion_auth->create_project($additional_data)))
        { 
            $this->session->set_flashdata('message', "Project Created");            
            $this->session->set_userdata('project_id', $project_id);
            $this->session->set_userdata('publish_code', $publish_code);
            //loading the project after project creation
            if($template_id == "1")
            {
                $redirect_path = "templates/template1/";
            }
            else if($template_id == "2")
            {
                $redirect_path = "templates/template2/";
            }
            
            redirect($redirect_path, 'refresh');

        }
        else
        { 
            //display the create project form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['project_name'] = array('name' => 'project_name',
                'id' => 'project_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('project_name'),
            );

            $this->data['templates'] = array();
            $this->data['templates']['1'] = 'Template1';
            $this->data['templates']['2'] = 'Template2';
            
            $base = base_url();
            $css = "<link rel='stylesheet' href='{$base}css/form_design.css' />"."<link rel='stylesheet' href='{$base}css/bluedream.css' />"."<link rel='stylesheet' href='{$base}css/menu_style.css' />";
            $this->template->set('css', $css);
            $this->template->set('menu_bar', 'design/menu_bar_member_demo');
            $this->template->load("default_template", 'auth/create_project', $this->data);
        }
    }
}
