<?php

class UserViewProfileFormatterApi extends mfFormatterApi {
    
     protected $data=array(),$item=null,$client=null;
    
    function __construct(User $item) {
        $this->item=$item;
        parent::__construct();      
    }
        
    function getItem()
    {
        return $this->item;
    }
                               
    
    function getData()
    {       
        
        if ($this->isFromTheme() && get_called_class()==__CLASS__)                                          
            return $this->theme_api->getData();          
        return array(
                    'id'=>array(
                        'label'=>__("id"),
                        //'style'=>array("display"=>"none")
                        ),
                    'username'=>array(
                        'label'=>__("username"),
                        ),
                    'lastname'=>array(
                        'label'=>__("lastname"),
                        ),
                    'firstname'=>array(
                        'label'=>__("firstname"),
                        ),
                    'email'=>array(
                         'label'=>__("email"),
                         ),
                    'mobile'=>array(
                         'label'=>__("mobile"),
                         ),              
                    'password'=>array(
                         'label'=>__("password"),
                         'type'=>'password',
                         ),
                    'profile'=>array(
                        'label'=>__("profile"),                        
                        'format'=>array(   
                            'method'=>'ProfileI18n'
                        ),
                    ),
                    'groups'=>array(
                         'label'=>__("groups"),
                         'format'=>array(   
                                'method'=>'GroupNames'
                          ),
                         ),                                             
                    );
    }
    
    
    
    function process()
    {        
        try
        {
            if ($this->getItem()->isNotLoaded())
                throw new mfException('Item is invalid');
            
            $this->loadTheme();
            
            parent:: process();            
           // $this->data['schema']=$this->getForm()->getMapping()->getValues()->toArray(); 
           /*  $index=0;
             foreach ($this->getData() as $field=>$options)
             {
                 if (!$this->getForm()->getMapping()->hasItemByKey(is_numeric($field)?$options:$field))
                         continue;
                 $this->data['data'][$index++]['schema']=$this->getForm()->getMapping()->getItemByKey(is_numeric($field)?$options:$field);
             } */   
        }
        catch (mfException $e)
        {
            $this->data['errors']=$e->getMessage();
        }       
        return $this;
    }
    
    
    
   
}

