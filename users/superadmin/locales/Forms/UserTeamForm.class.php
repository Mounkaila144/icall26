<?php


class UserTeamForm extends UserTeamBaseForm {
                
       function configure()
       {
           parent::configure();
           $this->setValidator('manager_id',new mfValidatorChoice(array('key'=>true,'choices'=>array(0=>"Not defined")+UserUtils::getUsersByFunctionsForSelect(array('TELEPROMANAGER','SALEMANAGER'),$this->getSite()),'required'=>false)));           
         //  var_dump($this->manager_id->getOption('choices'),$this->getSite());
       }
}

