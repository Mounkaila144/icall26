<?php

class customers_contracts_attributionsActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {              
       $contract=$this->getParameter('contract');
       $this->user=$this->getUser();
       
      // echo "<pre>"; var_dump($contract->getContributors()); echo "</pre>";
    } 
    
    
}