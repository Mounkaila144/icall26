<?php

class ProductItemFormatterApi extends mfFormatterFilterItemApi  {        
     
    function getDefaultsData()
    {
        return $this->getItem()->toArray(array());
    }
    
    function getData()
    {    
        if ($this->isFromThemeFormatter())       
        {                                                 
            return $this->theme_formatter_api->getData();                 
        }
        /*return array(  'id'=>array('properties'=>array('style'=>'display:none'),
                                    'label'=>__('id')
                                  ),
                       "line1"=>array(                           
                            'fields'=>array(                                                             
                                'is_active'=>array('label'=>__('State'),
                                                    'choices'=>array(
                                                        array(
                                                            'value'=>'YES',
                                                            'icon'=>'ion-icon-checkmark-outline',
                                                            'color'=>'green'
                                                        ),
                                                        array(
                                                            'value'=>'NO',
                                                            'icon'=>'ion-icon-close-outline',
                                                            'color'=>'red'
                                                        ),
                                                        
                                                    )
                                    ),                                
                                'meta_title'=>array('label'=>__('Metatitle')),
                                'mark'=>array('label'=>__('Mark')),
                                'description'=>array('label'=>__('Description')),
                            ),                                                      
                       ),
                       
                       "line2"=>array(
                            'fields'=>array(                                                              
                                
                            ),                                                      
                       ),
                       
                       "line3"=>array(
                            'fields'=>array(                                                              
                            
                            ),                                                      
                       ),
                       "line4"=>array(
                            'fields'=>array(                                                              
                                       
                            ),                                                      
                        ),
                             
                                                    
            
                 
                    );*/
    }
    
    
    function process()
    {
        ///$this->loadTheme();
        parent::process();
        return $this;
    }
  
}
