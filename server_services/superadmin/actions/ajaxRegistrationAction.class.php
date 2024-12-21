<?php

class ServerRegistrationForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            //'host'=>new mfValidatorDomain(),
            'name'=>new mfValidatorString(),             
            'password'=>new mfValidatorString(),
            'master_host'=>new mfValidatorDomain(),
            'master_password'=>new mfValidatorString(),
        ));
    }
    
    function getValues()
    {
        $values=parent::getValues();
        $values['services']= 'services';
        $values['ip']= mfConfig::getSuperAdmin('ip');
        $values['host']= mfConfig::getSuperAdmin('host');
        return $values;
    }
    
    function getMasterServer()
    {
        return new SiteServicesServer(array(
            'host'=>$this->getValue('master_host'),            
            'login_service'=>'services',
            'password'=>$this->getValue('master_host'),    
        ));
    }
}

class server_services_ajaxRegistrationAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();                     
        $this->settings= new ServerServicesSettings();        
        $this->form=new ServerRegistrationForm();          
        if (!$request->isMethod('POST') || !$request->getPostParameter('ServerRegistration'))
            return ;
            try 
            {               
                $this->form->bind($request->getPostParameter('ServerRegistration'));
                if ($this->form->isValid())
                {
                    var_dump($this->form->getValues());
                     $api=new iCall26ServerServiceApi(new SiteServicesServer());            
                    $api->ping();  
                    if ($api->hasErrors())
                throw new mfException(__('No answer from host'));  
                    $messages->addInfo(__("Server has been registered."));                    
                }
                else
                {
                    $messages->addError(__('Form has some errors.'));
                    var_dump($this->form->getErrorSchema()->getErrorsMessage());
                  $this->settings->add($request->getPostParameter('ServerRegistration')); // Repopulate
                }  
            }
            catch (mfException $e)
            {
              $messages->addError($e);
            }
       
    }

}
