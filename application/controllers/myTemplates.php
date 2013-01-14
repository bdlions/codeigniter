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
            $this->template->set('menu_bar', 'design/menu_bar_member_demo');
            if ($this->ion_auth->logged_in())
            {
                $this->template->set('is_logged_in', 'true');
            }
            $this->template->load("main_template","templates/index");
        }        
    }
    public function load_template()
    {
        if(isset($_POST['selectedTemplateId']))
        {
            if($_POST['selectedTemplateId'] == 1)
            {
                redirect('mytemplates/template1', 'refresh');
                //$this->template1();
            }
            else if($_POST['selectedTemplateId'] == 2)
            {
                redirect('mytemplates/template2', 'refresh');
                //$this->template2();
            }
        }
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
                $template_name = "Template1";                
                $publish_code = uniqid(); 
                $additional_data = array(
                    'template_id' => $template_id,
                    'template_name' => $template_name,
                    'publish_code' => $publish_code,
                );
                $project_id = $this->ion_auth->create_project($additional_data);
                $this->session->set_userdata('project_id', $project_id);
            }
            else
            {
                $project_id = "external_".uniqid();   
            } 
            $this->create_resources($template_id, $project_id);
        }
       
        $this->data['template_id'] = $template_id;  
        $this->data['project_id'] = $project_id;
        $this->data['publish_code'] = $publish_code;        
        
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css'/>" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
        $js = "";
        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('base', $base);
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('is_logged_in', 'true');
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
                $template_name = "Template2";                
                $publish_code = uniqid(); 
                $additional_data = array(
                    'template_id' => $template_id,
                    'template_name' => $template_name,
                    'publish_code' => $publish_code,
                );
                $project_id = $this->ion_auth->create_project($additional_data);
            }
            else
            {
                $project_id = "external_".uniqid();   
            } 
            $this->create_resources($template_id, $project_id);
        }
       
        $this->data['template_id'] = $template_id;  
        $this->data['project_id'] = $project_id;
        $this->data['publish_code'] = $publish_code;        
        
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/custom_common.css'/>" ;
        $css = $css."<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/jquery-ui.css'/>" ;
        $js = "";
        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('base', $base);
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('is_logged_in', 'true');
        }
        $this->template->load("second_template","templates/template", $this->data);
    }
    public function about()
    {
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />" ;
        $this->template->set('css', $css);
        $this->template->set('base', $base);
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('is_logged_in', 'true');
        }
        $this->template->load("main_template","auth/about");
    }
    public function copyright()
    {
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />" ;
        $this->template->set('css', $css);
        $this->template->set('base', $base);
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('is_logged_in', 'true');
        }
        $this->template->load("main_template","auth/copyright");
    }
    public function privacy()
    {
        $base = base_url(); 
        $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />" ;
        $this->template->set('css', $css);
        $this->template->set('base', $base);
        if ($this->ion_auth->logged_in())
        {
            $this->template->set('is_logged_in', 'true');
        }
        $this->template->load("main_template","auth/privacy");
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
        $file = $image_path .$image_name.'.png';

        if ($this->ion_auth->logged_in())
        {
            if($message != "")
            {
                $data = array(
                    'template_message' => $message
                );
                $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->update_project($data); 
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
        
        //$template_id = $_POST['buttonPreviewTemplateTemplateId'];
        if(isset($_POST['buttonPreviewTemplateProjectId']))
        {
            $project_id = $_POST['buttonPreviewTemplateProjectId'];
        
            //print_r("template_id".$template_id);
            //print_r("project_id".$project_id);
            $this->data['template_id'] = $template_id;
            $this->data['project_id'] = $project_id;
            $this->data['template_message'] = "";
            if(isset($_POST['buttonPreviewTemplateMessage']))
            {
                $this->data['template_message'] = $_POST['buttonPreviewTemplateMessage'];
            }
            $this->load->view("publish/template", $this->data);

            /*$base = base_url(); 
            $css ="<link type='text/css' media='screen' rel='stylesheet' href='{$base}css/main.css' />" ;
            $this->template->set('css', $css);
            $this->template->set('base', $base);
            $this->template->load("main_template","publish/template", $this->data);*/
        }
        else
        {
            redirect('templates', 'refresh');
        }
        
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
}
