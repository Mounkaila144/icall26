<?php


class CreatePasswordUserFormatterApi extends  mfFormatterApi{
    
    protected $data=array(),$item=null,$client=null,$form=null,$user=null;
    
    function __construct(User $item,$form) {
        $this->user = mfcontext::getInstance()->getUser();
        $this->item=$item;        
        $this->form=$form;        
        parent::__construct();
    }
        
    
    function getUser()
    {
        return $this->user;
    }
    
    function getItem() {
        
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
        if ($this->isFromTheme())                                          
            return $this->theme_api->getData(); 
        return array(
                     'password'=>array(
                         'label'=>__("Password"),
                         'properties'=>array(
                             "type"=>"password",
                             "size"=>"30"
                             )
                         ),                     
                     'repassword'=>array(
                         'label'=>__("Repassword"),
                         'properties'=>array(
                             "type"=>"password",
                             "size"=>"30"
                             )
                         ),                     
                    );
    }
    
    
    
    function process()
    {      
        try
        {
           
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
