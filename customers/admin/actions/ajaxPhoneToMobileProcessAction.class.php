<?php


class customers_ajaxPhoneToMobileProcessAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {                                    
                $messages->addInfo(__("%s Phones has been transferred to free mobiles",CustomerUtils::transferPhonesToMobile()));        
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->forward($this->getModuleName(), 'ajaxListPartial');
    }
}


