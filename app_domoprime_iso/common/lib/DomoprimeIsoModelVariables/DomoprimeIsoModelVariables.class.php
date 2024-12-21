<?php


class DomoprimeIsoModelVariables extends UtilsModelVariables {
    
    
    function configure($dictionnary='dictionary')
    {        
        $this->variables=array(
            
              'contract.request.surface_wall'=>__("Wall surface",[],$dictionnary), 
              'contract.request.surface_floor'=>__("Floor surface",[],$dictionnary),  
              'contract.request.surface_top'=>__("Top surface",[],$dictionnary), 
              'contract.request.energy'=>__("Energy",[],$dictionnary), 
            
              'contract.request.install_surface_wall'=>__("Wall installation surface",[],$dictionnary),  
              'contract.request.install_surface_floor'=>__("Floor installation surface",[],$dictionnary),  
              'contract.request.install_surface_top'=>__("Top installation surface",[],$dictionnary),  
            
              'contract.request.parcel_surface'=>__("Parcel surface",[],$dictionnary),  
              'contract.request.parcel_reference'=>__("Parcel reference",[],$dictionnary),  
              'contract.request.revenue'=>__("Revenu",[],$dictionnary), 
              'contract.request.number_of_fiscal'=>__("Fiscal number",[],$dictionnary), 
              'contract.request.more_2_years'=>__("More 2 years",[],$dictionnary), 
              'contract.request.number_of_children'=>__("Number of children",[],$dictionnary), 
              'contract.request.number_of_people'=>__("Number of people",[],$dictionnary), 
              'contract.request.declarants'=>__("Declarants",[],$dictionnary), 
                  
              'contract.request.occupation'=>__("Occupation",[],$dictionnary),                        
            
              'contract.request.parcel_number'=>__("Parcel number",[],$dictionnary),
            
          /*   'contract.request.surface_ite'=>__("Surface ITE",[],$dictionnary), 
              'contract.request.boiler_quantity'=>__("Boiler quantity",[],$dictionnary),  
              'contract.request.pack_quantity'=>__("Pack quantity",[],$dictionnary), */
                        
        );
    } 
    
    
}


