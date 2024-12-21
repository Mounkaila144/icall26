<?php


class GuardServicesFilter extends mfFilter
{
  
  public function execute($filterChain)
  {                  
      //var_dump('========== USER ===== : '.$this->context);
    if ($this->isFirstCall()  &&  $this->context->getUser()->isAnonymous())
    {   
       if (mfConfig::get('mod_'.$this->context->getModuleName()."_".$this->context->getActionName()."_always_access"))
       {        
           mfConfig::set('mf_login_module',$this->context->getModuleName());
           mfConfig::set('mf_login_action',$this->context->getActionName());             
       }
       else 
       {                  
           if (($token=$this->context->getRequest()->getPostParameter('token')))
           {                 
               //var_dump($this->context->getUser());
               $this->context->getUser()->signInBySession(iCall26ServerServiceApi::getSession($token));  
               if (!$this->context->getUser()->isAuthenticated()) {         
                 // mfConfig::set('mf_login_module',$this->context->getModuleName());
                 // mfConfig::set('mf_login_action',$this->context->getActionName());     
                  echo "Not Authorized"; die();
               } 
           }             
       }       
    }    
    $filterChain->execute();
  }
  
}
