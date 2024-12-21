<?php


class DomoprimePartnerPolluterModelUtilsBase {
    

       static function getModelsByDocumentForPolluterFromSelection(DomoprimePollutingCompany $polluter,mfArray $selection,$lang=null)
    {                    
        $collection=new PartnerPolluterModelCollection(null,$polluter->getSite());
        if ($polluter->isNotLoaded())
            return $collection;
        $settings= new DomoprimeIsoSettings(null,$polluter->getSite());        
        $documents=$settings->getDocuments();                   
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array(
                            'polluter_id'=>$polluter->get('id'),
                            'lang'=>$lang?$lang:mfContext::getInstance()->getUser()->getLanguage()))
                ->setObjects(array('PartnerPolluterModelI18n','PartnerPolluterModel','PartnerPolluterDocument','CustomerMeetingFormDocument'))
                ->setQuery("SELECT {fields} FROM ".PartnerPolluterModelI18n::getTable().                            
                           " INNER JOIN ".PartnerPolluterModelI18n::getOuterForJoin('model_id').
                           " INNER JOIN ".PartnerPolluterDocument::getInnerForJoin('model_id').
                           " INNER JOIN ".PartnerPolluterDocument::getOuterForJoin('document_id').
                           " WHERE ".PartnerPolluterModelI18n::getTableField('lang')."='{lang}' ".
                                   " AND ".PartnerPolluterModel::getTableField('polluter_id')."='{polluter_id}' ".
                                   " AND ".PartnerPolluterDocument::getTableField('document_id')." IN('".(string)$documents->getIDs()->implode("','")."')".                        
                                   ($selection->isEmpty()?"":" AND model_id IN('".$selection->implode("','")."')").                                   
                           ";")               
                ->makeSiteSqlQuery($polluter->getSite()); 
         //echo $db->getQuery();     
        if (!$db->getNumRows())
            return $collection;        
        while ($items=$db->fetchObjects())
        {
            foreach ($documents as $name=>$document)
            {
                if (isset($collection[$name]))
                   continue;
                if ($document->get('id')==$items->getCustomerMeetingFormDocument()->get('id'))
                {
                   $item=$items->getPartnerPolluterModel()->setI18n($items->getPartnerPolluterModelI18n());
                   $item->set('name',$name);
                   $item->getI18n()->set('value',$name);
                   $collection[$name]=$item;
                }   
            }             
        }             
      //  echo "<pre>"; var_dump($collection);
       //   die(__METHOD__);
        return $collection;
    }
}


