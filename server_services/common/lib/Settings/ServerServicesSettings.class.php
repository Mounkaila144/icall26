<?php


class ServerServicesSettings extends mfSettingsBase {
   
    protected static $instance=null;
     
     function __construct($data=null)
     {
         parent::__construct($data,null,'frontend');
     }
     
     
    function getDefaults()
     {   
         $this->add(array(
                           
                            'master_host'=>null,
             
                            'server_user'=>'services',   
                            'authorized_ips'=>null,
                          ));
        
     }    
                    
     
     function getServerName()
     {
         $host= new mfDomain(mfConfig::getSuperAdmin('host'));                  
         return 'serveur'.str_replace('server','',$host->getSubdomain());
     }
     
     function getServerHost()
     {
         return mfConfig::getSuperAdmin('host');
     }
     
     function getServerUser()
     {
         return $this->get('server_user');
     }
     
     function getAuthorizedIps()
     {
         if (!$this->get('authorized_ips'))
             return new mfArray();
         return $this->get('authorized_ips');
     }
}
