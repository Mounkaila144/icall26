<?php


class DomoprimeIsoEngine extends DomoprimeEngine {
     
  
    function __construct($data) {       
       if ($data instanceof CustomerMeeting)       
       {                                    
          $this->contract=new CustomerContract($data,$data->getSite());
          $this->form_request=new DomoprimeCustomerRequest($data,$data->getSite());
          $this->customer=$data->getCustomer();
          $this->site=$data->getSite();
          $this->meeting=$data;
       } 
       elseif ($data instanceof CustomerContract) 
       {                  
          $this->contract=$data;
          $this->customer=$data->getCustomer();
          $this->form_request=new DomoprimeCustomerRequest($data,$data->getSite());
          $this->site=$data->getSite();
          if ($this->contract->getMeeting()->isLoaded())
          {              
              $this->meeting=$this->contract->getMeeting();
          }    
       } 
       else
           throw new mfException(__("Contract/Meeting are invalid."));
    //   var_dump($this->forms);
       $this->configure();  
    }
   
    function getFormRequest()
    {
       return $this->form_request;    
    }
    
    function loadEnergyFromForms()
    {                        
        $this->energy=$this->getFormRequest()->getEnergy();          
        return $this->energy;
    }
    
    function loadRevenueFromForms()
    {
       $this->revenue=$this->getFormRequest()->get('revenue');
       return $this->revenue;
    }
    
    function loadNumberOfPeopleFromForms()
    {
        $this->number_of_people= $this->getFormRequest()->get('number_of_people');
        return $this->number_of_people;
    }
    
    function loadSurfacesFromForms()
    {
         $this->surfaces_forms=array();         
         foreach ($this->getSettings()->getSurfaceNamingsForProducts() as $product_id=>$surface)
         {               
             $this->surfaces_forms[$product_id]=$this->getFormRequest()->get($surface);
         }                    
         return $this->surfaces_forms;
    }
    
    function getName()
    {
        return "ISOCumacEngine";
    }
}
