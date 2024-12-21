<?php


class SiteServicesServerProcessEngine {

   
       
    function __construct($site=null) {      
        $this->api_errors=new ApiResponseErrorsCollection();     
        $this->settings=new  CustomerContractBillingSettings(); 
        $this->site=$site;
       $this->finished=false;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    
    
    function getLimit()
    {
        return 5;
    }
    
     function getIsFinished()
    {
        return $this->finished;
    }
   
   function getApiErrors(){
       return $this->api_errors;
       
   }
 
    function getSiteServicesServers()
   {
       if ($this->site_services_server===null)
       {
           $this->site_services_server=new SiteServicesServerCollection(null,$this->getSite());
           $db=mfSiteDatabase::getInstance()
                ->setParameters(array('limit'=>$this->getLimit()))               
                //->setObjects(array('CustomerContractServerICall26','ServerICall26'))               
                //->setObjects(array('SiteServicesServer'))               
                 ->setQuery("SELECT ". SiteServicesServer::getFieldsAndKeyWithTable()." FROM ".SiteServicesServer::getTable().
                            " WHERE ".SiteServicesServer::getTableField('is_processed')."= 'NO' ". // is_inprogress = 'N'
                            " AND ".SiteServicesServer::getTableField('is_inprogress')."= 'NO' ".
                            " AND is_active='YES'".
                            " LIMIT {limit}".              
                           ";")         
                ->makeSqlQuerySuperAdmin(); 
       //  echo $db->getQuery();
     
        if (!$db->getNumRows())
            return $this->site_services_server;
         
         while($item = $db->fetchObject('SiteServicesServer'))
        {       
          
           // $item=$items->getSiteServicesServer();           
            $this->site_services_server[$item->get('id')]=$item;
        } 
       
        $this->site_services_server->loaded();
       }   
     
       return $this->site_services_server;
   }
   
   
   
   function getNumberOfServers()
   {
      if ($this->number_of_servers===null)
       {           
           $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                                             
                ->setQuery( "SELECT COUNT(id) FROM ".SiteServicesServer::getTable().                        
                            " WHERE ".SiteServicesServer::getTableField('is_active')."= 'YES' ".
                            ";")  
                ->makeSiteSqlQuery($this->getSite());  
           $row=$db->fetchRow();
           $this->number_of_servers =$row[0];
       }   
       return $this->number_of_servers;
   }
   
   function getNumberOfProcessedServers()
   {
      if ($this->number_of_processed_servers===null)
       {
          $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                                             
                ->setQuery( "SELECT COUNT(id) FROM ".SiteServicesServer::getTable().                         
                           " WHERE ".SiteServicesServer::getTableField('is_processed')."= 'YES' ".
                                 " AND ".SiteServicesServer::getTableField('is_active')."= 'YES' ".
                            ";")  
                ->makeSiteSqlQuery($this->getSite());
        //    echo $db->getQuery();
           $row=$db->fetchRow();
           $this->number_of_processed_servers =$row[0];
       }          
       return $this->number_of_processed_servers;
   }
   
    
   
    
    
   function process(){
     
          
         $this->finished=false;
        $sites=new mfArray();  
        $this->getSiteServicesServers()->inprogress();       
        $this->getSiteServicesServers()->updateIsActive();
         
        $sites_collection=$this->loadSitesByHost(); 
    //var_dump($this->getSiteServicesServers());die(__METHOD__);
    // die(__METHOD__);
        foreach ($this->getSiteServicesServers() as $server){
          
            $api=new iCall26ServerServiceApi($server);           
            $api->login($server->get('login_service'),$server->getDecryptedPassword());              
            $sites=$api->siteList();  
           if (isset($sites['items']))
            {    
                foreach ($sites['items'] as $array_site)
                {              
                   if ($sites_collection->hasItemByKey($server->get('id')."-".$array_site['site_host'])) 
                   {                                 
                       $item=$sites_collection->getItemByKey($server->get('id')."-".$array_site['site_host']);
                   }    
                   else
                   {                    
                    $item=new SiteServicesSite();           
                    $item->set('server_id',$server); 
                   }
                   $item->transferArraySite($array_site);
                   //echo "<pre>"; var_dump($item->get('host')); echo "</pre>";
                   $item->set('is_active','Y');
                   $sites_collection[$server->get('id')."-".$item->get('host')]=$item;
                }         
            }
             //echo "--3--";
          //   $server->set('is_processed','YES')->save();
        } 
       
       // echo "<pre>"; var_dump($sites_collection); echo "</pre>";
         $sites_collection->save();        
        $this->getSiteServicesServers()->done();

        if($this->getNumberOfServers()==$this->getNumberOfProcessedServers())
        {
         
              $this->getSiteServicesServers()->resetAll();
              $this->finished=true;
        }
       return $this;
   }
   
     protected function loadSitesByHost()
   {
       $collection= new SiteServicesSiteCollection();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("SELECT * FROM ".SiteServicesSite::getTable().                          
                           ";") 
                ->makeSqlQuerySuperAdmin();   
        if (!$db->getNumRows())
            return $collection;
         while ($item=$db->fetchObject('SiteServicesSite'))         
         {
            $collection[$item->get('server_id')."-".$item->get('host')]=$item->loaded();
         }             
         $collection->loaded();
       return $collection;
   }
   
      protected function updateIsActive()
   {        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("UPDATE ".SiteServicesSite::getTable().                          
                         " SET " . SiteServicesSite::getTableField('is_active') ."='N' ;")
                ->makeSqlQuerySuperAdmin();          
   }
}
