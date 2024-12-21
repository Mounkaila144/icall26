<?php

class UserNewFormatterApi2 extends mfFormatterApi2 {
    
    protected $data=array(),$item=null,$client=null,$form=null,$user=null;
    
    function __construct($form) {
        $this->user = $form->getUser();
        $this->item=new User(null,'admin');        
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
          
    function process()
    {               
        try 
        {                                 
            if ($this->getForm()->isValid()) 
            {              
                $this->getItem()->add($this->getForm()->getValues());
                if ($this->getItem()->isExist())
                    throw new mfException(__("User already exists"));  
              //  if(!$this->getForm()->getProfile())       
              //      throw new mfException(__("Profile doesn't exist"));  
                if ($this->getForm()->getValue('password'))                                              
                     $this->getItem()->encryptPassword();                                
                $this->getItem()->save();                   
                if ($this->getForm()->getValue('team_id'))
                {    
                    $team_user=new UserTeamUsers();
                    $team_user->add(array('user_id'=>$this->getItem(),'team_id'=>$this->getForm()->getValue('team_id')))->save();
                }                         
                mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getItem(), 'user.change','new')); 
                return $this->data['id']=$this->getItem()->get('id');
            }
            else
            {                   
               if (!$this->getForm()->getNotCheckedValues())
                    return $this->data['errors']=__('Data is empty');              
               return $this->data['errors']=$this->getForm()->getErrorSchema()->getErrorsMessage();            
            }          
   
        }
        catch (mfException $e)
        {
            $this->data['errors']=$e->getMessage();
        }       
        return $this;
    }



}

