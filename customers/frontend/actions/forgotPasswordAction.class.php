<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerForgotPasswordForm.class.php";

class customers_forgotPasswordAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->form=new CustomerForgotPasswordForm($request->getPostParameter('ForgotPassword'));          
        if (!$request->isMethod('POST') || !$request->getPostParameter('ForgotPassword')) 
             return ;
        try 
        {
            $this->form->bind($request->getPostParameter('ForgotPassword'));
            if ($this->form->isValid()) {                   
                $user = $this->form->getValue('user');                   
                CustomerUserForgotPassword::cleanup($user);
                $forgot_password = new CustomerUserForgotPassword();
                $forgot_password->generateKeyAndPasswordForUser($user);   
                try 
                {
                    $model=CustomerSettings::load()->getForgotPasswordEmailModel();                        
                    $company=SiteCompany::getSiteCompany();
                    if ($model->getI18n()->isNotLoaded())
                        throw new mfException(__("Email Model doesn't exist."));
                  //  $this->getMailer()->debug();
                    $this->getMailer()->sendMail('customers','emailForgotPassword',
                                  array($company->get('email')=>$company->get('name')),
                                  $user->get('email'),$model->getI18n()->get('subject'),
                                  array('forgotpassword'=>$forgot_password->toArray(),
                                        'model_i18n'=>$model->getI18n(),
                                        'user'=>$user->toArray()
                                        )                                                   
                             );         
                     $email=new CustomerEmailSent();
                     $email->setModelAndUser($model,$this->getMailer()->getContent(),$user);                                        
                     $request->addRequestParameter('email',$user->get('email'));
                     $this->forward("customers", "forgotPasswordSent");
                } catch (Swift_TransportException $e) {
                    $messages->addError($e);
                } catch (Swift_MimeException $e) {
                    $messages->addError($e);
                } 
            }             
        } catch (mfException $e) {
            $messages->addError($e);
        }       
    }
    
 
   
}


