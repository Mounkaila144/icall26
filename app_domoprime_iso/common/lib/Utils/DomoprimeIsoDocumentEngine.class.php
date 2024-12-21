<?php


class DomoprimeIsoDocumentEngine {
    
    protected $request=null,$contract=null,$document=null,$calculation=null,$settings=null;
    
    function __construct($contract) {  
        $this->contract=$contract;
        $this->request=new DomoprimeCustomerRequest($contract,$contract->getSite());  
       
        $this->calculation=new DomoprimeCalculation($contract,$contract->getSite());
        
        if ($this->calculation->isNotLoaded())
            throw new mfException(__('Calculation is invalid'));
        $this->settings= new DomoprimeIsoSettings(null,$contract->getSite());
    }
    
    function getCalculation()
    {
        return $this->calculation;
    }
    
    function getRequest()
    {
        return $this->request;
    }
    
    function getContract()
    {
        return $this->contract;
    }
    
    function getDocument()
    {
        return $this->document;
    }
        
    function getName()
    {
        return $this->name;
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    function process()
    {
        $occupation=in_array($this->getRequest()->getOccupation()->get('name'),array(0,2,'R1'))?"R1":"R2"; 
        $class="";
        if ($this->getCalculation()->getClass()->get('id') == $this->getSettings()->getClassicClass()->get('id'))
            $class="Classic";               
        // 102: surface_wall
        // 101: surface_top
        // 103: surface_floor
        $doc="";
        if ($this->getRequest()->get('surface_top') > 0)
        {
            $doc="101";
        }
        if ($this->getRequest()->get('surface_wall') > 0)
        {
           $doc.="102"; 
        }
        if ($this->getRequest()->get('surface_floor') > 0)
        {
            $doc.="103";
        }
        if ($doc=="")
            return $this;
        $this->name=$doc.$occupation.$class;
        $method="get".$doc.$occupation.$class."Model";              
        if (!method_exists($this->getSettings(),$method))
            throw new mfException(__("Document doesn't exist."));
        $this->document =$this->getSettings()->$method();
        return $this;
    }
    
    
    function hasDocument()
    {
        if ($this->document==null)
            return false;
        return $this->document->isLoaded();
    }
    
    function hasGenerator()
    {
        return false;
    }
}
