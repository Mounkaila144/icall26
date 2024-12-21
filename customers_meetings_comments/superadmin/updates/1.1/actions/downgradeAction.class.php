<?php


class customers_meetings_comments_downgrade_11_Action extends mfModuleUpdate {
 
    
    function execute()
    {
       $site=$this->getSite();     
       $files=array(
              $this->getModelsPath()."/downgrade.sql",               
              );              
       $importDB=importDatabase::getInstance();           
       foreach ($files as $file)
       {    
           if (!is_readable($file))
               continue;          
           $importDB->import($file,$site);         
       }    
    }
    
   
}

