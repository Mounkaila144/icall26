<?php

require_once dirname(__FILE__)."/../locales/Forms/UserNewForm.class.php";


class users_ajaxNewUserAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {             
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);      
        try 
        {
            $this->item = new User(null,'admin',$this->site); // new object
            $this->form = new UserNewForm($this->getUser()->getCountry(),$request->getPostParameter('User'),$this->site);   
            
          //  var_dump($this->form->groups);
            if ($request->isMethod('POST') && $request->getPostParameter('User')!=null)
            {                                       
                    $this->form->bind($request->getPostParameter('User'),$request->getFiles('User'));
                    if ($this->form->isValid()) 
                    {
                        $this->item->add($this->form->getValues());
                        if ($this->item->isExist())
                            throw new mfException (__("User already exists"));  
                        if ($this->form->getValue('password'))                                              
                             $this->item->encryptPassword();                           
                      //  var_dump($this->item); return ;
                        $this->item->save();                                                
                        // Functions
                        $this->item->updateFunctions($this->form['functions']->getValue()); 
                        // Functions
                        $this->item->updateGroups($this->form['groups']->getValue());    
                        // Team
                        if ($this->form->getValue('team_id'))
                        {    
                            $team_user=new UserTeamUsers(null,$this->site);
                            $team_user->add(array('user_id'=>$this->item,'team_id'=>$this->form->getValue('team_id')));
                            $team_user->save();
                        }
                        $messages->addInfo(__("User %s (%s) has been saved.",array($this->item,$this->item->get('username'))));
                        $this->getEventDispather()->notify(new mfEvent($this->item, 'user.change','new')); 
                        $this->forward('users','ajaxListPartial');
                    }
                    else
                    {    
                       $this->item->add($request->getPostParameter('User'));
                       $messages->addError(__("Forms has some errors."));
                    //   var_dump($this->form->getErrorSchema()->getErrorsMessage());
                    }               
           }      
       } 
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
    }

}
