<?php


class userGuard_ajaxGroupsAddPermissionsSaveAction  extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
     
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
        $this->forwardIf(!$site,"sites","ajaxAdmin");
         try 
      {
          $form=new addPermissionsGroupForm($request->getPostParameter('permissions'),'admin',$site);
          $form->bind($request->getPostParameter('permissions'));
          if ($form->isValid())
          {
              $group=new Group($form->getValue('group_id'),'admin',$site);
              if ($group->isLoaded())
              {   
                $groupPermissions = new GroupPermissionCollection($form->getValue('permissions'),'admin',$site);  
                $groupPermissions->save();
                $messages->addInfo(__("permissions added on group [%s].",$group));
                $request->addRequestParameter('group', $group);
                $this->forward('userGuard','ajaxGroupsPermissionsList');   
              }  
          }    
          else
          {
              $messages->addErrors($form->getErrorSchema()->getErrors());
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->forward('userGuard','ajaxGroupsListPartial');   
      return mfView::NONE;
    }

}