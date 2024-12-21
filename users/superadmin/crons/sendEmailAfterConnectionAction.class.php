<?php

class users_sendEmailAfterConnectionAction extends cronAction {
    
    function execute()
    {
      foreach (sitesAdmin::getlistSites() as $site)     
      {
          //$site=new Site("www.monsys2.net");
          try
          {
              $db=  mfSiteDatabase::getInstance();
              $db->setQuery("SELECT * FROM ".user::getTable()." WHERE email_tosend='YES';")
                 ->makeSiteSqlQuery($site);
              $users=array();
              while ($row=$db->fetchObject('user'))
              {
                  $row->Loaded();
                  $users[]=$row;
              }    
              foreach ($users as $user)
              {
                  $this->company=companyUtils::getSiteCompany($this->site); // Load current company on this site
                  if (!$this->company)
                     throw new mfException(__("company information has to be completed."));
                //  $this->getMailer()->debug();
                  $this->getMailer()->sendMail('users','emailSignin',array($this->company->get('email') => $this->company->get('name')), $user->get('email'), __("connection to your account"),$user);                   
                  $user->emailSent()
                       ->save();
                  $this->getCron()->getReport()->addMessage(sprintf("site [%s] : email send to %s",$site->getHost(),$user->get('email')));
              }    
          }
          catch (Exception $e)
          {
              $this->getCron()->getReport()->addMessage(sprintf("site [%s] : %s.",$site->getHost(),$e->getMessage()));
          }
      }    
    }
}
