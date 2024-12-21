<?php


class UserTeamForm extends UserTeamBaseForm {
                
        function configure()
    {
        parent::configure();
        $managers=UserUtils::getUsersByFunctionsForSelect(array('TELEPROMANAGER','SALEMANAGER'));
        $this->setValidator('manager_id',new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>"Not defined")+$managers,'required'=>false)));        
        if (UserSettings::load()->hasManager2())
            $this->setValidator('manager2_id',new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>"Not defined")+$managers,'required'=>false)));        
    }
}

