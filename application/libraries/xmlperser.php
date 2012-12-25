<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of XMLPerser
 *
 * @author Alamgir
 */
class XMLPerser
{
    protected $ci;
    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('session'); 
    }
    public function readXML()
    {
        
        
        $xml_path = base_url() .'xml/'.$this->ci->session->userdata('project_id').'.xml';
        $doc = new DOMDocument();    
        $doc->load($xml_path);

        $fObjectArray = array();
        $features = $doc->getElementsByTagName("feature");

        foreach ($features as $feature)
        {
            $fObject = null;
            $fObject = &get_instance()->feature;

            $options = $feature->getElementsByTagName("options");
            $options = $options->item(0)->nodeValue;
            $fObject->options = $options;

            $optionstype = $feature->getElementsByTagName("optionstype");
            $optionstype = $optionstype->item(0)->nodeValue;
            $fObject->optionstype = $optionstype;

            $naturals = $feature->getElementsByTagName("natural");
            $natural = $naturals->item(0)->nodeValue;
            $fObject->natural = $natural;
            $codes = $feature->getElementsByTagName("code");
            $code = $codes->item(0)->nodeValue;
            $fObject->code = $code;

            $helps = $feature->getElementsByTagName("help");
            $help = $helps->item(0)->nodeValue;
            $fObject->help = $help;

            $parameters = $feature->getElementsByTagName("parameter");

            $fObject->parameters = array();
            foreach ($parameters as $parameter)
            {
                $pObject = null;
                $pObject = &get_instance()->parameter;
                
                $names = $parameter->getElementsByTagName("name");
                $name = $names->item(0)->nodeValue;
                $pObject->name = $name;
                $types = $parameter->getElementsByTagName("type");
                $type = $types->item(0)->nodeValue;
                $pObject->type = $type;

                $defaults = $parameter->getElementsByTagName("default");
                $default = $defaults->item(0)->nodeValue;
                $pObject->default = $default;

                $valueList = $parameter->getElementsByTagName("value");
                $pObject->allowedValueList = array();
                foreach ($valueList as $value)
                {
                    $pObject->allowedValueList[] = $value->nodeValue;
                }
                $interval = $parameter->getElementsByTagName("interval");
                $pObject->interval = array();
                foreach ($interval as $limit)
                {
                    $lowerlimit = $limit->getElementsByTagName("lowerlimit");
                    $pObject->interval[] = $lowerlimit->item(0)->nodeValue;
                    $upperlimit = $limit->getElementsByTagName("upperlimit");
                    $pObject->interval[] = $upperlimit->item(0)->nodeValue;
                }
                array_push($fObject->parameters, $pObject);
               
            }
           
            $fObjectArray[$fObject->options][] = $fObject;
        }
        return $fObjectArray;
    }
}
?>
