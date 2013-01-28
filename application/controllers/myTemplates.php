<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mytemplates extends CI_Controller
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
        //if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            $base = base_url(); 
            $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/carousel-style.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css' />" ;
            $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
            $js = "<script data-main='{$base}scripts/main_home' src='{$base}scripts/require-jquery.js'></script>";
            $this->template->set('css', $css);
            $this->template->set('js', $js);
            $this->template->set('base', $base);
            $this->template->set('menu_bar', 'design/menu_bar_unregistered_user');
            if ($this->ion_auth->logged_in())
            {
                $this->template->set('menu_bar', 'design/menu_bar_member_demo');
                $this->template->set('is_logged_in', 'true');
                $this->template->set('user_name', $this->session->userdata('username'));
            }
            $this->template->load("main_template","templates/index");
        }        
    }
    public function load_template()
    {
        $template_id = "";
        $project_id = ""; 
        $publish_code = "";    
        $template_name = "";
        $from = "";
        $to = "";
        $message = "";
        
        if(isset($_POST['selectedTemplateId']))
        {
            if($_POST['selectedTemplateId'] == 1)
            {
                $template_id = "1";
                $template_name = "Template1";
            }
            else if($_POST['selectedTemplateId'] == 2)
            {
                $template_id = "2";
                $template_name = "Template2";
            }
            
            if ($this->ion_auth->logged_in())
            {
                $where['users_projects.user_id'] = $this->session->userdata('user_id');
                $where['project_info.template_id'] = $template_id;
                $project_template_infos = $this->ion_auth->where($where)->check_project()->result_array();
                if(count($project_template_infos) == 0)
                {
                    $publish_code = uniqid();                     
                    $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
                    $time = time();
                    $created_date = mdate($datestring, $time);
                    
                    $additional_data = array(
                        'template_id' => $template_id,
                        'template_name' => $template_name,
                        'publish_code' => $publish_code,
                        'modified_date' => $created_date,
                    );
                    $project_id = $this->ion_auth->create_project($additional_data);
                    $this->session->set_userdata('project_id', $project_id);
                    $this->create_resources($template_id, $project_id);
                }
                else
                {
                    $project_id = $project_template_infos[0]['project_id'];
                    $from = $project_template_infos[0]['template_from'];
                    $to = $project_template_infos[0]['template_to'];
                    $message = $project_template_infos[0]['template_message'];
                }
            }
            else
            {
                $project_id = "external_".uniqid();  
                $this->create_resources($template_id, $project_id);
            }
        }
       
        $this->data['template_id'] = $template_id;  
        $this->data['project_id'] = $project_id;
        $this->data['publish_code'] = $publish_code;   
        $this->data['from'] = $from;  
        $this->data['to'] = $to;  
        $this->data['message'] = $message;  
        
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css'/>" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/subscribe.css'/>" ;
        $js = "";
        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('base', $base);
        $this->template->set('menu_bar', 'design/menu_bar_home');
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('is_logged_in', 'true');
            $this->template->set('user_name', $this->session->userdata('username'));
        }
        $this->template->load("second_template","templates/template", $this->data);
    }
    
    public function open_selected_template($project_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $this->session->set_userdata('project_id', $project_id); 
        redirect('mytemplates/open_template', 'refresh');
    }
    
    public function delete_template($project_id)
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        
        if ($this->input->post('delete_template_yes'))
        {
            $project_infos = $this->ion_auth->where('project_info.project_id',$project_id)->projects()->result_array();
            $project_info = $project_infos[0];
            $template_id = $project_info['template_id'];
            $template_user_id = $project_info['id'];
            $current_user_id = $this->session->userdata('user_id');

            $message = "";
            if($template_user_id != $current_user_id && !$this->ion_auth->is_admin())
            {
                $message = "You are not allowed to delete this template";
            }
            else
            {
                $this->ion_auth->where('project_id',$project_id)->delete_project();
                $this->ion_auth->where('project_id',$project_id)->delete_user_project();
                //deleting resource files from directory
                $project_resources_path = "./templates/".$template_id."/assets/graphics/1x/".$project_id; 
                delete_files($project_resources_path, TRUE);
                $project_resources_path = "./templates/".$template_id."/assets/graphics/2x/".$project_id; 
                delete_files($project_resources_path, TRUE);
                $project_resources_path = "./templates/".$template_id."/assets/graphics/4x/".$project_id; 
                delete_files($project_resources_path, TRUE);
                
                $message = "Your selected template is deleted successfully";
            }
            
            $this->data['message'] = $message;
            $base = base_url(); 
            $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/carousel-style.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css' />" ;
            $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
            $css = $css."<link rel='stylesheet' href='{$base}css/menu_style.css' />"."<link rel='stylesheet' href='{$base}css/bluedream.css' />" ;
            $js = "<script data-main='{$base}scripts/main_home' src='{$base}scripts/require-jquery.js'></script>";
            $this->template->set('css', $css);
            $this->template->set('js', $js);
            $this->template->set('base', $base);
            $this->template->set('menu_bar', 'design/menu_bar_footer');   
            if ($this->ion_auth->logged_in())
            {
                $this->template->set('is_logged_in', 'true');
                $this->template->set('user_name', $this->session->userdata('username'));
            }
            $this->template->load("main_template","auth/delete_template_successful", $this->data);
        }
        else if ($this->input->post('delete_template_no'))
        {
            redirect('mytemplates/index', 'refresh');
        }
        else
        {
            $this->data['message'] = "";
            $this->data['project_id'] = $project_id;
            $base = base_url(); 
            $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/carousel-style.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css' />" ;
            $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
            $css = $css."<link rel='stylesheet' href='{$base}css/menu_style.css' />"."<link rel='stylesheet' href='{$base}css/bluedream.css' />" ;
            $js = "<script data-main='{$base}scripts/main_home' src='{$base}scripts/require-jquery.js'></script>";
            $this->template->set('css', $css);
            $this->template->set('js', $js);
            $this->template->set('base', $base);
            $this->template->set('menu_bar', 'design/menu_bar_footer');   
            if ($this->ion_auth->logged_in())
            {
                $this->template->set('is_logged_in', 'true');
                $this->template->set('user_name', $this->session->userdata('username'));
            }
            $this->template->load("main_template","auth/delete_template_confirmation", $this->data);
        }
    }
    
    public function open_template()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        $template_id = "";
        $project_id = 1; 
        $publish_code = "";    
        $template_name = "";
        $from = "";
        $to = "";
        $message = "";
        
        $project_id = $this->session->userdata('project_id');
        if($project_id > 0)
        {
            //$this->session->set_userdata('project_id', ""); 
            $where['project_id'] = $project_id;
            $project_infos = $this->ion_auth->where($where)->get_project_info()->result_array();
            $project_info = $project_infos[0];
            $template_id = $project_info['template_id'];
            $publish_code = $project_info['publish_code'];
            $template_name = $project_info['template_name'];
            $from = $project_info['template_from'];
            $to = $project_info['template_to'];
            $message = $project_info['template_message'];
        }
        $this->data['template_id'] = $template_id;  
        $this->data['project_id'] = $project_id;
        $this->data['publish_code'] = $publish_code;   
        $this->data['from'] = $from;  
        $this->data['to'] = $to;  
        $this->data['message'] = $message;  
        
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css'/>" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/subscribe.css'/>" ;
        $js = "";
        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('base', $base);
        $this->template->set('menu_bar', 'design/menu_bar_home');
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('is_logged_in', 'true');
            $this->template->set('user_name', $this->session->userdata('username'));
        }
        $this->template->load("second_template","templates/template", $this->data);
    }
    
    public function template1()
    {
        $template_id = "1";
        $project_id = ""; 
        $publish_code = "";        
        if(isset($_POST['buttonPreprocessTemplate']))
        {            
            if ($this->ion_auth->logged_in())
            {
                $where['users_projects.user_id'] = $this->session->userdata('user_id');
                $where['project_info.template_id'] = 1;
                $project_template_infos = $this->ion_auth->where($where)->check_project()->result_array();
                if(count($project_template_infos) == 0)
                {
                    $template_name = "Template1";                
                    $publish_code = uniqid(); 
                    
                    $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
                    $time = time();
                    $created_date = mdate($datestring, $time);
                    
                    $additional_data = array(
                        'template_id' => $template_id,
                        'template_name' => $template_name,
                        'publish_code' => $publish_code,
                        'created_date' => $created_date,
                    );
                    $project_id = $this->ion_auth->create_project($additional_data);
                    $this->session->set_userdata('project_id', $project_id);
                    $this->create_resources($template_id, $project_id);
                }
                else
                {
                    $project_id = $project_template_infos[0]['project_id'];
                }
            }
            else
            {
                $project_id = "external_".uniqid();  
                $this->create_resources($template_id, $project_id);
            } 
            
        }
       
        $this->data['template_id'] = $template_id;  
        $this->data['project_id'] = $project_id;
        $this->data['publish_code'] = $publish_code;        
        
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css'/>" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/subscribe.css'/>" ;
        $js = "";
        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('base', $base);
        $this->template->set('menu_bar', 'design/menu_bar_unregistered_user');
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('menu_bar', 'design/menu_bar_member_demo');
            $this->template->set('is_logged_in', 'true');
            $this->template->set('user_name', $this->session->userdata('username'));
        }
        $this->template->load("second_template","templates/template", $this->data);
    }
    
    public function template2()
    {
        $project_id = ""; 
        $template_id = "2";
        $publish_code = "";        
        if(isset($_POST['buttonPreprocessTemplate']))
        {            
            if ($this->ion_auth->logged_in())
            {
                $where['users_projects.user_id'] = $this->session->userdata('user_id');
                $where['project_info.template_id'] = 2;
                $project_template_infos = $this->ion_auth->where($where)->check_project()->result_array();
                if(count($project_template_infos) == 0)
                {
                    $template_name = "Template2";                
                    $publish_code = uniqid(); 
                    
                    $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
                    $time = time();
                    $created_date = mdate($datestring, $time);
                    
                    $additional_data = array(
                        'template_id' => $template_id,
                        'template_name' => $template_name,
                        'publish_code' => $publish_code,
                        'created_date' => $created_date,
                    );
                    $project_id = $this->ion_auth->create_project($additional_data);
                    $this->session->set_userdata('project_id', $project_id);
                    $this->create_resources($template_id, $project_id);
                }
                else
                {
                    $project_id = $project_template_infos[0]['project_id'];
                }
            }
            else
            {
                $project_id = "external_".uniqid();  
                $this->create_resources($template_id, $project_id);
            } 
            $this->create_resources($template_id, $project_id);
        }
       
        $this->data['template_id'] = $template_id;  
        $this->data['project_id'] = $project_id;
        $this->data['publish_code'] = $publish_code;        
        
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css'/>" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/subscribe.css'/>" ;
        $js = "";
        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('base', $base);
        $this->template->set('menu_bar', 'design/menu_bar_unregistered_user');
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('menu_bar', 'design/menu_bar_member_demo');
            $this->template->set('is_logged_in', 'true');
            $this->template->set('user_name', $this->session->userdata('username'));
        }
        $this->template->load("second_template","templates/template", $this->data);
    }
    
    public function create_resources($template_id, $project_id)
    {
        $project_resources_path = "./templates/".$template_id."/assets/graphics/1x/".$project_id;        
        if(!is_dir($project_resources_path))
        {
            mkdir($project_resources_path);
        }

        $source = "./templates/".$template_id."/assets/graphics/1x/sprite-3-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/1x/".$project_id."/sprite-3-0.png";
        copy($source, $destination);

        $source = "./templates/".$template_id."/assets/graphics/1x/sprite-5-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/1x/".$project_id."/sprite-5-0.png";
        copy($source, $destination);
        
        $source = "./templates/".$template_id."/assets/graphics/1x/sprite-9-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/1x/".$project_id."/sprite-9-0.png";
        copy($source, $destination);

        $source = "./templates/".$template_id."/assets/graphics/1x/sprite-16-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/1x/".$project_id."/sprite-16-0.png";
        copy($source, $destination);

        $source = "./templates/".$template_id."/assets/graphics/1x/sprite-26-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/1x/".$project_id."/sprite-26-0.png";
        copy($source, $destination);
        
        $source = "./templates/".$template_id."/assets/graphics/1x/sprite-26-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/1x/".$project_id."/original_sprite-26-0.png";
        copy($source, $destination);

        $project_resources_path = "./templates/".$template_id."/assets/graphics/2x/".$project_id;
        if(!is_dir($project_resources_path))
        {
            mkdir($project_resources_path);
        }

        $source = "./templates/".$template_id."/assets/graphics/2x/sprite-3-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/2x/".$project_id."/sprite-3-0.png";
        copy($source, $destination);

        $source = "./templates/".$template_id."/assets/graphics/2x/sprite-5-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/2x/".$project_id."/sprite-5-0.png";
        copy($source, $destination);
        
        $source = "./templates/".$template_id."/assets/graphics/2x/sprite-9-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/2x/".$project_id."/sprite-9-0.png";
        copy($source, $destination);

        $source = "./templates/".$template_id."/assets/graphics/2x/sprite-16-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/2x/".$project_id."/sprite-16-0.png";
        copy($source, $destination);

        $source = "./templates/".$template_id."/assets/graphics/2x/sprite-26-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/2x/".$project_id."/sprite-26-0.png";
        copy($source, $destination);
        
        $source = "./templates/".$template_id."/assets/graphics/2x/sprite-26-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/2x/".$project_id."/original_sprite-26-0.png";
        copy($source, $destination);

        $project_resources_path = "./templates/".$template_id."/assets/graphics/4x/".$project_id;
        if(!is_dir($project_resources_path))
        {
            mkdir($project_resources_path);
        }

        $source = "./templates/".$template_id."/assets/graphics/4x/sprite-3-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/4x/".$project_id."/sprite-3-0.png";
        copy($source, $destination);

        $source = "./templates/".$template_id."/assets/graphics/4x/sprite-5-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/4x/".$project_id."/sprite-5-0.png";
        copy($source, $destination);
        
        $source = "./templates/".$template_id."/assets/graphics/4x/sprite-9-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/4x/".$project_id."/sprite-9-0.png";
        copy($source, $destination);

        $source = "./templates/".$template_id."/assets/graphics/4x/sprite-16-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/4x/".$project_id."/sprite-16-0.png";
        copy($source, $destination);

        $source = "./templates/".$template_id."/assets/graphics/4x/sprite-26-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/4x/".$project_id."/sprite-26-0.png";
        copy($source, $destination);
        
        $source = "./templates/".$template_id."/assets/graphics/4x/sprite-26-0.png";
        $destination = "./templates/".$template_id."/assets/graphics/4x/".$project_id."/original_sprite-26-0.png";
        copy($source, $destination);
    }
    
    public function upload()
    {
        $uniqueId = uniqid();        
        $file_name = $uniqueId."_".$_FILES["userfile"]["name"];
        
        $config['file_name'] = $file_name;        
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '3072';
        $config['overwrite'] = TRUE;        

        $this->load->library('upload');
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload()) {
            $result->success = false;
        } else {
            $data = $this->upload->data();
            
            //$uploaded_file_name = $data['raw_name'];
            //$uploaded_file_path = "./external_variables/".$uploaded_file_name.".txt";

            $result = new StdClass();
            $result->success = true;
            $result->fileName = $file_name;
            $result->uploadPath = 'upload/';
        }
        print_r(json_encode($result)); 
        
    }
    
     public function save()
    {
        $this->load->helper('file');
        $image_name = $_REQUEST['imageNname'];
        $image_path = $_REQUEST['imagePath'];
        $message = $_REQUEST['message'];
        $from = $_REQUEST['from'];
        $to = $_REQUEST['to'];
        $project_id = $_REQUEST['project_id'];
        $file = $image_path .$image_name.'.png';

        if ($this->ion_auth->logged_in())
        {
            if($message != "")
            {
                $data = array(
                    'template_message' => $message,
                    'template_from' => $from,
                    'template_to' => $to
                );
                $this->ion_auth->where('project_id',$project_id)->update_project($data); 
            }
        }
        
        $imageData = $_REQUEST['data'];
        // Remove the headers (data:,) part.  
        // A real application should use them according to needs such as to check image type
        $filteredData=substr($imageData, strpos($imageData, ",")+1);

        // Need to decode before saving since the data we received is already base64 encoded
        $unencodedData=base64_decode($filteredData);

        write_file($file, $unencodedData);
        echo $file;
    }
    
    public function temp()
    {
        //if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            $base = base_url(); 
            $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />" ;
            $this->template->set('css', $css);
            $this->template->set('base', $base);
            if ($this->ion_auth->logged_in())
            {
                $this->template->set('is_logged_in', 'true');
            }
            $this->template->load("second_template","templates/template");
        }        
    }
    
    public function redirect_path()
    {
        $this->template->load("default_template","templates/error_content");
    }
    
    public function templates()
    {
        if ($this->ion_auth->logged_in())
        {
            $where['users_projects.user_id'] = $this->session->userdata('user_id');
            $this->data['template_list'] = $this->ion_auth->where($where)->check_project()->result();
            
            $this->data['message'] = "";
            $base = base_url(); 
            $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/carousel-style.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css' />" ;
            $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
            $css = $css."<link rel='stylesheet' href='{$base}css/menu_style.css' />"."<link rel='stylesheet' href='{$base}css/bluedream.css' />" ;
            $js = "<script data-main='{$base}scripts/main_home' src='{$base}scripts/require-jquery.js'></script>";
            $this->template->set('css', $css);
            $this->template->set('js', $js);
            $this->template->set('base', $base);
            $this->template->set('menu_bar', 'design/menu_bar_home');
            if ($this->ion_auth->logged_in())
            {
                $this->template->set('is_logged_in', 'true');
            }
            $this->template->load("main_template","auth/template_list", $this->data);
        }
    }
    
    /////////////////////Publish and Preview start////////////////////////////////
    public function publishtemplate($publish_code)
    {
        $project_id = "";
        $template_id = "";
        $user_projects = $this->ion_auth->projects()->result();
        foreach ($user_projects as $user_project):
            if($publish_code == $user_project->publish_code)
            {
                $project_id = $user_project->project_id;
                $template_id = $user_project->template_id;
                $this->data['template_id'] = $template_id;
                $this->data['project_id'] = $project_id;
                $this->data['template_message'] = $user_project->template_message;
                $this->load->view("publish/template", $this->data);
            }
        endforeach;        
    }
    
    public function previewtemplate($template_id)
    {
        
        if(isset($_POST['buttonPreviewTemplateProjectId']))
        {
            $project_id = $_POST['buttonPreviewTemplateProjectId'];
        
            $this->data['template_id'] = $template_id;
            $this->data['project_id'] = $project_id;
            $this->data['template_message'] = "";
            if(isset($_POST['buttonPreviewTemplateMessage']))
            {
                $this->data['template_message'] = $_POST['buttonPreviewTemplateMessage'];
            }
            $this->load->view("publish/template", $this->data);
        }
        else
        {
            redirect('templates', 'refresh');
        }
        
    }
    ////////////////////Publish and Preview end///////////////////////////////////
    
    /////////////////////Footer links start////////////////////////////////
    public function about()
    {
        $this->data['message'] = "";
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/carousel-style.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css' />" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
        $css = $css."<link rel='stylesheet' href='{$base}css/menu_style.css' />"."<link rel='stylesheet' href='{$base}css/bluedream.css' />" ;
        $js = "<script data-main='{$base}scripts/main_home' src='{$base}scripts/require-jquery.js'></script>";
        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('base', $base);
        $this->template->set('menu_bar', 'design/menu_bar_footer');   
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('is_logged_in', 'true');
            $this->template->set('user_name', $this->session->userdata('username'));
        }
        $this->template->load("main_template","auth/about", $this->data);
    }
    public function copyright()
    {
        $this->data['message'] = "";
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/carousel-style.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css' />" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
        $css = $css."<link rel='stylesheet' href='{$base}css/menu_style.css' />"."<link rel='stylesheet' href='{$base}css/bluedream.css' />" ;
        $js = "<script data-main='{$base}scripts/main_home' src='{$base}scripts/require-jquery.js'></script>";
        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('base', $base);
        $this->template->set('menu_bar', 'design/menu_bar_footer');   
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('is_logged_in', 'true');
            $this->template->set('user_name', $this->session->userdata('username'));
        }
        $this->template->load("main_template","auth/copyright", $this->data);
    }
    public function privacy()
    {
        $this->data['message'] = "";
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/carousel-style.css' />"."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css' />" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
        $css = $css."<link rel='stylesheet' href='{$base}css/menu_style.css' />"."<link rel='stylesheet' href='{$base}css/bluedream.css' />" ;
        $js = "<script data-main='{$base}scripts/main_home' src='{$base}scripts/require-jquery.js'></script>";
        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('base', $base);
        $this->template->set('menu_bar', 'design/menu_bar_footer');   
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('is_logged_in', 'true');
            $this->template->set('user_name', $this->session->userdata('username'));
        }
        $this->template->load("main_template","auth/privacy", $this->data);
    }
    /////////////////////Footer links ends////////////////////////////////
}
