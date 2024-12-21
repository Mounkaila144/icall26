<?php


class UserProfileNewFormatterApi extends mfFormatterApi {
    
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
                    'username'=>array(
                        'label'=>__("username"),
                        'properties'=>(!$this->getUser()->hasCredential([['superadmin','admin','settings_user_modify']]))?array("disabled"=>"disabled"):array()
                        ),
                    'lastname'=>array(
                        'label'=>__("lastname"),
                        'properties'=>(!$this->getUser()->hasCredential([['superadmin','admin','settings_user_modify']]))?array("disabled"=>"disabled"):array()
                        ),
                    'firstname'=>array(
                        'label'=>__("firstname"),
                        'properties'=>(!$this->getUser()->hasCredential([['superadmin','admin','settings_user_modify']]))?array("disabled"=>"disabled"):array()
                        ),
                    'email'=>array(
                         'label'=>__("email"),
                         'properties'=>(!$this->getUser()->hasCredential([['superadmin','admin','settings_user_modify']]))?array("disabled"=>"disabled"):array()
                         ),
                    'mobile'=>array(
                         'label'=>__("mobile"),
                         'properties'=>(!$this->getUser()->hasCredential([['superadmin','admin','settings_user_modify']]))?array("disabled"=>"disabled"):array()
                         ),              
                    'password'=>array(
                         'label'=>__("password"),
                         'properties'=>(!$this->getUser()->hasCredential([['superadmin','admin','settings_user_modify']]))?array("disabled"=>"disabled"):array()
                         ),
                    'repassword'=>array(
                         'label'=>__("repassword"),
                         'properties'=>(!$this->getUser()->hasCredential([['superadmin','admin','settings_user_modify']]))?array("disabled"=>"disabled"):array()
                         ),
                    'sex'=>array(
                         'label'=>__("title"),
                         'properties'=>(!$this->getUser()->hasCredential([['superadmin','admin','settings_user_modify']]))?array("disabled"=>"disabled"):array()
                         ),
                    'team_id'=>array('label'=>__('Team'),
                                     'condition'=> $this->getForm()->hasValidator('team_id')
                                        ),             
                    'manager_id'=>array('label'=>__('Manager'),
                                     'condition'=> $this->getForm()->hasValidator('manager_id')
                                        ),                                                                                                                
                    'profile_id'=>array('label'=>__('Profile'),
                                     'condition'=> $this->getForm()->hasValidator('profile_id')
                                        ),                                                                                            
                    'company_id'=>array('label'=>__('Company'),
                                     'condition'=> $this->getForm()->hasValidator('company_id')
                                        ),                                               
                    'is_secure_by_code'=>array('label'=>__('Confirm By Code'),
                                     'condition'=> $this->getForm()->hasValidator('is_secure_by_code')
                                        ),                                               
                    'callcenter_id'=>array('label'=>__('Callcenter'),
                                     'condition'=> $this->getForm()->hasValidator('callcenter_id')
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

