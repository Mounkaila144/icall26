<?php


class UserTeamNewForm extends UserTeamBaseForm {
                
    
    function configure()
    {
        parent::configure();
        $this->setValidator('manager_id',new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>"Not defined")+UserUtils::getUsersByFunctionsForSelect(array('TELEPROMANAGER','SALEMANAGER'),$this->getSite()),'required'=>false)));
        unset($this['id']); 
    }
}

