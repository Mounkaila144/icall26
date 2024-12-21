<?php

class GenerateCoordinatesFromFilterForm extends mfForm {
    
    function configure()
    {
        $this->setDefault('forced',false);
        $this->setValidators(array(
            'forced'=>new mfvalidatorBoolean(array('empty_value'=>false))
        ));
    }
}
class customers_contracts_ajaxGenerateCoordinatesFromFilterAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();
      try 
      {   
        $filter= new CustomerContractsFormFilter($this->getUser());  
        $filter->bind($request->getPostParameter('filter'));
        if (!$filter->isValid())
           throw new mfException(__("Filter has some errors."))    ;
        $form=new GenerateCoordinatesFromFilterForm();
        $form->bind($request->getPostParameter('GenerateCoordinates'));            
        $msgs=CustomerContractUtils::generateCoordinatesFromContractFilter($filter,$form['forced']->getValue());        
        $response=array('info'=>(string)$msgs->implode(','));
        SystemDebug::getInstance()->trace(date("Y-m-d H:i:s").":Contract:GenerateCoordinatesFromFilter [".(string)$this->getUser()->getGuardUser()."] ");
      } 
      catch (mfException $e) {
           $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

