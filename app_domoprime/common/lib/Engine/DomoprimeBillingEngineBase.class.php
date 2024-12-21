<?php

class DomoprimeBillingEngine  {
    
    protected $quotation=null,$pourcentage=null,$is_over=false,$products=null,$state;
    
    function __construct(DomoprimeQuotation $quotation,$pourcentage,CustomerContractAdminStatus $state,$user) {
        $this->quotation=$quotation;
        $this->pourcentage=$pourcentage;
        $this->site=$quotation->getSite();
        $this->state=$state;
        $this->user=$user; 
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getState()
    {
        return $this->state;
    }
    
     function getPourcentage()
    {
        return $this->pourcentage;
    }

    function getSite()
    {
        return $this->site;
    }

    function getQuotation()
    {
        return $this->quotation;
    }
    
    function isOver()
    {
        return $this->is_over;
    }
    
    function getProducts()
    {
        return $this->products;
    }
    /*
     * SELECT t_domoprime_billing.company_id,partner_layer_id FROM `t_domoprime_billing`
INNER JOIN t_customers_contract ON t_customers_contract.id=t_domoprime_billing.contract_id
WHERE t_domoprime_billing.company_id IS NOT NULL 
AND dated_at > '2030-01-01 00:00:00'  AND dated_at < '2030-12-31 23:59:59'
     */
    /*
     * SELECT count(*) FROM `t_domoprime_billing`
INNER JOIN t_customers_contract ON t_customers_contract.id=t_domoprime_billing.contract_id
WHERE partner_layer_id=1
     * 
   SELECT count(*) FROM `t_domoprime_billing`
INNER JOIN t_customers_contract ON t_customers_contract.id=t_domoprime_billing.contract_id
     */
    function process()
    {       
        $this->is_over=false;         
        $day = $this->getQuotation()->getContract()->getBillingAtDate();        
        $query_state = $this->getState()->isLoaded() ? "AND ".CustomerContract::getTableField('admin_status_id')."='{state_id}'":"";        
        $db=mfSiteDatabase::getInstance()
           ->setParameters(array( //'partner_layer_id'=>$this->getQuotation()->getContract()->getPartnerLayer()->get('id'),
                                       'start_at'=>$day->getFirstDayOfYear()->getDate(),
                                       'end_at'=>$day->getLastDayOfYear()->getDate(),
                                       'state_id'=>$this->getState()->get('id'),                                     
                                      ));        
        if ($this->getUser()->hasCredential(array(array('app_domoprime_contract_creation_billing_company_ratio'))))
        {    
            if (!$this->getQuotation()->hasCompany())
                    return $this;                       
            $db->setParameter('company_id',$this->getQuotation()->get('company_id'));           
            $query="SELECT COUNT(".DomoprimeBilling::getTableField('id').") as number_of_billings FROM ". DomoprimeBilling::getTable().                          
                    " INNER JOIN ".DomoprimeBilling::getOuterForJoin('contract_id').
                    " WHERE ".DomoprimeBilling::getTableField('company_id')."='{company_id}' AND partner_layer_id !=0 ".$query_state.   
                             " AND dated_at > '{start_at} 00:00:00' AND dated_at < '{end_at} 23:59:59' ".  
                             " AND is_last='YES'".
                    ";";         
        }
        else
        {          
            $query="SELECT COUNT(".DomoprimeBilling::getTableField('id').") as number_of_billings FROM ". DomoprimeBilling::getTable().                          
                    " INNER JOIN ".DomoprimeBilling::getOuterForJoin('contract_id').
                    " WHERE partner_layer_id !=0 ".$query_state.   
                             " AND dated_at > '{start_at} 00:00:00' AND dated_at < '{end_at} 23:59:59' ".  
                             " AND is_last='YES'".
                    ";";     
        }            
         $db->setQuery($query)
           ->makeSiteSqlQuery($this->getSite());          
        $row=$db->fetchArray();
        $total_layer = floatval($row['number_of_billings']);                               
         if ($total_layer == 0)
             return $this;
         if ($this->getUser()->hasCredential(array(array('app_domoprime_contract_creation_billing_company_ratio'))))
         {
             if ($this->getQuotation()->getContract()->hasPartnerLayer() && $this->getQuotation()->hasCompany())
             {                 
                 $total_layer++; 
             }
         }
         else
         {
             if ($this->getQuotation()->getContract()->hasPartnerLayer())
                 $total_layer++; 
         }  
         
          $db->setParameters(array( 'start_at'=>$day->getFirstDayOfYear()->getDate(),
                                  'end_at'=>$day->getLastDayOfYear()->getDate()));
         if ($this->getUser()->hasCredential(array(array('app_domoprime_contract_creation_billing_company_ratio'))))
         {
              $db->setParameter('company_id',$this->getQuotation()->get('company_id'));
               $query_all="SELECT COUNT(".DomoprimeBilling::getTableField('id').") as number_of_billings FROM ". DomoprimeBilling::getTable().                                               
                      " INNER JOIN ".DomoprimeBilling::getOuterForJoin('contract_id').
                      " WHERE  ".DomoprimeBilling::getTableField('company_id')."='{company_id}' ".
                               " AND dated_at > '{start_at} 00:00:00' AND dated_at < '{end_at} 23:59:59' AND is_last='YES'".                  
                      ";";
         }   
         else
         {
             $query_all="SELECT COUNT(".DomoprimeBilling::getTableField('id').") as number_of_billings FROM ". DomoprimeBilling::getTable().                                               
                      " INNER JOIN ".DomoprimeBilling::getOuterForJoin('contract_id').
                      " WHERE  dated_at > '{start_at} 00:00:00' AND dated_at < '{end_at} 23:59:59' AND is_last='YES'".                  
                      ";";
         }             
           $db->setQuery($query_all)
              ->makeSiteSqlQuery($this->getSite());  
         $row=$db->fetchArray();  
         $total = floatval($row['number_of_billings']) + 1 ;                   
         if ($total_layer > ($total * $this->getPourcentage()))
            $this->is_over=true;
        return $this;
    }        
}
