<?php

class CustomerMeetingMutualBase  extends CustomerMeetingBase {
    
    //Added for mutual products
    
    function loadSelectedMutualProductsWithCommissionsAndDecommissionsForMeeting($duration)//load
    {
        $mutuals = new MutualPartnerCollectionForEngine();
        $db=mfSiteDatabase::getInstance()
                ->setObjects(array("MutualProductForEngine","MutualPartnerForEngine","MutualPartnerParamsForEngine","CustomerMeetingMutualProductForEngine"))                       
                ->setParameters(array("meeting_id"=> $this->get('id')))                       
                ->setQuery("SELECT {fields} FROM ". MutualProductForEngine::getTable().                                  
                           " INNER JOIN ".MutualPartnerForEngine::getTable().
                                " ON ". MutualProductForEngine::getTableField("financial_partner_id")."=".
                                        MutualPartnerForEngine::getTableField("id").
                           " INNER JOIN ". MutualPartnerParamsForEngine::getInnerForJoin("financial_partner_id").
                           " INNER JOIN ". CustomerMeetingMutualProductForEngine::getInnerForJoin("product_id").
                           " WHERE ".CustomerMeetingMutualProductForEngine::getTableField("meeting_id")."='{meeting_id}'".
                           ";")
                ->makeSiteSqlQuery($this->getSite());  
//        echo $db->getQuery()."<br />";
        if(!$db->getNumRows())
            return $mutuals;
        
        while($items = $db->fetchObjects())
        {
            $mutual = $items->getMutualPartnerForEngine();
            $mutual->setParams($items->getMutualPartnerParamsForEngine());
            $mutual_product = $items->getMutualProductForEngine();
            $meeting_product = $items->getCustomerMeetingMutualProductForEngine();
            $meeting_product->setProductForEngine($mutual_product);
            if(isset($mutuals[$mutual->get('id')]))
                $mutual = $mutuals[$mutual->get('id')];
            $mutual->addProductForEngine($mutual_product);
            $mutual->addSelectedProductForEngine($meeting_product);
            $mutuals[$mutual->get('id')] = $mutual;
        }
        
        //getCommissions For products   
        $date_commission = date("Y-m-d H:i:s");
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('date'=>$date_commission,'duration'=>$duration,"meeting_id"=> $this->get("id")))                       
            ->setObjects(array("MutualProductForEngine","MutualProductCommissionForEngine","CustomerMeetingMutualProductForEngine"))                     
            ->setQuery("SELECT {fields} FROM ". MutualProductCommissionForEngine::getTable().                                   
                       " INNER JOIN ". MutualProductCommissionForEngine::getOuterForJoin('mutual_product_id').
                       " INNER JOIN ". CustomerMeetingMutualProductForEngine::getInnerForJoin("product_id").
                       " WHERE ". MutualProductForEngine::getTableField('id')." IN (".$mutuals->getProductsIds()->getKeys()->implode(',').")".
                       " AND ".MutualProductCommissionForEngine::getTableField('started_at')."<= '{date}' ".
                       " AND ".MutualProductCommissionForEngine::getTableField('ended_at').">= '{date}' ".
                       " AND ".MutualProductCommissionForEngine::getTableField('from')."<= {duration} ".
                       " AND ".MutualProductCommissionForEngine::getTableField('to').">= {duration} ".
                       " AND ".CustomerMeetingMutualProductForEngine::getTableField('meeting_id')."='{meeting_id}' ".
                       ";")
            ->makeSiteSqlQuery($site);  
//        echo $db->getQuery()."<br />";
        if(!$db->getNumRows())
            return $mutuals;
        while($items = $db->fetchObjects())
        {
            $item = $items->getMutualProductCommissionForEngine();
            $item->setMutualProduct($items->getMutualProductForEngine());
            $mutuals[$item->getMutualProduct()->get('financial_partner_id')]->getProductByKey($item->getMutualProduct()->get('id'))->addCommission($item);
            $mutuals[$item->getMutualProduct()->get('financial_partner_id')]->getSelectedgetProductsForEngine()->getItemByKey($items->getCustomerMeetingMutualProductForEngine()->get('id'))->addCommission($item);
        }
        
        //getDecommissions For products   
        $date_decommission = date("Y-m-d H:i:s");
        
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('date'=>$date_decommission,'duration'=>$duration,"meeting_id"=> $this->get('id')))                           
            ->setObjects(array("MutualProductForEngine","MutualProductDecommissionForEngine","CustomerMeetingMutualProductForEngine"))                     
            ->setQuery("SELECT {fields} FROM ". MutualProductDecommissionForEngine::getTable().                                   
                       " INNER JOIN ". MutualProductDecommissionForEngine::getOuterForJoin('mutual_product_id').
                       " INNER JOIN ". CustomerMeetingMutualProductForEngine::getInnerForJoin("product_id").
                       " WHERE ". MutualProductForEngine::getTableField('id')." IN (".$mutuals->getProductsIds()->getKeys()->implode(',').")".
                       " AND ".MutualProductDecommissionForEngine::getTableField('started_at')."<= '{date}' ".
                       " AND ".MutualProductDecommissionForEngine::getTableField('ended_at').">= '{date}' ".
                       " AND ".MutualProductDecommissionForEngine::getTableField('from')."<= {duration} ".
                       " AND ".MutualProductDecommissionForEngine::getTableField('to').">= {duration} ".
                       " AND ".CustomerMeetingMutualProductForEngine::getTableField('meeting_id')."='{meeting_id}' ".
                       ";")
            ->makeSiteSqlQuery($site);            
//        echo $db->getQuery()."<br />";
        if(!$db->getNumRows())
            return $mutuals;
        while($items = $db->fetchObjects())
        {
            $item = $items->getMutualProductDecommissionForEngine();
            $item->setMutualProduct($items->getMutualProductForEngine());
            $mutuals[$item->getMutualProduct()->get('financial_partner_id')]->getProductByKey($item->getMutualProduct()->get('id'))->addDecommission($item);
            $mutuals[$item->getMutualProduct()->get('financial_partner_id')]->getSelectedgetProductsForEngine()->getItemByKey($items->getCustomerMeetingMutualProductForEngine()->get('id'))->addDecommission($item);
        }
        
        return $mutuals;
    }
    
    function getStart()
    {
        return  new DateTime($this->get('created_at'));
    }
    
    function getEnd()
    {
        return new DateTime($this->get('opc_at'));
    }
    
    function hasEnd()
    {
        return (boolean)$this->get('opc_at');
    }
    
    function setCustomer(Customer $customer)
    {
        $this->_customer_id = $customer;
        return $this;
    }
    
    public static function getValidMeetingsForCalculation($site=null)
    {
        /*
            SELECT * FROM `t_customers_meeting` 
            LEFT JOIN `t_app_mutual_engine_calculation_meeting` 
                    ON `t_customers_meeting`.id=`t_app_mutual_engine_calculation_meeting`.`meeting_id` 
                AND (`t_customers_meeting`.`opc_at` IS NULL OR (`t_customers_meeting`.`opc_at`>`t_app_mutual_engine_calculation_meeting`.`date_calculation`))
                AND (`t_app_mutual_engine_calculation_meeting`.`is_last`='YES')
        */
        //testet si la date opc_at est soit null ou > date_calculation pour la dérnière calculation
        
        $meetings = new mfArray();
        
        $db=mfSiteDatabase::getInstance()                       
                ->setParameters(array())     
                ->setObjects(array('CustomerMeetingMutual','MutualEngineCalculationMeeting','MutualEngineCalculationMeetingScheduler'))
                ->setQuery("SELECT {fields} FROM ". CustomerMeetingMutual::getTable().                         
                           " LEFT JOIN ". MutualEngineCalculationMeeting::getInnerForJoin("meeting_id").
                                " AND (".CustomerMeetingMutual::getTableField("opc_at")." IS NULL ".
                                " OR (".CustomerMeetingMutual::getTableField("opc_at").">".MutualEngineCalculationMeeting::getTableField("date_calculation").
                                    " AND (".MutualEngineCalculationMeeting::getTableField("is_last")."='YES')))".
                           " LEFT JOIN ".MutualEngineCalculationMeetingScheduler::getInnerForJoin("meeting_id").
                           " WHERE ".MutualEngineCalculationMeetingScheduler::getTableField("id")." IS NULL ".
                           " LIMIT 0,50".
                           ";")
                ->makeSiteSqlQuery($site); 
        
        if(!$db->getNumRows())
            return $meetings;
        
        while($items = $db->fetchObjects())
        {
            $meetings[$items->getCustomerMeetingMutual()->get('id')]=$items->getCustomerMeetingMutual();
        }
        
        return $meetings;
    }
}
