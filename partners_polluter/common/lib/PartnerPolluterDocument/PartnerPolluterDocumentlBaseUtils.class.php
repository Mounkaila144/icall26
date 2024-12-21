<?php


class PartnerPolluterDocumentBaseUtils {
    
        
   /* static function getModelsForSelect($lang=null,$site=null)
    {        
        $items=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=>$lang?$lang:  mfcontext::getInstance()->getUser()->getLanguage()))
                ->setQuery("SELECT ".PartnerPolluterModelI18n::getFieldsAndKeyWithTable()." FROM ".PartnerPolluterModelI18n::getTable().                                                 
                           " WHERE lang='{lang}';")               
                ->makeSiteSqlQuery($site); 
        //echo $db->getQuery();
        if (!$db->getNumRows())
            return $items;        
        while ($item=$db->fetchObject('PartnerPolluterModelI18n'))
        {
           $items[$item->get('model_id')]=$item->get('value');
        }     
       // var_dump($items);
        return $items;
    }*/
    
  /* static function getModelsForPolluterForSelect(PartnerPolluterCompany $polluter,$lang=null,$site=null)
    {        
        $items=new mfArray();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array(
                            'polluter_id'=>$polluter->get('id'),
                            'lang'=>$lang?$lang:  mfcontext::getInstance()->getUser()->getLanguage()))
                ->setQuery("SELECT ".PartnerPolluterModelI18n::getFieldsAndKeyWithTable()." FROM ".PartnerPolluterModelI18n::getTable(). 
                           " INNER JOIN ".PartnerPolluterModelI18n::getOuterForJoin('model_id').
                           " WHERE lang='{lang}' AND polluter_id='{polluter_id}';")               
                ->makeSiteSqlQuery($site); 
        //echo $db->getQuery();
        if (!$db->getNumRows())
            return $items;        
        while ($item=$db->fetchObject('PartnerPolluterModelI18n'))
        {
           $items[$item->get('model_id')]=$item->get('value')." (".$item->get('model_id').")";
        }     
       // var_dump($items);
        return $items;
    }*/
    
    
   
    
  /*  static function getModelsForPolluter(PartnerPolluterCompany $polluter,$lang=null)
    {        
        $collection=new PartnerPolluterModelCollection(null,$polluter->getSite());
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array(
                            'polluter_id'=>$polluter->get('id'),
                            'lang'=>$lang?$lang:mfContext::getInstance()->getUser()->getLanguage()))
                ->setObjects(array('PartnerPolluterModelI18n','PartnerPolluterModel'))
                ->setQuery("SELECT {fields} FROM ".PartnerPolluterModelI18n::getTable().                            
                           " INNER JOIN ".PartnerPolluterModelI18n::getOuterForJoin('model_id').
                           " WHERE lang='{lang}' AND polluter_id='{polluter_id}';")               
                ->makeSiteSqlQuery($polluter->getSite()); 
        //echo $db->getQuery();
        if (!$db->getNumRows())
            return $collection;        
        while ($items=$db->fetchObjects())
        {
           $collection[$items->getPartnerPolluterModel()->get('id')]=$items->getPartnerPolluterModel()->setI18n($items->getPartnerPolluterModelI18n());
        }                
        return $collection;
    }*/
    
    
  /*  static function getDocumentsForPolluterFromSelection(DomoprimePollutingCompany $polluter,mfArray $selection,$lang=null)
    {                       
        $collection=new PartnerPolluterDocumentCollection(null,$polluter->getSite());
        if ($polluter->isNotLoaded())
            return $collection;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array(
                            'polluter_id'=>$polluter->get('id'),
                            'lang'=>$lang?$lang:mfContext::getInstance()->getUser()->getLanguage()))
                ->setObjects(array('PartnerPolluterModelI18n','PartnerPolluterModel','PartnerPolluterDocument'))
                ->setQuery("SELECT {fields} FROM ".PartnerPolluterDocument::getTable(). 
                          " INNER JOIN ".PartnerPolluterDocument::getOuterForJoin('model_id').                        
                           " INNER JOIN ".PartnerPolluterModelI18n::getInnerForJoin('model_id').
                           " WHERE lang='{lang}' AND ".PartnerPolluterDocument::getTableField("polluter_id")."='{polluter_id}'".
                           ($selection->isEmpty()?"":" AND ".PartnerPolluterDocument::getTableField('model_id')." IN('".$selection->implode("','")."')").
                           ";")               
                ->makeSiteSqlQuery($polluter->getSite()); 
       // echo $db->getQuery();
        if (!$db->getNumRows())
            return $collection;        
        while ($items=$db->fetchObjects())
        {
          // $collection[$items->getPartnerPolluterModel()->get('id')]=$items->getPartnerPolluterModel()->setI18n($items->getPartnerPolluterModelI18n());
        }                
        return $collection;
    }*/
    
    static function getDocumentsForPolluterFromDocumentSelection(DomoprimePollutingCompany $polluter,CustomerMeetingFormDocumentCollection $selection,$lang=null)
    {                       
        $collection=new PartnerPolluterDocumentCollection(null,$polluter->getSite());
        if ($polluter->isNotLoaded())
            return $collection;
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array(
                            'polluter_id'=>$polluter->get('id'),
                            'lang'=>$lang?$lang:mfContext::getInstance()->getUser()->getLanguage()))
                ->setObjects(array('PartnerPolluterModelI18n','PartnerPolluterModel','PartnerPolluterDocument'))
                ->setQuery("SELECT {fields} FROM ".PartnerPolluterDocument::getTable(). 
                          " INNER JOIN ".PartnerPolluterDocument::getOuterForJoin('model_id').                        
                           " INNER JOIN ".PartnerPolluterModelI18n::getInnerForJoin('model_id').
                           " WHERE lang='{lang}' AND ".PartnerPolluterDocument::getTableField("polluter_id")."='{polluter_id}'".
                           ($selection->isEmpty()?"":" AND ".PartnerPolluterDocument::getTableField('document_id')." IN('".$selection->implode("','")."')").
                           ";")               
                ->makeSiteSqlQuery($polluter->getSite()); 
        // echo $db->getQuery();
        if (!$db->getNumRows())
            return $collection;        
        while ($items=$db->fetchObjects())
        {
             $item=$items->getPartnerPolluterDocument();
             $item->set('model_name',$selection[$item->get('document_id')]->get('model_name'));
             $item->set('model_id',$items->getPartnerPolluterModel());
             $item->getModel()->setI18n($items->getPartnerPolluterModelI18n());
             $collection[$item->get('id')]=$item;
        }                
        return $collection;
    }
}

