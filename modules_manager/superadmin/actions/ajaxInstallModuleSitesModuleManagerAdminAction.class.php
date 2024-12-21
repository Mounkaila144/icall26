<?php

class modules_manager_ajaxInstallModuleSitesModuleManagerAdminAction extends mfAction {
           
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {
          // TODO Not take $module from table (if table doesn't exist) ??
         /* $post=array(//'sites' =>array('545','898'),
                     // 'sites' =>array('test.ewebsolutions.fr','test2.ewebsolutions.fr'),
                      'module' => 1,
                      'token' => '2b25de5c10d788ec713d71b2f5333ae4'); */
          $form=new moduleSitesForm($request->getPostParameter('modules'));
          $form->bind($request->getPostParameter('modules'));
        //   $form=new moduleSitesForm($post);  $form->bind($post);
          if ($form->isValid())
          {                 
             $response=array("info"=>array());
             foreach ($form['sites']->getValue() as $site)
             {                
                 $moduleAdmin=$form['module']->getValue();                           
                 $module=new moduleManager($moduleAdmin->get('name'),$site);                                  
                 if ($module->isNotLoaded())
                 {
                    $module->set('title',$moduleAdmin->get('title'));
                    $module->set('description',$moduleAdmin->get('description'));  
                    $module->set('logo',$moduleAdmin->get('logo')); 
                    $module->set('type',$moduleAdmin->get('type'));                
                 }          
               //  var_dump($module->getModule()->getInstaller());
                 
                if (!$module->getModule()->getInstaller()->isUpToDate())
                {                        
                    $module->getModule()->getInstaller()->upGrade();                
                    $module->set('status','installed');
                    $module->save();        
                    $this->getContext()->getInstance()->getEventManager()->notify(new mfEvent($module, 'module.manager.upgraded'));
                    $status=__("upgraded to version [%s]",implode(",",$module->getModule()->getInstaller()->getVersionsUpgraded()));
                }
                else
                    $status=__("up to date (version [%s])",$module->getModule()->getInstaller()->getSiteLastVersion());               
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

