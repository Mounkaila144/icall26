<?php


class AppMutualEngineCore {
    
    protected $meeting = null;
    protected $products = null;
    protected $duration = null;
    protected $commission_total = 0.0;
    protected $decommission_total = 0.0;
    protected $date_calculation = null;
    
    function __construct(CustomerMeetingMutual $meeting,$date=null) {
        $this->meeting = $meeting;
        //calculer la durée du meeting en mois 
        $this->date_calculation = ($date===null)?$this->getMeeting()->getEnd():new DateTime($date);
        $this->duration = $this->date_calculation->diff($this->getMeeting()->getStart());
       
        //recuperer la list des produit avec la mutuelle et ces paramètres
        $this->products = $this->meeting->loadSelectedMutualProductsWithCommissionsAndDecommissionsForMeeting($this->getMeetingDurationInMounths());
        $this->products->setEngine($this);
    }
    
    function getGlobalCommission()
    {
        return $this->commission_total;
    }
            
    function getGlobalDecommission()
    {
        return $this->decommission_total;
    }
            
    function getProducts()
    {
        return $this->products;
    }
    
    function getMeeting()
    {
        return $this->meeting;
    }
    
    function getMeetingDurationInMounths()
    {
        return $this->duration->format('%m');
    }
    
    function process()
    {
        $this->products->process();
        $this->commission_total = $this->products->getTotalCommission();
        $this->decommission_total = $this->products->getTotalDecommission();
    }
    
    function getCalculationDate()
    {
        return $this->date_calculation;
    }
    
}
