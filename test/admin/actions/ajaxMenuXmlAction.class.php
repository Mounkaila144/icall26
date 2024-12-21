<?php

//require_once dirname(__FILE__)."/../locales/FormFilters/CustomersFormFilter.class.php";

// www.projet3.net/admin/module/site/test/admin/Test
class test_ajaxMenuXmlAction extends mfAction {
    
   
    function execute(mfWebRequest $request)
    {       
         function array_to_xml($array, &$xml) {        
            foreach($array as $key => $value) {    
                echo "<pre>"; echo $value; echo "</pre>";
               if(is_array($value)) {     
                     echo "-";
	           /* if(!is_numeric($key)){
                        
	                $subnode = $xml->addChild($key);
	                array_to_xml($value, $subnode);
	            } else{
                        echo "+";
	                array_to_xml($value, $subnode);
	            }*/
            } else {
                             //  echo "<pre>";var_dump($key."--------".$value);echo "</pre>"; 
                        $xml->addChild($key, $value);
                             echo "*";	

                    } 
            }        
      }
        $menu= SystemMenu::load('site.dashboard')->getMenu()->getChildren(); 
       echo "<pre>";var_dump(is_array($menu));echo "</pre>"; 
        $xml = new SimpleXMLElement('<items/>'); 
        array_to_xml($menu, $xml);

        // TO PRETTY PRINT OUTPUT
        $domxml = new DOMDocument('1.0');
        $domxml->preserveWhiteSpace = false;
        $domxml->formatOutput = true;
        $domxml->loadXML($xml->asXML());

       echo "<pre>";  echo $domxml->saveXML(); echo "</pre>";
     /*  foreach($menu as $key=>$value)
       {
              echo "<pre>";var_dump($key);echo "</pre>";
       }*/
     //       die(__METHOD__);      
     
    } 
}

