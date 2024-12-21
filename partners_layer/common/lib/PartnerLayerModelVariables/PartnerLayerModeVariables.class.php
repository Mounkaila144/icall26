<?php


class PartnerLayerModelVariables extends UtilsModelVariables {
    
    
    function configure($dictionnary='dictionary')
    {
        $this->variables= array(
            'layer.name'=>__('layer','',$dictionnary,'partners_layer'),
            'layer.phone'=>__('phone','',$dictionnary,'partners_layer'),
            'layer.web'=>__('web','',$dictionnary,'partners_layer'),
            'layer.logo.url'=>__('logo','',$dictionnary,'partners_layer'),
            'layer.address1'=>__('address1','',$dictionnary,'partners_layer'),
            'layer.address2'=>__('address2','',$dictionnary,'partners_layer'),
            'layer.postcode'=>__('postcode','',$dictionnary,'partners_layer'),
            'layer.city'=>__('city','',$dictionnary,'partners_layer'),
            'layer.email'=>__('email','',$dictionnary,'partners_layer'),
            'layer.address'=>__('address','',$dictionnary,'partners_layer'),                    
            'layer.siret'=>__('siret','',$dictionnary,'partners_layer'),  
            'layer.comments'=>__('comments','',$dictionnary,'partners_layer'),  
         //   'layer.siret9'=>__('siren','',$dictionnary,'partners_layer'),  
        );
    } 
    
  
    
    
}


