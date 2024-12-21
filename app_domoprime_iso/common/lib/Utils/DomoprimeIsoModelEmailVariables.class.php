<?php


class DomoprimeIsoModelEmailVariables extends UtilsModelVariables {
    
    
    function configure($dictionnary='dictionary')
    {
        $this->variables= new mfARray(array(          
            'contract.request.revenue'=>__('Revenu',[],$dictionnary),
            'contract.request.number_of_people'=>__('Number of people',[],$dictionnary),
            'contract.request.surface_wall'=>__('Wall surface',[],$dictionnary),
            'contract.request.surface_top'=>__('Top surface',[],$dictionnary),
            'contract.request.surface_floor'=>__('Floor surface',[],$dictionnary),
            'contract.request.number_of_children'=>__('Number of children',[],$dictionnary),
            'contract.request.number_of_fiscal'=>__('Fiscal number',[],$dictionnary),
            'contract.request.energy'=>__('Energy',[],$dictionnary),
            'contract.request.occupation'=>__('Occupation',[],$dictionnary),
            'contract.request.layer_type'=>__('Type layer',[],$dictionnary),
         //   'contract.request.ana_prime'=>__('ANAH prime',[],$dictionnary),
         //   'contract.request.pack_quantity'=>__('Pack quantity',[],$dictionnary),
         //   'contract.request.boiler_quantity'=>__('Boiler quantity',[],$dictionnary),
        ));
    } 
 
   
    function sort()
    {       
        $this->getVariables()->asort();
        return $this;
    }
    
}


