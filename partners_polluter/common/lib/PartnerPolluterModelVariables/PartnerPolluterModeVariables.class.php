<?php


class PartnerPolluterModelVariables extends UtilsModelVariables {
    
    
    function configure($dictionnary='dictionary')
    {
        $this->variables= array(
            'polluter.name'=>__('polluter','',$dictionnary,'partners_polluter'),
            'polluter.phone'=>__('phone','',$dictionnary,'partners_polluter'),
            'polluter.web'=>__('web','',$dictionnary,'partners_polluter'),
            'polluter.logo.url'=>__('logo','',$dictionnary,'partners_polluter'),
            'polluter.address1'=>__('address1','',$dictionnary,'partners_polluter'),
            'polluter.address2'=>__('address2','',$dictionnary,'partners_polluter'),
            'polluter.postcode'=>__('postcode','',$dictionnary,'partners_polluter'),
            'polluter.city'=>__('city','',$dictionnary,'partners_polluter'),
            'polluter.email'=>__('email','',$dictionnary,'partners_polluter'),
            'polluter.address'=>__('address','',$dictionnary,'partners_polluter'),                    
            'polluter.siret'=>__('siret','',$dictionnary,'partners_polluter'),  
        );
    } 
    
  
    
    
}


