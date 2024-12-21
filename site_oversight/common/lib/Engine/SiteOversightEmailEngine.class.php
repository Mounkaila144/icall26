<?php


class SiteOversightEmailEngine {
    
    protected  $mailer=null,$options=array(),$site=null;
        
    function __construct($site=null) {      
        
       $this->company=SiteCompanyUtils::getSiteCompany($site);       
       $this->site=$site?$site:mfContext::getInstance()->getSite()->getSite();      
       $this->settings=new SiteOversightSettings(null,$this->getSite());
       $this->mailer= mfcontext::getInstance()->getMailer();
    }
    
     
    function getCompany()
    {
        return $this->company;
    }
    
    function getMailer()
    {
        return $this->mailer;
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getMessages()
    {
        return $this->messages=$this->messages===null?SiteOversightMessage::getMessages():$this->messages;
    }
    
    function sendAlert()
    {            
         if (!$this->getSettings()->hasEmails())
             throw new mfException(__('No email'));
         if ($this->getMessages()->isEmpty())
             return $this;
         $today=new DateTimeFormatter();        
         try 
         {                       
          // $this->getMailer()->debug();               
           $this->getMailer()->sendMail('site_oversight','emailMessages',
                                         $this->getCompany()->getEmailWithName(),$this->getSettings()->getEmails()->toArray(),
                                         __('Alert: %s on %s',array($this->getSite()->getHost(),(string)$today->getText())), 
                                         $this);          
           $this->getMessages()->setIsSent();           
         } catch (Swift_TransportException $e) {
           throw new mfException(__('Error occurs during email sending.'));
        } catch (Swift_MimeException $e) {
           throw new mfException(__('Error occurs during email sending.'));
        }           
        return $this;
    }
     
    
   
}

