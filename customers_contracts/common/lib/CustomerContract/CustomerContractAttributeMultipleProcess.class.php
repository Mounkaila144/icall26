<?php

class CustomerContractAttributeMultipleProcess extends MultipleProcessCore {
   
    
    function process()
    {
        $query=new mfArray();
        $params=array();
        if ($this->getActions()->in('team'))
        {                      
            foreach ($this->getParameter('team') as $name=>$value)
            {
                if ($name=='team_id' && $value===null)
                    continue;
                $query[]= CustomerContractContributor::getTableField($name)."=".($value===null?" NULL ":"'{".$name."}'");   
            }            
            $db=mfSiteDatabase::getInstance()
                ->setParameters($this->getParameter('team'))                
                ->setQuery("UPDATE ". CustomerContractContributor::getTable().
                           " INNER JOIN ".CustomerContractContributor::getOuterForJoin('contract_id').
                           " SET ".$query->implode().
                           " WHERE ".CustomerCOntract::getTableField('id')." IN('".$this->getSelection()->implode("','")."') AND type='team'".
                           " AND is_hold='NO'".
                           ";")                        
                ->makeSiteSqlQuery($this->getSite()); 
          //  echo $db->getQuery();        
           $params=$this->getParameter('team');
           if ($params['team_id'])
           {                  
            // Contract
            $db=mfSiteDatabase::getInstance()
                ->setParameters($this->getParameter('team'))                
                ->setQuery("UPDATE ". CustomerContract::getTable().                         
                           " SET team_id='{team_id}'".
                           " WHERE ".CustomerCOntract::getTableField('id')." IN('".$this->getSelection()->implode("','")."') ".
                           " AND is_hold='NO'".
                           ";")                        
                ->makeSiteSqlQuery($this->getSite());            
           }
        }    
        $query=new mfArray();
        foreach (array('telepro','sale1'=>'sale_1','sale2'=>'sale_2','assistant','manager') as $name=>$type)
        {           
            $field =$type;
            $type= is_numeric($name)?$type:$name;                 
            if ($this->getActions()->in($type))
            {           
                foreach ($this->getParameter($type) as $name=>$value)
                {
                    if ($name=='user_id' && $value===null || $name=='team_id')
                        continue;                             
                    $query[]= CustomerContractContributor::getTableField($name)."=".($value===null?" NULL ":"'{".$name."}'");            
                }                                  
                $db=mfSiteDatabase::getInstance()
                    ->setParameters($this->getParameter($type))                
                    ->setParameter('type',$field)        
                    ->setQuery("UPDATE ". CustomerContractContributor::getTable().
                               " INNER JOIN ".CustomerContractContributor::getOuterForJoin('contract_id').
                               " SET ".(string)$query->implode().
                               " WHERE ".CustomerContract::getTableField('id')." IN('".$this->getSelection()->implode("','")."') AND type='{type}'".
                               " AND is_hold='NO'".
                               ";")                        
                    ->makeSiteSqlQuery($this->getSite());  
              //  echo $db->getQuery();
                // Contract
                $params=array();
                foreach ($this->getParameter($type) as $name=>$value)    
                {    
                    if ($name=='user_id' && $value===null)
                        continue;
                    $params[$name]=($value===null)?0:$value;                
                }                                                
                if (isset($params['user_id']))
                {                       
                    $db=mfSiteDatabase::getInstance()
                        ->setParameters($params)                
                        ->setQuery("UPDATE ". CustomerContract::getTable().                         
                                   " SET ".$field."_id='{user_id}'".
                                   " WHERE ".CustomerCOntract::getTableField('id')." IN('".$this->getSelection()->implode("','")."') ".
                                   " AND is_hold='NO'".
                                   ";")                        
                        ->makeSiteSqlQuery($this->getSite());                
              //  echo $db->getQuery();
                }
            }               
        }     
        return $this;
    }
    
    
}

