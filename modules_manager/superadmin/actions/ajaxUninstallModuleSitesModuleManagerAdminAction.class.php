<?php

class modules_manager_ajaxUninstallModuleSitesModuleManagerAdminAction extends mfAction {
           
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {
          
      /*    $post=array('sites' =>array('1','9','545','898'),
                     // 'sites' =>array('test.ewebsolutions.fr','test2.ewebsolutions.fr'),
                      'module' => 1,
                      'token' => '116fea1caa832e859d77c3cba44f54d6'); */
          $form=new moduleSitesForm($request->getPostParameter('modules'));
        //  $form->bind($post);
          $form->bind($request->getPostParameter('modules'));
          if ($form->isValid())
          {     
             $response=array("info"=>array());
             foreach ($form['sites']->getValue() as $site)
             {                
                 $moduleAdmin=$form['module']->getValue();   
                 // TODO Not take $module from table (if table doesn't exist) ??
                 $module=new moduleManager($moduleAdmin->get('name'),$site);                                                      
                 if ($module->isNotLoaded() || $module->getModule()->isNotInstalled())
                 {
                     $status=__("not installed");            
                 }  
                 else
                 {
                     $module->getModule()->getInstaller()->uninstall();                      
                     $module->set('status','loaded');
                     $module->set('is_active','NO');
                     $module->save(); 
                     $module->getModule()->removeConfigCache();
                     $this->getContext()->getEventManager()->notify(new mfEvent($module, 'module.manager.uninstalled'));
                     $status=__("uninstalled");
                 }                               
                $response['info'][]=__('module {module} is {status} on site [{site}]',array("module"=>$moduleAdmin->get('name'),"status"=>$status,"site"=>$site->get('site_host')));
                
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
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

