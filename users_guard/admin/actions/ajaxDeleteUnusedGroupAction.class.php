<?php

class users_guard_ajaxDeleteUnusedGroupAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();   
      try 
      {   
          $groups_deleted= GroupUtilsBase::deleteGroupUnusedByUser();
          if ($groups_deleted->isEmpty())
            $messages->addInfo(__("No group to delete.")); 
          else
            $messages->addInfo(__("Unused groups [%s] have been deleted.",$groups_deleted->implode()));                    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }   
      $this->forward('users_guard','ajaxListPartialGroup');
    }
}

