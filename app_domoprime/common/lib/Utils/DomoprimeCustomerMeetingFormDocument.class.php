<?php

class DomoprimeCustomerMeetingFormDocument extends CustomerMeetingFormDocumentBase  {
     
    
    
     
     
      static function getDocumentsForContract(CustomerContract $contract)
    {              
        if ($contract->isNotLoaded())
             throw new mfException(__("Contract is invalid.")); 
        $calculation=new DomoprimeCalculation($contract,$contract->getSite());
        if ($calculation->isNotLoaded())
            throw new mfException(__("Calculation doesn't exist."));
        if ($calculation->getClass()->isNotLoaded())
            throw new mfException(__("Calculation class doesn't exist."));                                
            // get data forms from meeting                
        $form_data=new CustomerMeetingForms($contract,$contract->getSite());
            // get all documents with conditions
        $documents=new CustomerMeetingFormDocumentCollection(null,$contract->getSite());   
        $db=mfSiteDatabase::getInstance();
        if (DomoprimeSettings::load($contract->getSite())->getClassicClass()->get('id')==$calculation->getClass()->get('id'))
        {                              
             $db->setParameters(array('class_id'=>$calculation->getClass()->get('id')))
                       ->setObjects(array('CustomerMeetingFormDocument','CustomerMeetingFormDocumentFormfield',
                                     'CustomerMeetingForm',
                                     'CustomerMeetingFormfield'))
                      ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormDocument::getTable().
                                " INNER JOIN ".CustomerMeetingFormDocumentFormfield::getInnerForJoin('document_id').
                                " INNER JOIN ".CustomerMeetingFormDocumentFormfield::getOuterForJoin('formfield_id').
                                " INNER JOIN ".DomoprimeCustomerMeetingFormDocumentClass::getInnerForJoin('form_document_id').
                                " INNER JOIN ".CustomerMeetingFormfield::getOuterForJoin('form_id').  
                                " WHERE class_id='{class_id}' AND ".CustomerMeetingFormDocument::getTableField('type')."=1".
                                ";")
                   ->makeSiteSqlQuery($contract->getSite()); 
         } 
         else
         {                               
                    $db->setParameters(array())
                      ->setObjects(array('CustomerMeetingFormDocument','CustomerMeetingFormDocumentFormfield',
                                     'CustomerMeetingForm',
                                     'CustomerMeetingFormfield'))
                      ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormDocument::getTable().
                            " INNER JOIN ".CustomerMeetingFormDocumentFormfield::getInnerForJoin('document_id').
                            " INNER JOIN ".CustomerMeetingFormDocumentFormfield::getOuterForJoin('formfield_id').
                            " INNER JOIN ".CustomerMeetingFormfield::getOuterForJoin('form_id').  
                            " WHERE ".CustomerMeetingFormDocument::getTableField('type')."=0".
                            ";")
                   ->makeSiteSqlQuery($contract->getSite());
         }
         //  echo $db->getQuery();
            if ($db->getNumRows())
            {
                while ($items=$db->fetchObjects())
                {                                
                    if (!isset($documents[$items->getCustomerMeetingFormDocument()->get('id')]))
                        $documents[$items->getCustomerMeetingFormDocument()->get('id')]=$items->getCustomerMeetingFormDocument(); 
                    if (!$items->hasCustomerMeetingFormDocumentFormfield())
                        continue;
                    $item=$items->getCustomerMeetingFormDocumentFormfield();
                    $item->set('form_id',$items->getCustomerMeetingForm()); 
                    $documents[$items->getCustomerMeetingFormDocument()->get('id')]->addFormField($item);
                }        
            }    
            // loop des docs => forms dans le document si OK => liste si non KO         
            foreach ($documents->getKeys() as $key)
            {
                $document=$documents[$key];
                $ret=$document->isExist($form_data);
                if (!$ret)
                  unset($documents[$key]) ;
            }    

     //   echo "<pre>"; var_dump($documents); echo "</pre>"; 
        return $documents;
    }        
    
    
     static function getDocumentForContract(CustomerContract $contract)
     {
         $documents=self::getDocumentsForContract($contract);
         
         return $documents->getFirst();
     }
     
     static function getPolluterDocumentsForContract(CustomerContract $contract)
     {
        $documents=self::getDocumentsForContract($contract);
        
        $polluter_documents=new PartnerPolluterDocumentCollection(null,$contract->getSite());        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('polluter_id'=>$contract->getPolluter()->get('id')))
                ->setObjects(array('CustomerMeetingFormDocument','PartnerPolluterDocument'))                       
                ->setQuery("SELECT {fields} FROM ".PartnerPolluterDocument::getTable().
                           " INNER JOIN ".PartnerPolluterDocument::getOuterForJoin('document_id').
                            " WHERE polluter_id='{polluter_id}' AND document_id IN('".implode("','",$documents->getKeys())."')".
                            ";")
                    ->makeSiteSqlQuery($contract->getSite());  
        //echo $db->getQuery();
        if ($db->getNumRows())
        {
            while ($items=$db->fetchObjects())
            {                                
               $item=$items->getPartnerPolluterDocument();
               $item->set('document_id',$items->getCustomerMeetingFormDocument());               
               $polluter_documents[$item->get('id')]=$item;   
            }        
        }                
        return $polluter_documents;  
     }
     
     
     static function getDocumentPolluterForContract(CustomerContract $contract)
     {
         $documents=self::getPolluterDocumentsForContract($contract);
         
         return $documents->getFirst();
     }
     
     
     static function getDocumentsPolluterForContract(CustomerContract $contract)
     {
         return self::getPolluterDocumentsForContract($contract);        
     }
}
