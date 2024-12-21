<?php

class UserViewFormatterApi extends mfFormatterApi {
    
     protected $data=array(),$item=null,$client=null;
    
    function __construct(User $item,$form) {
        $this->item=$item;
        $this->form=$form;           
        parent::__construct();      
    }
        
    function getItem()
    {
        return $this->item;
    }
    
    function getForm()
    {
        return $this->form;
    }
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new UserSettings():$this->settings;
    }                            
    
    function getData()
    {       
        
        if ($this->isFromTheme() && get_called_class()==__CLASS__)                                          
            return $this->theme_api->getData();          
        return array(
                     'id'=>array('style'=>'display:none'),
                     'username'=>array('label'=>__("Username")),
                     'company_id'=>array('label'=>__('Company'),                                                                       
                                        'default'=>__('No company'),
                                        'method'=>'Company',
                                      //  'flatten'=>array(),
                                       //  'condition'=>$this->getForm()->hasValidator('company_id')
                                        ),                        
                     'firstname',
                     'lastname',
                     'email',
                   //  'sex'=>array('label'=>__('Title'),"properties"=>(!$this->getUser()->hasCredential([['superadmin','admin','settings_user_modify']])?""=>"":"")),
            
                    
                   //  'created_at'=>array('format'=>array('method'=>'CreatedAt','output'=>array('method'=>'Formatted','options'=>'d'))),  // formatter
                   //  'created_at'=>array('output'=>'')   // method in object 
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
            $this->data['schema']=$this->getForm()->getMapping()->getValues()->toArray();     
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

