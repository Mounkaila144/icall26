<?php

class DomoprimePreMeetingModelUtils {
    
    
    static function getPollutersFromPager($pager)
    {       
       if (!$pager->hasItems())
            return null;
       foreach ($pager as $item)
           $item->polluters=new PartnerPolluterCompanyCollection($pager->getSite());
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())              
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable().",model_id FROM ".DomoprimePolluterPreMeeting::getTable().
                           " INNER JOIN ".DomoprimePolluterPreMeeting::getOuterForJoin('polluter_id').      
                           " WHERE ".DomoprimePolluterPreMeeting::getTableField('model_id')." IN(".implode(",",array_keys($pager->getItems())).")".
                           " GROUP BY ".PartnerPolluterCompany::getTableField('id').",".DomoprimePolluterPreMeeting::getTableField('model_id').
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
        //echo $db->getQuery();
        if (!$db->getNumRows())
            return array();        
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {                 
            //echo $item->get('model_id')."<br/>";
           $pager->items[$item->get('model_id')]->polluters[]=$item;
        }        
    }

}
