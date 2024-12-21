<?php

require_once dirname(__FILE__)."/../locales/Forms/UserNewForm.class.php";


class users_ajaxNewUserAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {             
        $messages = mfMessages::getInstance();      
         if (!$this->getUser()->hasCredential(array(array('superadmin','admin','settings_user_new'))))
            $this->forwardTo401Action();
        try 
        {            
            $this->item = new User(null,'admin'); // new object          
            $this->form = new UserNewForm($this->getUser(),$request->getPostParameter('User'));   
            $this->getEventDispather()->notify(new mfEvent($this->form, 'user.new.config',$this->item)); 
            if ($request->isMethod('POST') && $request->getPostParameter('User')!=null)
            {                                       
                    $this->form->bind($request->getPostParameter('User'),$request->getFiles('User'));
                    if ($this->form->isValid()) 
                    {
                        $this->item->add($this->form->getValues());
                        $this->item->set('creator_id',$this->getUser()->getGuardUser());
                        if ($this->item->isExist())
                            throw new mfException (__("User already exists"));  
                         if ($this->form->getValue('password'))                                              
                             $this->item->encryptPassword();  
                      // echo "<pre>";  var_dump($this->item,$this->form->getValues());  echo "</pre>";
                        $this->item->save();                        
                        // Functions
                        $this->item->updateFunctions($this->form->getValue('functions')); 
                        // Functions
                        $this->item->updateGroups($this->form->getValue('groups'));
                        // Team
                        if ($this->form->getValue('team_id'))
                        {    
                            $team_user=new UserTeamUsers();
                            $team_user->add(array('user_id'=>$this->item,'team_id'=>$this->form->getValue('team_id')));
                            $team_user->save();
                        }
                        $messages->addInfo(__("User %s (%s) has been saved.",array($this->item,$this->item->get('username'))));
                        $this->getEventDispather()->notify(new mfEvent($this->item, 'user.change',['action'=>'new','form'=>$this->form])); 
                      //  $this->forward('users','ajaxListPartial');
                    }
                    else
                    {    
                       $this->item->add($request->getPostParameter('User'));
                       $messages->addError(__("Forms has some errors."));
                     //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
                    }               
           }      
       } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        $this->user_settings=  UserSettings::load();
    }

}
