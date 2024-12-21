<?php

class SiteServicesFormFilter extends mfFormFilterBase {
 
   
    function configure()
    {
       // $this->setOption('disabledCSRF',true);
        $this->setDefaults(array(
            'order'=>array(
                            "site_id"=>"asc",
            ),
            'search'=>array(
                         
            ),
            'nbitemsbypage'=>"50",
       ));
       // Base Query
       $this->setClass('SiteServicesSite');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".SiteServicesSite::getTable().  
                 ";"); 
       // Validators 
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                            "host"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "db_name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                            "db_host"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                            "admin_theme"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "frontend_theme"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "type"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                            "host"=>new mfValidatorString(array("required"=>false)),                            
                            "db_name"=>new mfValidatorString(array("required"=>false)),
                            "db_host"=>new mfValidatorString(array("required"=>false)), 
                            "company"=>new mfValidatorString(array("required"=>false)),                           
                            "admin_available"=>new mfValidatorChoice(array("key"=>true,"choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"required"=>false)),
                            "frontend_available"=>new mfValidatorChoice(array("key"=>true,"choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"required"=>false)),
                            "available"=>new mfValidatorChoice(array("key"=>true,"choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"required"=>false)),
                           ),array("required"=>false)),
            'equal' => new mfValidatorSchema(array(                                                          
                            // "company"=>new mfValidatorChoice(array("key"=>true,"choices"=>array(""=>"")+SitesAdmin::getCompaniesForSelect(),"required"=>false)),
                             "server_id"=>new mfValidatorChoice(array("key"=>true,"choices"=>array(""=>"")+SiteServicesServer::getServersForSelect()->toArray(),"required"=>false)),
                           ),array("required"=>false)),
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"*"=>"*"),"required"=>false)),         
        ));
    }

    function getItems(){
        return $this->items->toArray();
    }   
    
    function execute()
    {
        $this->items=new mfArray();
        $db=new mfSiteDatabase();
        $db->setParameters(array())
                ->setQuery($this->getQuery())
                ->makeSqlQuerySuperAdmin();          
        if (!$db->getNumRows())
            return ;
        while ($item=$db->fetchObject('Site'))
        {   
            $this->items[$item->get('site_id')]=$item->toArray(array());                     
        }       
    }
    
    static function getToken()
    {
       return session_id();   
    }
  
    public function getCSRFToken()
    {
      return session_id();
    }
 
}

