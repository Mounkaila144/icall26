<?php


class CustomerModelEmailVariables extends UtilsModelVariables {
    
    
    function configure($dictionnary='dictionary')
    {
        $this->variables=  array(           
            'customer.name'=>__('name','',$dictionnary),
            'customer.firstname'=>__('firstname','',$dictionnary),
            'customer.lastname'=>__('lastname','',$dictionnary),
            'customer.mobile'=>__('mobile','',$dictionnary),            
            'customer.phone'=>__('phone','',$dictionnary),
            'customer.courtesy'=>__('courtesy','',$dictionnary),
            'customer.gender'=>__('gender','',$dictionnary),
            'customer.address.full'=>__('address','',$dictionnary),  
            'customer.mobile2'=>__('mobile 2','',$dictionnary),  
            'customer.email'=>__('email','',$dictionnary),  
            'customer.address.address1'=>__('address1','',$dictionnary),              
            'customer.address.address2'=>__('address2','',$dictionnary),       
            'customer.address.postcode'=>__('postcode','',$dictionnary),       
            'customer.address.city'=>__('city','',$dictionnary),     
        );
    } 
    
    
    
}


