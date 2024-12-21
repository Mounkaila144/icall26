<?php

class CustomerContractDateCheckerCollection extends mfArray
{
    protected $is_valid=null;

    function isValid()
    {
        if ($this->is_valid===null)
        {
            $this->is_valid=true;
            foreach ($this->collection as $item)
            {
                if (!$item->isValid())               
                {                     
                    $this->is_valid=false;
                    break;
                }                 
            }             
        }
        return $this->is_valid;
    }    
    
    function getDate($date)
    {
        return $this->collection[$date];
    }
}

class CustomerContractDateChecker {
    
    protected $is_valid=false,$field="";
    
    protected static $fields=array('pre_meeting_at'=>'sav_at',
                                   'quoted_at'=>'pre_meeting_at',
                                   'opened_at'=>'quoted_at',
                                   'billing_at'=>'opened_at',
                                   'doc_at'=>'billing_at',
                                    'opc_at'=>'doc_at'
                        );
    
    protected $contract=null;
    
    function __construct($contract = null, $field="") {
        $this->contract=$contract;        
        $this->field=$field;
        $this->is_valid=$this->process();
    }
    
    function getContract()
    {
        return $this->contract;
    }
    
    function getField()
    {
        return $this->field;
    }
    
    function getField2()
    {
        return isset(self::$fields[$this->getField()])?self::$fields[$this->getField()]:null;
    }
    
    function process()
    {
            if (!$this->getContract()->get($this->getField()))
                return false;        
            $field1= new Day($this->getContract()->get($this->getField()));
            $field2= new Day($this->getContract()->get($this->getField2()));           
            if ($field1->getDate() < $field2->getDate())    
                return false;          
            return true;
    }
    
    function isValid()
    {
        return $this->is_valid;
    }
    
    
    function getColor()
    {
        return $this->isValid()?"#00ff00":"#ff0000";
    }
    
    
}

class CustomerContractDatesCheckerEngine extends mfObjectBase {
     
    protected $contract=null,$errors=null;
    
    function __construct($contract = null, $site = null) {
        $this->contract=$contract;
        $this->errors=new mfArray();
        parent::__construct(null, $site);
    }
    
    /*
     *  " WHERE  pre_meeting_at >= sav_at AND pre_meeting_at IS NOT NULL ".
                            " AND quoted_at >= pre_meeting_at AND quoted_at IS NOT NULL ".
                            " AND opened_at >= quoted_at AND opened_at IS NOT NULL ".
                            " AND billing_at >= opened_at AND billing_at IS NOT NULL ".
                            " AND doc_at >= billing_at AND doc_at IS NOT NULL ".
                            " AND opc_at >= doc_at AND opc_at IS NOT NULL ".
                            " AND status='ACTIVE'".
     */
    
    function getErrors()
    {
        return $this->errors;
    }
    
    function getContract()
    {
        return $this->contract;
    }
        
    function isValid()
    {                    
        $this->errors=new mfArray();
        foreach (array('pre_meeting_at'=>'getPreMeetingAt','quoted_at'=>'getQuotedAt','opened_at'=>'getOpenedAt',
                       'billing_at'=>'getBillingAt','doc_at'=>'getDocAt','opc_at'=>'getOpcAt') as $field=>$method)
        {
            if (!$this->getContract()->hasPropertyChanged($field))
               continue ;
            if (!$this->$method()->isValid())
            {                    
                $this->getErrors()->push(__('%s >= %s',[__($this->$method()->getField()),__($this->$method()->getField2())]));                              
                return false;
            }                                                          
        }       
        return true;
    }        
    
    function getPreMeetingAt()
    {
        return $this->pre_meeting_at=$this->pre_meeting_at===null?new CustomerContractDateChecker($this->getContract(),'pre_meeting_at'):$this->pre_meeting_at;
    }
    
    function getQuotedAt()
    {
        return $this->quoted_at=$this->quoted_at===null?new CustomerContractDateChecker($this->getContract(),'quoted_at'):$this->quoted_at;
    }
        
    function getOpenedAt()
    {
        return $this->opened_at=$this->opened_at===null?new CustomerContractDateChecker($this->getContract(),'opened_at'):$this->opened_at;
    }
    
    function getBillingAt()
    {
        return $this->billing_at=$this->billing_at===null?new CustomerContractDateChecker($this->getContract(),'billing_at'):$this->billing_at;
    }
    
    function getDocAt()
    {
        return $this->doc_at=$this->doc_at===null?new CustomerContractDateChecker($this->getContract(),'doc_at'):$this->doc_at;
    }
    
     function getOpcAt()
    {
        return $this->opc_at=$this->opc_at===null?new CustomerContractDateChecker($this->getContract(),'opc_at'):$this->opc_at;
    }
    
    
    
    function getDates()
    {
        if ($this->dates===null)
        {    
            $this->dates=new CustomerContractDateCheckerCollection();
            foreach (array('pre_meeting_at'=>'getPreMeetingAt','quoted_at'=>'getQuotedAt','opened_at'=>'getOpenedAt',
                       'billing_at'=>'getBillingAt','doc_at'=>'getDocAt','opc_at'=>'getOpcAt') as $field=>$method)                   
                $this->dates[$field]=$this->$method();       
        }       
        return $this->dates;
    }
}
