<?php


 
class moduleManager extends moduleManagerBase {
    
   protected $installer=null;
   
   public function IsActiveNotAuthorized()
   {
      return !$this->changeAuthorized(); 
   } 
   
   public function IsAvailableNotAuthorized()
   {
      if (in_array($this->get('type'),array('core','system','base')))
          return true;
      return false;
   } 
   
   protected function changeAuthorized()
   {
       if (in_array($this->get('type'),array('core','system','base')))
            return false;
       if (!in_array($this->get('type'),array('core','system','base')) && $this->get('status')!='installed')
            return false;
       return true;
   }
   
   function isInstallable()
   {
       if ($this->get('isAvailable')=='NO')
            return false;
        if (in_array($this->get('type'),array('core','system','base')))
            return false;
        if ($this->get('status')!='loaded')
            return false;
        return true;
   }
   
    function isUninstallable()
    {
         if (in_array($this->get('type'),array('core','system','base')))
             return false;
         if ($this->get('status')!='installed')
             return false;
         return true;
    }

   
 /*  function getInstaller()
   {
       if (!isset($this->installer))
            $this->installer=new moduleUpdater($this->get('name'),$this->getSite());     
      return $this->installer;     
   }*/
    
    function getUpdater()
    {        
        if (!isset($this->updater))
            $this->updater=new moduleUpdater($this->get('name'),$this->getSite());  
        return $this->updater; 
    }
    
    
}