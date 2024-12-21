<?php

class CustomerCommentEvents {
     
 
    static function customerChange(mfEvent $event)
    {         
        $customer=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_comments', $customer->getSite()))
             return ;      
       //  echo "====customer==="    ;      
        if ($customer->hasPropertiesChanged(array('firstname','lastname','email','phone','mobile','phone1','mobile2','company')))
        {        
            $user=mfContext::getInstance ()->getUser()->getGuardUser();
            $changes=new mfArray();
            foreach ($customer->getPropertiesChanged(array('firstname','lastname','email','phone','mobile','phone1','mobile2','company')) as $field=>$change)                  
               $changes[]=__($field,array(),'fields','customers').": ".$customer->getPropertyChanged($field)." => ".$customer->get($field);           
           $comment= new CustomerComment(null,$customer->getSite());        
           $comment->set('comment',$changes->implode().__(" by ",array(),'messages','customers_comments').$user->getUpperName());           
           $comment->set('customer_id',$customer);
           $comment->set('type','SYSTEM');
           $comment->save();                           
           $comment->setHistory($user);            
        }     
    }
    
     static function customerAddressChange(mfEvent $event)
    {         
        $address=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_comments', $address->getSite()))
             return ;              
         if ($address->hasPropertiesChanged(array('address1','address2','city','postcode','country')))
        {
            $user=mfContext::getInstance ()->getUser()->getGuardUser();
            $changes=new mfArray();
            foreach ($address->getPropertiesChanged(array('address1','address2','city','postcode','country')) as $field=>$change)                  
               $changes[]=__($field,array(),'fields','customers').": ".$address->getPropertyChanged($field)." => ".$address->get($field);           
           $comment= new CustomerComment(null,$address->getSite());        
           $comment->set('comment',$changes->implode().__(" by ",array(),'messages','customers_comments').$user->getUpperName());           
           $comment->set('customer_id',$address->getCustomer());
           $comment->set('type','SYSTEM');
           $comment->save();                           
           $comment->setHistory($user);    
        } 
    }
    
    
     static function initializationExecute(mfEvent $event)
    {  
          $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_comments',$form->getSite()))
             return ;      
      //  echo "Meeting ICI Execute";
       // var_dump($form->getValue('meetings_clean'))         
        if ($form->getValue('meetings_clean'))
        {    
            CustomerCommentUtils::initializeSite($form->getSite());
        }
    }
    
}

