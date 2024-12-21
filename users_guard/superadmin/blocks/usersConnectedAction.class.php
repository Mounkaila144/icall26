<?php


class users_NumberOfUsersConnectedActionComponent extends mfActionComponent {

     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request)
    {
       $messages = mfMessages::getInstance();
       $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);      
       $this->number_of_users_connected= UserUtils::getNumberOfUsersConnected($this->site);
      // $this->users_connected= UserUtils::getConnectedUsers($site);       
    } 
     
    
}

