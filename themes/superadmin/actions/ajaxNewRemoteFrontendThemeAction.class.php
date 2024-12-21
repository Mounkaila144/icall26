<?php

/*
 * Créer le ftp + directory
 */
class NewRemoteFrontendThemeForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'theme'=>new mfValidatorName(),
            'login'=>new mfValidatorString(array('max_length'=>3)),
            'password'=>new mfValidatorString(),
            ));
    }
    
}

class themes_ajaxNewRemoteFrontendThemeAction extends mfAction {
       
    
    function execute(mfWebRequest $request)
    {
           $messages = mfMessages::getInstance();  
           $this->form=new NewRemoteFrontendThemeForm($request->getPostParameter('Theme'));
           if (!$request->getPostParameter('Theme') || !$request->isMethod('POST'))
               return;               
           $this->form->bind($request->getPostParameter('Theme'));
           if ($this->form->isValid())
           {
                try
                {
                    $theme=new ThemeCore((string)$this->form['theme'],'frontend');
                    $theme->create();                    
                    $soap=new SoapOvh();
                    $soap->login();                     
                    $soap->multiFtpAdd($this->getRequest()->getSite()->getHostName(),
                                       "/www/sites/themes/frontend/".(string)$this->form['theme'],
                                       (string)$this->form['login'],
                                       (string)$this->form['password']
                                     );
                    $soap->logout();
                    $messages->addInfo(__('remote theme has been created.'));
                    $this->forward('themes','ajaxListPartial');
                }
                catch (SoapFault $e)
                {
                    $messages->addError($e);
                }
           }         
    }
}

