<?php


class customers_forgotPasswordConfirmAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {        
         $messages = mfMessages::getInstance();
         try 
         {             
           if (!$request->isMethod('GET')) 
                throw new mfException(__('This key is invalid.'));            
            $validator=new KeyForgotPasswordValidator();
            $forgot= new CustomerUserForgotPassword($validator->isValid($request->getGetParameter('k')));                              
            if ($forgot->isNotLoaded())
                 throw new mfException(__('This key is invalid.'));                    
            $this->user=new CustomerUser($forgot->get('user_id'));
            $this->user->set('password',$forgot->get('password'));
            $this->user->save();                                                                                
            $forgot->delete(); 
            $this->model=CustomerSettings::load()->getForgotPasswordConfirmTextModel();             
        } 
        catch (mfValidatorError $e)
        {
           $this->forward('customers','forgotPassword');
        }
        catch (mfException $e) {
            $messages->addError($e);
            $this->forward('customers','forgotPassword');
        }
        
    }
    
 
   
}


