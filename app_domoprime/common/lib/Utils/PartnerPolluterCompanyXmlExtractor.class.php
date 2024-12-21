<?php


class PartnerPolluterCompanyXmlExtractor extends  XmlFileToObject {
   
     
    function getPolluter()
    {
        return $this->object;
    }
    
     function getPicturePath()
    {
        return $this->getPath()."/img";
    }    
    
    function getXmlFile()
    {
        return "polluter.xml";
    }
    
    function getRecipient()
    {
        return $this->recipient;
    }
    
    function extract()
    {       
       //$this->getPolluter()->add($this->toArray())->save();       
        $this->getPolluter()->add($this->toArray());       
        if ($this->getPolluter()->isExist())
        {
            $this->getPolluter()->add(array(
                                            'name'=>"1-".$this->getPolluter()->get('name')
                                        ));
        }    
        $this->getPolluter()->save();     
       // Contacts            
        $contact=new PartnerPolluterContact(null,$this->getSite());
        $contact->set('company_id',$this->getPolluter());
         
        $contact->add($this->toArray()->getValue('contacts'));      
        $contact->save();       
       // Recipient
       $this->recipient=new PartnerRecipientCompany(null,$this->getSite());     
       $this->recipient->add($this->toArray()->getValue('recipient'));
       if ($this->recipient->isExist())
       {
            $this->recipient->add(array('commercial'=>"1-".$this->recipient->get('commercial'),
                                        'name'=>$this->recipient->get('name')
                                        ));
       }
       $this->recipient->save();      
       // Recipient contact
       $recipient_contact=new PartnerRecipientContact(null,$this->getSite());
       $recipient_contact->set('company_id',$this->recipient);
       $recipient_contact->add((array)$this->toArray()->getValue('recipient')->contact);
       $recipient_contact->save();       
       // Recipient / polluter
       $recipient_polluter=new DomoprimePolluterRecipient(null,$this->getSite());
       $recipient_polluter->add(array('recipient_id'=>$this->recipient,'polluter_id'=>$this->getPolluter()))->save();  
             
       if ($this->toArray()->getValue('properties'))
       {             
          $properties_polluter=new DomoprimePolluterProperty($this->getPolluter(),$this->getSite());
          $properties_polluter->add($this->toArray()->getValue('properties'))->save();    
       }
       // Billing
       $billing_model = new DomoprimeBillingModel(null,$this->getSite());       
       $billing_model->add($this->toArray()->getValue('billing'))->save();
       // Billing I18n
       $billing_model_i18n = new DomoprimeBillingModelI18n(null,$this->getSite());       
       $billing_model_i18n->add(get_object_vars($this->toArray()->getValue('billing')->i18n));
       $billing_model_i18n->set('model_id',$billing_model);
       if ($billing_model_i18n->isExist())       
           $billing_model_i18n->set('value',"1-".$billing_model_i18n->get('value'));       
       $billing_model_i18n->save();
       
       $billing_polluter=new DomoprimePolluterBilling(null,$this->getSite());
       $billing_polluter->add(array('polluter_id'=>$this->getPolluter(),'model_id'=>$billing_model))->save();
       // Quotation
       $quotation_model = new DomoprimeQuotationModel(null,$this->getSite());
       $quotation_model->add($this->toArray()->getValue('quotation'))->save();
       // Quotation I18n
       $quotation_model_i18n = new DomoprimeQuotationModelI18n(null,$this->getSite());       
       $quotation_model_i18n->add(get_object_vars($this->toArray()->getValue('quotation')->i18n));
       $quotation_model_i18n->set('model_id',$quotation_model);
       if ($quotation_model_i18n->isExist())       
           $quotation_model_i18n->set('value',"1-".$quotation_model_i18n->get('value'));       
       $quotation_model_i18n->save();                    
       
       
       // Premodel
       $premodel=null;
       if ($this->toArray()->getValue('document_quotation') && $this->toArray()->getValue('document_quotation')->pre)
       {                              
            if ($this->toArray()->getValue('document_quotation')->pre->name)           
            {    
                 $premodel=new PartnerPolluterModel($this->toArray()->getValue('document_quotation')->pre->name,$this->getSite());                         
                  
            }
       }     
       
       $quotation_polluter=new DomoprimePolluterQuotation(null,$this->getSite());
       $quotation_polluter->add(array('polluter_id'=>$this->getPolluter(),
                                      'pre_model_id'=>$premodel,
                                      'model_id'=>$quotation_model))->save();              
      
       // Premeeting
       $premeeting_model = new DomoprimePreMeetingModel(null,$this->getSite());
       $premeeting_model->add($this->toArray()->getValue('premeeting'))->save();
       //premeeting I18n
       $premeeting_model_i18n = new DomoprimePreMeetingModelI18n(null,$this->getSite());       
       $premeeting_model_i18n->add(get_object_vars($this->toArray()->getValue('premeeting')->i18n));
       $premeeting_model_i18n->set('model_id',$premeeting_model);
       if ($premeeting_model_i18n->isExist())       
           $premeeting_model_i18n->set('value',"1-".$premeeting_model_i18n->get('value'));       
       $premeeting_model_i18n->save();   
       
       $premeeting_polluter=new DomoprimePolluterPreMeeting($this->getPolluter(),$this->getSite());
       $premeeting_polluter->set('model_id',$premeeting_model)->save(); 
       
           
       $premeeting_model_pdf=new File($this->getPath()."/premeetings/".(string)$this->toArray()->getValue('premeeting')->i18n->id."/".$premeeting_model_i18n->get('file'));
       $premeeting_model_pdf->copy($premeeting_model_i18n->getDirectory());
       
       
       // after
       $after_model = new DomoprimeAfterWorkModel(null,$this->getSite());
       $after_model->add($this->toArray()->getValue('afterwork'))->save();
       //premeeting I18n
       $after_model_i18n = new DomoprimeAfterWorkModelI18n(null,$this->getSite());       
       $after_model_i18n->add(get_object_vars($this->toArray()->getValue('afterwork')->i18n));
       $after_model_i18n->set('model_id',$after_model);
       if ($after_model_i18n->isExist())       
           $after_model_i18n->set('value',"1-".$after_model_i18n->get('value'));       
       $after_model_i18n->save();   
       
       $after_polluter=new DomoprimePolluterAfterWork($this->getPolluter(),$this->getSite());
       $after_polluter->set('model_id',$after_model)->save(); 
       
           
       $after_model_pdf=new File($this->getPath()."/afterworks/".(string)$this->toArray()->getValue('afterwork')->i18n->id."/".$after_model_i18n->get('file'));
       $after_model_pdf->copy($after_model_i18n->getDirectory());
             
       // Pictures      
       if ($this->getPolluter()->hasLogo())
       {
            $picture=new File($this->getPicturePath()."/polluter/".$this->getPolluter()->get('logo'));
            $picture->copy($this->getPolluter()->getDirectory());
       } 
       if ($this->getPolluter()->hasSignature())
       {
            $picture=new File($this->getPicturePath()."/polluter/".$this->getPolluter()->get('signature'));
            $picture->copy($this->getPolluter()->getDirectory());
       } 
      if ($this->getPolluter()->hasPicture())
       {
            $picture=new File($this->getPicturePath()."/polluter/".$this->getPolluter()->get('picture'));
            $picture->copy($this->getPolluter()->getDirectory());
       } 
       if ($this->getRecipient()->hasLogo())
       {
            $picture=new File($this->getPicturePath()."/recipient/".$this->getRecipient()->get('logo'));
            $picture->copy($this->getRecipient()->getDirectory());
       }  
       if ($this->getRecipient()->hasSignature())
       {
            $picture=new File($this->getPicturePath()."/recipient/".$this->getRecipient()->get('signature'));
            $picture->copy($this->getRecipient()->getDirectory());
       }  
       $classes_xml=new PartnerPolluterClassCollectionXmlExtractor($this->getPolluter(),$this->getPath());
       $classes_xml->extract();
       return $this;                        
    }
}
