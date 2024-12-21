<?php


class utils_editors_ckeditor_resourcesActionComponent extends mfActionComponent {
     
    function preExecute() {
       // var_dump(mfConfig::get('view_froala_version')); die(__METHOD__);
        $this->addJavascript(mfConfig::get('view_ckeditor_version').'/i18n/'.$this->getUser()->getCountry().'.js',array("module"=>"utils_editors_ckeditor")); 
    }
    
    function execute(mfWebRequest $request) 
    {                          
        // var_dump($this->getUser()->getExtendedCulture());
  
    }    
                    
}    